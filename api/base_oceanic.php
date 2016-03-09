<?php
function instanceofs($obj, $arr_obj)
{
    foreach ($arr_obj as $class_name)
    {
        if (!($obj instanceof $class_name))
            return false;
    }
    return true;
}

function apply_auth($action, $field_values, $obj, $session)
{
    $level = $session['level'];
    $org_id = empty($session['org_id']) ? 0 : $session['org_id'];
    $org_lvl = array('EMPLOYEES', 'SUPERVISORS', 'HR MANAGERS');
    $emp_id = empty($session['employee_id']) ? 0 : $session['employee_id'];

    if(in_array($level, array('EMPLOYEES', 'SUPERVISORS', 'HR MANAGERS')) && empty($org_id) && empty($emp_id))
    {
        exit(response_to_json(array("401", "Login Data Required!")));
    }

    if (in_array($action, array('view', 'add')) && in_array($level, array('EMPLOYEES', 'SUPERVISORS', 'HR MANAGERS')) && !empty($org_id))
    {
        $field_values['org_id'] = $org_id;

        if (instanceofs($obj, array('BaseOceanicForm')))
        {
            if ('add' == $action || ('view' == $action && 'EMPLOYEES' == $level))
            {
                $field_values['employee_id'] = $emp_id;
            }
        }
        // else if ($obj instanceof Employee && 'view' == $action && 'EMPLOYEES' == $level)
        // {
        //     $field_values['employee_id'] = $emp_id;
        // }
    }

    return array($action, $field_values);
}

function base_process_request($obj_to_use)
{
    $sess_user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL);
    $sess_level = (isset($_SESSION['level']) ? $_SESSION['level'] : '');
    $response = array("401", "Login Required!");
    if (empty($sess_user_id))
    {
        return response_to_json($response);
    }

    $response = array('402', "Incomplete Parameters!");
    if (empty($_POST))
    {
        return response_to_json($response);
    }

    // needs separate var because special
    $action = (isset($_POST['action']) ? $_POST['action'] : NULL);
    if (empty($action))
    {
        return response_to_json($response);
    }

    $response = array("401", "You dont have a permission on this module!");

    $tools = new Tools($_POST);
    $_POST = $tools->PreparePost();

    $obj = new $obj_to_use(connect());

    $fields_to_get = array_keys($obj->columns);
    $now = date('Y-m-d H:i:s');
    $field_values = get_field_values_from_post($fields_to_get, $_POST);

    list($action, $field_values) = apply_auth($action, $field_values, $obj, $_SESSION);

    switch($action)
    {
        case 'add':
            $response = array('403', "Records already existing!");

            if (!$obj->isExisting($field_values))
            {
                $field_values['created_by'] = $_SESSION['user_id'];
                $field_values['dt_created'] = $now;
                $insert_id = $obj->createData($field_values);

                if (!empty($insert_id))
                {
                    $response = array('OK', "Record $insert_id Inserted");
                }
            }
            break;

        case 'edit':
            $primary_id_name = $obj->primary_id_name;

            $response = array('402', "Incomplete Parameters!");
            if (array_key_exists($primary_id_name, $field_values))
            {

                $response = array('403', "No records found on the database!");
                if ($obj->isExisting($field_values, true))
                {
                    $field_values['modified_by'] = $_SESSION['user_id'];
                    $field_values['dt_last_modified'] = $now;
                    $obj->updateData($field_values[$primary_id_name], $field_values);
                    $response = array('OK', "Record Updated");
                }
            }
            break;

        case 'delete':
            $primary_id_name = $obj->primary_id_name;
            $response = array('402', "Incomplete Parameters!");

            if (array_key_exists($primary_id_name, $field_values))
            {
                $obj->deleteData($field_values[$primary_id_name]);
                $response = array('OK', "Record Deleted");
            }
            break;

        case 'view':
            if (0 < count(array_keys($field_values)))
            {
                $filter = $field_values;
                $list = $obj->viewDataByFilter($filter);
            }
            else
            {
                $list = $obj->viewData();
            }
            $response = array('200', $list);
            break;

        case 'view-id':
            $primary_id_name = $obj->primary_id_name;
            $list = array();

            if (array_key_exists($primary_id_name, $field_values))
            {
                $list = $obj->viewDataById($field_values[$primary_id_name]);
            }
            $response = array('200', $list);
            break;
        case 'approve':
            if ($obj instanceof BaseOceanicForm && in_array($sess_level, array('SUPERVISORS', 'HR MANAGERS')))
            {
                $obj->approve($field_values[$obj->primary_id_name]);
                $response = array('OK', "Record Updated");
            }
            break;

        case 'reject':
            if ($obj instanceof BaseOceanicForm && in_array($sess_level, array('SUPERVISORS', 'HR MANAGERS')) &&
                array_key_exists('reject_reason', $field_values))
            {
                $obj->reject($field_values[$obj->primary_id_name], $field_values['reject_reason']);
                $response = array('OK', "Record Updated");
            }
            break;
        case 'view-heads':
            if ($obj instanceof Department)
            {
                $list = $obj->viewDepartmentHeads();
                $response = array('200', $list);
                break;
            }
    }

    return response_to_json($response);
}
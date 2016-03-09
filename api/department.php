<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/department.php';

$obj_to_use = "Department";

// very unique because of view dept heads
$json = base_process_request($obj_to_use);

// $sess_user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL);
// $response = array("401", "Login Required!");
// if (empty($sess_user_id))
// {
//     return response_to_json($response);
// }

// $response = array('402', "Incomplete Parameters!");
// if (empty($_POST))
// {
//     return response_to_json($response);
// }

// // needs separate var because special
// $action = (isset($_POST['action']) ? $_POST['action'] : NULL);
// if (empty($action))
// {
//     return response_to_json($response);
// }

// $response = array("401", "You dont have a permission on this module!");

// $tools = new Tools($_POST);
// $_POST = $tools->PreparePost();

// $obj = new $obj_to_use(connect());

// $fields_to_get = array_keys($obj->columns);
// $now = date('Y-m-d H:i:s');
// $field_values = get_field_values_from_post($fields_to_get, $_POST);

// switch($action)
// {
//     case 'add':
//         $response = array('403', "Records already existing!");

//         if (!$obj->isExisting($field_values))
//         {
//             $field_values['created_by'] = $_SESSION['user_id'];
//             $field_values['dt_created'] = $now;
//             $insert_id = $obj->createData($field_values);

//             if (!empty($insert_id))
//             {
//                 $response = array('OK', "Record $insert_id Inserted");
//             }
//         }
//         break;

//     case 'edit':
//         $primary_id_name = $obj->primary_id_name;
//         $response = array('402', "Incomplete Parameters!");

//         if (array_key_exists($primary_id_name, $field_values))
//         {
//             $response = array('403', "No records found on the database!");
//             if ($obj->isExisting($field_values, true))
//             {
//                 $field_values['modified_by'] = $_SESSION['user_id'];
//                 $field_values['dt_last_modified'] = $now;
//                 $obj->updateData($field_values[$primary_id_name], $field_values);
//                 $response = array('OK', "Record Updated");
//             }
//         }
//         break;

//     case 'delete':
//         $primary_id_name = $obj->primary_id_name;
//         $response = array('402', "Incomplete Parameters!");

//         if (array_key_exists($primary_id_name, $field_values))
//         {
//             $obj->deleteData($field_values[$primary_id_name]);
//             $response = array('OK', "Record Deleted");
//         }
//         break;

//     case 'view':
//         $list = $obj->viewData();
//         $response = array('200', $list);
//         break;

//     case 'view-id':
//         $primary_id_name = $obj->primary_id_name;
//         $list = array();

//         if (array_key_exists($primary_id_name, $field_values))
//         {
//             $list = $obj->viewDataById($field_values[$primary_id_name]);
//         }
//         $response = array('200', $list);
//         break;

//     case 'view-heads':
//         $list = $obj->viewDepartmentHeads();
//         $response = array('200', $list);
//         break;

// }
// $json = response_to_json($response);

exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/department.php');
// require_once('database/dbtools.php');
// if (!empty($_POST))
// {
// 	$conn = connect();
// 	$Tools = new Tools ($_POST);
// 	$_POST = $Tools->PreparePost();

// 	$profile_id = $_SESSION['user_id'];
// 	if (empty($profile_id))
// 	{
// 		$json['code'] = "401";
// 		$json['response'] = "Login Required!";
// 	}
// 	else
// 	{
// 		// check parameters
// 		$action      = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$dept_code   = (isset($_POST['dept_code']) ? strtolower($_POST['dept_code']) : NULL);
// 		$name        = (isset($_POST['name']) ? strtolower($_POST['name']) : NULL);
// 		$location_id = (isset($_POST['location_id']) ? strtolower($_POST['location_id']) : NULL);
// 		$headed_by   = (isset($_POST['headed_by']) ? strtolower($_POST['headed_by']) : NULL);
// 		$division_id = (isset($_POST['division_id']) ? strtolower($_POST['division_id']) : NULL);
// 		//echo '<pre>';
// 		//print_r($_POST);
// 		//exit();
// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$department = new Department($conn, $dept_code, $name, $location_id, $headed_by, $division_id);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if dept_code exist
// 						if ($department->checkDeptCode() == '')
// 						{
// 							// insert records
// 							$insertId = $department->CreateDept();
// 							$json['code'] = "OK";
// 							$json['response'] = " $insertId Inserted";
// 						}
// 						else
// 						{
// 							$json['code'] = "403";
// 							$json['response'] = "Records already existing!";
// 						}
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'edit':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if has dept id
// 						$dept_id = (isset($_POST['dept_id']) ? strtolower($_POST['dept_id']) : NULL);
// 						if ($dept_id != '')
// 						{
// 							// check if dept_id exists
// 							if ($department->checkDeptId($dept_id))
// 							{
// 								$department->UpdateDept($dept_id);
// 								$json['code'] = "OK";
// 								$json['response'] = "Record Updated";
// 							}
// 							else
// 							{
// 								$json['code'] = "403";
// 								$json['response'] = "Invalid Department Id!";
// 							}
// 						}
// 						else
// 						{
// 							$json['code'] = "403";
// 							$json['response'] = "No records found on the database!";
// 						}

// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'delete':
// 					$dept_id = (isset($_POST['dept_id']) ? strtolower($_POST['dept_id']) : NULL);

// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$department->DeleteRecord($dept_id);
// 						$json['code'] = "OK";
// 						$json['response'] = "Record Deleted";
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'view':
// 					// check if has access, only hr managers can add
// 					$keyword = (isset($_POST['keyword']) ? strtolower($_POST['keyword']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $department->viewDepartments($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'view-id':
// 					// check if has access, only hr managers can add
// 					$dept_id = (isset($_POST['dept_id']) ? strtolower($_POST['dept_id']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $department->viewDepartmentById($dept_id);
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'view-heads':
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $department->viewDepartmentHeads();
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				default:
// 					$json['code'] = "403";
// 					$json['response'] = "You dont have a permission on this module!";
// 					break;
// 			}
// 		}

// 	}
// }
// $json = json_encode($json);
// echo $json;
?>

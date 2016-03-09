<?php
class OtForm extends BaseOceanicForm
{
    public function __construct($conn)
    {
        $this->session = $_SESSION;
        $columns = array(
            'ot_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'ot_start' => 'timestamp',
            'ot_end' => 'text',
            'total_hours' => 'text',
            'reason' => 'text',
            'output' => 'text',
            'status' => 'text',
            'sup_approved_by' => 'integer',
            'sup_approved_date' => 'timestamp',
            'sup_rejected_by' => 'integer',
            'sup_rejected_date' => 'timestamp',
            'man_approved_by' => 'integer',
            'man_approved_date' => 'timestamp',
            'man_rejected_by' => 'integer',
            'man_rejected_date' => 'timestamp',
            'reject_reason' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = array(array('employee_id', 'ot_start', 'total_hours'));
        $viewable = array_keys($columns);
        unset($viewable['created_by']);
        unset($viewable['dt_created']);
        unset($viewable['modified_by']);
        unset($viewable['dt_last_modified']);

        $searchable = $viewable;
        unset($searchable['ot_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);

        $required = array('employee_id', 'ot_start', 'total_hours', 'reason', 'status', 'output', 'created_by', 'dt_created');
        $updateable = array_keys($columns);
        unset($updateable['ot_id']);
        unset($updateable['employee_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'ot_applications', $columns, 'ot_id', $uks, $viewable, $searchable, $required, $updateable);
    }

    public function viewDataById($id)
    {
        // $this->conn->loadModule('Extended');
        $where_clause = "a.".$this->primary_id_name." = ".$this->conn->quote($id, 'integer');

        return $this->selectData($where_clause);
    }

    protected function generateFilterWhereClause($where_clause, $filters)
    {
        if (!empty($filters))
        {
            $addtnl_clause = empty($where_clause) ? '' : ' AND ';
            $len = count($filters);
            $i = 0;
            foreach ($filters as $column => $value)
            {
                $addtnl_clause .= "a.$column = ".$this->conn->quote($value, $this->columns[$column]);
                if ($i != $len - 1)
                    $addtnl_clause .= ' AND ';
                $i++;
            }

            return $where_clause.$addtnl_clause;
        }

        return $where_clause;
    }

    protected function generateSearchWhereClause($search_kw='')
    {
        $where_clause = false;

        if(!empty($search_kw))
        {
            // $this->conn->loadModule('Extended');
            $len = count($this->searchable_columns);
            $i = 0;
            foreach ($this->searchable_columns as $column)
            {
                if ('id' != substr($column, -2))
                {
                    $where_clause .= "a.$column like ".$this->conn->quote('%'.$search_kw.'%', 'text');
                    if ($i != $len - 1)
                        $where_clause .= ' OR ';
                }
                $i++;
            }
        }

        return $where_clause;
    }

    protected function selectData($where_clause=false)
    {
        // di pwede MDB2 since kailangan mag join, kailangan rekta na para iwas lookup
        // used by both view and view-id so reveal all needed columns
        // $query = "SELECT a.empl_infraction_id, a.employee_id, a.policy_id, a.description, a.date_received, a.sanction, b.policy_code FROM employee_infraction a LEFT JOIN policies b ON a.policy_id = b.policy_id";
        $query ="SELECT a.ot_id, a.org_id, a.employee_id, a.ot_start, a.total_hours, a.reason, a.output, a.status, a.sup_approved_by, a.sup_approved_date, a.sup_rejected_by, a.sup_rejected_date, a.man_approved_by, a.man_approved_date, a.man_rejected_by, a.man_rejected_date, b.firstname, b.middlename, b.lastname FROM ot_applications a INNER JOIN employees b ON a.employee_id = b.employee_id";

        if ('SUPERVISORS' == $this->session['level'])
        {
            $user_id = $this->session['user_id'];
            if (!empty($where_clause))
                $where_clause .= ' AND ';
            // $where_clause .= "((a.sup_approved_by = $user_id AND a.status != 'REJECTED') OR (a.sup_rejected_by = $user_id AND a.status NOT IN ('MAN-APPROVED', 'SUP-APPROVED')))";
            $where_clause .= "(a.employee_id = ".$this->session['employee_id']." OR ((a.sup_approved_by = $user_id AND a.sup_rejected_by = 0) OR (a.sup_approved_by = 0 AND a.sup_rejected_by = $user_id) OR (a.sup_approved_by = 0 AND a.sup_rejected_by = 0 AND a.man_approved_by = 0 AND a.man_rejected_by = 0)))";
        }

        if (!empty($where_clause))
            $query .= " WHERE $where_clause";

        $res = execute_query($this->conn, $query, '');
        // print_r($res);
        if (!PEAR::isError($res))
        {
            $data = array('total' => 0, $this->table => array());
            if ($res->numRows() > 0)
            {
                // print_r($res);
                $data['total'] = $res->numRows();
                $data[$this->table] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
            }

            return $data;
        }
        print_r($res);
        die($res->getMessage());
    }
}


// class OtForm
// {
//     public function OtForm($conn, $employee_id='', $ot_start='', $ot_end='', $reason='', $output='', $session)
//     {
//         $this->conn = $conn;
//         $this->employee_id = strtoupper($employee_id);
//         $this->ot_start = strtoupper($ot_start);
//         $this->ot_end = strtoupper($ot_end);
//         $this->reason = strtoupper($reason);
//         $this->output = strtoupper($output);

//         $this->act_user_id = $session['user_id'];
//         $this->act_username = $session['username'];
//         $this->act_emp_id = $session['employee_id'];
//         $this->act_level = $session['level'];
//         $this->table_name = 'ot_applications';
//     }

//     public function CreateOtForm()
//     {
//         $emp_id = (empty($this->employee_id) ? $this->act_emp_id : $this->employee_id);

//         $table_fields = array('employee_id', 'ot_start', 'ot_end', 'reason', 'output', 'status', 'created_by', 'dt_created');
//         $types = array('integer', 'date', 'date', 'text', 'text', 'text', 'integer', 'timestamp');

//         $table_values = array($emp_id, $this->ot_start, $this->ot_end, $this->reason, $this->output, 'PENDING', $this->act_user_id, date('Y-m-d H:i:s'));

//         $sth = $this->conn->extended->autoPrepare($this->table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
//         $res =& $sth->execute($table_values);

//         if (PEAR::isError($res)) {
//             die($res->getMessage());
//         }
//         else
//             return $this->conn->lastInsertID();
//     }

//     public function viewOtForm($keyword='')
//     {
//         $result_types = array(
//             'ot_id' => 'integer',
//             'employee_id' => 'integer',
//             'ot_start' => 'timestamp',
//             'ot_end' => 'timestamp',
//             'reason' => 'text',
//             'output' => 'text',
//             'status' => 'text'
//         );

//         $data = array();
//         $where_clause = null;
//         if('EMPLOYEES' == $this->act_level)
//         {
//             $where_clause = 'employee_id = '.$this->act_emp_id;
//         }

//         if ($keyword != '')
//         {
//             $where_clause .= empty($where_clause) ? '' : ' AND ';
//             $len = count($result_types);
//             $i = 0;
//             foreach ($result_types as $key => $value)
//             {
//                 if ('id' != substr($key, -2))
//                 {
//                     $where_clause .= "$key like '%$keyword%'";
//                     if ($i != $len - 1)
//                         $where_clause .= ' OR ';
//                 }
//                 $i++;
//             }
//         }

//         $res = $this->conn->extended->autoExecute($this->table_name, null, MDB2_AUTOQUERY_SELECT, $where_clause, null, true, $result_types);

//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $data = array();
//             if ($res->numRows() > 0)
//             {
//                 $data['total'] = $res->numRows();
//                 $data['otforms'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//         }
//         return $data;
//     }

//     public function approveOT($ot_id)
//     {
//         $data = array();

//         $status = '';
//         $approved_by = '';
//         $approved_date = '';
//         if ('HR MANAGERS' == $this->act_level)
//         {
//             $status = 'MAN-APPROVED';
//             $approved_by = 'man_approved_by';
//             $approved_date = 'man_approved_date';
//         }
//         else if('SUPERVISORS' == $this->act_level)
//         {
//             $status = 'SUP-APPROVED';
//             $approved_by = 'sup_approved_by';
//             $approved_date = 'sup_approved_date';
//         }

//         $field_values   = array(
//             'status' => $status,
//             $approved_by => $this->act_user_id,
//             $approved_date => date('Y-m-d H:i:s')
//             );
//         $types  = array('text', 'integer', 'timestamp');
//         $res = $this->conn->extended->autoExecute($this->table_name, $field_values, MDB2_AUTOQUERY_UPDATE, "ot_id = $ot_id LIMIT 1", $types);
//     }

//     public function rejectOT($ot_id)
//     {
//         $data = array();

//         $status = 'REJECTED';
//         $approved_by = '';
//         $approved_date = '';
//         if ('HR MANAGERS' == $this->act_level)
//         {
//             $approved_by = 'man_rejected_by';
//             $approved_date = 'man_rejected_date';
//         }
//         else if('SUPERVISORS' == $this->act_level)
//         {
//             $approved_by = 'sup_rejected_by';
//             $approved_date = 'sup_rejected_date';
//         }

//         $field_values   = array(
//             'status' => $status,
//             $approved_by => $this->act_user_id,
//             $approved_date => date('Y-m-d H:i:s')
//             );
//         $types  = array('text', 'integer', 'timestamp');
//         $res = $this->conn->extended->autoExecute($this->table_name, $field_values, MDB2_AUTOQUERY_UPDATE, "ot_id = $ot_id LIMIT 1", $types);
//     }


//     // public function CreateOt()
// //       {
//     //     $time = date('Y-m-d H:i:s');
// //           $table_name = 'ot_applications';
//     //     switch ($_SESSION['level'])
//     //     {
//     //         case 'EMPLOYEES':
//     //             $table_fields = array('employee_id', 'ot_date', 'start_time', 'end_time', 'reason', 'output', 'status', 'created_by', 'dt_created');
//     //             $types = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
//     //             $table_values = array($this->employee_id, $this->ot_date, $this->start_time, $this->end_time, $this->reason, $this->output, 'PENDING',   $_SESSION['employee_id'], $time);
//     //         break;
//     //         case 'SUPERVISOR':
//     //             $table_fields = array('employee_id', 'ot_date', 'start_time', 'end_time', 'reason', 'output', 'status', 'sup_approved_by', 'sup_approved_date', 'created_by', 'dt_created');
//     //             $types = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'timestamp', 'text', 'timestamp');
//     //             $table_values = array($this->employee_id, $this->ot_date, $this->start_time, $this->end_time, $this->reason, $this->output, 'SUP-PENDING', $_SESSION['username'], $time,  $_SESSION['employee_id'], $time);
//     //         break;
//     //         case 'HR MANAGERS':
//     //             $table_fields = array('employee_id', 'ot_date', 'start_time', 'end_time', 'reason', 'output', 'status', 'sup_approved_by', 'sup_approved_date', 'man_approved_by', 'man_approved_date',  'created_by', 'dt_created');
//     //             $types = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'timestamp', 'text', 'timestamp', 'text', 'timestamp');
//     //             $table_values = array($this->employee_id, $this->ot_date, $this->start_time, $this->end_time, $this->reason, $this->output, 'MAN-PENDING', $_SESSION['username'], $time, $_SESSION['employee_id'], $time,  $_SESSION['user_id'], $time);
//     //         break;

//     //     }
//     //     $sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// //           $res =& $sth->execute($table_values);
// //           $lastInsert = $this->conn->lastInsertID();
//     //     if (PEAR::isError($res)) {
//     //         die($res->getMessage());
//     //     }
//     //     else
//     //         return $lastInsert;
// //       }
//     // public function viewOT($keyword='')
// //       {

// //           $data = array();
//     //     $query = "SELECT a.* FROM ot_applications a WHERE a.employee_id = ".$this->employee_id;
//     //     $res = execute_query($this->conn, $query, '');
// //           if (PEAR::isError($res))
//     //     {
//     //         die($res->getMessage());
//     //     }
//     //     else
//     //     {
//     //         $data = array();
//     //         if ($res->numRows() > 0)
//     //         {
//     //             $data['total'] = $res->numRows();
//     //             $data['ot'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//     //         }
//     //     }
//     //     return $data;
//     // }

//     // public function viewPendingOT($status='')
// //       {
// //           $data = array();
//     //     $query = "SELECT a.*, b.lastname, b.firstname FROM ot_applications a, employees b WHERE a.status = '".$status."' AND  a.employee_id =b.employee_id";
//     //     $res = execute_query($this->conn, $query, '');
// //           if (PEAR::isError($res))
//     //     {
//     //         die($res->getMessage());
//     //     }
//     //     else
//     //     {
//     //         $data = array();
//     //         if ($res->numRows() > 0)
//     //         {
//     //             $data['total'] = $res->numRows();
//     //             $data['ot'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//     //         }
//     //     }
//     //     return $data;
//     // }

//     // public function approveOT($overtime_id, $status, $field, $value, $datelabel)
// //       {
// //           $data = array();
//     //     $query = "UPDATE ot_applications SET status='".$status."', $field = '$value', $datelabel=NOW() WHERE overtime_id = $overtime_id LIMIT 1";
//     //     $res = execute_query($this->conn, $query, '');
//     // }

//     // public function rejectOT($overtime_id, $field, $value, $datelabel)
// //       {
// //           $data = array();
//     //     $query = "UPDATE ot_applications SET status='REJECTED', $field = '$value', $datelabel=NOW() WHERE overtime_id = $overtime_id LIMIT 1";
//     //     $res = execute_query($this->conn, $query, '');
//     // }
// }

?>
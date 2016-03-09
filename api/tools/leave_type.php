<?php
class LeaveType extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'lv_id' => 'integer',
            'org_id' => 'integer',
            'lv_code' => 'text',
            'lv_description' => 'text',
            'lv_credits' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('lv_code'));
        $viewable = array(
            'lv_id' => 'integer',
            'lv_code' => 'text',
            'lv_description' => 'text',
            'lv_credits' => 'text'
            );

        $searchable = $viewable;
        unset($searchable['lv_id']);

        $required = array('lv_code', 'created_by', 'dt_created');
        $updateable = array('lv_description', 'lv_credits', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'leave_type', $columns, 'lv_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}

// class LeaveType
// {
// 	public function LeaveType($conn, $lv_code='', $lv_description='', $lv_credits='')
// 	{
// 		$this->conn            = $conn;
// 		$this->lv_code         = strtoupper($lv_code);
// 		$this->lv_description  = strtoupper($lv_description);
// 		$this->lv_credits      = strtoupper($lv_credits);
// 	}

// 	public function checkLeaveType()
//     {
//         $table_name = 'leave_type';
//         $result_types = array(
//                 'lv_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'lv_code="'.$this->lv_code.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}

// 		return $row['lv_id'];
//     }

// 	public function checkLeaveTypeId($lv_id)
//     {
//         $table_name = 'leave_type';
//         $result_types = array(
//                 'lv_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'lv_id='.$lv_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['lv_id'] != ''? true : False);
// 		return $res;
//     }

// 	public function CreateLeaveType()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'leave_type';
//         $table_fields = array('lv_code', 'lv_description', 'lv_credits', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->lv_code, $this->lv_description, $this->lv_credits, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdateLeaveType($lv_id)
// 	{
// 		$table_name = 'leave_type';
// 		$field_values   = array(
//             'lv_description' => $this->lv_description,
//             'lv_credits' => $this->lv_credits,
//             'modified_by' => $_SESSION['user_id'],
//             'dt_last_modified' => date("Y-m-d H:i:s")
// 		     );
// 		$types  = array('text', 'text');
// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'lv_id = "'.$lv_id.'" LIMIT 1', $types);
// 	}

// 	public function viewLeaveTypes($keyword='')
//     {
//         $table_name = 'leave_type';
//         $result_types = array(
//                 'lv_id' => 'integer',
// 				'lv_code' => 'text',
// 				'lv_description' => 'text',
// 				'lv_credits' => 'text'
//         );
//         $data = array();
// 		if ($keyword != '')
//         {
//             $where_clause = '';
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
//             $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, $where_clause, null, true, $result_types);
//         }
// 		else
// 			$res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, null, null, true, $result_types);

//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$data = array();
// 			if ($res->numRows() > 0)
// 			{
// 				$data['total'] = $res->numRows();
// 				$data['leave_type'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function viewLeaveTypeById($lv_id)
//     {
//         $table_name = 'leave_type';
//         $result_types = array(
//                 'lv_code' => 'text',
// 				'lv_description' => 'text',
// 				'lv_credits' => 'text'

//         );
//         $data = array();
// 		$res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "lv_id = $lv_id LIMIT 1", null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$data = array();
// 			if ($res->numRows() > 0)
// 			{
// 				$data['total'] = $res->numRows();
// 				$data['leave_type'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function DeleteRecord($lv_id)
// 	{
// 		$query = "DELETE FROM leave_type WHERE lv_id = $lv_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');

// 	}

// }

?>
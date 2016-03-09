<?php

class EmployeeType extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'empl_type_id' => 'integer',
            'org_id' => 'integer',
            'org_id' => 'integer',
            'empl_type' => 'text',
            'description' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('empl_type'));
        $viewable = array(
            'empl_type_id' => 'integer',
            'empl_type' => 'text',
            'description' => 'text'
            );
        $searchable = $viewable;
        unset($searchable['empl_type_id']);

        $required = array('empl_type', 'description', 'created_by', 'dt_created');
        $updateable = array('empl_type', 'description', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'employee_type', $columns, 'empl_type_id', $uks, $viewable, $viewable, $required, $updateable);
    }
}

// class EmployeeType
// {
// 	public function EmployeeType($conn, $empl_type='', $description='')
// 	{
// 		$this->conn         = $conn;
// 		$this->empl_type    = strtoupper($empl_type);
// 		$this->description  = strtoupper($description);
// 	}

// 	public function checkEmployeeType()
//     {
//         $table_name = 'employee_type';
//         $result_types = array(
//                 'empl_type_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'empl_type="'.$this->empl_type.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		return $row['empl_type_id'];
//     }

// 	public function checkEmployeeTypeId($empl_type_id)
//     {
//         $table_name = 'employee_type';
//         $result_types = array(
//                 'empl_type_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'empl_type_id='.$empl_type_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['empl_type_id'] != ''? true : False);
// 		return $res;
//     }

// 	public function CreateEmployeeType()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_type';
//         $table_fields = array('empl_type', 'description', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->empl_type, $this->description, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdateEmployeeType($empl_type_id)
// 	{
// 		$table_name = 'employee_type';
// 		$field_values   = array(
//             'empl_type' => $this->empl_type,
//             'description' => $this->description,
//             'modified_by' => $_SESSION['user_id'],
//             'dt_last_modified' => date("Y-m-d H:i:s")
// 			);
// 		$types  = array('text', 'text');
// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'empl_type_id = "'.$empl_type_id.'" LIMIT 1', $types);
// 	}

// 	public function viewEmployeeTypes($keyword='')
//     {
//         $table_name = 'employee_type';
//         $result_types = array(
//                 'empl_type_id' => 'integer',
// 				'empl_type' => 'text',
// 				'description' => 'text'
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
// 				$data['employee_type'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function viewEmployeeTypeById($empl_type_id)
//     {
//         $table_name = 'employee_type';
//         $result_types = array(
//                 'empl_type_id' => 'integer',
// 				'empl_type' => 'text',
// 				'description' => 'text'

//         );
//         $data = array();
// 		$res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "empl_type_id = $empl_type_id LIMIT 1", null, true, $result_types);
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
// 				$data['employee_type'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function DeleteRecord($empl_type_id)
// 	{
// 		$query = "DELETE FROM employee_type WHERE empl_type_id = $empl_type_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');

// 	}

// }
?>
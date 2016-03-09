<?php
class EmployeeFamily extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_family_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'name' => 'text',
            'birthdate' => 'date',
            'gender' => 'text',
            'relationship' => 'text',
            'civil_status' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = null;
        $viewable = array_keys($columns);

        $searchable = array_keys($columns);
        unset($searchable['empl_family_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);


        $required = array_keys($columns);
        unset($required['empl_family_id']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_family_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_family', $columns, 'empl_family_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}

// class Family
// {
// 	public function Family($conn, $employee_id, $name='', $birthdate='', $gender='', $relationship='', $civil_status='')
// 	{
// 		$this->conn         = $conn;
// 		$this->employee_id  = $employee_id;
// 		$this->name         = $name;
// 		$this->birthdate    = $birthdate;
// 		$this->gender       = $gender;
// 		$this->relationship = $relationship;
// 		$this->civil_status = $civil_status;
// 	}


// 	public function CreateFamily()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_family';
//         $table_fields = array('employee_id', 'name', 'birthdate', 'gender', 'relationship', 'civil_status', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'timestamp', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->name, $this->birthdate, $this->gender, $this->relationship, $this->civil_status, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewFamily($keyword='')
//     {
//         $query = "SELECT * FROM employee_family WHERE employee_id=$this->employee_id";
// 		$res = execute_query($this->conn, $query, '');
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
// 				$data['family'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
<?php
class EmployeeTraining extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_training_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'training_type' => 'text',
            'description' => 'text',
            'date_attended' => 'date',
            'remarks' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = null;
        $viewable = array_keys($columns);

        $searchable = array_keys($columns);
        unset($searchable['empl_training_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);


        $required = array_keys($columns);
        unset($required['empl_training_id']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_training_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_training', $columns, 'empl_training_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}


// class Training
// {
// 	public function Training($conn, $employee_id, $training_type='', $description='', $date_attended='', $remarks='')
// 	{
// 		$this->conn          = $conn;
// 		$this->employee_id   = strtoupper($employee_id);
// 		$this->training_type = strtoupper($training_type);
// 		$this->description   = strtoupper($description);
// 		$this->date_attended = strtoupper($date_attended);
// 		$this->remarks = strtoupper($remarks);
// 	}


// 	public function CreateTraining()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_training';
//         $table_fields = array('employee_id', 'training_type', 'description', 'date_attended', 'remarks', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->training_type, $this->description, $this->date_attended,  $this->remarks, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewTraining($keyword='')
//     {
//         $query = "SELECT * FROM employee_training WHERE employee_id=$this->employee_id";
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
// 				$data['training'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
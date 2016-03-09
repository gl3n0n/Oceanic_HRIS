<?php
class EmployeeMedical extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_medical_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'description' => 'text',
            'prescription' => 'text',
            'hospital' => 'text',
            'physician' => 'text',
            'checkup_date' => 'date',
            'vac_exp' => 'date',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = null;
        $viewable = array_keys($columns);

        $searchable = array_keys($columns);
        unset($searchable['empl_medical_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);


        $required = array_keys($columns);
        unset($required['empl_medical_id']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_medical_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_medical', $columns, 'empl_medical_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}

// class MedicalRecords
// {
// 	public function MedicalRecords($conn, $employee_id, $description='', $prescription='', $hospital='', $physician='', $checkup_date='', $vac_exp='')
// 	{
// 		$this->conn         = $conn;
// 		$this->employee_id  = $employee_id;
// 		$this->description  = $description;
// 		$this->prescription = $prescription;
// 		$this->hospital     = $hospital;
// 		$this->physician    = $physician;
// 		$this->checkup_date = $checkup_date;
// 		$this->vac_exp      = $vac_exp;
// 	}


// 	public function CreateMedical()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_medical';
//         $table_fields = array('employee_id', 'description', 'prescription', 'hospital', 'physician', 'checkup_date', 'vac_exp', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'timestamp', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->description, $this->prescription, $this->hospital, $this->physician, $this->checkup_date, $this->vac_exp, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewMedical($keyword='')
//     {
//         $query = "SELECT * FROM employee_medical WHERE employee_id=$this->employee_id";
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
// 				$data['medical'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
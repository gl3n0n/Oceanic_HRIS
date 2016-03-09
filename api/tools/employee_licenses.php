<?php
class EmployeeLicenses extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_license_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'license_type' => 'text',
            'license_no' => 'date',
            'date_issued' => 'date',
            'expiry_date' => 'date',
            'remarks' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = null;
        $viewable = array_keys($columns);

        $searchable = array_keys($columns);
        unset($searchable['empl_license_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);


        $required = array_keys($columns);
        unset($required['empl_license_id']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_license_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_licenses', $columns, 'empl_license_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}



// class Licenses
// {
// 	public function Licenses($conn, $employee_id, $license_type='', $license_no='', $date_issued='', $expiry_date='', $remarks='')
// 	{
// 		$this->conn          = $conn;
// 		$this->employee_id   = $employee_id;
// 		$this->license_type  = $license_type;
// 		$this->license_no   = $license_no;
// 		$this->date_issued = $date_issued;
// 		$this->expiry_date = $expiry_date;
// 		$this->remarks = $remarks;
// 	}


// 	public function CreateLicense()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_licenses';
//         $table_fields = array('employee_id', 'license_type', 'license_no', 'date_issued', 'expiry_date', 'remarks', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->license_type, $this->license_no, $this->date_issued, $this->expiry_date, $this->remarks, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewLicense($keyword='')
//     {
//         $query = "SELECT * FROM employee_licenses WHERE employee_id=$this->employee_id";
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
// 				$data['license'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
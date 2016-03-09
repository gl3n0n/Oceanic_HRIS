<?php
class EmployeeEducation extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_education_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'school' => 'text',
            'level' => 'text',
            'course' => 'text',
            'degree' => 'text',
            'honors' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = null;

        $viewable = array_keys($columns);
        unset($viewable['created_by']);
        unset($viewable['dt_created']);
        unset($viewable['modified_by']);
        unset($viewable['dt_last_modified']);

        $searchable = $viewable;
        unset($searchable['empl_education_id']);

        $required = array_keys($columns);
        unset($required['empl_education_id']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_education_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_education', $columns, 'empl_education_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}

// class Education
// {
// 	public function Education($conn, $employee_id, $school='', $level='', $course='', $degree='', $honors='')
// 	{
// 		$this->conn         = $conn;
// 		$this->employee_id  = $employee_id;
// 		$this->school       = $school;
// 		$this->level        = $level;
// 		$this->course       = $course;
// 		$this->degree       = $degree;
// 		$this->honors       = $honors;
// 	}


// 	public function CreateEducation()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_education';
//         $table_fields = array('employee_id', 'school', 'level', 'course', 'degree', 'honors', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->school, $this->level, $this->course, $this->degree, $this->honors, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewEducation($keyword='')
//     {
//         $query = "SELECT * FROM employee_education WHERE employee_id=$this->employee_id";
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
// 				$data['education'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
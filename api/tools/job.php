<?php
class Job extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'job_id' => 'integer',
            'org_id' => 'integer',
            'job_code' => 'text',
            'job_description' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('job_code'));
        $viewable = array(
            'job_id' => 'integer',
            'job_code' => 'text',
            'job_description' => 'text'
            );

        $searchable = $viewable;
        unset($searchable['job_id']);

        $required = array('job_code', 'job_description', 'created_by', 'dt_created');
        $updateable = array('job_description', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'jobs', $columns, 'job_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}
// class Job
// {
// 	public function Job($conn, $job_code='', $job_description='')
// 	{
// 		$this->conn = $conn;
// 		$this->job_code = strtoupper($job_code);
// 		$this->job_description = strtoupper($job_description);
// 	}

// 	public function checkJobCode()
//     {
//         $table_name = 'jobs';
//         $result_types = array(
//                 'job_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'job_code="'.$this->job_code.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		return $row['job_id'];
//     }

// 	public function checkJobId($job_id)
//     {
//         $table_name = 'jobs';
//         $result_types = array(
//                 'job_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'job_id='.$job_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['job_id'] != ''? true : false);
// 		return $res;
//     }

// 	public function CreateJob()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'jobs';

// 		$table_fields = array('job_code', 'job_description',  'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->job_code, $this->job_description, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdateJob($job_id)
// 	{
// 		$table_name = 'jobs';
// 		$field_values   = array(
//             'job_description' => $this->job_description,
//             'modified_by' => $_SESSION['user_id'],
//             'dt_last_modified' => date("Y-m-d H:i:s")
// 			);
// 		$types  = array('text', 'text');
// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'job_id = "'.$job_id.'" LIMIT 1', $types);
// 	}

// 	public function viewjobs($keyword='')
//     {
//         $table_name = 'jobs';
//         $result_types = array(
//                 'job_id' => 'integer',
// 				'job_code' => 'text',
// 				'job_description' => 'text'
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
// 				$data['jobs'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function viewJobById($job_id)
//     {
//         $table_name = 'jobs';
//         $result_types = array(
// 				'job_code' => 'text',
// 				'job_description' => 'text'

//         );
//         $data = array();
// 		$res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "job_id = $job_id LIMIT 1", null, true, $result_types);
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
// 				$data['jobs'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function DeleteRecord($job_id)
// 	{
// 		$query = "DELETE FROM jobs WHERE job_id = $job_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');

// 	}

// }
?>
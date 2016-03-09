<?php
class Policy extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'policy_id' => 'integer',
            'org_id' => 'integer',
            'policy_code' => 'text',
            'policy_description' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('policy_code'));
        $viewable = array(
            'policy_id' => 'integer',
            'policy_code' => 'text',
            'policy_description' => 'text'
            );

        $searchable = $viewable;
        unset($searchable['policy_id']);

        $required = array('policy_code', 'policy_description', 'created_by', 'dt_created');
        $updateable = array('policy_description', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'policies', $columns, 'policy_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}
// class Policies
// {
// 	public function Policies($conn, $policy_code='', $policy_description='')
// 	{
// 		$this->conn            = $conn;
// 		$this->policy_code     = strtoupper($policy_code);
// 		$this->policy_description  = strtoupper($policy_description);
// 	}

// 	public function checkPolicyCode()
//     {
//         $table_name = 'policies';
//         $result_types = array(
//                 'policy_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'policy_code="'.$this->policy_code.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}

// 		return $row['policy_id'];
//     }

// 	public function checkPolicyId($policy_id)
//     {
//         $table_name = 'policies';
//         $result_types = array(
//                 'policy_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'policy_id='.$policy_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['policy_id'] != ''? true : False);
// 		return $res;
//     }

// 	public function CreatePolicy()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'policies';
//         $table_fields = array('policy_code', 'policy_description', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->policy_code, $this->policy_description, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdatePolicy($policy_id)
// 	{
// 		$table_name = 'policies';
// 		$field_values   = array(
//             'policy_description' => $this->policy_description,
// 			'modified_by' => $_SESSION['user_id'],
//             'dt_last_modified' => date("Y-m-d H:i:s")
// 			);
// 		$types  = array('text', 'text');
// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'policy_id = "'.$policy_id.'" LIMIT 1', $types);
// 	}

// 	public function viewPolicy($keyword='')
//     {
//         $table_name = 'policies';
//         $result_types = array(
//                 'policy_id' => 'integer',
// 				'policy_code' => 'text',
// 				'policy_description' => 'text'
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
// 				$data['policies'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function viewPolicyById($policy_id)
//     {
//         $table_name = 'policies';
//         $result_types = array(
//             'policy_code' => 'text',
// 			'policy_description' => 'text'
//             );
//         $data = array();
// 		$res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "policy_id = $policy_id LIMIT 1", null, true, $result_types);
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
// 				$data['policies'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function DeleteRecord($policy_id)
// 	{
// 		$query = "DELETE FROM policies WHERE policy_id = $policy_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');

// 	}

// }
?>
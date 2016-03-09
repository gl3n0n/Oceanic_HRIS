<?php
class EmployeeRewards extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_reward_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'reward' => 'text',
            'description' => 'text',
            'date_received' => 'date',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = null;
        $viewable = array_keys($columns);

        $searchable = array_keys($columns);
        unset($searchable['empl_reward_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);


        $required = array_keys($columns);
        unset($required['empl_reward_id']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_reward_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_reward', $columns, 'empl_reward_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}


// class Rewards
// {
// 	public function Rewards($conn, $employee_id, $reward='', $description='', $date_received='')
// 	{
// 		$this->conn          = $conn;
// 		$this->employee_id   = $employee_id;
// 		$this->reward        = $reward;
// 		$this->description   = $description;
// 		$this->date_received = $date_received;
// 	}


// 	public function CreateReward()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_reward';
//         $table_fields = array('employee_id', 'reward', 'description', 'date_received', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->reward, $this->description, $this->date_received, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewReward($keyword='')
//     {
//         $query = "SELECT * FROM employee_reward WHERE employee_id=$this->employee_id";
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
// 				$data['reward'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
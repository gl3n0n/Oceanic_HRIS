<?php
class EmployeeInfractions extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_infraction_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'policy_id' => 'integer',
            'description' => 'text',
            'date_received' => 'date',
            'sanction' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = null;
        $viewable = null;

        $searchable = array_keys($columns);
        unset($searchable['empl_infraction_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);


        $required = array_keys($columns);
        unset($required['empl_infraction_id']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_infraction_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_infraction', $columns, 'empl_infraction_id', $uks, $viewable, $searchable, $required, $updateable);
    }

    public function viewDataById($id)
    {
        // $this->conn->loadModule('Extended');
        $where_clause = "a.".$this->primary_id_name." = ".$this->conn->quote($id, 'integer');

        return $this->selectData($where_clause);
    }

    protected function generateFilterWhereClause($where_clause, $filters)
    {
        if (!empty($filters))
        {
            $addtnl_clause = empty($where_clause) ? '' : ' AND ';
            $len = count($filters);
            $i = 0;
            foreach ($filters as $column => $value)
            {
                $addtnl_clause .= "a.$column = ".$this->conn->quote($value, $this->columns[$column]);
                if ($i != $len - 1)
                    $addtnl_clause .= ' AND ';
                $i++;
            }

            return $where_clause.$addtnl_clause;
        }

        return $where_clause;
    }

    protected function generateSearchWhereClause($search_kw='')
    {
        $where_clause = false;

        if(!empty($search_kw))
        {
            // $this->conn->loadModule('Extended');
            $len = count($this->searchable_columns);
            $i = 0;
            foreach ($this->searchable_columns as $column)
            {
                if ('id' != substr($column, -2))
                {
                    $where_clause .= "a.$column like ".$this->conn->quote('%'.$search_kw.'%', 'text');
                    if ($i != $len - 1)
                        $where_clause .= ' OR ';
                }
                $i++;
            }
        }

        return $where_clause;
    }

    protected function selectData($where_clause=false)
    {
        // di pwede MDB2 since kailangan mag join, kailangan rekta na para iwas lookup
        // used by both view and view-id so reveal all needed columns
        $query = "SELECT a.empl_infraction_id, a.employee_id, a.policy_id, a.description, a.date_received, a.sanction, b.policy_code FROM employee_infraction a LEFT JOIN policies b ON a.policy_id = b.policy_id";

        if (!empty($where_clause))
            $query .= " WHERE $where_clause";

        $res = execute_query($this->conn, $query, '');
        // print_r($res);
        if (!PEAR::isError($res))
        {
            $data = array('total' => 0, $this->table => array());
            if ($res->numRows() > 0)
            {
                // print_r($res);
                $data['total'] = $res->numRows();
                $data[$this->table] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
            }

            return $data;
        }
        print_r($res);
        die($res->getMessage());
    }
}

// class Infractions
// {
// 	public function Infractions($conn, $employee_id, $policy_id='', $description='', $date_received='', $penalty='')
// 	{
// 		$this->conn          = $conn;
// 		$this->employee_id   = $employee_id;
// 		$this->policy_id        = $policy_id;
// 		$this->description   = $description;
// 		$this->date_received = $date_received;
// 		$this->action = $penalty;
// 	}


// 	public function CreateInfraction()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_infraction';
//         $table_fields = array('employee_id', 'policy_id', 'description', 'date_received', 'action', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->policy_id, $this->description, $this->date_received, $this->action, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewInfraction($keyword='')
//     {
//         $query = "SELECT a.*, b.policy_code FROM employee_infraction a, policies b WHERE a.employee_id=$this->employee_id AND a.policy_id = b.policy_id";
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
// 				$data['infraction'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
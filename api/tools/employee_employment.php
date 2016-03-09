<?php
class EmployeeEmployment extends BaseOceanic
{
	public function __construct($conn)
    {
        $columns = array(
            'empl_employment_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'effectivity_date' => 'date',
            'job_id' => 'integer',
            'position_id' => 'integer',
            'remarks' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = null;
        $viewable = null;

        $searchable = array_keys($columns);
        unset($searchable['empl_employment_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);


        $required = array_keys($columns);
        unset($required['empl_employment_id']);
        unset($required['remarks']);
        unset($required['modified_by']);
        unset($required['dt_last_modified']);

        $updateable = array_keys($columns);
        unset($updateable['empl_employment_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employee_employment', $columns, 'empl_employment_id', $uks, $viewable, $searchable, $required, $updateable);
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
        $query = "SELECT a.empl_employment_id, a.employee_id, a.effectivity_date, a.job_id, a.position_id, a.remarks, b.position_title, c.job_description FROM employee_employment a LEFT JOIN positions b ON a.position_id = b.position_id LEFT JOIN jobs c ON a.job_id = c.job_id";

        if (!empty($where_clause))
            $query .= " WHERE $where_clause";

        $res = execute_query($this->conn, $query, '');
        if (!PEAR::isError($res))
        {
            $data = array('total'=>0, $this->table=>array());
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


// class Employment
// {
// 	public function Employment($conn, $employee_id, $effectivity_date='', $job='', $position='', $remarks='')
// 	{
// 		$this->conn              = $conn;
// 		$this->employee_id       = strtoupper($employee_id);
// 		$this->effectivity_date  = strtoupper($effectivity_date);
// 		$this->job               = strtoupper($job);
// 		$this->position          = strtoupper($position);
// 		$this->remarks           = strtoupper($remarks);
// 	}


// 	public function CreateEmployment()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'employee_employment';
//         $table_fields = array('employee_id', 'effectivity_date', 'job', 'position', 'remarks', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->effectivity_date, $this->job, $this->position,  $this->remarks, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function viewEmployment($keyword='')
//     {
//         $query = "SELECT * FROM employee_employment WHERE employee_id=$this->employee_id";
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
// 				$data['employment'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// }

?>
<?php
class Position extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'position_id' => 'integer',
            'org_id' => 'integer',
            'position_code' => 'text',
            'position_title' => 'text',
            'position_description' => 'text',
            'job_id' => 'integer',
            'dept_id' => 'integer',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = array(array('position_code'));
        // no need to set since we will construct this manually
        $viewable = array();

        $searchable = array(
            'position_code' => 'text',
            'position_title' => 'text',
            'position_description' => 'text'
            );

        $required = array('position_code', 'position_title', 'position_description', 'job_id', 'dept_id', 'created_by', 'dt_created');
        $updateable = array('position_title', 'position_description', 'job_id', 'dept_id', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'positions', $columns, 'position_id', $uks, $viewable, $searchable, $required, $updateable);
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
        $query = "SELECT a.position_id, a.position_code, a.position_title, a.position_description, b.job_id, b.job_code, c.dept_id, c.name dept_name FROM positions a, jobs b, departments c WHERE a.job_id = b.job_id AND a.dept_id = c.dept_id";

        if (!empty($where_clause))
            $query .= " AND $where_clause";

        $res = execute_query($this->conn, $query, '');
        if (!PEAR::isError($res))
        {
            $data = array('total'=>0, $this->table=>array());
            if ($res->numRows() > 0)
            {
                $data['total'] = $res->numRows();
                $data[$this->table] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
            }

            return $data;
        }
        die($res->getMessage());
    }
}

// class Position
// {
// 	public function Position($conn, $position_code='', $position_title='', $position_description='', $job_id='', $dept_id='')
// 	{
// 		$this->conn            = $conn;
// 		$this->position_code   = strtoupper($position_code);
// 		$this->position_title  = strtoupper($position_title);
// 		$this->position_description = strtoupper($position_description);
// 		$this->job_id       = strtoupper($job_id);
// 		$this->dept_id       = strtoupper($dept_id);
// 	}

// 	public function checkPositionCode()
//     {
//         $table_name = 'positions';
//         $result_types = array(
//                 'position_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'position_code="'.$this->position_code.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		return $row['position_id'];
//     }

// 	public function checkPositionId($position_id)
//     {
//         $table_name = 'positions';
//         $result_types = array(
//                 'position_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'position_id='.$position_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['position_id'] != ''? true : False);
// 		return $res;
//     }

// 	public function CreatePosition()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'positions';
//         $table_values = array($this->position_code, $this->position_title, $this->position_description, $this->job_id, $this->dept_id, $_SESSION['user_id'], $time);
//         $table_fields = array('position_code', 'position_title', 'position_description', 'job_id', 'dept_id', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'integer', 'integer', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdatePosition($position_id)
// 	{
// 		$table_name = 'positions';
// 		$field_values   = array(
//             'position_title' => $this->position_title,
//             'position_description' => $this->position_description,
//             'job_id' => $this->job_id,
//             'dept_id' => $this->dept_id,
//             'modified_by' => $_SESSION['user_id'],
//             'dt_last_modified' => date("Y-m-d H:i:s")
// 		    );
// 		$types  = array('text', 'text', 'integer', 'integer', 'integer');
// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, "position_id = $position_id LIMIT 1", $types);
// 	}

// 	public function viewPositions($keyword='')
//     {
//         $table_name = 'positions';
//         // di pwede MDB2 since kailangan mag join
//         // kailangan rekta na para iwas lookup
//         $data = array();
//         $query = "SELECT a.position_id, a.position_code, a.position_title, a.position_description, b.job_code, c.name dept_name FROM positions a, jobs b, departments c WHERE a.job_id = b.job_id AND a.dept_id = c.dept_id";
// 		if($keyword != '')
// 			$query .= " AND a.position_title like '%$keyword%'";

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
// 				$data['positions'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 			else
// 			{
// 				$data['total'] = 0;
// 			}
// 		}
// 		return $data;
// 	}

// 	public function viewPositionById($position_id)
//     {
//         $data = array();
//         // id as opposed to code/name since we will use this for edit select tag options
// 		// $query = "SELECT a.position_code, a.position_title, a.position_description, b.job_id, c.dept_id FROM positions a, jobs b, departments c WHERE a.job_id = b.job_id AND a.dept_id = c.dept_id AND a.position_id = $position_id";
//         $query = "SELECT a.position_code, a.position_title, a.position_description, a.job_id, a.dept_id FROM positions a WHERE a.position_id = $position_id";
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
// 				$data['positions'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function DeleteRecord($position_id)
// 	{
// 		$query = "DELETE FROM positions WHERE position_id = $position_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');
// 	}

// 	public function GeneratePositionCode()
// 	{
// 		$salt = 'POS-';
// 		$middle = substr(number_format(time() * rand(),0,'',''),0,10);
// 		$code = $salt.$middle;
// 		$data['total'] = '1';
// 		$data['position_code'] = $code;
// 		return $data;
// 	}

// }
?>
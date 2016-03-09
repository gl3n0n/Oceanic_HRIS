<?php
class Department extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'dept_id' => 'integer',
            'org_id' => 'integer',
            'dept_code' => 'text',
            'name' => 'text',
            'location_id' => 'integer',
            'headed_by' => 'text',
            'division_id' => 'integer',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = array(array('dept_code'));
        // no need to set since we will construct this manually
        $viewable = array();

        $searchable = array_keys($columns);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);

        $required = array('dept_code', 'name', 'location_id', 'created_by', 'dt_created');
        $updateable = array_keys($columns);
        unset($updateable['dept_id']);
        unset($updateable['dept_code']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'departments', $columns, 'dept_id', $uks, $viewable, $searchable, $required, $updateable);
    }

    public function viewDepartmentHeads()
    {
        $query = "SELECT a.employee_id, b.firstname, b.lastname, b.middlename FROM users a INNER JOIN employees b ON a.employee_id = b.employee_id WHERE a.level = 'SUPERVISORS'";

        $res = execute_query($this->conn, $query, '');
        if (!PEAR::isError($res))
        {
            $data = array('total'=>0, $this->table=>array());
            if ($res->numRows() > 0)
            {
                $data['total'] = $res->numRows();
                $data['department_heads'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
            }

            return $data;
        }
        die($res->getMessage());
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
        $query = "SELECT a.dept_id, a.dept_code, a.name, a.location_id, c.location_code, a.headed_by, a.division_id, b.division_code FROM departments a LEFT JOIN division b ON a.division_id = b.division_id LEFT JOIN location c ON a.location_id = c.location_id";

        if (!empty($where_clause))
            $query .= " WHERE $where_clause";

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

// class Department
// {
// 	public function Department($conn, $dept_code='', $name='', $location_id='', $headed_by='', $division_id='')
// 	{
// 		$this->conn        = $conn;
// 		$this->dept_code   = strtoupper($dept_code);
// 		$this->name        = strtoupper($name);
// 		$this->location_id = strtoupper($location_id);
// 		$this->headed_by   = strtoupper($headed_by);
// 		$this->division_id = strtoupper($division_id);
// 	}

// 	public function checkDeptCode()
//     {
//         $table_name = 'departments';
//         $result_types = array(
//                 'dept_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'dept_code="'.$this->dept_code.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		return $row['dept_id'];
//     }

// 	public function checkDeptId($dept_id)
//     {
//         $table_name = 'departments';
//         $result_types = array(
//                 'dept_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'dept_id='.$dept_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['dept_id'] != ''? true : False);
// 		return $res;
//     }

// 	public function CreateDept()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'departments';
//         $table_fields = array('dept_code', 'name', 'location_id', 'headed_by', 'division_id', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->dept_code, $this->name, $this->location_id, $this->headed_by, $this->division_id, $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdateDept($dept_id)
// 	{
// 		$table_name = 'departments';
// 		$field_values   = array(
// 					'name' => $this->name,
// 					'location_id' => $this->location_id,
// 					'division_id' => $this->division_id,
//                     'headed_by' => $this->headed_by,
// 				    'modified_by' => $_SESSION['user_id'],
//                     'dt_last_modified' => date("Y-m-d H:i:s")
// 			   );
// 		$types  = array('text', 'integer', 'integer', 'integer', 'text', 'timestamp');
// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, "dept_id = $dept_id LIMIT 1", $types);
// 	}

// 	public function viewDepartments($keyword='')
//     {
//         $table_name = 'departments';
//  //        $result_types = array(
//  //                'dept_id' => 'integer',
// 				// 'name' => 'text',
// 				// 'headed_by' => 'text',
// 				// 'location' => 'text',
// 				// 'division_id' => 'integer',
// 				// 'dept_code' => 'text'
//  //        );

//         $data = array();
//         $query = "SELECT a.dept_id, a.dept_code, a.name, a.location_id, c.location_code, a.headed_by, a.division_id, b.division_code FROM departments a LEFT JOIN division b ON a.division_id = b.division_id LEFT JOIN location c ON a.location_id = c.location_id";
//         // $query = "SELECT a.dept_id, a.dept_code, a.name, a.location_id, c.location_code, a.headed_by, a.parent_dept, b.name parent_dept_name FROM departments a LEFT JOIN departments b ON a.parent_dept = b.dept_id LEFT JOIN location c ON a.location_id = c.location_id";

//         if($keyword != '')
//             $query .= " WHERE a.name LIKE '%$keyword%' OR a.division_code LIKE '%$keyword%' OR c.location_code LIKE '%$keyword%'";

//         $res = execute_query($this->conn, $query, '');
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $data = array();
//             if ($res->numRows() > 0)
//             {
//                 $data['total'] = $res->numRows();
//                 $data['departments'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//             else
//             {
//                 $data['total'] = 0;
//             }
//         }

// 		return $data;
// 	}

//     public function viewDepartmentHeads()
//     {
//         $query = "SELECT a.employee_id, b.firstname, b.lastname, b.middlename FROM users a INNER JOIN employees b ON a.employee_id = b.employee_id WHERE a.level = 'SUPERVISORS'";
//         $res = execute_query($this->conn, $query, '');
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $data = array();
//             if ($res->numRows() > 0)
//             {
//                 $data['total'] = $res->numRows();
//                 $data['department_heads'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//             else
//             {
//                 $data['total'] = 0;
//             }
//         }

//         return $data;
//     }

// 	public function viewDepartmentById($dept_id)
//     {
//         $table_name = 'departments';
//         $result_types = array(
//                 'name' => 'text',
//                 'dept_code' => 'text',
//                 'headed_by' => 'integer',
//                 'location_id' => 'integer',
//                 'division_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "dept_id = $dept_id LIMIT 1", null, true, $result_types);
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $data = array();
//             if ($res->numRows() > 0)
//             {
//                 $data['total'] = $res->numRows();
//                 $data['departments'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//         }
//         return $data;
//     }

// 	public function DeleteRecord($dept_id)
// 	{
// 		$query = "DELETE FROM departments WHERE dept_id = $dept_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');

// 	}

// }

?>
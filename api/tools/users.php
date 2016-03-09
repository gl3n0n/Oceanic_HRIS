<?php
class Users extends BaseOceanic
{
    public function __construct($conn)
    {
        $this->session = $_SESSION;
        $columns = array(
            'user_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'username' => 'text',
            'password' => 'text',
            'email' => 'text',
            'level' => 'text',
            'status_flag' => 'integer', // WUT?
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = array(array('username'));
        // no need to set since we will construct this manually
        $viewable = array();

        $searchable = array(
            'username' => 'text',
            'password' => 'text',
            'email' => 'text',
            'level' => 'text'
            );

        $required = array('employee_id', 'username', 'password', 'email', 'level', 'created_by', 'dt_created');
        $updateable = array('password', 'email', 'level', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'users', $columns, 'user_id', $uks, $viewable, $searchable, $required, $updateable);
    }

    public function createData($new_data)
    {
        if(!empty($new_data['password']))
            $new_data['password'] = crypt($new_data['password'], SALT);
        return parent::createData($new_data);
    }

    public function updateData($id, $new_data)
    {
        if(!empty($new_data['password']))
            $new_data['password'] = crypt($new_data['password'], SALT);
        parent::updateData($id, $new_data);
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
        if ('SYS ADMINS' == $this->session['level'])
            $query = 'SELECT a.user_id, a.username, a.email, a.level, b.lastname, b.firstname, b.middlename, c.org_name FROM users a LEFT JOIN employees b ON a.employee_id = b.employee_id LEFT JOIN organization c ON a.org_id = c.org_id';
        else
            $query = "SELECT a.user_id, a.username, a.email, a.level, b.lastname, b.firstname, b.middlename FROM users a, employees b WHERE a.employee_id = b.employee_id";

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

// class Users
// {
// 	public function Users($conn, $employee_id='', $username='', $password='', $email='', $level='')
// 	{
// 		$this->conn        = $conn;
// 		$this->employee_id   = strtoupper($employee_id);
// 		$this->username        = strtoupper($username);
// 		$this->password    = $password;
// 		$this->email = strtoupper($email);
// 		$this->level = strtoupper($level);
// 	}

// 	public function checkEmployeeId()
//     {
//         $table_name = 'users';
//         $result_types = array(
//                 'employee_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'employee_id="'.$this->employee_id.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		return $row['employee_id'];
//     }

// 	public function checkUserId($user_id)
//     {
//         $table_name = 'users';
//         $result_types = array(
//                 'user_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'user_id='.$user_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['user_id'] != ''? true : False);
// 		return $res;
//     }

// 	public function CreateUsers()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'users';
//         $table_fields = array('employee_id', 'username', 'password', 'email', 'level', 'created_by', 'date_created');
// 		$types = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->employee_id, $this->username, $this->password, $this->email, $this->level, $_SESSION['user_id'], $time);
// 		// echo '<pre>';
// 		// print_r($sth);
// 		// exit();
//         $res =& $sth->execute($table_values);

//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdateUser($user_id)
// 	{
// 		$table_name = 'users';
//         $field_values   = array(
//             'email' => $this->email,
//             'level' => $this->level,
//             'modified_by' => $_SESSION['user_id']
//             );
//         $types  = array('text', 'text', 'integer');

// 		if ($this->password != '')
// 		{
//             $field_values['password'];
//             $types[] = 'text';
// 		}

// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'user_id = "'.$user_id.'" LIMIT 1', $types);
// 	}

// 	public function viewUsers($keyword='')
//     {
//         $table_name = 'users';
//         $result_types = array(
//                 'user_id' => 'integer',
// 				'username' => 'text',
// 				'email' => 'text',
// 				'level' => 'text'
//         );
//         $data = array();
// 		if($keyword != '')
// 			$query = "SELECT a.user_id, a.username, a.email, a.level, b.lastname, b.firstname, b.middlename FROM users a, employees b WHERE a.employee_id = b.employee_id  AND b.firstname like '%$keyword%'";
// 		else
// 			$query = "SELECT a.user_id, a.username, a.email, a.level, b.lastname, b.firstname, b.middlename FROM users a, employees b WHERE a.employee_id = b.employee_id";

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
// 				$data['users'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function viewUserById($user_id)
//     {
//         $table_name = 'departments';
//         $result_types = array(
//                 'dept_id' => 'integer',
// 				'name' => 'text',
// 				'headed_by' => 'text',
// 				'location' => 'text',
// 				'parent_dept' => 'text',
// 				'dept_code' => 'text',

//         );
//         $data = array();
// 		$query = "SELECT a.user_id, a.username, a.email, a.level, b.lastname, b.firstname FROM users a, employees b WHERE a.employee_id = b.employee_id  AND a.user_id = $user_id";

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
// 				$data['users'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function DeleteRecord($user_id)
// 	{
// 		$query = "DELETE FROM users WHERE user_id = $user_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');

// 	}

// }

?>
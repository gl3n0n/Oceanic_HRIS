<?php
class BaseOceanic
{
    public function __construct($conn, $table, $columns, $primary_id_name, $unique_keys, /*$column_values,*/ $viewable_columns=null, $searchable_columns=null, $required_columns=null, $updateable_columns=null, $col_filters=null)
    {
        $this->conn = $conn;
        $this->table = $table;
        $this->columns = $columns;
        $this->primary_id_name = $primary_id_name;
        $this->unique_keys = $unique_keys;
        $this->col_filters = $col_filters;
        // $this->column_values = $column_values;

        $this->required_columns = $this->prepareCreateUpdateColumns($required_columns);
        $this->viewable_columns = $this->prepareViewColumns($viewable_columns);
        $this->searchable_columns = $this->prepareSearchColumns($searchable_columns);
        $this->updateable_columns = $this->prepareCreateUpdateColumns($updateable_columns);
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
                $addtnl_clause .= "$column = ".$this->conn->quote($value, $this->columns[$column]);
                if ($i != $len - 1)
                    $addtnl_clause .= ' AND ';
                $i++;
            }

            return $where_clause.$addtnl_clause;
        }

        return $where_clause;
    }


    public function isExisting($values, $byId=false)
    {
        $where_clause = false;
        if (!$byId && !empty($this->unique_keys))
        {
            $uks_cnt = count($this->unique_keys);
            if ($uks_cnt > 0)
                $where_clause = '';

            $i = 0;

            foreach ($this->unique_keys as $uk) {
                $uk_cnt = count($uk);
                $j = 0;
                foreach ($uk as $key) {
                    $where_clause .= $key." = ".$this->conn->quote($values[$key], $this->columns[$key]);
                    if ($j != $uk_cnt - 1)
                        $where_clause .= ' AND ';
                    $j++;
                }
                $i++;
            }
        }
        else if (array_key_exists($this->primary_id_name, $values))
        {
            // $this->conn->loadModule('Extended');
            $where_clause = $this->primary_id_name."=".$this->conn->quote($values[$this->primary_id_name], 'integer');
        }
        else
        {
            return false;
            // die("Error in parameter");
        }

        $row_cnt = 0;
        $res = $this->conn->extended->autoExecute($this->table, null, MDB2_AUTOQUERY_SELECT, $where_clause, null, true, array($this->primary_id_name => 'integer'));
        if (!PEAR::isError($res))
        {
            $row_cnt = $res->numRows();
            return (0 < $row_cnt) ? true : false;
        }
        print_r($res);
        die($res->getMessage());
    }


    public function viewData($search_kw='')
    {
        $where_clause = $this->generateSearchWhereClause($search_kw);
        return $this->selectData($where_clause);
    }


    public function viewDataByFilter($filters)
    {
        $where_clause = $this->generateFilterWhereClause('', $filters);

        return $this->selectData($where_clause);
    }


    public function viewDataById($id)
    {
        // $this->conn->loadModule('Extended');
        $where_clause = $this->primary_id_name." = ".$this->conn->quote($id, 'integer');

        return $this->selectData($where_clause);
    }
	
	public function getHigherDetails($org_id, $level)
	{
		// if EMPLOYEE, get all SUPERVISORS and HR MANAGERS details
		// if SUPERVISOR, get all HR MANAGERS details
		
		$xconditions = 'AND org_id = '. $org_id;
			
		if ($level == 'SUPERVISOR')
			$xconditions .= ' AND level = "HR MANAGERS"';
		else if ($level == 'EMPLOYEE')
			$xconditions .= ' AND (level = "HR MANAGERS" OR level == "SUPERVISORS")';
		
		$data = array();
		$query = "SELECT * FROM users WHERE 1=1 ".$xconditions;
		$res = execute_query($this->conn, $query, '');
		if (PEAR::isError($res)) 
		{
			die($res->getMessage());
		}
		else
		{
			$data = array();
			if ($res->numRows() > 0)
			{
				$data['users'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
			}
		}
		return $data;
		
		
		
	}	
	
	public function getRejectName($user_id)
	{
		$query = "SELECT username FROM users where user_id = " . $user_id;
		$res = execute_query($this->conn, $query, '');
		if (PEAR::isError($res)) 
		{
			die($res->getMessage());
		}
		else
		{
			$data = array();
			if ($res->numRows() > 0)
			{
				$data['users'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
			}
		}
		return $data;
		// return $query;
	}

	public function getUserAlerts($table, $key, $value)
	{
		$query = "SELECT a.*, b.* FROM ".$table." a, users b WHERE a.employee_id = b.employee_id AND a.".$key." = " . $value;
		$res = execute_query($this->conn, $query, '');
		if (PEAR::isError($res)) 
		{
			die($res->getMessage());
		}
		else
		{
			$data = array();
			if ($res->numRows() > 0)
			{
				$data['users'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
			}
		}
		return $data;
		// return $query;
	}		
	
	public function sendMail($to, $subject, $message)
	{
		// $to = 'yuri.santos@gmail.com';

		// $subject = 'Website Change Reqest';

		$headers = "From: webmaster@oceanic.com\r\n";
		$headers .= "Reply-To: webmaster@oceanic.com\r\n";
		// $headers .= "CC: susan@example.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";

		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		/*
		$message = '<html><body>';
		$message .= '<h1>Hello, World!</h1>';
		$message .= '</body></html>';
		*/

		mail($to, $subject, $message, $headers);

	}


    public function createData($new_data)
    {
        list($fields_values, $result_types) = $this->prepareCreateUpdateData($new_data, $this->required_columns);

        // print_r($new_data);
        // print_r($fields_values);
        // print_r($result_types);

        $res = $this->conn->extended->autoExecute($this->table, $fields_values, MDB2_AUTOQUERY_INSERT, false, $result_types);
        if (!PEAR::isError($res))
        {
            $insert_id = $this->conn->lastInsertID();
			
			// this goes the email alert
			$os = array("leave_applications", "ot_applications", "ob_applications");
			if (in_array($this->table, $os)) 
			{
				$users = $this->getHigherDetails($new_data['org_id'], $_SESSION['level']);
				// prepare fields per table
				// $this->sendMail('yuri.santos@gmail.com', 'Pending Overtime for Approval');
				switch($this->table)
				{
					case 'leave_applications':
						$subject = "Pending Leave for Approval";
						$message = "You have a pending Leave for Approval";
					break;
					case 'ot_applications':
						$pdata['ot_start'] = $new_data['ot_start'];
						$pdata['total_hours'] = $new_data['total_hours'];
						$pdata['employee_id'] = $new_data['employee_id'];
						$pdata['reason'] = $new_data['reason'];
						$pdata['output'] = $new_data['output'];
						$subject = "Pending Overtime for Approval";
						$message = "You have a pending Overtime for Approval";
					break;
					case 'ob_applications':
						$subject = "Pending OB for Approval";
						$message = "You have a pending OB for Approval";
					default:
					break;
				}
				
				for($i=0; $i<=count($users); $i++)
				{
					$this->sendMail($users['users'][$i]['email'], $subject, $message);
				}
				
			}			
            return $insert_id;
        }

        // print_r($res);
        die($res->getMessage());
    }


    public function updateData($id, $new_data)
    {
        // $this->conn->loadModule('Extended');
        $where_clause = $this->primary_id_name."=".$this->conn->quote($id, 'integer');

        list($fields_values, $result_types) = $this->prepareCreateUpdateData($new_data, $this->updateable_columns);

        $res = $this->conn->extended->autoExecute($this->table, $fields_values, MDB2_AUTOQUERY_UPDATE, $where_clause, $result_types);
        if (!PEAR::isError($res))
        {
            return (0 < $res) ? true : false;
        }
        print_r($res);
        die($res->getMessage());
    }


    public function deleteData($id)
    {
        // $this->conn->loadModule('Extended');
        $where_clause = $this->primary_id_name."=".$this->conn->quote($id, 'integer');

        $res = $this->conn->extended->autoExecute($this->table, null, MDB2_AUTOQUERY_DELETE, $where_clause);
        if (!PEAR::isError($res))
        {
            return (0 < $res) ? true : false;
        }
        die($res->getMessage());
    }


    protected function prepareCreateUpdateData($new_data, $chosen_columns)
    {
        $data = array();
        $types = array();

        foreach ($new_data as $key => $value)
        {
            if (in_array($key, $chosen_columns))
            {
                $data[$key] = $value;
                $types[] = $this->columns[$key];
            }
        }

        return array($data, $types);
    }


    protected function selectData($where_clause=false)
    {
        if (empty($where_clause))
            $where_clause = false;

        $res = $this->conn->extended->autoExecute($this->table, null, MDB2_AUTOQUERY_SELECT, $where_clause, null, true, $this->viewable_columns);
        if (!PEAR::isError($res))
        {
            $data = array('total'=>0, $this->table=>array());
            if ($res->numRows() > 0)
            {
                $data['total'] = $res->numRows();
                $data[$this->table] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
            }
            // print_r($res);
            return $data;
        }
        print_r($res);
        die($res->getMessage());
    }


    protected function generateSearchWhereClause($where_clause, $search_kw='')
    {
        if(!empty($search_kw))
        {
            // $this->conn->loadModule('Extended');
            $len = count($this->searchable_columns);
            $i = 0;
            foreach ($this->searchable_columns as $column)
            {
                if ('id' != substr($column, -2))
                {
                    $where_clause .= "$column like ".$this->conn->quote('%'.$search_kw.'%', 'text');
                    if ($i != $len - 1)
                        $where_clause .= ' OR ';
                }
                $i++;
            }
        }

        return $where_clause;
    }


    protected function prepareSearchColumns($chosen_columns)
    {
        if (!empty($chosen_columns))
        {
            return $chosen_columns;
        }
        return array_keys($this->columns);
    }


    protected function prepareViewColumns($chosen_columns)
    {
        $cols = $this->columns;
        if (!empty($chosen_columns))
        {
            $cols = array();
            foreach ($this->columns as $key => $value) {
                if (in_array($key, $chosen_columns))
                    $cols[$key] = $value;
            }
        }
        return $cols;
    }


    protected function prepareCreateUpdateColumns($chosen_columns)
    {
        $cols = array_keys($this->columns);
        if (in_array($this->primary_id_name, $cols))
            unset($cols[array_search($this->primary_id_name, $cols)]);

        if(!empty($chosen_columns))
            $cols = array_intersect($cols, $chosen_columns);

        return $cols;
    }
}


class BaseOceanicForm extends BaseOceanic
{
    public function createData($new_data)
    {
        $new_data['employee_id'] = $_SESSION['employee_id'];
        // $new_data['status'] = 'PENDING';
        return parent::createData($new_data);
    }

    public function approve($formId)
    {
        $level = $_SESSION['level'];
        $status = '';
        $approved_by = '';
        $approved_date = '';
        if ('HR MANAGERS' == $level)
        {
            $status = 'MAN-APPROVED';
            $approved_by = 'man_approved_by';
            $approved_date = 'man_approved_date';
        }
        else if('SUPERVISORS' == $level)
        {
            // $status = 'SUP-APPROVED';
			$status = 'MAN-APPROVED';
            $approved_by = 'sup_approved_by';
            $approved_date = 'sup_approved_date';
        }

        $update = array(
            'status' => $status,
            $approved_by => $_SESSION['user_id'],
            $approved_date => date('Y-m-d H:i:s')
            );

        if (!empty($approved_by))
            $this->updateData($formId, $update);
		
		// this goes the email alert
		switch($this->table)
		{
			case 'leave_applications':
				$subject = "Pending Leave for Approval";
				$message = "Your Leave has been approved";
				$users = $this->getUserAlerts('leave_applications', 'leave_id', $formId);
			break;
			case 'ot_applications':
				$subject = "[Approved] - Overtime";
				$message = "Your Overtime has been approved";
				$users = $this->getUserAlerts('ot_applications', 'ot_id', $formId);
			break;
			case 'ob_applications':
			default:
				$subject = "Pending OB for Approval";
				$message = "Your OB has been approved";
				$users = $this->getUserAlerts('ob_applications', 'ob_id', $formId);
			break;
		}
		
		for($i=0; $i<=count($users); $i++)
		{
			// send email
			$this->sendMail($users['users'][$i]['email'], $subject, $message);
		}
    }

    public function reject($formId, $reason)
    {
        $level = $_SESSION['level'];
        $status = 'REJECTED';
        $rejected_by = '';
        $rejected_date = '';
        if ('HR MANAGERS' == $level)
        {
            $rejected_by = 'man_rejected_by';
            $rejected_date = 'man_rejected_date';
        }
        else if('SUPERVISORS' == $level)
        {
            $rejected_by = 'sup_rejected_by';
            $rejected_date = 'sup_rejected_date';
        }

        $update = array(
            'status' => $status,
            'reject_reason' => $reason,
            $rejected_by => $_SESSION['user_id'],
            $rejected_date => date('Y-m-d H:i:s')
            );

        if (!empty($rejected_by))
            $this->updateData($formId, $update);
		
		
		// this goes the email alert
		switch($this->table)
		{
			case 'leave_applications':
				$subject = "[Rejected] - Leave Application";
				$users = $this->getUserAlerts('leave_applications', 'leave_id', $formId);
			break;
			case 'ot_applications':
				$subject = "[Rejected] - Overtime Application";
				$users = $this->getUserAlerts('ot_applications', 'ot_id', $formId);
			break;
			case 'ob_applications':
			default:
				$subject = "[Rejected] - OB Application";
				$users = $this->getUserAlerts('ob_applications', 'ob_id', $formId);
			break;
		}
		
		for($i=0; $i<=count($users); $i++)
		{
			switch($this->table)
			{
				case 'leave_applications':
					$start_date = $users['users'][$i]['start_date'];
					$end_date = $users['users'][$i]['end_date'];
					$leave_type = $users['users'][$i]['leave_type'];
					$reason = $users['users'][$i]['reason'];
					$reject_reason = $users['users'][$i]['reject_reason'];
					$message = "<p>Your Leave Application has been rejected.<p>";
					$message .= "<p>Here are the details<p>";
					$message .= "<p>Start: ".$start_date."<p>";
					$message .= "<p>End: ".$end_date."<p>";
					$message .= "<p>Leave Type: ".$leave_type."<p>";
					$message .= "<p>Reason: ".$reason."<p>";
					$message .= "<p>Rejected By: ".$_SESSION['username']."<p>";
					$message .= "<p>Remarks: ".$reject_reason."<p>";
				break;
				case 'ot_applications':
					$ot_start = $users['users'][$i]['ot_start'];
					$total_hours = $users['users'][$i]['total_hours'];
					$output = $users['users'][$i]['output'];
					$reject_reason = $users['users'][$i]['reject_reason'];
					$message = "<p>Your Overtime Application has been rejected.<p>";
					$message .= "<p>Here are the details<p>";
					$message .= "<p>Start: ".$ot_start."<p>";
					$message .= "<p>Total Hours: ".$total_hours."<p>";
					$message .= "<p>Reason: ".$reason."<p>";
					$message .= "<p>Output: ".$output."<p>";
					$message .= "<p>Rejected By: ".$_SESSION['username']."<p>";
					$message .= "<p>Remarks: ".$reject_reason."<p>";
				break;
				case 'ob_applications':
				default:
					$start_date = $users['users'][$i]['start_date'];
					$end_date = $users['users'][$i]['end_date'];
					$purpose = $users['users'][$i]['purpose'];
					$location = $users['users'][$i]['location'];
					$reject_reason = $users['users'][$i]['reject_reason'];
					$message = "<p>Your Leave Application has been rejected.<p>";
					$message .= "<p>Here are the details<p>";
					$message .= "<p>Start: ".$start_date."<p>";
					$message .= "<p>End: ".$end_date."<p>";
					$message .= "<p>Purpose: ".$purpose."<p>";
					$message .= "<p>Location: ".$location."<p>";
					$message .= "<p>Rejected By: ".$_SESSION['username']."<p>";
					$message .= "<p>Remarks: ".$reject_reason."<p>";
				break;
			}
			
			// send email
			$this->sendMail($users['users'][$i]['email'], $subject, $message);
		}
    }
}
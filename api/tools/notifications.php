<?

	class Notifications
	{
		public function Notifications($conn, $org_id, $emp_id, $level)
		{
			$this->conn     = $conn;
			$this->org_id   = $org_id;
			$this->emp_id   = $emp_id;
			$this->level   = $level;
		}
		
		public function countLeave()
        {
			if ($this->level == 'SUPERVISORS')
				$query = "SELECT count(1) FROM leave_applications WHERE employee_id != ".$this->emp_id." AND status='PENDING' AND org_id=" . $this->org_id;
			else if ($this->level == 'HR MANAGERS')
				$query = "SELECT count(1) FROM leave_applications WHERE employee_id != ".$this->emp_id." AND (status='PENDING' OR status='SUP-APPROVED') AND org_id=" . $this->org_id;
			$res = execute_query($this->conn, $query, '');
			$numrows = 0;
            if (PEAR::isError($res)) 
			{
				die($res->getMessage());
			}
			else
			{
				$data = array();
				$numrows = $res->numRows();
			}
			return $numrows;
        }
		
		public function countOT()
        {
			if ($this->level == 'SUPERVISORS')
				$query = "SELECT * FROM ot_applications WHERE employee_id != ".$this->emp_id." AND status='PENDING' AND org_id=" . $this->org_id;
			else if ($this->level == 'HR MANAGERS')
				$query = "SELECT * FROM ot_applications WHERE employee_id != ".$this->emp_id." AND (status='PENDING' OR status='SUP-APPROVED') AND org_id=" . $this->org_id;
			$res = execute_query($this->conn, $query, '');
			$numrows = 0;
            if (PEAR::isError($res)) 
			{
				die($res->getMessage());
			}
			else
			{
				$data = array();
				$numrows = $res->numRows();
			}
			return $numrows;
        }
		
		public function countOB()
        {
			if ($this->level == 'SUPERVISORS')
				$query = "SELECT * FROM ob_applications WHERE employee_id != ".$this->emp_id." AND status='PENDING' AND org_id=" . $this->org_id;
			else if ($this->level == 'HR MANAGERS')
				$query = "SELECT * FROM ob_applications WHERE employee_id != ".$this->emp_id." AND (status='PENDING' OR status='SUP-APPROVED') AND org_id=" . $this->org_id;
			$res = execute_query($this->conn, $query, '');
			$numrows = 0;
            if (PEAR::isError($res)) 
			{
				die($res->getMessage());
			}
			else
			{
				$data = array();
				$numrows = $res->numRows();
			}
			return $numrows;
        }
        
	}
	
	class EmailSystem
	{
		public function EmailSystem($conn, $org_id, $level)
		{
			$this->conn     = $conn;
			$this->org_id   = $org_id;
			$this->level   = $level;
		}
		
		public function getHigherDetails()
        {
			// if EMPLOYEE, get all SUPERVISORS and HR MANAGERS details
			// if SUPERVISOR, get all HR MANAGERS details
			
			$xconditions = 'AND org_id = '. $this->org_id;
			
			if ($this->level == 'SUPERVISOR')
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
	}
	
?>
<?php

    class Login {
		public function Login($conn, $username, $password)
		{
			$this->conn         = $conn;
            $this->username     = $username;
            $this->password     = $password;
		}

        public function Authenticate()
        {
     //        $table_name = 'users';
     //        $result_types = array(
     //                'user_id' => 'integer',
					// 'username' => 'text',
     //                'level' => 'text',
     //                'email' => 'text',
					// 'employee_id' => 'integer',
     //                'org_id' => 'integer'
     //        );
     //        $data = array();
            $result = 'INVALID';
            $query = 'SELECT a.user_id, a.username, a.level, a.employee_id, a.org_id, a.email, b.logo FROM users a, organization b WHERE a.org_id = b.org_id AND username="'.$this->username.'" AND password="'.$this->password.'" AND status_flag = 1';
            $res = execute_query($this->conn, $query, '');
            // print_r($res);
            if (!PEAR::isError($res))
            {
                if ($res->numRows() > 0)
                {
                    $row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
                    // save session
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['level'] = $row['level'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['employee_id'] = $row['employee_id'];
                    $_SESSION['org_id'] = $row['org_id'];
                    $_SESSION['logo'] = $row['logo'];


                    // set login session
                    $this->setLoginSession($row['user_id'], $_COOKIE['PHPSESSID']);
                    $result = 'OK';
                }

                return $result;
            }
            die($res->getMessage());

   //          $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'username="'.$this->username.'" AND password="'.$this->password.'" AND status_flag = "1"', null, true, $result_types);
   //          if (PEAR::isError($res))
			// {
			// 	die($res->getMessage());
			// }
			// else
			// {
			// 	if ($res->numRows() == 0)
   //              {
   //                  $result = 'INVALID';
   //              }
   //              else
   //              {
   //                  $row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
   //                  // save session
   //                  $_SESSION['user_id'] = $row['user_id'];
			// 		$_SESSION['username'] = $row['username'];
			// 		$_SESSION['level'] = $row['level'];
			// 		$_SESSION['email'] = $row['email'];
			// 		$_SESSION['employee_id'] = $row['employee_id'];
   //                  $_SESSION['org_id'] = $row['org_id'];


			// 		// set login session
			// 		$this->setLoginSession($row['user_id'], $_COOKIE['PHPSESSID']);
			// 		$result = 'OK';

   //              }
			// }
   //          return $result;
        }

		function setLoginSession($id, $session)
		{
			$table_name = 'users';
			$field_values   = array(
						  'session_id' => $session
				   );
			$types  = array('text');
			$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'user_id = "'.$id.'" LIMIT 1', $types);
		}

	}

?>
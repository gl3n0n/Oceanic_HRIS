<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/users.php';

$obj_to_use = "Users";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/users.php');
// require_once('database/dbtools.php');
// if (!empty($_POST))
// {
// 	$conn = connect();
// 	$Tools = new Tools ($_POST);
// 	$_POST = $Tools->PreparePost();

// 	$profile_id = $_SESSION['user_id'];
// 	if (empty($profile_id))
// 	{
// 		$json['code'] = "401";
// 		$json['response'] = "Login Required!";
// 	}
// 	else
// 	{
// 		// check parameters
// 		$action      = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$employee_id   = (isset($_POST['employee_id']) ? strtolower($_POST['employee_id']) : NULL);
// 		$username   = (isset($_POST['username']) ? strtolower($_POST['username']) : NULL);
// 		$password   = (isset($_POST['password']) ? strtolower($_POST['password']) : NULL);
// 		$email    = (isset($_POST['email']) ? strtolower($_POST['email']) : NULL);
// 		$level   = (isset($_POST['level']) ? strtolower($_POST['level']) : NULL);
// 		//echo '<pre>';
// 		//print_r($_POST);
// 		//exit();
// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			if ($password != '')
// 			{
// 				$new_password = crypt($password, SALT);
// 			}
// 			else
// 			{
// 				$new_password = '';
// 			}
// 			//echo "password:: $password<br>";
// 			//echo "new password: $new_password";
// 			$user = new Users($conn, $employee_id, $username, $new_password, $email, $level);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if employee_id exist
// 						if ($user->checkEmployeeId() == '')
// 						{
// 							// insert records
// 							$insertId = $user->CreateUsers();
// 							$json['code'] = "OK";
// 							$json['response'] = " $insertId Inserted";
// 						}
// 						else
// 						{
// 							$json['code'] = "403";
// 							$json['response'] = "Records already existing!";
// 						}
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'edit':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if has dept id
// 						$user_id = (isset($_POST['user_id']) ? strtolower($_POST['user_id']) : NULL);
// 						if ($user_id != '')
// 						{
// 							$user->UpdateUser($user_id);
// 							$json['code'] = "OK";
// 							$json['response'] = "Record Updated";

// 						}
// 						else
// 						{
// 							$json['code'] = "403";
// 							$json['response'] = "No records found on the database!";
// 						}

// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'delete':
// 					$user_id = (isset($_POST['user_id']) ? strtolower($_POST['user_id']) : NULL);

// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$user->DeleteRecord($user_id);
// 						$json['code'] = "OK";
// 						$json['response'] = "Record Deleted";
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'view':
// 					// check if has access, only hr managers can add
// 					$keyword = (isset($_POST['keyword']) ? strtolower($_POST['keyword']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $user->viewUsers($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'view-id':
// 					// check if has access, only hr managers can add
// 					$user_id = (isset($_POST['user_id']) ? strtolower($_POST['user_id']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $user->viewUserById($user_id);
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				default:
// 					$json['code'] = "403";
// 					$json['response'] = "You dont have a permission on this module!";
// 					break;
// 			}
// 		}

// 	}
// }
// $json = json_encode($json);
// echo $json;
?>
<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/employee_family.php';

$obj_to_use = "EmployeeFamily";

$json = base_process_request($obj_to_use);
exit($json);


// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/employee-family.php');
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
// 		$employee_id = (isset($_POST['employee_id']) ? strtolower($_POST['employee_id']) : NULL);
// 		$action      = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$name      = (isset($_POST['name']) ? strtolower($_POST['name']) : NULL);
// 		$birthdate       = (isset($_POST['birthdate']) ? strtolower($_POST['birthdate']) : NULL);
// 		$gender      = (isset($_POST['gender']) ? strtolower($_POST['gender']) : NULL);
// 		$relationship      = (isset($_POST['relationship']) ? strtolower($_POST['relationship']) : NULL);
// 		$civil_status      = (isset($_POST['civil_status']) ? strtolower($_POST['civil_status']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$family = new Family($conn, $employee_id, $name, $birthdate, $gender, $relationship, $civil_status);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if complete params
// 						if ($employee_id != '' && $name != '' && $birthdate != '' && $gender != '' && $relationship != '')
// 						{
// 							// insert records
// 							$insertId = $family->CreateFamily();
// 							$json['code'] = "OK";
// 							$json['response'] = "Leave Type id $insertId Inserted";
// 						}
// 						else
// 						{
// 							$json['code'] = "402";
// 							$json['response'] = "Incomplete Parameters!";
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
// 						$lv_type_id = (isset($_POST['lv_type_id']) ? strtolower($_POST['lv_type_id']) : NULL);
// 						if ($lv_type_id != '')
// 						{
// 							// check if rank_id exists
// 							if ($policies->checkPoliciesId($lv_type_id))
// 							{
// 								$policies->UpdatePolicies($lv_type_id);
// 								$json['code'] = "OK";
// 								$json['response'] = "Record Updated";
// 							}
// 							else
// 							{
// 								$json['code'] = "403";
// 								$json['response'] = "Invalid employee type Id!";
// 							}
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
// 					$json['code'] = "403";
// 					$json['response'] = "You dont have a permission on this module!";
// 					break;
// 				case 'view':
// 					// check if has access, only hr managers can add
// 					$keyword = (isset($_POST['keyword']) ? strtolower($_POST['keyword']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$familyList = $family->viewFamily($keyword, $employee_id);
// 						$json['code'] = "200";
// 						$json['response'] = $familyList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 				default:
// 					break;
// 			}
// 		}

// 	}
// }
// $json = json_encode($json);
// echo $json;
?>
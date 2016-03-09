<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/employee_type.php';

$obj_to_use = "EmployeeType";

$json = base_process_request($obj_to_use);
exit($json);


// if (!empty($_POST))
// {
// 	$conn = connect();
// 	$Tools = new Tools ($_POST);
// 	$_POST = $Tools->PreparePost();

// 	$profile_id = (isset($_SESSION['user_id']) ? strtolower($_SESSION['user_id']) : NULL);
// 	if (empty($profile_id))
// 	{
// 		$json['code'] = "401";
// 		$json['response'] = "Login Required!";
// 	}
// 	else
// 	{
// 		// check parameters
// 		$action       = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$empl_type    = (isset($_POST['empl_type']) ? strtolower($_POST['empl_type']) : NULL);
// 		$description  = (isset($_POST['description']) ? strtolower($_POST['description']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$employee_type = new EmployeeType($conn, $empl_type, $description);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if dept_code exist
// 						if ($employee_type->checkEmployeeType() == '')
// 						{
// 							// insert records
// 							$insertId = $employee_type->CreateEmployeeType();
// 							$json['code'] = "OK";
// 							$json['response'] = "Employee Type id $insertId Inserted";
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
// 						$empl_type_id = (isset($_POST['empl_type_id']) ? strtolower($_POST['empl_type_id']) : NULL);
// 						if ($empl_type_id != '')
// 						{
// 							// check if rank_id exists
// 							if ($employee_type->checkEmployeeTypeId($empl_type_id))
// 							{
// 								$employee_type->UpdateEmployeeType($empl_type_id);
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
// 					$empl_type_id = (isset($_POST['empl_type_id']) ? strtolower($_POST['empl_type_id']) : NULL);

// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$employee_type->DeleteRecord($empl_type_id);
// 						$json['code'] = "OK";
// 						$json['response'] = "Record Deleted";
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'view-id':
// 					// check if has access, only hr managers can add
// 					$empl_type_id = (isset($_POST['empl_type_id']) ? strtolower($_POST['empl_type_id']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $employee_type->viewEmployeeTypeById($empl_type_id);
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
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
// 						$rankList = $employee_type->viewEmployeeTypes($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $rankList;
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
// else
// {
// 	$json['code'] = "401";
// 	$json['response'] = "You dont have a permission on this module!";
// }
// $json = json_encode($json);
// echo $json;
?>
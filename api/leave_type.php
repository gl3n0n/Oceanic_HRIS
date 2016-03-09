<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );
@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/leave_type.php';

$obj_to_use = "LeaveType";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/leave_type.php');
// require_once('database/dbtools.php');
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
// 		$action          = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$lv_code         = (isset($_POST['lv_code']) ? strtolower($_POST['lv_code']) : NULL);
// 		$lv_description  = (isset($_POST['lv_description']) ? strtolower($_POST['lv_description']) : NULL);
// 		$lv_credits      = (isset($_POST['lv_credits']) ? strtolower($_POST['lv_credits']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$leave_type = new LeaveType($conn, $lv_code, $lv_description, $lv_credits);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if leave_type exist
// 						if ($leave_type->checkLeaveType() == '')
// 						{
// 							// insert records
// 							$insertId = $leave_type->CreateLeaveType();
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
// 						$lv_id = (isset($_POST['lv_id']) ? strtolower($_POST['lv_id']) : NULL);
// 						if ($lv_id != '')
// 						{
// 							// check if rank_id exists
// 							if ($leave_type->checkLeaveTypeId($lv_id))
// 							{
// 								$leave_type->UpdateLeaveType($lv_id);
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
// 					$lv_id = (isset($_POST['lv_id']) ? strtolower($_POST['lv_id']) : NULL);

// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$leave_type->DeleteRecord($lv_id);
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
// 					$lv_id = (isset($_POST['lv_id']) ? strtolower($_POST['lv_id']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $leave_type->viewLeaveTypeById($lv_id);
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
// 						$leaveList = $leave_type->viewLeaveTypes($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $leaveList;
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
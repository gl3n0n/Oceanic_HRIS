<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/position.php';

$obj_to_use = "Position";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/position.php');
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
// 		$action       = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$position_code    = (isset($_POST['position_code']) ? strtolower($_POST['position_code']) : NULL);
// 		$position_title  = (isset($_POST['position_title']) ? strtolower($_POST['position_title']) : NULL);
// 		$position_description  = (isset($_POST['position_description']) ? strtolower($_POST['position_description']) : NULL);
// 		$job_id  = (isset($_POST['job_id']) ? strtolower($_POST['job_id']) : NULL);
// 		$dept_id  = (isset($_POST['dept_id']) ? strtolower($_POST['dept_id']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$position = new Position($conn, $position_code, $position_title, $position_description, $job_id, $dept_id);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if position_code exist
// 						if ($position->checkPositionCode() == '')
// 						{
// 							// insert records
// 							$insertId = $position->CreatePosition();
// 							$json['code'] = "OK";
// 							$json['response'] = "Position id $insertId Inserted";
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
// 						$position_id = (isset($_POST['position_id']) ? strtolower($_POST['position_id']) : NULL);
// 						if ($position_id != '')
// 						{
// 							$position->UpdatePosition($position_id);
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
// 				case 'view-id':
// 					// check if has access, only hr managers can add
// 					$position_id = (isset($_POST['position_id']) ? strtolower($_POST['position_id']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $position->viewPositionById($position_id);
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'get_position_code':
// 					$deptList = $position->GeneratePositionCode();
// 					$json['code'] = "200";
// 					$json['response'] = $deptList;
// 					break;
// 				case 'delete':
// 					$position_id = (isset($_POST['position_id']) ? strtolower($_POST['position_id']) : NULL);

// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$position->DeleteRecord($position_id);
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
// 						$positionList = $position->viewPositions($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $positionList;
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
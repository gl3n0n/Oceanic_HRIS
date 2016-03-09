<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING


@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/employee_training.php';

$obj_to_use = "EmployeeTraining";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/employee-training.php');
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
// 		$employee_id  = (isset($_POST['employee_id']) ? strtolower($_POST['employee_id']) : NULL);
// 		$action       = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$training_type  = (isset($_POST['training_type']) ? strtolower($_POST['training_type']) : NULL);
// 		$description    = (isset($_POST['description']) ? strtolower($_POST['description']) : NULL);
// 		$date_attended     = (isset($_POST['date_attended']) ? strtolower($_POST['date_attended']) : NULL);
// 		$remarks    = (isset($_POST['remarks']) ? strtolower($_POST['remarks']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$training = new Training($conn, $employee_id, $training_type, $description, $date_attended, $remarks);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if complete params
// 						if ($employee_id != '' && $training_type != '' && $description != '' && $date_attended != '' && $remarks != '')
// 						{
// 							// insert records
// 							$insertId = $training->CreateTraining();
// 							$json['code'] = "OK";
// 							$json['response'] = "Training id $insertId Inserted";
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
// 						$trainingList = $training->viewTraining($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $trainingList;
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
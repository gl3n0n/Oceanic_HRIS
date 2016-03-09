<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/obform.php';

$obj_to_use = "ObForm";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/obform.php');
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
// 		$action = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
// 		$ob_id = (isset($_POST['ob_id']) ? strtolower($_POST['ob_id']) : NULL);
// 		$employee_id = (isset($_POST['employee_id']) ? strtolower($_POST['employee_id']) : NULL);
// 		$start_date = (isset($_POST['start_date']) ? strtolower($_POST['start_date']) : NULL);
// 		$end_date = (isset($_POST['end_date']) ? strtolower($_POST['end_date']) : NULL);
// 		$purpose = (isset($_POST['purpose']) ? strtolower($_POST['purpose']) : NULL);
// 		$status = (isset($_POST['status']) ? strtolower($_POST['status']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$obform = new ObForm($conn, $employee_id, $start_date, $end_date, $purpose, $_SESSION);
// 			switch ($action)
// 			{
// 				case 'add':
// 					$insertId = $obform->CreateObForm();
// 					$json['code'] = "OK";
// 					$json['response'] = " $insertId Inserted";
// 					break;
// 				case 'view':
// 					$keyword = (isset($_POST['keyword']) ? strtolower($_POST['keyword']) : NULL);
// 					$otList = $obform->viewObForm($keyword);
// 					$json['code'] = "200";
// 					$json['response'] = $otList;
// 					break;
// 				case 'approve':
// 					$otPending = $obform->approveOB($ob_id);
// 					$json['code'] = "OK";
// 					$json['response'] = "Record Updated";
// 					break;
// 				case 'reject':
// 					$otPending = $obform->rejectOB($ob_id);
// 					$json['code'] = "OK";
// 					$json['response'] = "Record Updated";
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
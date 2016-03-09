<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/location.php';

$obj_to_use = "Location";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/location.php');
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
// 		$location_code   = (isset($_POST['location_code']) ? strtolower($_POST['location_code']) : NULL);
// 		$description     = (isset($_POST['description']) ? strtolower($_POST['description']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$location = new Location($conn, $location_code, $description);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if leave_type exist
// 						if ($location->checkLocation() == '')
// 						{
// 							// insert records
// 							$insertId = $location->CreateLocation();
// 							$json['code'] = "OK";
// 							$json['response'] = "Location id $insertId Inserted";
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
// 						$location_id = (isset($_POST['location_id']) ? strtolower($_POST['location_id']) : NULL);
// 						if ($location_id != '')
// 						{
// 							// check if rank_id exists
// 							if ($location->checkLocationId($location_id))
// 							{
// 								$location->UpdateLocation($location_id);
// 								$json['code'] = "OK";
// 								$json['response'] = "Record Updated";
// 							}
// 							else
// 							{
// 								$json['code'] = "403";
// 								$json['response'] = "Invalid Location Id!";
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
// 					$location_id = (isset($_POST['location_id']) ? strtolower($_POST['location_id']) : NULL);

// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$location->DeleteRecord($location_id);
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
// 					$location_id = (isset($_POST['location_id']) ? strtolower($_POST['location_id']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $location->viewLocationById($location_id);
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
// 						$leaveList = $location->viewLocations($keyword);
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
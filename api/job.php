<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );
@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/job.php';

$obj_to_use = "Job";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/job.php');
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
// 		$job_code = (isset($_POST['job_code']) ? strtolower($_POST['job_code']) : NULL);
// 		$job_description = (isset($_POST['job_description']) ? strtolower($_POST['job_description']) : NULL);

// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$job = new Job($conn, $job_code, $job_description);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// check if dept_code exist
// 						if ($job->checkJobCode() == '')
// 						{
// 							// insert records
// 							$insertId = $job->CreateJob();
// 							$json['code'] = "OK";
// 							$json['response'] = "Job id $insertId Inserted";
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
// 						$job_id = (isset($_POST['job_id']) ? strtolower($_POST['job_id']) : NULL);
// 						if ($job_id != '')
// 						{
// 							// check if job_id exists
// 							if ($job->checkJobId($job_id))
// 							{
// 								$job->UpdateJob($job_id);
// 								$json['code'] = "OK";
// 								$json['response'] = "Record Updated";
// 							}
// 							else
// 							{
// 								$json['code'] = "403";
// 								$json['response'] = "Invalid Job Id!";
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
// 				case 'view-id':
// 					// check if has access, only hr managers can add
// 					$job_id = (isset($_POST['job_id']) ? strtolower($_POST['job_id']) : NULL);
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$deptList = $job->viewJobById($job_id);
// 						$json['code'] = "200";
// 						$json['response'] = $deptList;
// 					}
// 					else
// 					{
// 						$json['code'] = "403";
// 						$json['response'] = "You dont have a permission on this module!";
// 					}
// 					break;
// 				case 'delete':
// 					$job_id = (isset($_POST['job_id']) ? strtolower($_POST['job_id']) : NULL);

// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						$job->DeleteRecord($job_id);
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
// 						$jobList = $job->viewJobs($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $jobList;
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
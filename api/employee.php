<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );
@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/employee.php';

$obj_to_use = "Employee";

$json = base_process_request($obj_to_use);
exit($json);


// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/employee.php');
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
// 		$lastname   = (isset($_POST['lastname']) ? strtolower($_POST['lastname']) : NULL);
// 		$firstname   = (isset($_POST['firstname']) ? strtolower($_POST['firstname']) : NULL);
// 		$middlename   = (isset($_POST['middlename']) ? strtolower($_POST['middlename']) : NULL);
// 		$dept_id   = (isset($_POST['dept_id']) ? strtolower($_POST['dept_id']) : NULL);
// 		$position_id   = (isset($_POST['position_id']) ? strtolower($_POST['position_id']) : NULL);
// 		$gender   = (isset($_POST['gender']) ? strtolower($_POST['gender']) : NULL);
// 		$empl_type_id   = (isset($_POST['empl_type_id']) ? strtolower($_POST['empl_type_id']) : NULL);
// 		$address   = (isset($_POST['address']) ? strtolower($_POST['address']) : NULL);
// 		$tel_no        = (isset($_POST['tel_no']) ? strtolower($_POST['tel_no']) : NULL);
// 		$cell_no    = (isset($_POST['cell_no']) ? strtolower($_POST['cell_no']) : NULL);
// 		$civil_status   = (isset($_POST['civil_status']) ? strtolower($_POST['civil_status']) : NULL);
// 		$religion = (isset($_POST['religion']) ? strtolower($_POST['religion']) : NULL);
// 		$date_hired   = (isset($_POST['date_hired']) ? strtolower($_POST['date_hired']) : NULL);
// 		$birthdate   = (isset($_POST['birthdate']) ? strtolower($_POST['birthdate']) : NULL);
// 		$birthplace   = (isset($_POST['birthplace']) ? strtolower($_POST['birthplace']) : NULL);
// 		$empl_status   = (isset($_POST['empl_status']) ? strtolower($_POST['empl_status']) : NULL);
// 		$sss   = (isset($_POST['sss']) ? strtolower($_POST['sss']) : NULL);
// 		$tin   = (isset($_POST['tin']) ? strtolower($_POST['tin']) : NULL);
// 		$pagibig   = (isset($_POST['pagibig']) ? strtolower($_POST['pagibig']) : NULL);
// 		$philhealth   = (isset($_POST['philhealth']) ? strtolower($_POST['philhealth']) : NULL);
// 		$tax_type   = (isset($_POST['tax_type']) ? strtolower($_POST['tax_type']) : NULL);
// 		$salary_grade   = (isset($_POST['salary_grade']) ? strtolower($_POST['salary_grade']) : NULL);
// 		$passport_no   = (isset($_POST['passport_no']) ? strtolower($_POST['passport_no']) : NULL);
// 		$passport_exp   = (isset($_POST['passport_exp']) ? strtolower($_POST['passport_exp']) : NULL);
// 		$date_resigned   = (isset($_POST['date_resigned']) ? strtolower($_POST['date_resigned']) : NULL);
// 		$seaman_book_no   = (isset($_POST['seaman_book_no']) ? strtolower($_POST['seaman_book_no']) : NULL);
// 		$seaman_book_exp   = (isset($_POST['seaman_book_exp']) ? strtolower($_POST['seaman_book_exp']) : NULL);
// 		$biometric_no   = (isset($_POST['biometric_no']) ? strtolower($_POST['biometric_no']) : NULL);
// 		if ($action == '')
// 		{
// 			$json['code'] = "402";
// 			$json['response'] = "Incomplete Parameters!";
// 		}
// 		else
// 		{
// 			$employee = new Employee($conn, $lastname, $firstname, $middlename, $dept_id, $position_id,
// 									$gender, $empl_type_id, $address, $tel_no, $cell_no, $civil_status,
// 									$religion, $date_hired, $birthdate, $birthplace, $empl_status, $sss,
// 									$tin, $pagibig, $philhealth, $tax_type, $salary_grade, $passport_no,
// 									$passport_exp, $date_resigned, $seaman_book_no, $seaman_book_exp, $biometric_no);
// 			switch ($action)
// 			{
// 				case 'add':
// 					// check if has access, only hr managers can add
// 					if ($_SESSION['level'] == 'HR MANAGERS')
// 					{
// 						// insert records
// 							$insertId = $employee->CreateEmployee();
// 							$json['code'] = "OK";
// 							$json['response'] = " $insertId Inserted";
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
// 						$dept_id = (isset($_POST['dept_id']) ? strtolower($_POST['dept_id']) : NULL);
// 						if ($dept_id != '')
// 						{
// 							// check if dept_id exists
// 							if ($department->checkDeptId($dept_id))
// 							{
// 								$department->UpdateDept($dept_id);
// 								$json['code'] = "OK";
// 								$json['response'] = "Record Updated";
// 							}
// 							else
// 							{
// 								$json['code'] = "403";
// 								$json['response'] = "Invalid Department Id!";
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
// 						$emplList = $employee->viewEmployee($keyword);
// 						$json['code'] = "200";
// 						$json['response'] = $emplList;
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
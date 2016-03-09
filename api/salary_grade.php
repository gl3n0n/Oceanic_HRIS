<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/salary_grade.php';

$obj_to_use = "SalaryGrade";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/salary_grade.php');
// require_once('database/dbtools.php');
// if (!empty($_POST))
// {
//     $conn = connect();
//     $Tools = new Tools ($_POST);
//     $_POST = $Tools->PreparePost();

//     $profile_id = (isset($_SESSION['user_id']) ? strtolower($_SESSION['user_id']) : NULL);
//     if (empty($profile_id))
//     {
//         $json['code'] = "401";
//         $json['response'] = "Login Required!";
//     }
//     else
//     {
//         // check parameters
//         $action = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);

//         $sal_grd_id = (isset($_POST['sal_grd_id']) ? strtolower($_POST['sal_grd_id']) : NULL);
//         $gr_lvl = (isset($_POST['gr_lvl']) ? strtolower($_POST['gr_lvl']) : NULL);
//         $job_id = (isset($_POST['job_id']) ? strtolower($_POST['job_id']) : NULL);
//         $classification = (isset($_POST['classification']) ? strtolower($_POST['classification']) : NULL);
//         $minimum = (isset($_POST['minimum']) ? strtolower($_POST['minimum']) : NULL);
//         $median = (isset($_POST['median']) ? strtolower($_POST['median']) : NULL);
//         $maximum = (isset($_POST['maximum']) ? strtolower($_POST['maximum']) : NULL);

//         if ($action == '')
//         {
//             $json['code'] = "402";
//             $json['response'] = "Incomplete Parameters!";
//         }
//         else
//         {
//             $salary_grade = new SalaryGrade($conn, $gr_lvl, $job_id, $classification, $minimum, $median, $maximum);
//             switch ($action)
//             {
//                 case 'add':
//                     // check if has access, only hr managers can add
//                     if ($_SESSION['level'] == 'HR MANAGERS')
//                     {
//                         // check if leave_type exist
//                         if ($salary_grade->checkSalaryGrade() == '')
//                         {
//                             // insert records
//                             $insertId = $salary_grade->CreateSalaryGrade();
//                             $json['code'] = "OK";
//                             $json['response'] = "Salary Grade id $insertId Inserted";
//                         }
//                         else
//                         {
//                             $json['code'] = "403";
//                             $json['response'] = "Records already existing!";
//                         }
//                     }
//                     else
//                     {
//                         $json['code'] = "403";
//                         $json['response'] = "You dont have a permission on this module!";
//                     }
//                     break;
//                 case 'edit':
//                     // check if has access, only hr managers can add
//                     if ($_SESSION['level'] == 'HR MANAGERS')
//                     {
//                         // check if has dept id
//                         if ($sal_grd_id != '')
//                         {
//                             // check if rank_id exists
//                             if ($salary_grade->checkSalaryGradeId($sal_grd_id))
//                             {
//                                 $salary_grade->UpdateSalaryGrade($sal_grd_id);
//                                 $json['code'] = "OK";
//                                 $json['response'] = "Record Updated";
//                             }
//                             else
//                             {
//                                 $json['code'] = "403";
//                                 $json['response'] = "Invalid Salary Grade Id!";
//                             }
//                         }
//                         else
//                         {
//                             $json['code'] = "403";
//                             $json['response'] = "No records found on the database!";
//                         }

//                     }
//                     else
//                     {
//                         $json['code'] = "403";
//                         $json['response'] = "You dont have a permission on this module!";
//                     }
//                     break;
//                 case 'delete':

//                     if ($_SESSION['level'] == 'HR MANAGERS')
//                     {
//                         $salary_grade->DeleteRecord($sal_grd_id);
//                         $json['code'] = "OK";
//                         $json['response'] = "Record Deleted";
//                     }
//                     else
//                     {
//                         $json['code'] = "403";
//                         $json['response'] = "You dont have a permission on this module!";
//                     }
//                     break;
//                 case 'view-id':
//                     // check if has access, only hr managers can add
//                     if ($_SESSION['level'] == 'HR MANAGERS')
//                     {
//                         $deptList = $salary_grade->viewSalaryGradeById($sal_grd_id);
//                         $json['code'] = "200";
//                         $json['response'] = $deptList;
//                     }
//                     else
//                     {
//                         $json['code'] = "403";
//                         $json['response'] = "You dont have a permission on this module!";
//                     }
//                     break;
//                 case 'view':
//                     // check if has access, only hr managers can add
//                     $keyword = (isset($_POST['keyword']) ? strtolower($_POST['keyword']) : NULL);
//                     if ($_SESSION['level'] == 'HR MANAGERS')
//                     {
//                         $salaryGradeList = $salary_grade->viewSalaryGrades($keyword);
//                         $json['code'] = "200";
//                         $json['response'] = $salaryGradeList;
//                     }
//                     else
//                     {
//                         $json['code'] = "403";
//                         $json['response'] = "You dont have a permission on this module!";
//                     }
//                 default:
//                     break;
//             }
//         }

//     }
// }
// else
// {
//     $json['code'] = "401";
//     $json['response'] = "You dont have a permission on this module!";
// }
// $json = json_encode($json);
// echo $json;
?>
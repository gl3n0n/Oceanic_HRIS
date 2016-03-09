<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/otform.php';

$obj_to_use = "OtForm";

$json = base_process_request($obj_to_use);
exit($json);

// @ob_gzhandler('ob_start');
// session_start();
// require('_config.php');
// require('tools/tools.php');
// require('tools/otform.php');
// require_once('database/dbtools.php');
// if (!empty($_POST))
// {
//     $conn = connect();
//     $Tools = new Tools ($_POST);
//     $_POST = $Tools->PreparePost();

//     $profile_id = $_SESSION['user_id'];
//     if (empty($profile_id))
//     {
//         $json['code'] = "401";
//         $json['response'] = "Login Required!";
//     }
//     else
//     {
//         // check parameters
//         $action = (isset($_POST['action']) ? strtolower($_POST['action']) : NULL);
//         $ot_id = (isset($_POST['ot_id']) ? strtolower($_POST['ot_id']) : NULL);
//         $employee_id = (isset($_POST['employee_id']) ? strtolower($_POST['employee_id']) : NULL);
//         $ot_start = (isset($_POST['ot_start']) ? strtolower($_POST['ot_start']) : NULL);
//         $ot_end = (isset($_POST['ot_end']) ? strtolower($_POST['ot_end']) : NULL);
//         $total_hours = (isset($_POST['total_hours']) ? strtolower($_POST['total_hours']) : NULL);
//         $reason = (isset($_POST['reason']) ? strtolower($_POST['reason']) : NULL);
//         $output = (isset($_POST['output']) ? strtolower($_POST['output']) : NULL);
//         $status = (isset($_POST['status']) ? strtolower($_POST['status']) : NULL);

//         if ($action == '')
//         {
//             $json['code'] = "402";
//             $json['response'] = "Incomplete Parameters!";
//         }
//         else
//         {
//             $otform = new OtForm($conn, $employee_id, $ot_start, $ot_end, $reason, $output, $_SESSION);

//             switch ($action)
//             {
//                 case 'add':
//                     $insertId = $otform->CreateOtForm();
//                     $json['code'] = "OK";
//                     $json['response'] = " $insertId Inserted";
//                     break;
//                 case 'view':
//                     $keyword = (isset($_POST['keyword']) ? strtolower($_POST['keyword']) : NULL);
//                     $otList = $otform->viewOtForm($keyword);
//                     $json['code'] = "200";
//                     $json['response'] = $otList;
//                     break;
//                 case 'approve':
//                     $otPending = $otform->approveOT($ot_id);
//                     $json['code'] = "OK";
//                     $json['response'] = "Record Updated";
//                     break;
//                 case 'reject':
//                     $otPending = $otform->rejectOT($ot_id);
//                     $json['code'] = "OK";
//                     $json['response'] = "Record Updated";
//                     break;
//                 default:
//                     $json['code'] = "403";
//                     $json['response'] = "You dont have a permission on this module!";
//                     break;
//             }

//             // switch ($action)
//             // {
//             //     case 'add':
//             //         // insert records
//             //         $insertId = $otform->CreateOt();
//             //         $json['code'] = "OK";
//             //         $json['response'] = " $insertId Inserted";
//             //         break;
//             //     case 'view':
//             //         // check if has access, only hr managers can add
//             //         $keyword = (isset($_POST['keyword']) ? strtolower($_POST['keyword']) : NULL);
//             //         $otList = $otform->viewOT($keyword);
//             //         $json['code'] = "200";
//             //         $json['response'] = $otList;
//             //         break;
//             //     case 'viewbylevel':
//             //         switch($_SESSION['level'])
//             //         {
//             //             case 'SUPERVISORS':
//             //                 $status = 'SUP-PENDING';
//             //             break;
//             //             case 'HR MANAGERS':
//             //                 $status = 'SUP-APPROVED';
//             //             break;
//             //         }
//             //         $otPending = $otform->viewPendingOT($status);
//             //         $json['code'] = "200";
//             //         $json['response'] = $otPending;
//             //         break;
//             //     case 'approve':
//             //         $overtime_id = (isset($_POST['overtime_id']) ? strtolower($_POST['overtime_id']) : NULL);
//             //         switch($_SESSION['level'])
//             //         {
//             //             case 'SUPERVISORS':
//             //                 $field = 'sup_approved_by';
//             //                 $status = 'SUP-APPROVED';
//             //                 $datelabel = 'sup_approved_date';
//             //             break;
//             //             case 'HR MANAGERS':
//             //                 $field = 'man_approved_by';
//             //                 $status = 'MAN-APPROVED';
//             //                 $datelabel = 'man_approved_date';
//             //             break;
//             //         }
//             //         $value = $_SESSION['username'];
//             //         $otPending = $otform->approveOT($overtime_id, $status, $field, $value, $datelabel);
//             //         $json['code'] = "OK";
//             //         $json['response'] = "Record Updated";
//             //         break;
//             //     case 'reject':
//             //         $overtime_id = (isset($_POST['overtime_id']) ? strtolower($_POST['overtime_id']) : NULL);
//             //         switch($_SESSION['level'])
//             //         {
//             //             case 'SUPERVISORS':
//             //                 $field = 'sup_rejected_by';
//             //                 $datelabel = 'sup_rejected_date';
//             //             break;
//             //             case 'HR MANAGERS':
//             //                 $field = 'man_rejected_by';
//             //                 $datelabel = 'man_rejected_date';
//             //             break;
//             //         }
//             //         $value = $_SESSION['username'];
//             //         $otPending = $otform->rejectOT($overtime_id, $field, $value, $datelabel);
//             //         $json['code'] = "OK";
//             //         $json['response'] = "Record Updated";
//             //         break;
//             //     default:
//             //         $json['code'] = "403";
//             //         $json['response'] = "You dont have a permission on this module!";
//             //         break;
//             // }
//         }

//     }
// }
// $json = json_encode($json);
// echo $json;
?>
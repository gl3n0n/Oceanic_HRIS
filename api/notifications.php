<?php

// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';
require_once 'tools/tools.php';
require_once 'tools/notifications.php';

$conn = connect();
$org_id = $_POST['org_id'];
$employee_id = $_POST['employee_id'];
$level = $_POST['level'];
$alerts = new Notifications($conn, $org_id, $employee_id, $level);
$pending_leaves = $alerts->countLeave();
$pending_ot = $alerts->countOT();
$pending_ob = $alerts->countOB();
$res = array();
if ($pending_leaves != '0' || $pending_ot != '0' || $pending_ob  != '0')
{
	$res['data'] = true;
	$res['leaves'] = $pending_leaves;
	$res['ot'] = $pending_ot;
	$res['ob'] = $pending_ob;
}
else
{
	$res['data'] = false;
}
echo json_encode($res);

?>
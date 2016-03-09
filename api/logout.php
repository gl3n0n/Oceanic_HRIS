<?php
	// error_reporting( E_ALL ^ E_DEPRECATED );
	@ob_gzhandler('ob_start');
	session_start();
	require('_config.php');
    require('tools/tools.php');
    require_once('database/dbtools.php');
	$profile_id = $_SESSION['user_id'];

	unset($_SESSION['user_id']);
	unset($_SESSION['username']);
	unset($_SESSION['email']);
	unset($_SESSION['level']);
	session_destroy();


	header ('Location: http://104.156.53.150/oceanic/');
?>

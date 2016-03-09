<?php
	// error_reporting( E_ALL ^ E_DEPRECATED );
	@ob_gzhandler('ob_start');
	session_start();
	require('_config.php');
    require('tools/tools.php');
    require('tools/login.php');
    require_once('database/dbtools.php');
	if (!empty($_POST))
	{
		$conn = connect();
		$Tools = new Tools ($_POST);
		$_POST = $Tools->PreparePost();

		$username       =    $_POST['username'];
		$password       =    $_POST['password'];
        // check if complete parameters
        if (empty($username) || empty($password))
        {
            $json['code'] = "401";
            $json['response'] = "Incomplete parameters!";
        }
        else
        {
            $new_password = crypt($password, SALT);
            $login = new Login($conn, $username, $new_password);
            $login_details = $login->Authenticate();
            if ($login_details == 'OK')
            {
                // check if has social network linked.
                $json['code'] = "200";

                $details['user_id'] = $_SESSION['user_id'];
                $details['username'] = $_SESSION['username'];
                $details['email'] =	$_SESSION['email'];
                $details['level'] = $_SESSION['level'];
                $details['org_id'] = $_SESSION['org_id'];
                $details['logo'] = $_SESSION['logo'];
                $json['response'] = $details;
            }
            else
            {
                $json['code'] = "401";
                $json['response'] = "Invalid Username or Password!";
            }
        }
	}
    else
    {
        $json['code'] = "409";
		$json['response'] = "Unauthorized!";
    }
    $json = json_encode($json);
    echo $json;
?>

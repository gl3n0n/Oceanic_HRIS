<?php
	// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );
	@ob_gzhandler('ob_start');
	session_start();

	$user_id = (isset($_SESSION['user_id']) ? strtolower($_SESSION['user_id']) : '');
    $level = (isset($_SESSION['level']) ? $_SESSION['level'] : '');
?>
<!-- <!DOCTYPE html> -->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />

        <title>Oceanic Container Lines, Inc. HRIS</title>

        <link rel="stylesheet" href="css/normalize.css" />
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/stylesheet.css" />
		<!--
		<link rel="stylesheet" type="text/css" href="css/page.css" media="screen" />
		-->
		<link rel="stylesheet" type="text/css" href="css/calendar-eightysix-v1.1-default.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/calendar-eightysix-v1.1-vista.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/calendar-eightysix-v1.1-osx-dashboard.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="mootools-datepicker-master/Source/datepicker_bootstrap/datepicker_bootstrap.css" media="screen" />

        <!-- <script src="js/vendor/custom.modernizr.js"></script> -->
        <?php //echo print_r($_SERVER['PHP_SELF'], true);?>

		<!-- <script type="text/javascript" src="js/lib/mootools-1.4.1.js"></script>
		<script type="text/javascript" src="js/lib/mootools-more-1.4.0.1.js"></script> -->

        <script type="text/javascript" src="js/lib/MooTools-Core-1.5.1.js"></script>
        <script type="text/javascript" src="js/lib/MooTools-More-1.5.1.js"></script>

        <!-- <script type="text/javascript" src="js/lib/MooTools-Core-1.5.1-compressed.js"></script>
        <script type="text/javascript" src="js/lib/MooTools-More-1.5.1-compressed.js"></script> -->

		<script src="mootools-datepicker-master/Source/Locale.en-US.DatePicker.js" type="text/javascript"></script>
		<script src="mootools-datepicker-master/Source/Picker.js" type="text/javascript"></script>
		<script src="mootools-datepicker-master/Source/Picker.Attach.js" type="text/javascript"></script>
		<script src="mootools-datepicker-master/Source/Picker.Date.js" type="text/javascript"></script>
		<!--
		<script type="text/javascript" src="js/mootools-1.2.4-core.js"></script>
		<script type="text/javascript" src="js/mootools-1.2.4.4-more.js"></script>

		<script type="text/javascript" src="js/calendar-eightysix-v1.1.js"></script>
		-->

		<script>

		window.addEvent('domready', function(){
			new Picker.Date($$('#birthdate, #edit_birthdate, #date_resigned, #edit_date_resigned, #date_received, #edit_date_received, #date_issued, #edit_date_issued, #expiry_date, #edit_expiry_date, #date_attended, #edit_date_attended, #effectivity_date, #edit_effectivity_date, #date_hired, #edit_date_hired, #passport_exp, #edit_passport_exp, #seaman_book_exp, #edit_seaman_book_exp, #checkup_date, #edit_checkup_date, #vac_exp, #edit_vac_exp'),
            {
                format : '%Y-%m-%d',
                positionOffset: {x: 5, y: 0},
                pickerClass: 'datepicker_bootstrap',
                useFadeInOut: !Browser.ie
            });

            new Picker.Date($$('#start_date, #edit_start_date, #end_date, #edit_end_date, #ot_start, #edit_ot_start, #ot_end, #edit_ot_end, #start, #end'),
            {
                format : '%Y-%m-%d',
                //format : '%Y-%m-%d %T',
                // timePicker: true,
                positionOffset: {x: 5, y: 0},
                pickerClass: 'datepicker_bootstrap',
                useFadeInOut: !Browser.ie
            });


            // new Picker.Date($$(
            //     '#start_time', '#edit_start_time',
            //     '#end_time', '#edit_end_time'),
            // {
            //     pickerClass: 'datepicker_bootstrap',
            //     pickOnly: 'time'
            // });
		});

		</script>

    </head>
    <body>
        <!-- Header -->
        <div class="row header-block-wrapper">
            <!-- <div class="large-12 columns"> -->
            <div class="large-12">
                <div class="right header-login-wrapper large-3">

				<?	if ($user_id == '') {  ?>
					<div class="notifier"></div>
                    <div class="login-controls-wrapper" style="display: block">
                        <form id="signin">
                            <div class="username-wrapper">
                                <p class="lbl-username">Username</p>
                                <input type="text" class="txt-username" id="username" />
                            </div>
                            <div class="password-wrapper">
                                <p class="lbl-password">Password</p>
                                <input type="password" class="txt-password" id="password" />
                            </div>
                            <div class="btn-login-wrapper">
                                <input type="submit" value="Log In" class="btn-login" />
                            </div>
                        </form>
                    </div>
				<? } else { ?>
                    <div class="login-info-wrapper" style="display: block">
                        <p class="login-info-text">You are logged as: <b><?php echo $_SESSION['username']?></b></p>
                        <p class="login-info-text">Level: <b><?=$_SESSION['level']?></b></p>
                        <!-- <a class="login-info-button" href="edit_prof.php">Edit Profile</a> -->
                        <!-- <br/> -->
                        <a class="login-info-button" href="api/logout.php">Log Out</a>
                    </div>
				<? } ?>

                </div>
                <div class="large-9">
                    <div class="logo-wrapper">
                        <?php if(!empty($_SESSION['logo'])) {
                            echo '<a href="index.php"><img src="img/'.$_SESSION['logo'].'" /></a>';
                        } else { ?>
                        <a href="index.php"><img src="img/logo.png" /></a>
                        <?php }?>
                    </div>
                    <div class="header-text-wrapper">
                        <p class="header-text">Human Resource Information System</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- Main Page Content and Sidebar -->
        <div class="row">

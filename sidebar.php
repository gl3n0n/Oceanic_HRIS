<?php
	
	$flag_notification = false;

	if(!empty($user_id) && $level != 'EMPLOYEES')
	{
		//get notifications
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://104.156.53.150/oceanic/api/notifications.php");
		curl_setopt($ch, CURLOPT_POST, 1);

		//array('postvar1' =&amp;gt; 'value1') here you can send your parameters

		curl_setopt($ch, CURLOPT_POSTFIELDS,
				 http_build_query(array('org_id' => $_SESSION['org_id'], 'employee_id' => $_SESSION['employee_id'], 'level' => $_SESSION['level'])));

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);
		
		$server_output = json_decode($server_output);
		/*
		stdClass Object
		(
			[data] => 1
			[leaves] => 1
			[ot] => 0
			[ob] => 0
		)
		
		*/
		
		if ($server_output->data != 0)
		{
			$flag_notification = true;
		}
	
	}

	
?>

<aside class="large-3 columns">
	<?php
    if(!empty($user_id) && !empty($level)) {
		if ($level != 'EMPLOYEES')
		{
			if ($flag_notification) {
    ?>

	<div class="sb-pnl-wrapper">
            <div class="sb-pnl-header-wrapper" id="pnl-header-notifications">
                <div class="sb-pnl-header-text-wrapper"><big>Notifications</big></div>
                <div class="sb-pnl-toggle-button-wrapper right" id="btn-toggle-notifications"><span> </span></div>
            </div>
            <div class="sb-pnl-content-wrapper">
                <ul>
                    <?php
						if ($server_output->leaves != '0')
							echo '<li><a href="#">Leave for Approval ('.$server_output->leaves.')</a></li>';
						if ($server_output->ot != '0')
							echo '<li><a href="#">Overtime for Approval ('.$server_output->ot.')</a></li>';
						if ($server_output->ob != '0')
							echo '<li><a href="#">OB for Approval ('.$server_output->ob.')</a></li>';
					
					?>
                </ul>
            </div>
    </div>
			<?php  } } } ?>

    <?php
    if(!empty($user_id) && !empty($level)) {
    ?>
        <input type="hidden" id="sess_level" value="<?php echo $level;?>">
        <div class="sb-pnl-wrapper">
            <div class="sb-pnl-header-wrapper" id="pnl-header-maintenance">
                <div class="sb-pnl-header-text-wrapper"><big>Maintenance</big></div>
                <div class="sb-pnl-toggle-button-wrapper right" id="btn-toggle-maintenance"><span> </span></div>
            </div>
            <div class="sb-pnl-content-wrapper">
                <ul>
                    <?php if ('HR MANAGERS' == $level) {?>
                        <li><a href="division.php">Divisions</a></li>
                        <li><a href="location.php">Locations</a></li>
                        <li><a href="department.php">Departments</a></li>
                        <li><a href="job.php">Jobs</a></li>
                        <li><a href="position.php">Positions</a></li>
                        <li><a href="salary_grade.php">Salary Grades</a></li>
                        <li><a href="employee_type.php">Employee Types</a></li>
                        <li><a href="leave_type.php">Leave Types</a></li>
                        <li><a href="policy.php">Policies</a></li>
                        <li><a href="employee.php">Employees</a></li>
                        <li><a href="users.php">Application Users</a></li>
                        <!-- <li><a href="employee-details.php?employee_id=12">Employees details TEST<a></li> -->
                    <?php } else if ('EMPLOYEES' == $level) {
                        echo '<li><a href="employee-details.php?employee_id='.$_SESSION['employee_id'].'">Your Information<a></li>';
                     } else if ('SYS ADMINS' == $level) {
                        echo '<li><a href="organization.php">Organizations<a></li>';
                        echo '<li><a href="users.php">Application Users</a></li>';
                    } else {?>
                        <li><a href="employee.php">Employees</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <?php if ('SYS ADMINS' != $level) { ?>
        <div class="sb-pnl-wrapper">
            <div class="sb-pnl-header-wrapper" id="pnl-header-transactions">
                <div class="sb-pnl-header-text-wrapper"><big>Transactions</big></div>
                <div class="sb-pnl-toggle-button-wrapper right" id="btn-toggle-transactions"><span></span></div>
            </div>
            <div class="sb-pnl-content-wrapper">
                <ul>
    				<li><a href="obform.php">Official Business Application</a></li>
                    <li><a href="otform.php">Overtime Application</a></li>
                    <li><a href="lvform.php">Leave Application</a></li>

                    <?php if ('HR MANAGERS' == $level) {?>
                    <li><a href="hrcalendar.php">HR Calendar</a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>

        <div class="sb-pnl-wrapper">
            <div class="sb-pnl-header-wrapper" id="pnl-header-reports">
                <div class="sb-pnl-header-text-wrapper"><big>Reports--</big></div>
                <div class="sb-pnl-toggle-button-wrapper right" id="btn-toggle-reports"><span> </span></div>
            </div>
            <div class="sb-pnl-content-wrapper">
                <ul>
                    <!-- <li><a href="record-summary.php">Employee Record Summary (employee)</a></li> -->
                    <li><a href="deduct-form.php">Authority to Deduct Form------</a></li>
                    <li><a href="monitoring-report.php">Leave Monitoring Report------</a></li>
                </ul>
            </div>
        </div>

	<?php }} ?>

</aside>

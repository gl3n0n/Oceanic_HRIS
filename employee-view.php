<?php 

include_once('header.php'); 
require('api/_config.php');
require('api/tools/tools.php');
require_once('api/database/dbtools.php');
require('api/tools/employee-details.php');

$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL); 

$conn = connect();
$Tools = new Tools ($_POST);

$emp_details = new EmployeeDetails($conn, $employee_id);

$details = $emp_details->viewEmployeeRecord();
//echo '<pre>';
//print_r($details);

?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">EMPLOYEES MAINTENANCE</h3>
	<div id="notifier"></div>
	
	<table>
		<tr>
			<td><a href="employee-view.php?employee_id=<?=$employee_id?>">Information</a></td>
			<td><a href="employee-education.php?employee_id=<?=$employee_id?>">Education</a></td>
			<td><a href="employee-employment.php?employee_id=<?=$employee_id?>">Employment</a></td>
			<td><a href="employee-family.php?employee_id=<?=$employee_id?>">Family</a></td>
			<td><a href="employee-licenses.php?employee_id=<?=$employee_id?>">Licenses</a></td>
		</tr>
		<tr>
			<td><a href="employee-infractions.php?employee_id=<?=$employee_id?>">Infractions</a></td>
			<td><a href="employee-perfreviews.php?employee_id=<?=$employee_id?>">Perf Reviews</a></td>
			<td><a href="employee-medicalrecords.php?employee_id=<?=$employee_id?>">Medical Records</a></td>
			<td><a href="employee-rewards.php?employee_id=<?=$employee_id?>">Rewards</a></td>
			<td><a href="employee-trainings.php?employee_id=<?=$employee_id?>">Trainings</a></td>
		</tr>
	</table>
	<div>INFORMATION <br /></div>
	<div>&nbsp;</div>
	<div id="view-employee">
		<div>Last Name: &nbsp;&nbsp;<b><?=$details[0]['lastname']?></b>
		</div>
		<div>First Name: &nbsp;&nbsp;<b><?=$details[0]['firstname']?></b>
		</div>
		<div>Middle Name: &nbsp;&nbsp;<b><?=$details[0]['middlename']?></b>
		</div>
		<div>Department: &nbsp;&nbsp;<b><?=$details[0]['name']?></b>
		</div>
		<div>Position: &nbsp;&nbsp;<b><?=$details[0]['position_title']?></b>
		</div>
		<div>Employee Type: &nbsp;&nbsp;<b><?=$details[0]['empl_type']?></b>
		</div>
    </div>
	
	
</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/employee.js"></script>
<?php 
    include_once('sidebar.php');
    include_once('footer.php');
?>

<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">EMPLOYEES MAINTENANCE</h3>
<?php
$module = "employee";
echo generate_view_div($module, array('Last Name', 'First Name', 'Middle Name', 'Employment Status', 'Actions'));
echo generate_add_div($module, array(
        array('lastname', 'Last Name*', 'text'),
		array('firstname', 'First Name*', 'text'),
		array('middlename', 'Middle Name*', 'text'),
		array('dept_id', 'Department*', 'select'),
		array('position_id', 'Position*', 'select'),
		array('empl_type_id', 'Employee Type*', 'select'),
		array('gender', 'Gender*', 'select'),
		array('address', 'Home Address', 'text'),
		array('tel_no', 'Tel No', 'text'),
		array('cell_no', 'Cell No', 'text'),
		array('civil_status', 'Civil Status', 'select'),
		array('religion', 'Religion', 'text'),
		array('date_hired', 'Date Hired', 'text'),
		array('birthdate', 'Birthdate', 'text'),
		array('birthplace', 'Birthplace', 'text'),
		array('empl_status', 'Employment Status', 'select'),
		array('sss', 'SSS', 'text'),
		array('tin', 'TIN', 'text'),
		array('pagibig', 'Pag-ibig', 'text'),
		array('philhealth', 'Philhealth', 'text'),
		array('tax_type', 'Tax Type', 'text'),
		array('salary_grade', 'Salary Grade', 'text'),
		array('passport_no', 'Passport No.', 'text'),
		array('passport_exp', 'Passport Exp.', 'text'),
		array('date_resigned', 'Date Resigned', 'text'),
		array('seaman_book_no', 'Seaman Book No.', 'text'),
		array('seaman_book_exp', 'Seaman Book Exp.', 'text'),
		array('biometric_no', 'Biometrics Card', 'text')
    ));

// echo generate_edit_div($module, array(
//         array('lastname', 'Last Name*', 'text', false),
//         array('firstname', 'First Name*', 'text', false),
//         array('middlename', 'Middle Name*', 'text', false),
//         array('dept_id', 'Department*', 'text', false),
//         array('position_id', 'Position*', 'text', false),
//         array('empl_type_id', 'Employee Type*', 'text', false),
//         array('gender', 'Gender*', 'text', false),
//         array('address', 'Home Address', 'text', false),
//         array('tel_no', 'Tel No', 'text', false),
//         array('cell_no', 'Cell No', 'text', false),
//         array('civil_status', 'Civil Status', 'text', false),
//         array('religion', 'Religion', 'text', false),
//         array('date_hired', 'Date Hired', 'text', false),
//         array('birthdate', 'Birthdate', 'text', false),
//         array('birthplace', 'Birthplace', 'text', false),
//         array('empl_status', 'Employment Status', 'text', false),
//         array('sss', 'SSS', 'text', false),
//         array('tin', 'TIN', 'text', false),
//         array('pagibig', 'Pag-ibig', 'text', false),
//         array('philhealth', 'Philhealth', 'text', false),
//         array('tax_type', 'Tax Type', 'text', false),
//         array('salary_grade', 'Salary Grade', 'text', false),
//         array('passport_no', 'Passport No.', 'text', false),
//         array('passport_exp', 'Passport Exp.', 'text', false),
//         array('date_resigned', 'Date Resigned', 'text', false),
//         array('seaman_book_no', 'Seaman Book No.', 'text', false),
//         array('seaman_book_exp', 'Seaman Book Exp.', 'text', false),
//         array('biometric_no', 'Biometrics Card', 'text', false)
//     ));
?>


<!-- 	<div id="view-employee">

		<?php if($_SESSION['level'] == 'HR MANAGERS') { ?>
		<div class="right">
      		<input type="button" class="tbl-main-action-btn" id="add_dept" value="Add New" onclick='window.location="employee-add.php"' />
		</div>
		<?php } ?>

		<div class="search-form-wrapper">
			<form method="POST"  onsubmit="return false;">
				<label class="search-form-field-label">Search:</label>
				<input type="text" class="search-form-field" id="searchfield" />
				<input type="button" class="btn-search" id="search" value="Go" />
			</form>
		</div>

		<table>
			<thead>
				<tr>
					<td>Last Name</td>
					<td>First Name</td>
					<td>Middle Name</td>
					<td>Employment Status</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody class="empl_list" id="empl_list">

			</tbody>
		</table>
    </div>

	<div id="add-employee" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Employee</p>
			</div>
		</div>
		<form id="form-employee" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">empl Code*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="empl_code" class="modal-text-input" name="empl-code" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Name*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="name" class="modal-text-input" name="name" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Location*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="location" class="modal-text-input" name="location" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Headed By*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text"  id="headed_by" class="modal-text-input" name="headed_by" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Parent empl*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text"  id="parent_empl" class="modal-text-input" name="parent_empl" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">&nbsp;</div>
						<div class="modal-form-field-container">
							<p class="modal-form-disclaimer">*required field</p>
						</div>
					</div>
				</div>
				<div class="modal-actions-wrapper">
					<div class="modal-actions-container right">
						<a class="modal-action-cancel" href="#" id="empl-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="empl-save" value="Save" onclick="window.location='index.php' " />
					</div>
				</div>
			</div>
		</form>
	</div> -->
</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/employee2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>

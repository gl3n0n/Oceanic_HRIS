<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<?
$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);
?>

<div class="large-9 columns" role="content" style="z-index: 0">

<?php echo generate_employee_view_header($employee_id, 'Medical Records');?>

	<div>MEDICAL RECORDS<br/><br/></div>
<?php
$module = "employee_medical";
echo generate_view_div($module, array('Name', 'Prescription', 'Hospital', 'Physician', 'Checkup Date', 'Vaccine Exp', 'Actions'));

echo generate_add_div($module, array(
        array('description', 'Name*', 'text'),
        array('prescription', 'Prescription*', 'text'),
        array('hospital', 'Hospital*', 'text'),
        array('physician', 'Physician*', 'text'),
        array('checkup_date', 'Checkup Date*', 'text'),
        array('vac_exp', 'Vaccine Exp*', 'text')
    ));

echo generate_edit_div($module, array(
        array('description', 'Name*', 'text', false),
        array('prescription', 'Prescription*', 'text', false),
        array('hospital', 'Hospital*', 'text', false),
        array('physician', 'Physician*', 'text', false),
        array('checkup_date', 'Checkup Date*', 'text', false),
        array('vac_exp', 'Vaccine Exp*', 'text', false)
    ));
?>
	<!-- <div>&nbsp;</div>
	<div id="view-medical">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_medical" value="Add New" />
		</div>
		<div>&nbsp;</div>
		<table>
			<thead>
				<tr>
					<td>Name</td>
					<td>Prescription</td>
					<td>Hospital</td>
					<td>Physician</td>
					<td>Checkup Date</td>
					<td>Vacc Exp</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="medical_list" id="medical_list">

			</tbody>
		</table>
    </div>

	<div id="add-medical" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Medical Record</p>
			</div>
		</div>
		<form id="form-medical" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">

					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Name*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="description" class="modal-text-input" name="description" />
						</div>
					</div>
					<div</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Prescription*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="prescription" class="modal-text-input" name="prescription" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Hospital*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="hospital" class="modal-text-input" name="hospital" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Physician*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="physician" class="modal-text-input" name="physician" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">ChkUp Date*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="checkup_date" class="modal-text-input" name="checkup_date" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Vacc Exp*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="vac_exp" class="modal-text-input" name="vac_exp" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">&nbsp;</div>
						<div class="modal-form-field-container">
							<p class="modal-form-disclaimer">*required field</p>
						</div>
					</div>
				</div>
				<input type="hidden" id="employee_id" value="<?=$employee_id?>">
				<div class="modal-actions-wrapper">
					<div class="modal-actions-container right">
						<a class="modal-action-cancel" href="#" id="medical-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="medical-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="view-medical-single" class="modal-wrapper" style="display: none; z-index: 3">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">View Medical</p>
			</div>
		</div>
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">

					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Level</p>
						</div>
						<div class="modal-form-field-container">
							<span id="view-level"></span>
						</div>
					</div>
					<div</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">School</p>
						</div>
						<div class="modal-form-field-container">
							<span id="view-school"></span>
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Course</p>
						</div>
						<div class="modal-form-field-container">
							<span id="view-course"></span>
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Degree</p>
						</div>
						<div class="modal-form-field-container">
							<span id="view-degree"></span>
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Honors</p>
						</div>
						<div class="modal-form-field-container">
							<span id="view-honor"></span>
						</div>
					</div>
				</div>
			</div>
	</div> -->


</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/employee-medical2.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
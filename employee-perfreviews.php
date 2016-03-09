<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<?
$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);
?>

<div class="large-9 columns" role="content" style="z-index: 0">

<?php echo generate_employee_view_header($employee_id, 'Perf Reviews');?>

	<div>PERF REVIEWS<br/><br/></div>
<?php
$module = "employee_licenses";
// echo generate_view_div($module, array('Level', 'School', 'Course', 'Degree', 'Honors', 'Actions'));

// echo generate_add_div($module, array(
//         array('school', 'School*', 'text'),
//         array('level', 'Level*', 'text'),
//         array('course', 'Course*', 'text'),
//         array('degree', 'Degree*', 'text'),
//         array('honors', 'Honors*', 'text')
//     ));

// echo generate_edit_div($module, array(
//         array('school', 'School*', 'text', false),
//         array('level', 'Level*', 'text', false),
//         array('course', 'Course*', 'text', false),
//         array('degree', 'Degree*', 'text', false),
//         array('honors', 'Honors*', 'text', false)
//     ));
?>

<!-- 	<div>&nbsp;</div>
	<div id="view-perfreviews">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_perfreview" value="Add New" />
		</div>
		<div>&nbsp;</div>
		<table>
			<thead>
				<tr>
					<td>License Type</td>
					<td>License No</td>
					<td>Date Issued</td>
					<td>Expiration Date</td>
					<td>Remarks</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="license_list" id="license_list">

			</tbody>
		</table>
    </div>

	<div id="add-license" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add License</p>
			</div>
		</div>
		<form id="form-license" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">

					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">License Type*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="license_type" class="modal-text-input" name="license_type" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">License No*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="license_no" class="modal-text-input" name="license_no" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Date Issued*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="date_issued" class="modal-text-input" name="date_issued" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Expiry Date*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="expiry_date" class="modal-text-input" name="expiry_date" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Remarks*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="remarks"></textarea>
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
						<a class="modal-action-cancel" href="#" id="license-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="license-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="view-license-single" class="modal-wrapper" style="display: none; z-index: 3">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">View Expiry</p>
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
<script type="text/javascript" src="js/employee-license.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
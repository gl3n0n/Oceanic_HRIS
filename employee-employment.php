<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<?
$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);
?>

<div class="large-9 columns" role="content" style="z-index: 0">

<?php echo generate_employee_view_header($employee_id, 'Employment');?>

	<div>EMPLOYMENT<br/><br/></div>
<?php
$module = "employee_employment";
echo generate_view_div($module, array('Effectivity Date', 'Job', 'Position', 'Remarks', 'Actions'));

echo generate_add_div($module, array(
        array('effectivity_date', 'Effectivity Date*', 'text'),
        array('job_id', 'Job*', 'select'),
        array('position_id', 'Position*', 'select'),
        array('remarks', 'Remarks', 'text')
    ));

echo generate_edit_div($module, array(
        array('effectivity_date', 'Effectivity Date*', 'text', false),
        array('job_id', 'Job*', 'select', false),
        array('position_id', 'Position*', 'select', false),
        array('remarks', 'Remarks', 'text', false)
    ));

?>

	<!-- <div>&nbsp;</div>
	<div id="view-employment">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_employment" value="Add New" />
		</div>
		<div>&nbsp;</div>
		<table>
			<thead>
				<tr>
					<td>Effectivity Date</td>
					<td>Job</td>
					<td>Position</td>
					<td>Remarks</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="employment_list" id="employment_list">

			</tbody>
		</table>
    </div>

	<div id="add-employment" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Employment</p>
			</div>
		</div>
		<form id="form-employment" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">

					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Eff. Date*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="effectivity_date" class="modal-text-input" name="effectivity_date" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Job*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="job" class="modal-text-input" name="job" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Position*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="position" class="modal-text-input" name="position" />
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
						<a class="modal-action-cancel" href="#" id="employment-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="employment-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div> -->

</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/employee-employment2.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
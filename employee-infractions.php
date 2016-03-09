<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<?
$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);
?>

<div class="large-9 columns" role="content" style="z-index: 0">

<?php echo generate_employee_view_header($employee_id, 'Infractions');?>

	<div>INFRACTIONS<br/><br/></div>

<?php
$module = "employee_infractions";
echo generate_view_div($module, array('Policy', 'Description', 'Date Received', 'Sanction', 'Actions'));

echo generate_add_div($module, array(
        array('policy_id', 'Policy*', 'select'),
        array('description', 'Description*', 'text'),
        array('date_received', 'Date Received*', 'text'),
        array('sanction', 'Sanction*', 'text')
    ));

echo generate_edit_div($module, array(
		array('policy_id', 'Policy*', 'select', false),
        array('description', 'Description*', 'text', false),
        array('date_received', 'Date Received*', 'text', false),
        array('sanction', 'Sanction*', 'text', false)
    ));
?>


<!-- 	<div>&nbsp;</div>
	<div id="view-infraction">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_infraction" value="Add New" />
		</div>
		<div>&nbsp;</div>
		<table>
			<thead>
				<tr>
					<td>Policy</td>
					<td>Description</td>
					<td>Date Received</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="infraction_list" id="infraction_list">

			</tbody>
		</table>
    </div>

	<div id="add-infraction" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Infraction</p>
			</div>
		</div>
		<form id="form-infraction" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">



					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Policy*</p>
						</div>
						<div class="modal-form-field-container" id="policy_codes">
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Description*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="description" class="modal-text-input" name="description" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Date Received*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="date_received" class="modal-text-input" name="date_received" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Action*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="penalty" class="modal-text-input" name="penalty" />
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
						<a class="modal-action-cancel" href="#" id="infraction-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="infraction-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="view-infraction-single" class="modal-wrapper" style="display: none; z-index: 3">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">View infraction</p>
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
<script type="text/javascript" src="js/employee-infractions2.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
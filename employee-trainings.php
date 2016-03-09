<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<?
$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);
?>

<div class="large-9 columns" role="content" style="z-index: 0">

<?php echo generate_employee_view_header($employee_id, 'Trainings');?>

	<div>TRAININGS<br/><br/></div>

<?php
$module = "employee_training";
echo generate_view_div($module, array('Training Type', 'Description', 'Date Attended', 'Remarks', 'Actions'));

echo generate_add_div($module, array(
        array('traning_type', 'Training Type*', 'text'),
        array('description', 'Description*', 'text'),
        array('date_attended', 'Date Attended*', 'text'),
        array('remarks', 'Remarks*', 'text')
    ));

echo generate_edit_div($module, array(
        array('traning_type', 'Training Type*', 'text', false),
        array('description', 'Description*', 'text', false),
        array('date_attended', 'Date Attended*', 'text', false),
        array('remarks', 'Remarks*', 'text', false)
    ));
?>

<!-- 	<div>&nbsp;</div>
	<div id="view-training">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_training" value="Add New" />
		</div>
		<div>&nbsp;</div>
		<table>
			<thead>
				<tr>
					<td>Training Type</td>
					<td>Description</td>
					<td>Date Attended</td>
					<td>Remarks</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="training_list" id="training_list">

			</tbody>
		</table>
    </div>

	<div id="add-training" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add training</p>
			</div>
		</div>
		<form id="form-training" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">

					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Training Type*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="training_type" class="modal-text-input" name="training_type" />
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
							<p class="modal-form-field-label">Dt Attended*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="date_attended" class="modal-text-input" name="date_attended" />
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
						<a class="modal-action-cancel" href="#" id="training-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="training-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div> -->

</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/employee-training2.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
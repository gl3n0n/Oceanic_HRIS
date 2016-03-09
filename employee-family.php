<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<?
$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);
?>

<div class="large-9 columns" role="content" style="z-index: 0">

<?php echo generate_employee_view_header($employee_id, 'Family');?>

	<div>FAMILY<br/><br/></div>
<?php
$module = "employee_family";
echo generate_view_div($module, array('Name', 'Birthdate', 'Gender', 'Relationship', 'Civil Status', 'Actions'));

echo generate_add_div($module, array(
        array('name', 'Name*', 'text'),
        array('birthdate', 'Birthdate*', 'text'),
        array('gender', 'Gender*', 'select'),
        array('relationship', 'Relationship*', 'select'),
        array('civil_status', 'Civil Status*', 'select')
    ));

echo generate_edit_div($module, array(
        array('name', 'Name*', 'text', false),
        array('birthdate', 'Birthdate*', 'text', false),
        array('gender', 'Gender*', 'select', false),
        array('relationship', 'Relationship*', 'select', false),
        array('civil_status', 'Civil Status*', 'select', false)
    ));
?>

<!-- 	<div>&nbsp;</div>
	<div id="view-family">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_family" value="Add New" />
		</div>
		<div>&nbsp;</div>
		<table>
			<thead>
				<tr>
					<td>Name</td>
					<td>Birthdate</td>
					<td>Gender</td>
					<td>Relationship</td>
					<td>Civil Status</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody class="family_list" id="family_list">

			</tbody>
		</table>
    </div>

	<div id="add-family" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Family</p>
			</div>
		</div>
		<form id="form-family" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">

					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Name*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="name" class="modal-text-input" name="name" />
						</div>
					</div>
					<div</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Birthdate*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="birthdate" class="modal-text-input" name="birthdate" />
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Gender*</p>
						</div>
						<div class="modal-form-field-container">
							<div id="options">
							<select id="gender">
								<option value="MALE" selected="selected">Male</option>
								<option value="FEMALE">Female</option>
							</select>
							</div>
						</div>
					</div>



					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Relationship*</p>
						</div>
						<div class="modal-form-field-container">
							<div id="options">
							<select id="relationship">
								<option value="FATHER" selected="selected">Father</option>
								<option value="MOTHER">Mother</option>
								<option value="BROTHER">Brother</option>
								<option value="SISTER">Sister</option>
								<option value="SON">Son</option>
								<option value="DAUTHER">Dauther</option>
							</select>
							</div>
						</div>
					</div>

					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Civil Status*</p>
						</div>
						<div class="modal-form-field-container">
							<div id="options">
							<select id="civil_status">
								<option value="SINGLE" selected="selected">Single</option>
								<option value="MARRIED">Married</option>
								<option value="SEPERATED">Seperated</option>
								<option value="WIDOWED">Widowed</option>
							</select>
							</div>
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
						<a class="modal-action-cancel" href="#" id="family-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="family-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="view-family-single" class="modal-wrapper" style="display: none; z-index: 3">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">View family</p>
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
<script type="text/javascript" src="js/employee-family2.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">EMPLOYEE TYPE MAINTENANCE</h3>
<?php
$module = "employee_type";
echo generate_view_div($module, array('Employee Type', 'Description', 'Actions'));
echo generate_add_div($module, array(
        array('empl_type', 'Type*', 'text'),
        array('description', 'Description*', 'textarea')
    ));

echo generate_edit_div($module, array(
        array('empl_type', 'Type*', 'text', false),
        array('description', 'Description*', 'textarea', false)
    ));
?>
	<!-- <div id="view-emptype">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_emptype" value="Add New" />
		</div>

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
					<td>Employee Type</td>
					<td>Description</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody class="emptype_list" id="emptype_list">

			</tbody>
		</table>
    </div>

	<div id="add-emptype" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Employee Type</p>
			</div>
		</div>
		<form id="form-empltype" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Type*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="empl_type" class="modal-text-input" name="empl_type" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Description*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="description"></textarea>
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
						<a class="modal-action-cancel" href="#" id="emptype-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="emptype-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="edit-emptype" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Edit Employee Type</p>
			</div>
		</div>
		<form id="form-empltype" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Type*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="edit_empl_type" class="modal-text-input" name="empl_type" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Description*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="edit_description"></textarea>
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
						<a class="modal-action-cancel" href="#" id="edit_emptype-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="edit_emptype-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div> -->

</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/employee_type2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
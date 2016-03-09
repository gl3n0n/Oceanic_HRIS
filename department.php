<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<script type="text/javascript">

function dept()
{
var dept = document.getElementById('edit_dept_code').innerHTML;
window.location.href = "headedby.php?dept=" + dept;
}
</script>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">DEPARTMENTS MAINTENANCE</h3>
<?php
$module = "department";
echo generate_view_div($module, array('Department Code', 'Name', 'Location', 'Actions'));
echo generate_add_div($module, array(
        array('dept_code', 'Dept Code*', 'text'),
        array('name', 'Name*', 'text'),
        array('headed_by', 'Headed By', 'select'),
        array('division_id', 'Division*', 'select'),
        array('location_id', 'Location*', 'select')
    ));

echo generate_edit_div($module, array(
        array('dept_code', 'Dept Code*', 'text', true),
        array('name', 'Name*', 'text', false),
        array('headed_by', 'Headed By', 'select', false),
        array('division_id', 'Division*', 'select', false),
        array('location_id', 'Location*', 'select', false)
    ));
?>

	<!-- <div id="view-department">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_dept" value="Add New" />
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
					<td>Department Code</td>
					<td>Name</td>
					<td>Location</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody class="dept_list" id="dept_list">

			</tbody>
		</table>
    </div>

		 <div id="add-department" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Department</p>
			</div>
		</div>
		<form id="form-department" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Dept Code*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="dept_code" class="modal-text-input" name="dept-code" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Parent Dept</p>
						</div>
						<div class="modal-form-field-container" id="dept_codes">
						</div>
					</div>&nbsp;
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
						<div class="modal-form-field-container" id="loc_codes">
						</div>
					</div>&nbsp;
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">&nbsp;</div>
						<div class="modal-form-field-container">
							<p class="modal-form-disclaimer">*required field</p>
						</div>
					</div>
				</div>
				<div class="modal-actions-wrapper">
					<div class="modal-actions-container right">
						<a class="modal-action-cancel" href="#" id="dept-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="dept-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="edit-department" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Edit Department</p>
			</div>
		</div>
		<form id="form-department" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="edit_notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Dept Code</p>
						</div>
						<div class="modal-form-field-container">
							<p id="edit_dept_code" name="edit_dept"></p>
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Parent Dept</p>
						</div>
						<div class="modal-form-field-container" id="edit_parent_dept"></div>
					</div>&nbsp;

					<div class="modal-form-field-row">

						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Headed By:</p>
						</div>

						<input type="button" class="modal-action-btn primary-btn" id="head_edit" value="Choose.." onclick="dept()"  />

					</div>


					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Name*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="edit_name" class="modal-text-input" name="name" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Location*</p>
						</div>
						<div class="modal-form-field-container" id="ed_loc_codes">
						</div>
					</div>&nbsp;
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">&nbsp;</div>
						<div class="modal-form-field-container">
							<p class="modal-form-disclaimer">*required field</p>
						</div>
					</div>
				</div>
				<div class="modal-actions-wrapper">
					<div class="modal-actions-container right">
						<a class="modal-action-cancel" href="#" id="edit_dept-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="edit_dept-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div> -->


</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/department2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
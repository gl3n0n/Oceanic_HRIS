<?php
include_once('header.php');
include_once 'add_boiler.php';
?>


<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">LEAVE TYPE MAINTENANCE</h3>

<?php
$module = "leave_type";
echo generate_view_div($module, array('Leave Code', 'Leave Description', 'Credits', 'Actions'));
echo generate_add_div($module, array(
		array('lv_code', 'Code*', 'text'),
		array('lv_description', 'Description*', 'textarea'),
		array('lv_credits', 'Credits*', 'text')
	));

echo generate_edit_div($module, array(
		array('lv_code', 'Code*', 'text', true),
		array('lv_description', 'Description*', 'textarea', false),
		array('lv_credits', 'Credits*', 'text', false)
	));
?>
	<!-- <div id="view-leave_type">
		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_leave_type" value="Add New" />
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
					<td>Leave Code</td>
					<td>Leave Description</td>
					<td>Credits</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody class="leave_type_list" id="leave_type_list">

			</tbody>
		</table>
    </div>

	<div id="add-leave_type" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Leave Type</p>
			</div>
		</div>
		<form id="form-leave_type" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Code*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="lv_code" class="modal-text-input" name="lv_code" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Description*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="lv_description"></textarea>
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Credits*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="lv_credits" class="modal-text-input" name="lv_credits" />
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
						<a class="modal-action-cancel" href="#" id="leave_type-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="leave_type-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="edit-leave_type" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Edit Leave Type</p>
			</div>
		</div>
		<form id="form-leave_type" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Code</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="edit_lv_code" class="modal-text-input" name="lv_code" disabled="disabled" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Description*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="edit_lv_description"></textarea>
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Credits*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="edit_lv_credits" class="modal-text-input" name="lv_credits" />
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
						<a class="modal-action-cancel" href="#" id="edit_leave_type-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="edit_leave_type-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>-->
</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/leave_type2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
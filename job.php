<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<!-- Same as job.php -->
<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">JOBS MAINTENANCE</h3>

<?php
$module = "job";
echo generate_view_div($module, array('Job Code', 'Description', 'Actions'));
echo generate_add_div($module, array(
		array('job_code', 'Code*', 'text'),
		array('job_description', 'Description*', 'textarea')
	));
echo generate_edit_div($module, array(
		array('job_code', 'Code', 'text', true),
		array('job_description', 'Description*', 'textarea', false)
	));
?>

	<!-- <div id="view-rank">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_rank" value="Add New" />
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
					<td>Job Code</td>
					<td>Description</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody class="rank_list" id="rank_list">

			</tbody>
		</table>
    </div>

	<div id="add-rank" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Job</p>
			</div>
		</div>
		<form id="form-rank" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Job Code*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="rank_code" class="modal-text-input" name="rank-code" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Job Desc*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="job_description"></textarea>
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
						<a class="modal-action-cancel" href="#" id="rank-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="rank-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="edit-rank" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Edit Job</p>
			</div>
		</div>
		<form id="form-rank" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Job Code*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="edit_rank_code" class="modal-text-input" name="rank-code" disabled="disabled" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Job Desc*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="edit_job_description"></textarea>
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
						<a class="modal-action-cancel" href="#" id="edit_rank-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="edit_rank-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div> -->
</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/job2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">OVERTIME APPLICATION FORM</h3>
<?php
$module = "otform";
$labels = array('Start Date', 'Total Hours', 'Reason', 'Output', 'Status');
if ($level != 'EMPLOYEES') {
	array_unshift($labels, 'Name');
    $labels[] = 'Actions';
}

echo generate_view_div($module, $labels);
echo generate_add_div($module, array(
		array('ot_start', 'Start Date*', 'text'),
		array('total_hours', 'Total Hours*', 'text'),
		array('reason', 'Reason*', 'text'),
		array('output', 'Output*', 'text'),
		// array('status', 'Status*', 'select'),
	));
?>
	<!-- <div id="view-ot">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_ot" value="Add New" />
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
					<td>Date</td>
					<td>Time</td>
					<td>Reason</td>
					<td>Status</td>
				</tr>
			</thead>
			<tbody class="ot_list" id="ot_list">

			</tbody>
		</table>
    </div>

	<div id="add-ot" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Apply for Overtime</p>
			</div>
		</div>
		<form id="form-overtime" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Date*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="ot_date" class="modal-text-input"  />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Start*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="start_time" class="modal-text-input"  />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">End*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="end_time" class="modal-text-input" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Reason*</p>
						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="reason"></textarea>
						</div>
					</div>
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Exp. Output*</p>

						</div>
						<div class="modal-form-field-container">
							<textarea style="width: 351px; height: 150px; resize: none" rows="6" id="output"></textarea>
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
					<input type="hidden" id="employee_id" name="employee_id" value="<?php //echo $_SESSION['employee_id']; ?>">
						<a class="modal-action-cancel" href="#" id="ot-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="ot-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div> -->

</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/otform2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
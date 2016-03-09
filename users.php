<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">USERS MAINTENANCE</h3>

<?php
$module = "users";
$labels = array('Username', 'Name', 'Email', 'Level', 'Actions');
$add_lbl = array(
        array('employee_id', 'Employee*', 'select'),
        array('username', 'Username*', 'text'),
        array('password', 'Password*', 'password'),
        array('email', 'Email', 'text'),
        array('level', 'Level', 'select'));

if ($level == 'SYS ADMINS') {
    array_unshift($labels, 'Organization');
    array_unshift($add_lbl, array('org_id', 'Organization*', 'select'));
}

echo generate_view_div($module, $labels);

echo generate_add_div($module, $add_lbl);

echo generate_edit_div($module, array(
        // array('employee_id', 'Employee*', 'select'),
        array('username', 'Username*', 'text', false),
        array('password', 'Password*', 'password', false),
        array('email', 'Email', 'text', false),
        array('level', 'Level', 'select', false)
    ));
?>

	<!-- <div id="view-user">

		<div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_user" value="Add New" />
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
					<td>Username</td>
					<td>Name</td>
					<td>Email</td>
					<td>Level</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="user_list" id="user_list">

			</tbody>
		</table>
    </div>

	<div id="add-user" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Add Users</p>
			</div>
		</div>
		<form id="form-user" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div id="notifier"></div>
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Emp ID*</p>
						</div>
						<div class="modal-form-field-container">
							<div class="modal-form-field-container" id="employee_ids"></div>
						</div>
					</div>&nbsp;
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Username*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="username" class="modal-text-input" name="name" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Password*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="password" id="password" class="modal-text-input" name="name" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Email*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="email" class="modal-text-input" name="location" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Level</p>
						</div>
						<div class="modal-form-field-container">
							<select id="level">
								<option value="EMPLOYEES">EMPLOYEES</option>
								<option value="SUPERVISORS">SUPERVISORS</option>
								<option value="HR MANAGERS">HR MANAGERS</option>
							</select>
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
						<a class="modal-action-cancel" href="#" id="user-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="user-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div id="edit-user" class="modal-wrapper" style="display: none; z-index: 2">
		<div class="modal-header-wrapper">
			<div class="modal-header-text-container">
				<p class="modal-header-text">Edit Users</p>
			</div>
		</div>
		<form id="form-user" onsubmit="return false;">
			<div class="modal-content-wrapper">
				<div class="modal-form-fields-wrapper">
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Username</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="edit_username" class="modal-text-input" name="name" readonly="readonly" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Password*</p>
						</div>
						<div class="modal-form-field-container">
							<input type="password" id="edit_password" class="modal-text-input" name="name" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Email</p>
						</div>
						<div class="modal-form-field-container">
							<input type="text" id="edit_email" class="modal-text-input" name="location" readonly="readonly" />
						</div>
					</div>
					<div class="modal-form-field-row">
						<div class="modal-form-field-label-container">
							<p class="modal-form-field-label">Level</p>
						</div>
						<div class="modal-form-field-container">
							<select id="ed_level">
								<option value="EMPLOYEES">EMPLOYEES</option>
								<option value="SUPERVISORS">SUPERVISORS</option>
								<option value="HR MANAGERS">HR MANAGERS</option>
							</select>
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
						<a class="modal-action-cancel" href="#" id="edit_user-cancel">Cancel</a>
						<input type="submit" class="modal-action-btn primary-btn" id="edit_user-save" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div> -->


</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/users2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
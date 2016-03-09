<?php

function generate_view_div($module, $thead_arr)
{
    $boiler =
    '<div id="view-{{MODULE}}">

        <div class="right">
            <input type="button" class="tbl-main-action-btn" id="add_{{MODULE}}" value="Add New" />
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
                    {{THEAD}}
                </tr>
            </thead>
            <tbody class="{{MODULE}}_list" id="{{MODULE}}_list">

            </tbody>
        </table>
    </div>';

    $thead_str = '';
    foreach ($thead_arr as $value)
        $thead_str .= '<td>'.$value.'</td>';

    return str_replace(
        array('{{MODULE}}', '{{THEAD}}'),
        array($module, $thead_str),
        $boiler
    );
}


function generate_add_div($module, $columns)
{
    $boiler =
    '<div id="add-{{MODULE}}" class="modal-wrapper" style="display: none; z-index: 2">
        <div class="modal-header-wrapper">
            <div class="modal-header-text-container">
                <p class="modal-header-text">Add {{MODULE_TITLE}}</p>
            </div>
        </div>
        <form id="addform-{{MODULE}}" onsubmit="return false;">
            <div class="modal-content-wrapper">
                <div class="modal-form-fields-wrapper">
                    <div class="modal-form-field-row">
                        <div id="add-notifier"></div>
                    </div>

                    {{COLUMNS}}

                    <div class="modal-form-field-row">
                        <div class="modal-form-field-label-container">&nbsp;</div>
                        <div class="modal-form-field-container">
                            <p class="modal-form-disclaimer">*required field</p>
                        </div>
                    </div>
                </div>
                <div class="modal-actions-wrapper">
                    <div class="modal-actions-container right">
                        <a class="modal-action-cancel" href="#" id="{{MODULE}}-cancel">Cancel</a>
                        <input type="submit" class="modal-action-btn primary-btn" id="{{MODULE}}-save" value="Save" />
                    </div>
                </div>
            </div>
        </form>
    </div>';

    $columns_str = '';
    foreach ($columns as $col)
        $columns_str .= generate_row_div('', $col[0], $col[1], $col[2]);

    $module_title = '';
    foreach (explode('_', $module) as $value)
        $module_title .= ucfirst($value)." ";
    $module_title = trim($module_title);

    return str_replace(
        array('{{MODULE}}', '{{MODULE_TITLE}}', '{{COLUMNS}}'),
        array($module, $module_title, $columns_str),
        $boiler
    );
}

function generate_row_div($row_mode, $id, $label, $type, $is_disabled=false)
{
    $boiler =
    '<div class="modal-form-field-row">
        <div class="modal-form-field-label-container">
            <p class="modal-form-field-label">{{LABEL}}</p>
        </div>
        <div class="modal-form-field-container">
            {{INPUT}}
        </div>
    </div>';

    $input_str = '';
    $disabled_str = $is_disabled ? 'disabled="disabled"' : '';

    switch ($type) {
        case 'text':
        case 'integer':
            $input_str = '<input type="text" id="{{ID}}" class="modal-text-input" name="{{ID}}" '.$disabled_str.'/>';
            break;

        case 'textarea':
            $input_str = '<textarea rows="6" id="{{ID}}" '.$disabled_str.'></textarea>';
            break;

        case 'select':
            $input_str = '<div class="modal-form-field-container" id="{{ID}}_select"></div>';
            $boiler .= '<div style="clear: both"></div>';
            break;
        case 'password':
            $input_str = '<input id="{{ID}}" class="modal-text-input" name="name" type="password">';
            break;
    }

    $id_prepend = empty($row_mode) ? '' : $row_mode.'_';
    $input_str = str_replace("{{ID}}", $id_prepend.$id, $input_str);

    return str_replace(
        array('{{LABEL}}', '{{INPUT}}'),
        array($label, $input_str),
        $boiler
    );
}


function generate_edit_div($module, $columns)
{
    $boiler =
    '<div id="edit-{{MODULE}}" class="modal-wrapper" style="display: none; z-index: 2">
        <div class="modal-header-wrapper">
            <div class="modal-header-text-container">
                <p class="modal-header-text">Edit {{MODULE_TITLE}}</p>
            </div>
        </div>

        <form id="editform-{{MODULE}}" onsubmit="return false;">
            <div class="modal-content-wrapper">
                <div class="modal-form-fields-wrapper">
                    <div class="modal-form-field-row">
                        <div id="edit-notifier"></div>
                    </div>

                    {{COLUMNS}}

                    <div class="modal-form-field-row">
                        <div class="modal-form-field-label-container">&nbsp;</div>
                        <div class="modal-form-field-container">
                            <p class="modal-form-disclaimer">*required field</p>
                        </div>
                    </div>
                </div>
                <div class="modal-actions-wrapper">
                    <div class="modal-actions-container right">
                        <a class="modal-action-cancel" href="#" id="edit_{{MODULE}}-cancel">Cancel</a>
                        <input type="submit" class="modal-action-btn primary-btn" id="edit_{{MODULE}}-save" value="Save" />
                    </div>
                </div>
            </div>
        </form>
    </div>';

    $columns_str = '';
    foreach ($columns as $col)
        $columns_str .= generate_row_div('edit', $col[0], $col[1], $col[2], $col[3]);

    $module_title = '';
    foreach (explode('_', $module) as $value)
        $module_title .= ucfirst($value)." ";
    $module_title = trim($module_title);

    return str_replace(
        array('{{MODULE}}', '{{MODULE_TITLE}}', '{{COLUMNS}}'),
        array($module, $module_title, $columns_str),
        $boiler
    );
}

function generate_employee_view_header($emp_id, $view_name)
{
    $boiler =
    '<h3 class="heading-text">EMPLOYEES MAINTENANCE</h3>
    <input type="hidden" id="employee_id" value="{{EMP_ID}}">
    <div id="links">
        <table>
            <tr>
                <td><a href="employee-details.php?employee_id={{EMP_ID}}">Information</a></td>
                <td><a href="employee-education.php?employee_id={{EMP_ID}}">Education</a></td>
                <td><a href="employee-employment.php?employee_id={{EMP_ID}}">Employment</a></td>
                <td><a href="employee-family.php?employee_id={{EMP_ID}}">Family</a></td>
                <td><a href="employee-licenses.php?employee_id={{EMP_ID}}">Licenses</a></td>
            </tr>
            <tr>
                <td><a href="employee-infractions.php?employee_id={{EMP_ID}}">Infractions</a></td>
                <td><a href="employee-perfreviews.php?employee_id={{EMP_ID}}">Perf Reviews</a></td>
                <td><a href="employee-medicalrecords.php?employee_id={{EMP_ID}}">Medical Records</a></td>
                <td><a href="employee-rewards.php?employee_id={{EMP_ID}}">Rewards</a></td>
                <td><a href="employee-trainings.php?employee_id={{EMP_ID}}">Trainings</a></td>
            </tr>
        </table>
    </div>';

    return str_replace(array('{{EMP_ID}}', $view_name), array($emp_id, "<b>$view_name</b>"), $boiler);
}
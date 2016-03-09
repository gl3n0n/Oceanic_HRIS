<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<?
$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);
?>

<div class="large-9 columns" role="content" style="z-index: 0">

<?php echo generate_employee_view_header($employee_id, 'Education');?>

    <div>EDUCATION<br/><br/></div>
<?php
$module = "employee_education";
echo generate_view_div($module, array('Level', 'School', 'Course', 'Degree', 'Honors', 'Actions'));

echo generate_add_div($module, array(
        array('school', 'School*', 'text'),
        array('level', 'Level*', 'select'),
        array('course', 'Course*', 'text'),
        array('degree', 'Degree*', 'text'),
        array('honors', 'Honors*', 'text')
    ));

echo generate_edit_div($module, array(
        array('school', 'School*', 'text', false),
        array('level', 'Level*', 'select', false),
        array('course', 'Course*', 'text', false),
        array('degree', 'Degree*', 'text', false),
        array('honors', 'Honors*', 'text', false)
    ));
?>


    <!-- <div>&nbsp;</div>
    <div id="view-education">

        <div class="right">
        <input type="button" class="tbl-main-action-btn" id="add_education" value="Add New" />
        </div>
        <div>&nbsp;</div>
        <table>
            <thead>
                <tr>
                    <td>Level</td>
                    <td>School</td>
                    <td>Course</td>
                    <td>Degree</td>
                    <td>Honors</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody class="education_list" id="education_list">

            </tbody>
        </table>
    </div>

    <div id="add-education" class="modal-wrapper" style="display: none; z-index: 2">
        <div class="modal-header-wrapper">
            <div class="modal-header-text-container">
                <p class="modal-header-text">Add Education</p>
            </div>
        </div>
        <form id="form-education" onsubmit="return false;">
            <div class="modal-content-wrapper">
                <div class="modal-form-fields-wrapper">

                    <div class="modal-form-field-row">
                        <div id="notifier"></div>
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">Level*</p>
                        </div>
                        <div class="modal-form-field-container">
                            <div id="options">
                            <select id="level">
                                <option value="COLLEGE" selected="selected">COLLEGE</option>
                                <option value="TERTIARY">TERTIARY</option>
                                <option value="ELEMENTARY">ELEMENTARY</option>
                                <option value="MASTER">MASTER</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div</div>

                    <div class="modal-form-field-row">
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">School*</p>
                        </div>
                        <div class="modal-form-field-container">
                            <input type="text" id="school" class="modal-text-input" name="school" />
                        </div>
                    </div>

                    <div class="modal-form-field-row">
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">Course*</p>
                        </div>
                        <div class="modal-form-field-container">
                            <input type="text" id="course" class="modal-text-input" name="course" />
                        </div>
                    </div>

                    <div class="modal-form-field-row">
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">Degree*</p>
                        </div>
                        <div class="modal-form-field-container">
                            <input type="text" id="degree" class="modal-text-input" name="degree" />
                        </div>
                    </div>

                    <div class="modal-form-field-row">
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">Honors*</p>
                        </div>
                        <div class="modal-form-field-container">
                            <input type="text" id="honors" class="modal-text-input" name="honors" />
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
                        <a class="modal-action-cancel" href="#" id="education-cancel">Cancel</a>
                        <input type="submit" class="modal-action-btn primary-btn" id="education-save" value="Save" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="view-education-single" class="modal-wrapper" style="display: none; z-index: 3">
        <div class="modal-header-wrapper">
            <div class="modal-header-text-container">
                <p class="modal-header-text">View Education</p>
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
<script type="text/javascript" src="js/employee-education2.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
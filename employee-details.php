<?php
include_once('header.php');
include_once 'add_boiler.php';

$employee_id = (isset($_GET['employee_id']) ? strtolower($_GET['employee_id']) : NULL);

function generate_emp_details_view_div($module, $thead_arr, $emp_id)
{
    //'<a href="#" id="edit_' + val['employee_id'] + '">Edit</a>'
    $boiler =
    '<div id="view-{{MODULE}}">

        <div class="right">
            <input type="button" class="tbl-main-action-btn" id="edit_{{MODULE}}_{{EMP_ID}}" value="Edit" />
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
        array('{{MODULE}}', '{{THEAD}}', '{{EMP_ID}}'),
        array($module, $thead_str, $emp_id),
        $boiler
    );
}
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <?php echo generate_employee_view_header($employee_id, 'Information') ?>

    <div>INFORMATION<br/><br/></div>
    <?php
        $module = 'employee';
        echo generate_emp_details_view_div($module, array('', ''), $employee_id);
        echo generate_edit_div($module, array(
            array('lastname', 'Last Name*', 'text', false),
            array('firstname', 'First Name*', 'text', false),
            array('middlename', 'Middle Name*', 'text', false),
            array('dept_id', 'Department*', 'select', false),
            array('position_id', 'Position*', 'select', false),
            array('empl_type_id', 'Employee Type*', 'select', false),
            array('gender', 'Gender*', 'select', false),
            array('address', 'Home Address', 'text', false),
            array('tel_no', 'Tel No', 'text', false),
            array('cell_no', 'Cell No', 'text', false),
            array('civil_status', 'Civil Status', 'select', false),
            array('religion', 'Religion', 'text', false),
            array('date_hired', 'Date Hired', 'text', false),
            array('birthdate', 'Birthdate', 'text', false),
            array('birthplace', 'Birthplace', 'text', false),
            array('empl_status', 'Employment Status', 'select', false),
            array('sss', 'SSS', 'text', false),
            array('tin', 'TIN', 'text', false),
            array('pagibig', 'Pag-ibig', 'text', false),
            array('philhealth', 'Philhealth', 'text', false),
            array('tax_type', 'Tax Type', 'text', false),
            array('salary_grade', 'Salary Grade', 'text', false),
            array('passport_no', 'Passport No.', 'text', false),
            array('passport_exp', 'Passport Exp.', 'text', false),
            array('date_resigned', 'Date Resigned', 'text', false),
            array('seaman_book_no', 'Seaman Book No.', 'text', false),
            array('seaman_book_exp', 'Seaman Book Exp.', 'text', false),
            array('biometric_no', 'Biometrics Card', 'text', false)
        ));
    ?>
    <!-- <div>&nbsp;</div>
    <div id="view-employee">
        <div>Last Name: &nbsp;&nbsp;<b><?=$details[0]['lastname']?></b>
        </div>
        <div>First Name: &nbsp;&nbsp;<b><?=$details[0]['firstname']?></b>
        </div>
        <div>Middle Name: &nbsp;&nbsp;<b><?=$details[0]['middlename']?></b>
        </div>
        <div>Department: &nbsp;&nbsp;<b><?=$details[0]['name']?></b>
        </div>
        <div>Position: &nbsp;&nbsp;<b><?=$details[0]['position_title']?></b>
        </div>
        <div>Employee Type: &nbsp;&nbsp;<b><?=$details[0]['empl_type']?></b>
        </div>
    </div> -->


</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/employee-details.js"></script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
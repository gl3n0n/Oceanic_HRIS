<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">SALARY GRADE</h3>

<?php
$module = "salary_grade";
echo generate_view_div($module, array('Grade Level', 'Ranking', 'Classification', 'Minimum', 'Median', 'Maximum', 'Actions'));
echo generate_add_div($module, array(
        array('gr_lvl', 'Grade Level*', 'text'),
        array('job_id', 'Ranking*', 'select'),
        array('classification', 'Classification*', 'text'),
        array('minimum', 'Minimum', 'integer'),
        array('median', 'Median', 'integer'),
        array('maximum', 'Maximum', 'integer')
    ));

echo generate_edit_div($module, array(
        array('gr_lvl', 'Grade Level*', 'text', false),
        array('job_id', 'Ranking*', 'select', false),
        array('classification', 'Classification*', 'text', false),
        array('minimum', 'Minimum', 'integer', false),
        array('median', 'Median', 'integer', false),
        array('maximum', 'Maximum', 'integer', false)
    ));
?>
</div>

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/salary_grade.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
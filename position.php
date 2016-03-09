<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">POSITION MAINTENANCE</h3>
<?php
$module = "position";
echo generate_view_div($module, array('Position Code', 'Title', 'Remarks', 'Job Level', 'Department', 'Actions'));
echo generate_add_div($module, array(
        array('position_code', 'Position Code*', 'text'),
        array('job_id', 'Job Level', 'select'),
        array('position_title', 'Title*', 'text'),
        array('position_description', 'Remarks*', 'text'),
        array('dept_id', 'Department', 'select')
    ));

echo generate_edit_div($module, array(
        array('position_code', 'Position Code', 'text', true),
        array('job_id', 'Job Level*', 'select', false),
        array('position_title', 'Title*', 'text', false),
        array('position_description', 'Remarks*', 'text', false),
        array('dept_id', 'Department*', 'select', false)
    ));
?>
</div>

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/position2.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
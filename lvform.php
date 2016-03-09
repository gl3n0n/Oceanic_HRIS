<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">LEAVE APPLICATION FORM</h3>

<?php
$module = "lvform";
$labels = array('Start Date', 'End Date', 'Leave Type', 'Reason', 'Status');
if ($level != 'EMPLOYEES') {
    array_unshift($labels, 'Name');
    $labels[] = 'Actions';
}

echo generate_view_div($module, $labels);
echo generate_add_div($module, array(
        array('start_date', 'Start Date*', 'text'),
        array('end_date', 'End Date*', 'text'),
        array('leave_type', 'Leave Type*', 'select'),
        array('reason', 'Reason*', 'text'),
        // array('status', 'Status*', 'select'),
    ));

// NO EDIT SINCE IT IS THE APPROVE REJECT PART
// echo generate_edit_div($module, array(
//      array('policy_code', 'Code', 'text', true),
//      array('policy_description', 'Description*', 'textarea', false)
//  ));
?>
</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/lvform.js"></script>


<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
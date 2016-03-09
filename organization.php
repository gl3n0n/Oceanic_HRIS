<?php
include_once('header.php');
include_once 'add_boiler.php';
?>


<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">ORGANIZATION MAINTENANCE</h3>
<?php
$module = "organization";
echo generate_view_div($module, array('Name', 'Logo Filename', 'Actions'));
echo generate_add_div($module, array(
        array('org_name', 'Name*', 'text'),
        array('logo', 'Logo Filename*', 'textarea')
    ));

echo generate_edit_div($module, array(
        array('org_name', 'Name*', 'text', true),
        array('logo', 'Logo Filename*', 'textarea', false)
    ));
?>
</div>

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/organization.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
<?php
include_once('header.php');
include_once 'add_boiler.php';
?>

<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">HR CALENDAR</h3>

    <div id='view-hr_events'>
        <div id="calBody"></div>
        <hr/>
        <div >
            <input type="button" class="tbl-main-action-btn" id="add_hr_events" value="Add New" />
        </div>
    </div>

    <?php
        $module = 'hr_events';
        echo generate_add_div($module, array(
            array('title', 'Title*', 'text'),
            array('location', 'Location*', 'text'),
            array('start', 'Start*', 'text'),
            array('end', 'End*', 'text')
        ));
    ?>

</div>

<link rel="stylesheet" href="moocalendar/mooECal.css" />

<script type="text/javascript" src="moocalendar/mooECal.js"></script>
<script type="text/javascript" src="moocalendar/mecPHPplugin.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/hr_events.js"></script>


<script type="text/javascript">
    window.addEvent('domready',function(){
        new Calendar({
            calContainer:'calBody',
            newDate: new Date(),
            // scroller: false,
            feedPlugin: new mecPHPPlugin()
        });
    })
</script>

<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
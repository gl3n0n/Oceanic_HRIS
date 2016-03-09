<?php
include_once('header.php');
include_once 'add_boiler.php';
?>


<div class="large-9 columns" role="content" style="z-index: 0">
    <h3 class="heading-text">DIVISION MAINTENANCE</h3>
<?php
$module = "division";
echo generate_view_div($module, array('Division Code', 'Description', 'Actions'));
echo generate_add_div($module, array(
        array('division_code', 'Code*', 'text'),
        array('description', 'Description*', 'textarea')
    ));

echo generate_edit_div($module, array(
        array('division_code', 'Code', 'text', true),
        array('description', 'Description*', 'textarea', false)
    ));
?>


    <!-- <div id="view-location">

        <div class="right">
            <input type="button" class="tbl-main-action-btn" id="add_location" value="Add New" />
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
                    <td>Name</td>
                    <td>Description</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody class="location_list" id="location_list">

            </tbody>
        </table>
    </div>

    <div id="add-location" class="modal-wrapper" style="display: none; z-index: 2">
        <div class="modal-header-wrapper">
            <div class="modal-header-text-container">
                <p class="modal-header-text">Add Division</p>
            </div>
        </div>
        <form id="form-location" onsubmit="return false;">
            <div class="modal-content-wrapper">
                <div class="modal-form-fields-wrapper">
                    <div class="modal-form-field-row">
                        <div id="notifier"></div>
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">Name*</p>
                        </div>
                        <div class="modal-form-field-container">
                            <input type="text" id="division_name" class="modal-text-input" name="division_name" />
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
                        <a class="modal-action-cancel" href="#" id="location-cancel">Cancel</a>
                        <input type="submit" class="modal-action-btn primary-btn" id="location-save" value="Save" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="edit-location" class="modal-wrapper" style="display: none; z-index: 2">
        <div class="modal-header-wrapper">
            <div class="modal-header-text-container">
                <p class="modal-header-text">Edit Location</p>
            </div>
        </div>
        <form id="form-location" onsubmit="return false;">
            <div class="modal-content-wrapper">
                <div class="modal-form-fields-wrapper">
                    <div class="modal-form-field-row">
                        <div id="notifier"></div>
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">Code</p>
                        </div>
                        <div class="modal-form-field-container">
                            <input type="text" id="edit_location_code" class="modal-text-input" disabled="disabled" />
                        </div>
                    </div>
                    <div class="modal-form-field-row">
                        <div class="modal-form-field-label-container">
                            <p class="modal-form-field-label">Name*</p>
                        </div>
                        <div class="modal-form-field-container">
                            <textarea style="width: 351px; height: 150px; resize: none" rows="6" id="edit_description"></textarea>
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
                        <a class="modal-action-cancel" href="#" id="edit_location-cancel">Cancel</a>
                        <input type="submit" class="modal-action-btn primary-btn" id="edit_location-save" value="Save" />
                    </div>
                </div>
            </div>
        </form>
    </div> -->
</div>



<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/baseOceanic.js"></script>
<script type="text/javascript" src="js/division.js"></script>
<?php
    include_once('sidebar.php');
    include_once('footer.php');
?>
function EmployeeDetails() {
    BaseOceanic.call(this, 'employee', 'employees', 'employee');
}

EmployeeDetails.prototype = Object.create(BaseOceanic.prototype);
EmployeeDetails.prototype.constructor = EmployeeDetails;

EmployeeDetails.prototype.getData = function(requestData) {
    requestData = typeof requestData !== 'undefined' ? requestData : {};

    requestData['employee_id'] = $$('#employee_id').get('value')[0];

    if (!this.runningReq) {
        this.runningReq = true;
        requestData['action'] = 'view-id';

        var self = this;
        var jsonRequest = new Request.JSON({
            url: this.apiUrl,
            data: requestData,
            method: 'POST',
            onError: function(text, error) { console.log(text);self.requestError(); },
            onFailure: function(xhr) { self.requestError(); },
            onSuccess: function(responseJSON, responseText) {
                self.runningReq = false;
                console.log(responseJSON);
                self.data = responseJSON.response[self.modulePlural];

                self.build();
                self.addEvents();
            }
        }).send();
    }
};

EmployeeDetails.prototype.addEditEvents = function() {
    var self = this;
    $$('input[type="button"][id^=edit_]').removeEvents();
    $$('input[type="button"][id^=edit_]').addEvent('click', function(e) {
        var id = this.id.split('_')[2];

        var requestData = {'action': 'view-id'};
        requestData[self.moduleAbbrev + '_id'] = id;

        var jsonRequest = new Request.JSON({
            url: self.apiUrl,
            data: requestData,
            method: 'POST',
            onError: function(text, error) { console.log(text); self.requestError(); },
            onFailure: function(xhr) { self.requestError(); },
            onSuccess: function(responseJSON, responseText) {
                self.runningReq = false;

                self.data = responseJSON.response[self.modulePlural];
                self.editModalContainer(id, self.data);
            }
        }).send();
    });
};

EmployeeDetails.prototype.getText = function(module, module_plural, id, id_name, result_col)
{
    var self = this;
    var result = '';
    var request =  { 'action' : 'view-id'};
    request[id_name] = id;

    var getter = new Request.JSON(
    {
        url: 'api/' + module + '.php',
        data: request,
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response[module_plural];

            result = response[0][result_col];
            var html_id = "#"+id_name+"_"+result_col;

            $$(html_id)[0].set('text', result);
        }
    }).send();
}

EmployeeDetails.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        console.log(val);

        var empDetails = ''
        + '<tr><td><strong>Last Name</strong></td><td> ' + val['lastname'] + ' </td></tr>'
        + '<tr><td><strong>First Name</strong></td><td> ' + val['firstname'] + ' </td></tr>'
        + '<tr><td><strong>Middle Name</strong></td><td> ' + val['middlename'] + ' </td></tr>'
        + '<tr><td><strong>Gender</strong></td><td> ' + val['gender'] + ' </td></tr>'
        + '<tr><td><strong>Department</strong></td><td id="dept_id_name"></td></tr>'
        + '<tr><td><strong>Position</strong></td><td id="position_id_position_title"></td></tr>'
        + '<tr><td><strong>Employee Type</strong></td><td id="empl_type_id_description"></td></tr>'
        + '<tr><td><strong>Employee Status</strong></td><td> ' + val['empl_status'] + ' </td></tr>'
        + '<tr><td><strong>Civil Status</strong></td><td> ' + val['civil_status'] + ' </td></tr>'
        + '<tr><td><strong>Address</strong></td><td> ' + val['address'] + ' </td></tr>'
        + '<tr><td><strong>Cell No</strong></td><td> ' + val['cell_no'] + ' </td></tr>'
        + '<tr><td><strong>Birth Date</strong></td><td> ' + val['birthdate'] + ' </td></tr>'
        + '<tr><td><strong>Birth Place</strong></td><td> ' + val['birthplace'] + ' </td></tr>'
        + '<tr><td><strong>SSS</strong></td><td> ' + val['sss'] + ' </td></tr>'
        + '<tr><td><strong>TIN</strong></td><td> ' + val['tin'] + ' </td></tr>'
        + '';

            // + '<td> ' + val['firstname'] + ' </td>'
            // + '<td> ' + val['lastname'] + ' </td>'
            // + '<td>' + val['empl_status'] + ' </td>'
            // + '<td>'
            //     + '<a href="#" id="edit_' + val['employee_id'] + '">Edit</a>'
            //     + ' | <a href="#" title="delete Employee Details ' + val['division_code'] + ' " class="confirm" id="del_'+ val['employee_id'] +'">Delete</a> '
            // + '</td>';

        $$('tbody.' + self.module + '_list')[0].innerHTML = empDetails;

        self.getText('department', 'departments', val['dept_id'], 'dept_id', 'name');
        self.getText('position', 'positions', val['position_id'], 'position_id', 'position_title');
        self.getText('employee_type', 'employee_type', val['empl_type_id'], 'empl_type_id', 'description');

        // self.render(divisionList);
    });
};

// EmployeeDetails.prototype.getAddModalFieldValues = function() {
//     var division_code = $$('#division_code').get('value')[0];
//     var description = $$('#description').get('value')[0];
//     return [
//         {'division_code': division_code, 'description': description},
//         ['division_code', 'description']
//     ];
// };

EmployeeDetails.prototype.getEditModalFieldValues = function() {
    var fields = {};
    // fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['lastname'] = $$('#edit_lastname').get('value')[0];
    fields['firstname'] = $$('#edit_firstname').get('value')[0];
    fields['middlename'] = $$('#edit_middlename').get('value')[0];
    fields['dept_id'] = $$('#edit_dept_id').get('value')[0];
    fields['position_id'] = $$('#edit_position_id').get('value')[0];
    fields['empl_type_id'] = $$('#edit_empl_type_id').get('value')[0];
    fields['gender'] = $$('#edit_gender').get('value')[0];
    fields['address'] = $$('#edit_address').get('value')[0];
    fields['tel_no'] = $$('#edit_tel_no').get('value')[0];
    fields['cell_no'] = $$('#edit_cell_no').get('value')[0];
    fields['civil_status'] = $$('#edit_civil_status').get('value')[0];
    fields['religion'] = $$('#edit_religion').get('value')[0];
    fields['date_hired'] = $$('#edit_date_hired').get('value')[0];
    fields['birthdate'] = $$('#edit_birthdate').get('value')[0];
    fields['birthplace'] = $$('#edit_birthplace').get('value')[0];
    fields['empl_status'] = $$('#edit_empl_status').get('value')[0];
    fields['sss'] = $$('#edit_sss').get('value')[0];
    fields['tin'] = $$('#edit_tin').get('value')[0];
    fields['pagibig'] = $$('#edit_pagibig').get('value')[0];
    fields['philhealth'] = $$('#edit_philhealth').get('value')[0];
    fields['tax_type'] = $$('#edit_tax_type').get('value')[0];
    fields['salary_grade'] = $$('#edit_salary_grade').get('value')[0];
    fields['passport_no'] = $$('#edit_passport_no').get('value')[0];
    fields['passport_exp'] = $$('#edit_passport_exp').get('value')[0];
    fields['date_resigned'] = $$('#edit_date_resigned').get('value')[0];
    fields['seaman_book_no'] = $$('#edit_seaman_book_no').get('value')[0];
    fields['seaman_book_exp'] = $$('#edit_seaman_book_exp').get('value')[0];
    fields['biometric_no'] = $$('#edit_biometric_no').get('value')[0];

    return [fields, ['firstname', 'middlename', 'lastname', 'dept_id', 'position_id', 'empl_type_id', 'gender']];
}

EmployeeDetails.prototype.editModalLookup = function() {
    var deptLookup = new Request.JSON(
    {
        'url' : 'api/department.php',
        'data' : {
            'action' : 'view'
        },
        'method' : 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var resp = responseJSON.response['departments'];
            var cnt = resp.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_dept_id";
            selectList.name = "edit_dept_id";
            document.getElementById("edit_dept_id_select").appendChild(selectList);
            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = resp[i];
                var option = document.createElement("option");
                option.value = val['dept_id'];
                option.text = val['name'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var positionLookup = new Request.JSON(
    {
        url: 'api/position.php',
        data: {
            'action': 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['positions'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_position_id";
            selectList.name = "edit_position_id";
            document.getElementById("edit_position_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['position_id'];
                option.text = val['position_description'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var emplTypeLookup = new Request.JSON(
    {
        url: 'api/employee_type.php',
        data: {
            'action': 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['employee_type'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_empl_type_id";
            selectList.name = "edit_empl_type_id";
            document.getElementById("edit_empl_type_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['empl_type_id'];
                option.text = val['empl_type'];
                selectList.appendChild(option);
            }
        }
    }).send();

    // var salGrdLookup = new Request.JSON(
    // {
    //     url: 'api/salary_grade.php',
    //     data: {
    //         'action': 'view'
    //     },
    //     method: 'POST',
    //     onError: function(text, error) { self.requestError(); },
    //     onFailure: function(xhr) { self.requestError(); },
    //     onSuccess: function(responseJSON, responseText) {
    //         self.runningReq = false;

    //         var response = responseJSON.response['positions'];
    //         var cnt = response.length;

    //         var selectList = document.createElement("select");
    //         selectList.id = "sal_grd_id";
    //         selectList.name = "sal_grd_id";
    //         document.getElementById("sal_grd_id_select").appendChild(selectList);

    //         var please_select = document.createElement("option");
    //         please_select.selected = 'true';
    //         please_select.value = '';
    //         please_select.text = "Please Select";
    //         selectList.appendChild(please_select);

    //         for (var i = 0; i < cnt; i++) {
    //             var val = response[i];
    //             var option = document.createElement("option");
    //             option.value = val['sal_grd_id'];
    //             option.text = val['classification'];
    //             selectList.appendChild(option);
    //         }
    //     }
    // }).send();

    var genders = ['MALE','FEMALE'];
    this.createHardcodeSelect(genders, 'edit_gender', 'edit_gender_select');

    var cvl_stats = ['SINGLE','MARRIED','SEPERATED','WIDOWED'];
    this.createHardcodeSelect(cvl_stats, 'edit_civil_status', 'edit_civil_status_select');

    var empl_status = ['ACTIVE','INACTIVE', 'TERMINATED'];
    this.createHardcodeSelect(empl_status, 'edit_empl_status', 'edit_empl_status_select');
}

window.addEvent('domready', function()
{
    var obj = new EmployeeDetails();
    obj.init()
});
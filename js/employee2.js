function Employee() {
    BaseOceanic.call(this, 'employee', 'employees', 'employee');
}

Employee.prototype = Object.create(BaseOceanic.prototype);
Employee.prototype.constructor = Employee;

Employee.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td> ' + val['lastname'] + ' </td>'
            + '<td> ' + val['firstname'] + ' </td>'
            + '<td> ' + val['lastname'] + ' </td>'
            + '<td>' + val['empl_status'] + ' </td>'
            + '<td>'
                + '<a href="employee-details.php?employee_id='+ val['employee_id']+'" >View</a>'
                // + '<a href="#" id="edit_' + val['employee_id'] + '">Edit</a>'
                // + ' | <a href="#" title="delete Employee ' + val['division_code'] + ' " class="confirm" id="del_'+ val['employee_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['employee_id']
        });

        self.render(liElem);
    });
};

Employee.prototype.createModalLookup = function() {
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
            selectList.id = "dept_id";
            selectList.name = "dept_id";
            document.getElementById("dept_id_select").appendChild(selectList);
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
            selectList.id = "position_id";
            selectList.name = "position_id";
            document.getElementById("position_id_select").appendChild(selectList);

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
            selectList.id = "empl_type_id";
            selectList.name = "empl_type_id";
            document.getElementById("empl_type_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['empl_type_id'];
                option.text = val['description'];
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
    this.createHardcodeSelect(genders, 'gender', 'gender_select');

    var cvl_stats = ['SINGLE','MARRIED','SEPERATED','WIDOWED'];
    this.createHardcodeSelect(cvl_stats, 'civil_status', 'civil_status_select');

    var empl_status = ['ACTIVE','INACTIVE', 'TERMINATED'];
    this.createHardcodeSelect(empl_status, 'empl_status', 'empl_status_select');
}

// Employee.prototype.getAddModalFieldValues = function() {
//     var division_code = $$('#division_code').get('value')[0];
//     var description = $$('#description').get('value')[0];
//     return [
//         {'division_code': division_code, 'description': description},
//         ['division_code', 'description']
//     ];
// };

// Employee.prototype.getEditModalFieldValues = function() {
//     var fields = {};
//     fields['description'] = $$('#edit_description').get('value')[0];
//     return [fields, ['description']];
// }

window.addEvent('domready', function()
{
    var obj = new Employee();
    obj.init()
});
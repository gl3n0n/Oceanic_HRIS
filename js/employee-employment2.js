function EmployeeEmployment() {
    BaseEmployeeDetail.call(this, 'employee_employment', 'employee_employment', 'empl_employment');
}

EmployeeEmployment.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeEmployment.prototype.constructor = EmployeeEmployment;

EmployeeEmployment.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['effectivity_date'] + '</td>'
            + '<td>' + val['job_description'] + '</td>'
            + '<td>' + val['position_title'] + '</td>'
            + '<td>' + val['remarks'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_employment_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete division code ' + val['division_code'] + ' " class="confirm" id="del_'+ val['empl_employment_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_employment_id']
        });

        self.render(liElem);
    });
};

EmployeeEmployment.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['effectivity_date'] = $$('#effectivity_date').get('value')[0];
    fields['job_id'] = $$('#job_id').get('value')[0];
    fields['position_id'] = $$('#position_id').get('value')[0];
    fields['remarks'] = $$('#remarks').get('value')[0];

    console.log(fields);

    return [fields, ['effectivity_date', 'job_id', 'position_id']];
};

EmployeeEmployment.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['effectivity_date'] = $$('#edit_effectivity_date').get('value')[0];
    fields['job_id'] = $$('#edit_job_id').get('value')[0];
    fields['position_id'] = $$('#edit_position_id').get('value')[0];
    fields['remarks'] = $$('#edit_remarks').get('value')[0];

    return [fields, ['effectivity_date', 'job_id', 'position_id']];
}

EmployeeEmployment.prototype.createModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var jobLookup = new Request.JSON(
    {
        url: 'api/job.php',
        data: {
            'action': 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['jobs'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "job_id";
            selectList.name = "job_id";
            document.getElementById("job_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['job_id'];
                option.text = val['job_description'];
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
};

EmployeeEmployment.prototype.editModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var jobLookup = new Request.JSON(
    {
        url: 'api/job.php',
        data: {
            'action': 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['jobs'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_job_id";
            selectList.name = "edit_job_id";
            document.getElementById("edit_job_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['job_id'];
                option.text = val['job_description'];
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
};

window.addEvent('domready', function()
{
    var obj = new EmployeeEmployment();
    obj.init()
});
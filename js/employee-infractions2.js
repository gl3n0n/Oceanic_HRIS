function EmployeeEmployment() {
    BaseEmployeeDetail.call(this, 'employee_infractions', 'employee_infraction', 'empl_infraction');
}

EmployeeEmployment.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeEmployment.prototype.constructor = EmployeeEmployment;

EmployeeEmployment.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['policy_code'] + '</td>'
            + '<td>' + val['description'] + '</td>'
            + '<td>' + val['date_received'] + '</td>'
            + '<td>' + val['sanction'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_infraction_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete infraction record ' + val['description'] + ' " class="confirm" id="del_'+ val['empl_infraction_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_infraction_id']
        });

        self.render(liElem);
    });
};

EmployeeEmployment.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['policy_id'] = $$('#policy_id').get('value')[0];
    fields['description'] = $$('#description').get('value')[0];
    fields['date_received'] = $$('#date_received').get('value')[0];
    fields['sanction'] = $$('#sanction').get('value')[0];

    return [fields, ['policy_id', 'description', 'date_received']];
};

EmployeeEmployment.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['policy_id'] = $$('#edit_policy_id').get('value')[0];
    fields['description'] = $$('#edit_description').get('value')[0];
    fields['date_received'] = $$('#edit_date_received').get('value')[0];
    fields['sanction'] = $$('#edit_sanction').get('value')[0];

    return [fields, ['policy_id', 'description', 'date_received']];
}

EmployeeEmployment.prototype.createModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var policyLookup = new Request.JSON(
    {
        url: 'api/policy.php',
        data: {
            'action': 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['policies'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "policy_id";
            selectList.name = "policy_id";
            document.getElementById("policy_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['policy_id'];
                option.text = val['policy_code'];
                selectList.appendChild(option);
            }
        }
    }).send();
};

EmployeeEmployment.prototype.editModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var policyLookup = new Request.JSON(
    {
        url: 'api/policy.php',
        data: {
            'action': 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['policies'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_policy_id";
            selectList.name = "edit_policy_id";
            document.getElementById("edit_policy_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['policy_id'];
                option.text = val['policy_code'];
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
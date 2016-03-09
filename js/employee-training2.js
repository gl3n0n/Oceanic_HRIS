function EmployeeTraining() {
    BaseEmployeeDetail.call(this, 'employee_training', 'employee_training', 'empl_training');
}

EmployeeTraining.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeTraining.prototype.constructor = EmployeeTraining;

EmployeeTraining.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['training_type'] + '</td>'
            + '<td>' + val['description'] + '</td>'
            + '<td>' + val['date_attended'] + '</td>'
            + '<td>' + val['remarks'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_training_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete training record ' + val['training_type'] + ' " class="confirm" id="del_'+ val['empl_training_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_training_id']
        });

        self.render(liElem);
    });
};

EmployeeTraining.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['training_type'] = $$('#training_type').get('value')[0];
    fields['description'] = $$('#description').get('value')[0];
    fields['date_attended'] = $$('#date_attended').get('value')[0];
    fields['remarks'] = $$('#remarks').get('value')[0];

    return [fields, Object.keys(fields)];
};

EmployeeTraining.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['training_type'] = $$('#edit_training_type').get('value')[0];
    fields['description'] = $$('#edit_description').get('value')[0];
    fields['date_attended'] = $$('#edit_date_attended').get('value')[0];
    fields['remarks'] = $$('#edit_remarks').get('value')[0];

    return [fields, Object.keys(fields)];
}

window.addEvent('domready', function()
{
    var obj = new EmployeeTraining();
    obj.init()
});
function EmployeeType() {
    BaseOceanic.call(this, 'employee_type', 'employee_type', 'empl_type');
}

EmployeeType.prototype = Object.create(BaseOceanic.prototype);
EmployeeType.prototype.constructor = EmployeeType;

EmployeeType.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var employeeTypeList = ''
            + '<td>' + val['empl_type'] + '</td>'
            + '<td>' + val['description'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_'+val['empl_type_id']+'">Edit</a>'
                + ' | <a href="#" title="delete employee type '+ val['empl_type'] +' " class="confirm" id="del_'+val['empl_type_id']+'">Delete</a>'
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': employeeTypeList,
            'id': 'list_' + val['empl_type_id']
        });

        self.render(liElem);
    });
};

EmployeeType.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['empl_type'] = $$('#empl_type').get('value')[0];
    fields['description'] = $$('#description').get('value')[0];

    return [fields, Object.keys(fields)];
};

EmployeeType.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['empl_type'] = $$('#edit_empl_type').get('value')[0];
    fields['description'] = $$('#edit_description').get('value')[0];

    return [fields, Object.keys(fields)];
};


window.addEvent('domready', function()
{
    var obj = new EmployeeType();
    obj.init()
});
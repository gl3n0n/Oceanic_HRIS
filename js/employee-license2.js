function EmployeeLicenses() {
    BaseEmployeeDetail.call(this, 'employee_licenses', 'employee_licenses', 'empl_license');
}

EmployeeLicenses.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeLicenses.prototype.constructor = EmployeeLicenses;

EmployeeLicenses.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['license_type'] + '</td>'
            + '<td>' + val['license_no'] + '</td>'
            + '<td>' + val['date_issued'] + '</td>'
            + '<td>' + val['expiry_date'] + '</td>'
            + '<td>' + val['remarks'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_license_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete license record ' + val['license_no'] + ' " class="confirm" id="del_'+ val['empl_license_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_license_id']
        });

        self.render(liElem);
    });
};

EmployeeLicenses.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['license_type'] = $$('#license_type').get('value')[0];
    fields['license_no'] = $$('#license_no').get('value')[0];
    fields['date_issued'] = $$('#date_issued').get('value')[0];
    fields['expiry_date'] = $$('#expiry_date').get('value')[0];
    fields['remarks'] = $$('#remarks').get('value')[0];

    return [fields, Object.keys(fields)];
};

EmployeeLicenses.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['license_type'] = $$('#edit_license_type').get('value')[0];
    fields['license_no'] = $$('#edit_license_no').get('value')[0];
    fields['date_issued'] = $$('#edit_date_issued').get('value')[0];
    fields['expiry_date'] = $$('#edit_expiry_date').get('value')[0];
    fields['remarks'] = $$('#edit_remarks').get('value')[0];

    return [fields, Object.keys(fields)];
}

window.addEvent('domready', function()
{
    var obj = new EmployeeLicenses();
    obj.init()
});
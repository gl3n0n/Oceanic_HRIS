function EmployeeMedical() {
    BaseEmployeeDetail.call(this, 'employee_medical', 'employee_medical', 'empl_medical');
}

EmployeeMedical.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeMedical.prototype.constructor = EmployeeMedical;

EmployeeMedical.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['description'] + '</td>'
            + '<td>' + val['prescription'] + '</td>'
            + '<td>' + val['hospital'] + '</td>'
            + '<td>' + val['physician'] + '</td>'
            + '<td>' + val['checkup_date'] + '</td>'
            + '<td>' + val['vac_exp'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_medical_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete medical record ' + val['description'] + ' " class="confirm" id="del_'+ val['empl_medical_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_medical_id']
        });

        self.render(liElem);
    });
};

EmployeeMedical.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['description'] = $$('#description').get('value')[0];
    fields['prescription'] = $$('#prescription').get('value')[0];
    fields['hospital'] = $$('#hospital').get('value')[0];
    fields['physician'] = $$('#physician').get('value')[0];
    fields['checkup_date'] = $$('#checkup_date').get('value')[0];
    fields['vac_exp'] = $$('#vac_exp').get('value')[0];

    return [fields, Object.keys(fields)];
};

EmployeeMedical.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['description'] = $$('#edit_description').get('value')[0];
    fields['prescription'] = $$('#edit_prescription').get('value')[0];
    fields['hospital'] = $$('#edit_hospital').get('value')[0];
    fields['physician'] = $$('#edit_physician').get('value')[0];
    fields['checkup_date'] = $$('#edit_checkup_date').get('value')[0];
    fields['vac_exp'] = $$('#edit_vac_exp').get('value')[0];

    return [fields, Object.keys(fields)];
}

window.addEvent('domready', function()
{
    var obj = new EmployeeMedical();
    obj.init()
});
function EmployeeFamily() {
    BaseEmployeeDetail.call(this, 'employee_family', 'employee_family', 'empl_family');
}

EmployeeFamily.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeFamily.prototype.constructor = EmployeeFamily;

EmployeeFamily.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['name'] + '</td>'
            + '<td>' + val['birthdate'] + '</td>'
            + '<td>' + val['gender'] + '</td>'
            + '<td>' + val['relationship'] + '</td>'
            + '<td>' + val['civil_status'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_family_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete family record ' + val['name'] + ' " class="confirm" id="del_'+ val['empl_family_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_family_id']
        });

        self.render(liElem);
    });
};

EmployeeFamily.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['name'] = $$('#name').get('value')[0];
    fields['birthdate'] = $$('#birthdate').get('value')[0];
    fields['gender'] = $$('#gender').get('value')[0];
    fields['relationship'] = $$('#relationship').get('value')[0];
    fields['civil_status'] = $$('#civil_status').get('value')[0];

    return [fields, Object.keys(fields)];
};

EmployeeFamily.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['name'] = $$('#edit_name').get('value')[0];
    fields['birthdate'] = $$('#edit_birthdate').get('value')[0];
    fields['gender'] = $$('#edit_gender').get('value')[0];
    fields['relationship'] = $$('#edit_relationship').get('value')[0];
    fields['civil_status'] = $$('#edit_civil_status').get('value')[0];

    return [fields, Object.keys(fields)];
}

EmployeeFamily.prototype.createModalLookup = function() {
    var genders = ['MALE','FEMALE'];
    this.createHardcodeSelect(genders, 'gender', 'gender_select');

    var rels = ['FATHER','MOTHER','SON','DAUGHTER','COUSIN','BROTHER','SISTER'];
    this.createHardcodeSelect(rels, 'relationship', 'relationship_select');

    var cvl_stats = ['SINGLE','MARRIED','SEPERATED','WIDOWED'];
    this.createHardcodeSelect(cvl_stats, 'civil_status', 'civil_status_select');
};

EmployeeFamily.prototype.editModalLookup = function() {
    var genders = ['MALE','FEMALE'];
    this.createHardcodeSelect(genders, 'edit_gender', 'edit_gender_select');

    var rels = ['FATHER','MOTHER','SON','DAUGHTER','COUSIN','BROTHER','SISTER'];
    this.createHardcodeSelect(rels, 'edit_relationship', 'edit_relationship_select');

    var cvl_stats = ['SINGLE','MARRIED','SEPERATED','WIDOWED'];
    this.createHardcodeSelect(cvl_stats, 'edit_civil_status', 'edit_civil_status_select');
};

window.addEvent('domready', function()
{
    var obj = new EmployeeFamily();
    obj.init()
});
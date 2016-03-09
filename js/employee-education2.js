function EmployeeEducation() {
    BaseEmployeeDetail.call(this, 'employee_education', 'employee_education', 'empl_education');
}

EmployeeEducation.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeEducation.prototype.constructor = EmployeeEducation;

EmployeeEducation.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['level'] + '</td>'
            + '<td>' + val['school'] + '</td>'
            + '<td>' + val['course'] + '</td>'
            + '<td>' + val['degree'] + '</td>'
            + '<td>' + val['honors'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_education_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete division code ' + val['division_code'] + ' " class="confirm" id="del_'+ val['empl_education_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_education_id']
        });

        self.render(liElem);
    });
};

EmployeeEducation.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['school'] = $$('#school').get('value')[0];
    fields['level'] = $$('#level').get('value')[0];
    fields['course'] = $$('#course').get('value')[0];
    fields['degree'] = $$('#degree').get('value')[0];
    fields['honors'] = $$('#honors').get('value')[0];

    return [fields, Object.keys(fields)];
};

EmployeeEducation.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['school'] = $$('#edit_school').get('value')[0];
    fields['level'] = $$('#edit_level').get('value')[0];
    fields['course'] = $$('#edit_course').get('value')[0];
    fields['degree'] = $$('#edit_degree').get('value')[0];
    fields['honors'] = $$('#edit_honors').get('value')[0];

    return [fields, Object.keys(fields)];
}

EmployeeEducation.prototype.createModalLookup = function() {
    var levels = ['ELEMENTARY', 'TERTIARY', 'COLLEGE', 'MASTER'];
    this.createHardcodeSelect(levels, 'level', 'level_select');
};

EmployeeEducation.prototype.editModalLookup = function() {
    var levels = ['ELEMENTARY', 'TERTIARY', 'COLLEGE', 'MASTER'];
    this.createHardcodeSelect(levels, 'edit_level', 'edit_level_select');
};

window.addEvent('domready', function()
{
    var obj = new EmployeeEducation();
    obj.init()
});
function EmployeeRewards() {
    BaseEmployeeDetail.call(this, 'employee_rewards', 'employee_reward', 'empl_reward');
}

EmployeeRewards.prototype = Object.create(BaseEmployeeDetail.prototype);
EmployeeRewards.prototype.constructor = EmployeeRewards;

EmployeeRewards.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td>' + val['reward'] + '</td>'
            + '<td>' + val['description'] + '</td>'
            + '<td>' + val['date_received'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['empl_reward_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete reward record ' + val['reward'] + ' " class="confirm" id="del_'+ val['empl_reward_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['empl_reward_id']
        });

        self.render(liElem);
    });
};

EmployeeRewards.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').get('value')[0];
    fields['description'] = $$('#description').get('value')[0];
    fields['reward'] = $$('#reward').get('value')[0];
    fields['date_received'] = $$('#date_received').get('value')[0];

    return [fields, Object.keys(fields)];
};

EmployeeRewards.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['description'] = $$('#edit_description').get('value')[0];
    fields['reward'] = $$('#edit_reward').get('value')[0];
    fields['date_received'] = $$('#edit_date_received').get('value')[0];

    return [fields, Object.keys(fields)];
}

window.addEvent('domready', function()
{
    var obj = new EmployeeRewards();
    obj.init()
});
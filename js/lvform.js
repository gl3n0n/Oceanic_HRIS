function LvForm() {
    BaseOceanicForm.call(this, 'lvform', 'leave_applications', 'leave', true);
}

LvForm.prototype = Object.create(BaseOceanicForm.prototype);
LvForm.prototype.constructor = LvForm;

LvForm.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var policyList = '';
        if ('EMPLOYEES' != self.sess_level)
        {
             policyList += '<td> ' + val['lastname'] + ', ' + val['firstname'] + ' '+ val['middlename'] + ' </td>';
        }
		var newStat = '';
		if (val['status'] == 'MAN-APPROVED')
			newStat = 'Approved';
		else if(val['status'] == 'SUP-APPROVED')
			newStat = 'Approved';
	    else if(val['status'] == 'REJECTED')
			newStat = 'Rejected';
		else if(val['status'] == 'PENDING')
			newStat = 'Pending';
		else
			newStat = val['status'];
        policyList += '<td> ' + val['start_date'] + ' </td>'
            + '<td>' + val['end_date'] + ' </td>'
            + '<td>' + val['leave_type'] + ' </td>'
            + '<td>' + val['reason'] + ' </td>'
            + '<td>' + newStat + ' </td>';

        if ('EMPLOYEES' != self.sess_level &&
            (('SUPERVISORS' == self.sess_level && val['status'] == 'PENDING') ||
             ('HR MANAGERS' == self.sess_level && (val['status'] == 'PENDING' || val['status'] == 'SUP-APPROVED'))
            ))
        {
            policyList += ''
                + '<td>'
                    + '<a href="#" id="edit_'+ val['leave_id'] +'">Approve</a>'
                    + ' | <a href="#" title="Reject Leave application" class="confirm" id="del_'+val['leave_id']+'">Reject</a>'
                + '</td>';
        }

        var liElem = new Element('</tr>',
        {
            'html': policyList,
            'id': 'list_' + val['leave_id']
        });

        self.render(liElem);
    });
};

LvForm.prototype.createModalLookup = function() {
    var leave_type = ['VACATION','SICK','BIRTHDAY'];
    this.createHardcodeSelect(leave_type, 'leave_type', 'leave_type_select');
};

LvForm.prototype.getAddModalFieldValues = function() {
    var fields = {};
	var self = this;
    fields['start_date'] = $$('#start_date').get('value')[0];
    fields['end_date'] = $$('#end_date').get('value')[0];
    fields['leave_type'] = $$('#leave_type').getSelected()[0].get('value')[0];
    fields['reason'] = $$('#reason').get('value')[0];
	if ('SUPERVISORS' == self.sess_level)
	{
		fields['status'] = 'SUP-APPROVED';
	}
	
	if ('HR MANAGERS' == self.sess_level)
	{
		fields['status'] = 'MAN-APPROVED';
	}
    // fields['status'] = $$('#status').getSelected()[0].get("value")[0];
    // console.log(fields)

    return [fields, Object.keys(fields)];
};

window.addEvent('domready', function()
{
    var obj = new LvForm();
    obj.init()
});
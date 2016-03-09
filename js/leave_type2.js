function LeaveType() {
    BaseOceanic.call(this, 'leave_type', 'leave_type', 'lv');
}

LeaveType.prototype = Object.create(BaseOceanic.prototype);
LeaveType.prototype.constructor = LeaveType;

LeaveType.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var leaveTypeList = ''
            + '<td> ' + val['lv_code'] + ' </td>'
            + '<td>' + val['lv_description'] + ' </td>'
            + '<td>' + val['lv_credits'] + ' </td>'
            + '<td>'
                + '<a href="#" id="edit_'+val['lv_id']+'">Edit</a>'
                + ' | <a href="#" title="delete leave type '+ val['lv_code'] +' " class="confirm" id="del_'+val['lv_id']+'">Delete</a>'
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': leaveTypeList,
            'id': 'list_' + val['lv_id']
        });

        self.render(liElem);
    });
};

LeaveType.prototype.getAddModalFieldValues = function() {
    var lv_code = $$('#lv_code').get('value')[0];
    var lv_description = $$('#lv_description').get('value')[0];
    var lv_credits = $$('#lv_credits').get('value')[0];

    return [
        {'lv_code': lv_code, 'lv_description': lv_description, 'lv_credits': lv_credits},
        ['lv_code', 'lv_description', 'lv_credits']
    ];
};

LeaveType.prototype.getEditModalFieldValues = function() {
    var fields = {};

    fields['lv_description'] = $$('#edit_lv_description').get('value')[0];
    fields['lv_credits'] = $$('#edit_lv_credits').get('value')[0];

    return [fields, ['lv_description', 'lv_credits']];
};


window.addEvent('domready', function()
{
    var obj = new LeaveType();
    obj.init()
});
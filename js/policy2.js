function Policy() {
    BaseOceanic.call(this, 'policy', 'policies', 'policy');
}

Policy.prototype = Object.create(BaseOceanic.prototype);
Policy.prototype.constructor = Policy;

Policy.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var policyList = ''
            + '<td> ' + val['policy_code'] + ' </td>'
            + '<td>' + val['policy_description'] + ' </td>'
            + '<td>'
                + '<a href="#" id="edit_'+ val['policy_id'] +'">Edit</a>'
                + ' | <a href="#" title="delete policy code '+ val['policy_code'] +' " class="confirm" id="del_'+val['policy_id']+'">Delete</a>'
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': policyList,
            'id': 'list_' + val['policy_id']
        });

        self.render(liElem);
    });
};

Policy.prototype.getAddModalFieldValues = function() {
    var policy_code = $$('#policy_code').get('value')[0];
    var policy_description = $$('#policy_description').get('value')[0];

    return [
        {'policy_code': policy_code, 'policy_description': policy_description},
        ['policy_code', 'policy_description']
    ];
};

Policy.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['policy_description'] = $$('#edit_policy_description').get('value')[0];
    return [fields, ['policy_description']];
};


window.addEvent('domready', function()
{
    var obj = new Policy();
    obj.init()
});
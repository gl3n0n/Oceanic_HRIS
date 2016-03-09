function Organization() {
    BaseOceanic.call(this, 'organization', 'organization', 'org');
}

Organization.prototype = Object.create(BaseOceanic.prototype);
Organization.prototype.constructor = Organization;

Organization.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td> ' + val['org_name'] + ' </td>'
            + '<td>' + val['logo'] + ' </td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['org_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete organization ' + val['org_name'] + ' " class="confirm" id="del_'+ val['org_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['org_id']
        });

        self.render(liElem);
    });
};

Organization.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['org_name'] = $$('#org_name').get('value')[0];
    fields['logo'] = $$('#logo').get('value')[0];

    return [fields, Object.keys(fields)];
};

Organization.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['logo'] = $$('#edit_logo').get('value')[0];
    return [fields, ['logo']];
}

window.addEvent('domready', function()
{
    var obj = new Organization();
    obj.init()
});
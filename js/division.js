function Division() {
    BaseOceanic.call(this, 'division', 'division', 'division');
}

Division.prototype = Object.create(BaseOceanic.prototype);
Division.prototype.constructor = Division;

Division.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var divisionList = ''
            + '<td> ' + val['division_code'] + ' </td>'
            + '<td>' + val['description'] + ' </td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['division_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete division code ' + val['division_code'] + ' " class="confirm" id="del_'+ val['division_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': divisionList,
            'id': 'list_' + val['division_id']
        });

        self.render(liElem);
    });
};

Division.prototype.getAddModalFieldValues = function() {
    var division_code = $$('#division_code').get('value')[0];
    var description = $$('#description').get('value')[0];
    return [
        {'division_code': division_code, 'description': description},
        ['division_code', 'description']
    ];
};

Division.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['description'] = $$('#edit_description').get('value')[0];
    return [fields, ['description']];
}

window.addEvent('domready', function()
{
    var obj = new Division();
    obj.init()
});
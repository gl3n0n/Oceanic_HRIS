function Location() {
    BaseOceanic.call(this, 'location', 'location', 'location');
}

Location.prototype = Object.create(BaseOceanic.prototype);
Location.prototype.constructor = Location;

Location.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var locationList = ''
            + '<td> ' + val['location_code'] + ' </td>'
            + '<td>' + val['description'] + ' </td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['location_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete location code ' + val['location_code'] + ' " class="confirm" id="del_'+ val['location_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': locationList,
            'id': 'list_' + val['location_id']
        });

        self.render(liElem);
    });
};

Location.prototype.getAddModalFieldValues = function() {
    var location_code = $$('#location_code').get('value')[0];
    var description = $$('#description').get('value')[0];
    return [
        {'location_code': location_code, 'description': description},
        ['location_code', 'description']
    ];
};

Location.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['description'] = $$('#edit_description').get('value')[0];
    return [fields, ['description']];
}

window.addEvent('domready', function()
{
    var obj = new Location();
    obj.init()
});
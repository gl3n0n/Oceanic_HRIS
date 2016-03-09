function Job() {
    BaseOceanic.call(this, 'job', 'jobs', 'job');
}

Job.prototype = Object.create(BaseOceanic.prototype);
Job.prototype.constructor = Job;

Job.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var jobList = ''
            + '<td> ' + val['job_code'] + ' </td>'
            + '<td>' + val['job_description'] + ' </td>'
            + '<td>'
                + '<a href="#" id="edit_'+val['job_id']+'">Edit</a>'
                + ' | <a href="#" title="delete job '+ val['job_code'] +'" class="confirm" id="del_'+val['job_id']+'">Delete</a>'
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': jobList,
            'id': 'list_' + val['job_id']
        });

        self.render(liElem);
    });
};

Job.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['job_code'] = $$('#job_code').get('value')[0];
    fields['job_description'] = $$('#job_description').get('value')[0];

    return [fields, Object.keys(fields)];
};

Job.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['job_description'] = $$('#edit_job_description').get('value')[0];

    return [fields, Object.keys(fields)];
};

window.addEvent('domready', function()
{
    var obj = new Job();
    obj.init()
});
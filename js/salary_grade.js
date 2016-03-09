function SalaryGrade() {
    BaseOceanic.call(this, 'salary_grade', 'salary_grade', 'sal_grd');
}

SalaryGrade.prototype = Object.create(BaseOceanic.prototype);
SalaryGrade.prototype.constructor = SalaryGrade;

SalaryGrade.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var locationList = ''
            + '<td>' + val['gr_lvl'] + '</td>'
            + '<td>' + val['job_description'] + '</td>'
            + '<td>' + val['classification'] + '</td>'
            + '<td>' + (val['minimum'] || "")  + '</td>'
            + '<td>' + (val['median'] || "") + '</td>'
            + '<td>' + (val['maximum'] || "") + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['sal_grd_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete salary grade ' + val['job_description'] + ' ' + val['classification'] + ' " class="confirm" id="del_'+ val['sal_grd_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': locationList,
            'id': 'list_' + val['sal_grd_id']
        });

        self.render(liElem);
    });
};

SalaryGrade.prototype.getAddModalFieldValues = function() {
    var gr_lvl = $$('#gr_lvl').get('value')[0];
    var job_id = $$('#job_id').get('value')[0];
    var classification = $$('#classification').get('value')[0];
    var minimum = $$('#minimum').get('value')[0];
    var median = $$('#median').get('value')[0];
    var maximum = $$('#maximum').get('value')[0];

    return [
        {'gr_lvl': gr_lvl, 'job_id': job_id, 'classification': classification, 'minimum': minimum, 'median': median, 'maximum': maximum},
        ['gr_lvl', 'job_id', 'classification']
    ];
};

SalaryGrade.prototype.createModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var jobLookup = new Request.JSON(
    {
        url: 'api/job.php',
        data: {
            'action' : 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            response = responseJSON.response['jobs'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "job_id";
            selectList.name = "job_id";
            document.getElementById("job_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['job_id'];
                option.text = val['job_code'];
                selectList.appendChild(option);
            }
        }
    }).send();
};

SalaryGrade.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['gr_lvl'] = $$('#edit_gr_lvl').get('value')[0];
    // fields['job_id'] = $$('#edit_job_id').get('value')[0];
    fields['job_id'] = $$('#edit_job_id').getSelected()[0].get("value")[0];
    fields['classification'] = $$('#edit_classification').get('value')[0];
    fields['minimum'] = $$('#edit_minimum').get('value')[0];
    fields['median'] = $$('#edit_median').get('value')[0];
    fields['maximum'] = $$('#edit_maximum').get('value')[0];
    return [fields, ['gr_lvl', 'job_id', 'classification']];
}

SalaryGrade.prototype.editModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var jobLookup = new Request.JSON(
    {
        url: 'api/job.php',
        data: {
            'action' : 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            response = responseJSON.response['jobs'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_job_id";
            selectList.name = "edit_job_id";
            document.getElementById("edit_job_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['job_id'];
                option.text = val['job_code'];
                selectList.appendChild(option);
            }
        }
    }).send();
};

window.addEvent('domready', function()
{
    var obj = new SalaryGrade();
    obj.init()
});
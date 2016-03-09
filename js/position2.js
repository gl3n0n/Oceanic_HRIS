function Position() {
    BaseOceanic.call(this, 'position', 'positions', 'position');
}

Position.prototype = Object.create(BaseOceanic.prototype);
Position.prototype.constructor = Position;

Position.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var positionList = ''
            + '<td>' + val['position_code'] + '</td>'
            + '<td>' + val['position_title'] + '</td>'
            + '<td>' + val['position_description'] + '</td>'
            + '<td>' + val['job_code'] + '</td>'
            + '<td>' + val['dept_name'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['position_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete position ' + val['position_code'] + ' " class="confirm" id="del_'+ val['position_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': positionList,
            'id': 'list_' + val['position_id']
        });

        self.render(liElem);
    });
};

Position.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['position_code'] = $$('#position_code').get('value')[0];
    fields['position_title'] = $$('#position_title').get('value')[0];
    fields['position_description'] = $$('#position_description').get('value')[0];
    fields['job_id'] = $$('#job_id').getSelected()[0].get("value")[0];
    fields['dept_id'] = $$('#dept_id').getSelected()[0].get("value")[0];

    return [fields, Object.keys(fields)];
};

Position.prototype.createModalLookup = function() {
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

            var resp = responseJSON.response['jobs'];
            var cnt = resp.length;

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
                var val = resp[i];
                var option = document.createElement("option");
                option.value = val['job_id'];
                option.text = val['job_code'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var deptLookup = new Request.JSON(
    {
        'url' : 'api/department.php',
        'data' : {
            'action' : 'view'
        },
        'method' : 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var resp = responseJSON.response['departments'];
            var cnt = resp.length;

            var selectList = document.createElement("select");
            selectList.id = "dept_id";
            selectList.name = "dept_id";
            document.getElementById("dept_id_select").appendChild(selectList);
            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = resp[i];
                var option = document.createElement("option");
                option.value = val['dept_id'];
                option.text = val['name'];
                selectList.appendChild(option);
            }
        }
    }).send();
};

Position.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['position_code'] = $$('#edit_position_code').get('value')[0];
    fields['position_title'] = $$('#edit_position_title').get('value')[0];
    fields['position_description'] = $$('#edit_position_description').get('value')[0];
    fields['job_id'] = $$('#edit_job_id').getSelected()[0].get("value")[0];
    fields['dept_id'] = $$('#edit_dept_id').getSelected()[0].get("value")[0];

    return [fields, Object.keys(fields)];
}

Position.prototype.editModalLookup = function() {
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

            var resp = responseJSON.response['jobs'];
            var cnt = resp.length;

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
                var val = resp[i];
                var option = document.createElement("option");
                option.value = val['job_id'];
                option.text = val['job_code'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var deptLookup = new Request.JSON(
    {
        'url' : 'api/department.php',
        'data' : {
            'action' : 'view'
        },
        'method' : 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var resp = responseJSON.response['departments'];
            var cnt = resp.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_dept_id";
            selectList.name = "edit_dept_id";
            document.getElementById("edit_dept_id_select").appendChild(selectList);
            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = resp[i];
                var option = document.createElement("option");
                option.value = val['dept_id'];
                option.text = val['name'];
                selectList.appendChild(option);
            }
        }
    }).send();
};


window.addEvent('domready', function()
{
    var obj = new Position();
    obj.init()
});
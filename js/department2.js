function Department() {
    BaseOceanic.call(this, 'department', 'departments', 'dept');
}

Department.prototype = Object.create(BaseOceanic.prototype);
Department.prototype.constructor = Department;

Department.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var positionList = ''
            + '<td>' + val['dept_code'] + '</td>'
            + '<td>' + val['name'] + '</td>'
            + '<td>' + val['location_code'] + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['dept_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete department ' + val['dept_code'] + ' " class="confirm" id="del_'+ val['dept_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': positionList,
            'id': 'list_' + val['dept_id']
        });

        self.render(liElem);
    });
};

Department.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['dept_code'] = $$('#dept_code').get('value')[0];
    fields['name'] = $$('#name').get('value')[0];
    fields['division_id'] = $$('#division_id').getSelected()[0].get("value")[0];
    fields['location_id'] = $$('#location_id').getSelected()[0].get("value")[0];
    fields['headed_by'] = $$('#headed_by').getSelected()[0].get("value")[0];


    return [fields, ['dept_code', 'division_id', 'name', 'location_id']];
};

Department.prototype.createModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var locationLookup = new Request.JSON(
    {
        url: 'api/location.php',
        data: {
            'action' : 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            response = responseJSON.response['location'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "location_id";
            selectList.name = "location_id";
            document.getElementById("location_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['location_id'];
                option.text = val['location_code'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var divsionLookup = new Request.JSON(
    {
        'url' : 'api/division.php',
        'data' : {
            'action' : 'view'
        },
        'method' : 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['division'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "division_id";
            selectList.name = "division_id";
            document.getElementById("division_id_select").appendChild(selectList);
            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['division_id'];
                option.text = val['division_code'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var headLookup = new Request.JSON(
    {
        'url' : 'api/department.php',
        'data' : {
            'action' : 'view-heads'
        },
        'method' : 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['department_heads'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "headed_by";
            selectList.name = "headed_by";
            document.getElementById("headed_by_select").appendChild(selectList);
            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['employee_id'];
                option.text = val['lastname'] + ', ' + val['firstname'] + ' ' + val['middlename'];
                selectList.appendChild(option);
            }
        }
    }).send();
};

Department.prototype.getEditModalFieldValues = function() {
    var fields = {};
    fields['dept_code'] = $$('#edit_dept_code').get('value')[0];
    fields['division_id'] = $$('#edit_division_id').getSelected()[0].get("value")[0];
    fields['name'] = $$('#edit_name').get('value')[0];
    fields['location_id'] = $$('#edit_location_id').getSelected()[0].get("value")[0];
    fields['headed_by'] = $$('#edit_headed_by').getSelected()[0].get("value")[0];

    return [fields, ['dept_code', 'division_id', 'name', 'location_id']];
}

Department.prototype.editModalLookup = function() {
    this.runningReq = true;

    var self = this;
    var locationLookup = new Request.JSON(
    {
        url: 'api/location.php',
        data: {
            'action' : 'view'
        },
        method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            response = responseJSON.response['location'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_location_id";
            selectList.name = "edit_location_id";
            document.getElementById("edit_location_id_select").appendChild(selectList);

            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['location_id'];
                option.text = val['location_code'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var divsionLookup = new Request.JSON(
    {
        'url' : 'api/division.php',
        'data' : {
            'action' : 'view'
        },
        'method' : 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['division'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_division_id";
            selectList.name = "edit_division_id";
            document.getElementById("edit_division_id_select").appendChild(selectList);
            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['division_id'];
                option.text = val['division_code'];
                selectList.appendChild(option);
            }
        }
    }).send();

    var headLookup = new Request.JSON(
    {
        'url' : 'api/department.php',
        'data' : {
            'action' : 'view-heads'
        },
        'method' : 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            var response = responseJSON.response['department_heads'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "edit_headed_by";
            selectList.name = "edit_headed_by";
            document.getElementById("edit_headed_by_select").appendChild(selectList);
            var please_select = document.createElement("option");
            please_select.selected = 'true';
            please_select.value = '';
            please_select.text = "Please Select";
            selectList.appendChild(please_select);

            for (var i = 0; i < cnt; i++) {
                var val = response[i];
                var option = document.createElement("option");
                option.value = val['employee_id'];
                option.text = val['lastname'] + ', ' + val['firstname'] + ' ' + val['middlename'];
                selectList.appendChild(option);
            }
        }
    }).send();
};


window.addEvent('domready', function()
{
    var obj = new Department();
    obj.init()
});
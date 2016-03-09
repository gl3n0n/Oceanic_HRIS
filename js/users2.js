function Users() {
    BaseOceanic.call(this, 'users', 'users', 'user');
}

Users.prototype = Object.create(BaseOceanic.prototype);
Users.prototype.constructor = Users;

Users.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        console.log(self.sess_level)
        var policyList = '';
        if ('SYS ADMINS' == self.sess_level)
        {
             policyList += '<td> ' + val['org_name'] + ' </td>';
        }
        policyList += ''
            // + '<td>' + val['employee_id'] + '</td>'
            + '<td>' + val['username'] + '</td>'
            + '<td>' + val['lastname'] + ', ' + val['firstname'] + ' ' + val['middlename'] + '</td>'
            + '<td>' + (val['email'] || "")  + '</td>'
            + '<td>' + (val['level'] || "") + '</td>'
            // + '<td>' + (val['maximum'] || "") + '</td>'
            + '<td>'
                + '<a href="#" id="edit_' + val['user_id'] + '">Edit</a>'
                + ' | <a href="#" title="delete User ' + val['username'] + '" class="confirm" id="del_'+ val['user_id'] +'">Delete</a> '
            + '</td>';

        var liElem = new Element('</tr>',
        {
            'html': policyList,
            'id': 'list_' + val['user_id']
        });

        self.render(liElem);
    });
};

Users.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['employee_id'] = $$('#employee_id').getSelected()[0].get("value")[0];
    fields['username'] = $$('#username').get('value')[0];
    fields['password'] = $$('#password').get('value')[0];
    fields['email'] = $$('#email').get('value')[0];
    fields['level'] = $$('#level').getSelected()[0].get("value")[0];

    var req = ['username', 'password', 'level'];
    if ('SYS ADMINS' != this.sess_level && fields['level'] == 'SYS ADMINS')
        req.push('employee_id')

    return [fields, req];
};

Users.prototype.createModalLookup = function() {
    this.runningReq = true;

    var self = this;
    emplook_data = {'action' : 'view'}

    var empLookup = new Request.JSON(
    {
        url: 'api/employee.php',
        // ,
        // method: 'POST',
        onError: function(text, error) { self.requestError(); },
        onFailure: function(xhr) { self.requestError(); },
        onSuccess: function(responseJSON, responseText) {
            self.runningReq = false;

            response = responseJSON.response['employees'];
            var cnt = response.length;

            var selectList = document.createElement("select");
            selectList.id = "employee_id";
            selectList.name = "employee_id";

            select_tag = document.getElementById("employee_id_select")
            select_tag.innerHTML = ''
            select_tag.appendChild(selectList);

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
    });

    if ('SYS ADMINS' == this.sess_level)
    {
        var orgLookup = new Request.JSON(
        {
            url: 'api/organization.php',
            data: {
                'action' : 'view'
            },
            method: 'POST',
            onError: function(text, error) { self.requestError(); },
            onFailure: function(xhr) { self.requestError(); },
            onSuccess: function(responseJSON, responseText) {
                self.runningReq = false;

                response = responseJSON.response['organization'];
                var cnt = response.length;

                var selectList = document.createElement("select");
                selectList.id = "org_id";
                selectList.name = "org_id";

                select_tag = document.getElementById("org_id_select");
                select_tag.appendChild(selectList);
                select_tag.onchange = function(e){
                    console.log(e.target.options[e.target.selectedIndex].value);
                    emplook_data['org_id'] = e.target.options[e.target.selectedIndex].value;
                    empLookup.post(emplook_data);
                }


                var please_select = document.createElement("option");
                please_select.selected = 'true';
                please_select.value = '';
                please_select.text = "Please Select";
                selectList.appendChild(please_select);

                for (var i = 0; i < cnt; i++) {
                    var val = response[i];
                    var option = document.createElement("option");
                    option.value = val['org_id'];
                    option.text = val['org_name'];
                    selectList.appendChild(option);
                }
            }
        }).send();
    }
    else
        empLookup.post(emplook_data)
    // emplook_data = {'action' : 'view'}

    // var empLookup = new Request.JSON(
    // {
    //     url: 'api/employee.php',
    //     // ,
    //     // method: 'POST',
    //     onError: function(text, error) { self.requestError(); },
    //     onFailure: function(xhr) { self.requestError(); },
    //     onSuccess: function(responseJSON, responseText) {
    //         self.runningReq = false;

    //         response = responseJSON.response['employees'];
    //         var cnt = response.length;

    //         var selectList = document.createElement("select");
    //         selectList.id = "employee_id";
    //         selectList.name = "employee_id";
    //         document.getElementById("employee_id_select").appendChild(selectList);

    //         var please_select = document.createElement("option");
    //         please_select.selected = 'true';
    //         please_select.value = '';
    //         please_select.text = "Please Select";
    //         selectList.appendChild(please_select);

    //         for (var i = 0; i < cnt; i++) {
    //             var val = response[i];
    //             var option = document.createElement("option");
    //             option.value = val['employee_id'];
    //             option.text = val['lastname'] + ', ' + val['firstname'] + ' ' + val['middlename'];
    //             selectList.appendChild(option);
    //         }
    //     }
    // }).post(emplook_data);

    var levels = ['EMPLOYEES', 'SUPERVISORS', 'HR MANAGERS', 'SYS ADMINS'];
    this.createHardcodeSelect(levels, 'level', 'level_select');
};

Users.prototype.getEditModalFieldValues = function() {
    var fields = {};
    // fields['user_id'] = $$('#edit_user_id').get('value')[0];
    // fields['employee_id'] = $$('#edit_employee_id').get('value')[0];
    fields['username'] = $$('#edit_username').getSelected()[0].get("value")[0];
    fields['password'] = $$('#edit_password').get('value')[0];
    fields['email'] = $$('#edit_email').get('value')[0];
    fields['level'] = $$('#edit_level').getSelected()[0].get("value")[0];

    return [fields, ['username', 'level']];
}

Users.prototype.editModalLookup = function() {
    var levels = ['EMPLOYEES', 'SUPERVISORS', 'HR MANAGERS', 'SYS ADMINS'];
    this.createHardcodeSelect(levels, 'edit_level', 'edit_level_select');
};

window.addEvent('domready', function()
{
    var obj = new Users();
    obj.init()
});
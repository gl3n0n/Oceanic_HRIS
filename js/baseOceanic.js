var BaseOceanic = function(module, plural, abbrev, deleteWithReason) {
    this.module = module;
    this.modulePlural = plural;
    this.moduleAbbrev = abbrev;
    this.apiUrl = "api/" + this.module + ".php";
    this.runningReq = false;
    this.retrievedData = [];
    this.sess_level = $$('#sess_level').get('value')[0];
    this.deleteWithReason = deleteWithReason;
};

BaseOceanic.prototype.init = function() {
    this.getData();
    // we nee to run this to prevent duplication of DOM element
    this.createModalLookup();
    // we need to run this here to prevent assigning value on a non existing DOM
    this.editModalLookup();
};

BaseOceanic.prototype.render = function(element) {
    var content = $$('tbody.' + this.module + '_list')[0];
    element.inject(content);
};

BaseOceanic.prototype.requestError = function() {
    this.runningReq = false;
    alert('An error occured while trying to contact our server. Please try again later.');
};

BaseOceanic.prototype.resetRecords = function(searchPattern) {
    searchPattern = typeof searchPattern !== 'undefined' ? searchPattern : 'tr[id^=list_]';

    $$('#'+ this.module +'_list > tr').setStyle('display', 'table-row');
};

BaseOceanic.prototype.build = function() {

};

BaseOceanic.prototype.createModalLookup = function() {

};

BaseOceanic.prototype.editModalLookup = function() {

};

BaseOceanic.prototype.getAddModalFieldValues = function() {
    return [[], []];
};

BaseOceanic.prototype.getEditModalFieldValues = function() {
    return [[], []];
};

BaseOceanic.prototype.createHardcodeSelect = function(values, id_name, parent) {
    var cnt = values.length;

    var selectList = document.createElement("select");
    selectList.id = id_name;
    selectList.name = id_name;
    document.getElementById(parent).appendChild(selectList);

    var please_select = document.createElement("option");
    please_select.selected = 'true';
    please_select.value = '';
    please_select.text = "Please Select";
    selectList.appendChild(please_select);

    for (var i = 0; i < cnt; i++) {
        var val = values[i];
        var option = document.createElement("option");
        option.value = val;
        option.text = val;
        selectList.appendChild(option);
    }
};

BaseOceanic.prototype.getData = function(requestData) {
    requestData = typeof requestData !== 'undefined' ? requestData : {};

    if (!this.runningReq) {
        this.runningReq = true;
        requestData['action'] = 'view';

        var self = this;
        var jsonRequest = new Request.JSON({
            url: this.apiUrl,
            data: requestData,
            method: 'POST',
            onError: function(text, error) { console.log('GETDATA ERR');console.log(text);self.requestError(); },
            onFailure: function(xhr) { self.requestError(); },
            onSuccess: function(responseJSON, responseText) {
                self.runningReq = false;
                console.log(responseJSON);
                self.data = responseJSON.response[self.modulePlural];

                self.build();
                self.addEvents();
            }
        }).send();
    }
};

BaseOceanic.prototype.addEvents = function() {
    var self = this;

    $$('#add_' + this.module).removeEvents();
    $$('#add_' + this.module).addEvent('click', function(e) {
        self.createModalContainer();
    });

    $$('#searchfield').removeEvents();
    $$('#searchfield').addEvent('keypress', function(e)
    {
        if (e.key == 'enter') {
            self.resetRecords();

            // var searchKw = $$('#searchfield').get('value')[0];
            self.search($$('#searchfield').get('value')[0]);
        }
    });

    $$('#search').removeEvents();
    $$('#search').addEvent('click', function(e) {
        self.resetRecords();

        self.search($$('#searchfield').get('value')[0]);
    });

    this.addEditEvents();
    this.addDeleteEvents();
};

BaseOceanic.prototype.search = function(searchKw) {
    if (searchKw.trim()) {
        var thead_cnt = $$('table > thead > tr > td').length;

        var trs = $$('#'+ this.module +'_list > tr');
        var cnt = trs.length;
        for (var i=0; i<cnt; i++) {
            var tds = trs[i].getElements('td:nth-child(-n+' + (thead_cnt - 1) + ')')
            if (!this.shouldPresent(tds, searchKw))
                trs[i].setStyle('display', 'none');
        }
    }
}

BaseOceanic.prototype.shouldPresent = function(tds, searchKw) {
    var re = new RegExp(searchKw,"i");
    var cnt = tds.length;

    for (var i=0; i<cnt; i++) {
        if (tds[i].get('text').trim().match(re))
            return true;
    }
    return false;
}

BaseOceanic.prototype.addEditEvents = function() {
    var self = this;
    $$('td > a[id^=edit_]').removeEvents();
    $$('td > a[id^=edit_]').addEvent('click', function(e) {
        var id = this.id.split('_')[1];

        var requestData = {'action': 'view-id'};
        requestData[self.moduleAbbrev + '_id'] = id;

        var jsonRequest = new Request.JSON({
            url: self.apiUrl,
            data: requestData,
            method: 'POST',
            onError: function(text, error) { console.log(text); self.requestError(); },
            onFailure: function(xhr) { self.requestError(); },
            onSuccess: function(responseJSON, responseText) {
                self.runningReq = false;
                console.log(responseJSON);
                self.data = responseJSON.response[self.modulePlural];

                self.editModalContainer(id, self.data);
            }
        }).send();
    });
};

BaseOceanic.prototype.addDeleteEvents = function() {
    var self = this;
    $$('td > a[id^=del_]').removeEvents();
    $$('td > a[id^=del_]').addEvent('click',function(e) {
        var msg = this.title ? 'Are you sure you would like to ' + this.title + '?' : 'Are you sure?';

        if (confirm(msg)) {
            var id = this.id.split('_')[1];
            var requestData = {'action': 'delete'};
            requestData[self.moduleAbbrev + '_id'] = id;

            var jsonRequest = new Request.JSON(
            {
                url: self.apiUrl,
                data: requestData,
                method: 'POST',
                onError: function(text, error) { self.requestError(); },
                onFailure: function(xhr) { self.requestError(); },
                onSuccess: function(responseJSON, responseText) {
                    self.runningReq = false;
                    if (responseJSON.code != 'OK')
                    {
                        $$('#notifier').set('html', responseJSON.response);
                        $$('#notifier').setStyle('display', 'block');
                    }
                    else
                    {
                        $('list_'+ id).destroy();
                    }
                }
            }).send();
        }
    });
};

BaseOceanic.prototype.createModalContainer = function(param) {
    modalHTML = $('add-' + this.module);
    modalHTML.setStyle('display', 'block');
    formDept = $('view-' + this.module);
    formDept.setStyle('display', 'none');

    $$('#' + this.module + '-cancel').addEvent('click', function(e)
    {
        $$('#notifier').set('html', '');
        formDept.setStyle('display', 'block');
        modalHTML.setStyle('display', 'none');
    });

    var self = this;
    $$('#' + this.module + '-save').addEvent('click', function(e)
    {
        var error_listings = [];
        var noerror = true;

        var fieldValues = self.getAddModalFieldValues();

        var toCheck = fieldValues[1];
        fieldValues = fieldValues[0];

        for (var key in fieldValues) {
            if (-1 != toCheck.indexOf(key) && (fieldValues[key] == '' || fieldValues[key] == undefined)) {
                noerror = false;
                error_listings.push(key);
            }
        }

        if (error_listings.length > 0)
        {
            var html = 'Please check the following fields<br/>';
            error_listings.forEach(function(currentValue, index, array) {
                html += currentValue + '<br/>';
            });

            $$('#add-notifier').set('html', html);
            $$('#add-notifier').setStyle('display', 'block');
        }
        else
        {
            fieldValues['action'] = 'add';
            console.log(fieldValues);
            var jsonRequest = new Request.JSON(
            {
                url: self.apiUrl,
                data: fieldValues,
                method: 'POST',
                onError: function(text, error) { console.log(text); self.requestError(); },
                onFailure: function(xhr) { self.requestError(); },
                onSuccess: function(responseJSON, responseText) {
                    self.runningReq = false;

                    if (responseJSON.code != 'OK') {
                        $$('#add-notifier').set('html', responseJSON.response);
                        $$('#add-notifier').setStyle('display', 'block');
                    }
                    else {
                        // console.log(responseJSON);
                        window.location = document.URL.replace("#", "");
                    }
                }
            }).send();
        }
    });
};

BaseOceanic.prototype.editModalContainer = function(id, param) {
    var modalHTML = $('edit-' + this.module);
    modalHTML.setStyle('display', 'block');

    var viewHTML = $('view-' + this.module);
    viewHTML.setStyle('display', 'none');

    var pArr = param[0];
    for (var key in pArr) {
        var elem = $$('#edit_' + key)[0];
        if (elem)
            elem.set("value", pArr[key]);
    }


    $$('#edit_' + this.module + '-cancel').addEvent('click', function(e) {
       viewHTML.setStyle('display', 'block');
       modalHTML.setStyle('display', 'none');
    });

    var self = this;
    $$('#edit_' + this.module + '-save').addEvent('click', function(e)
    {
        var error_listings = [];
        var noerror = true;

        var fieldValues = self.getEditModalFieldValues();
        var toCheck = fieldValues[1];
        fieldValues = fieldValues[0];

        for (var key in fieldValues) {
            if (-1 != toCheck.indexOf(key) && fieldValues[key] == '') {
                noerror = false;
                error_listings.push(key);
            }
        }

        if (error_listings.length > 0)
        {
            html = 'Please check the following fields<br/>';
            error_listings.forEach(function(currentValue, index, array) {
                html += currentValue + '<br/>';
            });

            $$('#edit-notifier').set('html', html);
            $$('#edit-notifier').setStyle('display', 'block');
        }
        else
        {
            fieldValues['action'] = 'edit';
            fieldValues[self.moduleAbbrev + '_id'] = id;

            var jsonRequest = new Request.JSON({
                url: self.apiUrl,
                data: fieldValues,
                method: 'POST',
                onError: function(text, error) { console.log(text); self.requestError(); },
                onFailure: function(xhr) { self.requestError(); },
                onSuccess: function(responseJSON, responseText) {
                    self.runningReq = false;
                    console.log(responseJSON);
                    if (responseJSON.code != 'OK') {
                        $$('#edit-notifier').set('html', responseJSON.response);
                        $$('#edit-notifier').setStyle('display', 'block');
                    }
                    else {
                        window.location = document.URL.replace("#", "");
                    }
                }
            }).send();
        }
    });
};



var BaseEmployeeDetail = function(module, plural, abbrev) {
    BaseOceanic.call(this, module, plural, abbrev);
}

BaseEmployeeDetail.prototype = Object.create(BaseOceanic.prototype);
BaseEmployeeDetail.prototype.constructor = BaseEmployeeDetail;

BaseEmployeeDetail.prototype.init = function() {
    var emp_id = $$('#employee_id').get('value')[0];
    this.getData({'employee_id': emp_id});
    // we nee to run this to prevent duplication of DOM element
    this.createModalLookup();
    // we need to run this here to prevent assigning value on a non existing DOM
    this.editModalLookup();
};

var BaseOceanicForm = function(module, plural, abbrev, deleteWithReason) {
    BaseOceanic.call(this, module, plural, abbrev, deleteWithReason);
}

BaseOceanicForm.prototype = Object.create(BaseOceanic.prototype);
BaseOceanicForm.prototype.constructor = BaseOceanicForm;

// BaseOceanicForm.prototype.init = function() {
//     this.getData();
//     // we nee to run this to prevent duplication of DOM element
//     this.createModalLookup();
//     // we need to run this here to prevent assigning value on a non existing DOM
//     this.editModalLookup();
// };

BaseOceanicForm.prototype.addEditEvents = function() {
    // APPROVE
    var self = this;
    $$('td > a[id^=edit_]').removeEvents();
    $$('td > a[id^=edit_]').addEvent('click', function(e) {
        var id = this.id.split('_')[1];

        var requestData = {'action': 'approve'};
        requestData[self.moduleAbbrev + '_id'] = id;

        var jsonRequest = new Request.JSON({
            url: self.apiUrl,
            data: requestData,
            method: 'POST',
            onError: function(text, error) { self.requestError(); },
            onFailure: function(xhr) { self.requestError(); },
            onSuccess: function(responseJSON, responseText) {
                self.runningReq = false;
                window.location = document.URL.replace("#", "");
            }
        }).send();
    });
};

BaseOceanicForm.prototype.addDeleteEvents = function() {
    // REJECT
    var self = this;
    $$('td > a[id^=del_]').removeEvents();
    $$('td > a[id^=del_]').addEvent('click',function(e) {
        var proceedWithDelete = false;
        if (self.deleteWithReason) {
            var msg = "Please state the reason for the rejection.";
            var reason = prompt(msg);
            if (!reason) {
                alert("Stating the reason for rejection is required");
            }
            else
                proceedWithDelete = true;
        }
        else {
            var msg = this.title ? 'Are you sure you would like to ' + this.title + '?' : 'Are you sure?';
            proceedWithDelete = confirm(msg);
        }

        if (proceedWithDelete) {
            var id = this.id.split('_')[1];
            var requestData = {'action': 'reject'};
            requestData[self.moduleAbbrev + '_id'] = id;

            if (self.deleteWithReason)
                requestData['reject_reason'] = reason;

            console.log(requestData)

            var jsonRequest = new Request.JSON(
            {
                url: self.apiUrl,
                data: requestData,
                method: 'POST',
                onError: function(text, error) { self.requestError(); },
                onFailure: function(xhr) { self.requestError(); },
                onSuccess: function(responseJSON, responseText) {
                    self.runningReq = false;
                    window.location = document.URL.replace("#", "");
                }
            }).send();
        }
    });
};
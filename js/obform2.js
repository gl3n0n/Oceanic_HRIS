function ObForm() {
    BaseOceanicForm.call(this, 'obform', 'ob_applications', 'ob', true);
}

ObForm.prototype = Object.create(BaseOceanicForm.prototype);
ObForm.prototype.constructor = ObForm;

ObForm.prototype.build = function() {
    var self = this;
    Object.each(this.data, function(val, idx)
    {
        var policyList = '';
        if ('EMPLOYEES' != self.sess_level)
        {
             policyList += '<td> ' + val['lastname'] + ', ' + val['firstname'] + ' '+ val['middlename'] + ' </td>';
        }
		var newStat = '';
		if (val['status'] == 'MAN-APPROVED')
			newStat = 'Approved';
		else if(val['status'] == 'SUP-APPROVED')
			newStat = 'Approved';
	    else if(val['status'] == 'REJECTED')
			newStat = 'Rejected';
		else if(val['status'] == 'PENDING')
			newStat = 'Pending';
		else
			newStat = val['status'];
        policyList += '<td> ' + val['start_date'] + ' </td>'
            + '<td>' + val['end_date'] + ' </td>'
            + '<td>' + val['purpose'] + ' </td>'
            + '<td>' + val['location'] + ' </td>'
            + '<td>' + newStat + ' </td>';

        if ('EMPLOYEES' != self.sess_level &&
            (('SUPERVISORS' == self.sess_level && val['status'] == 'PENDING') ||
             ('HR MANAGERS' == self.sess_level && (val['status'] == 'PENDING' || val['status'] == 'SUP-APPROVED'))
            ))
        {
            policyList += ''
                + '<td>'
                    + '<a href="#" id="edit_'+ val['ob_id'] +'">Approve</a>'
                    + ' | <a href="#" title="Reject OB application" class="confirm" id="del_'+val['ob_id']+'">Reject</a>'
                + '</td>';
        }

        var liElem = new Element('</tr>',
        {
            'html': policyList,
            'id': 'list_' + val['ob_id']
        });

        self.render(liElem);
    });
};

ObForm.prototype.getAddModalFieldValues = function() {
    var fields = {};
	var self = this;
    fields['start_date'] = $$('#start_date').get('value')[0];
    fields['end_date'] = $$('#end_date').get('value')[0];
    fields['purpose'] = $$('#purpose').get('value')[0];
    fields['location'] = $$('#location').get('value')[0];
	if ('SUPERVISORS' == self.sess_level)
	{
		fields['status'] = 'SUP-APPROVED';
	}
	
	if ('HR MANAGERS' == self.sess_level)
	{
		fields['status'] = 'MAN-APPROVED';
	}
    // fields['status'] = $$('#status').getSelected()[0].get("value")[0];
    console.log(fields)

    return [fields, Object.keys(fields)];
};

// NO NEED SINCE THIS IS LEVEL BASED STATUS
// ObForm.prototype.createModalLookup = function() {
//     this.runningReq = true;

//     var self = this;

//     var selectList = document.createElement("select");
//     selectList.id = "status";
//     selectList.name = "status";
//     document.getElementById("status_select").appendChild(selectList);

//     var please_select = document.createElement("option");
//     please_select.selected = 'true';
//     please_select.value = '';
//     please_select.text = "Please Select";
//     selectList.appendChild(please_select);

//     var status_enum = ['PENDING', 'SUP-APPROVED', 'MAN-APPROVED', 'REJECTED'];
//     var cnt = status_enum.length;

//     for (var i = 0; i < cnt; i++) {
//         var val = status_enum[i];
//         var option = document.createElement("option");
//         option.value = val;
//         option.text = val;
//         selectList.appendChild(option);
//     }
// }

// ObForm.prototype.addEditEvents = function() {
//     // APPROVE
//     var self = this;
//     $$('td > a[id^=edit_]').removeEvents();
//     $$('td > a[id^=edit_]').addEvent('click', function(e) {
//         var id = this.id.split('_')[1];

//         var requestData = {'action': 'approve'};
//         requestData[self.moduleAbbrev + '_id'] = id;

//         var jsonRequest = new Request.JSON({
//             url: self.apiUrl,
//             data: requestData,
//             method: 'POST',
//             onError: function(text, error) { self.requestError(); },
//             onFailure: function(xhr) { self.requestError(); },
//             onSuccess: function(responseJSON, responseText) {
//                 self.runningReq = false;
//                 window.location = document.URL.replace("#", "");
//             }
//         }).send();
//     });
// };

// ObForm.prototype.addDeleteEvents = function() {
//     // REJECT
//     var self = this;
//     $$('td > a[id^=del_]').removeEvents();
//     $$('td > a[id^=del_]').addEvent('click',function(e) {
//         var msg = this.title ? 'Are you sure you would like to ' + this.title + '?' : 'Are you sure?';

//         if (confirm(msg)) {
//             var id = this.id.split('_')[1];
//             var requestData = {'action': 'reject'};
//             requestData[self.moduleAbbrev + '_id'] = id;

//             var jsonRequest = new Request.JSON(
//             {
//                 url: self.apiUrl,
//                 data: requestData,
//                 method: 'POST',
//                 onError: function(text, error) { self.requestError(); },
//                 onFailure: function(xhr) { self.requestError(); },
//                 onSuccess: function(responseJSON, responseText) {
//                     self.runningReq = false;
//                     window.location = document.URL.replace("#", "");
//                 }
//             }).send();
//         }
//     });
// };


window.addEvent('domready', function()
{
    var obj = new ObForm();
    obj.init();
});
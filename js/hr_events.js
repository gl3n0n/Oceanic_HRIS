function HrEvents() {
    BaseOceanic.call(this, 'hr_events', 'hr_events', 'hr_events');
}

HrEvents.prototype = Object.create(BaseOceanic.prototype);
HrEvents.prototype.constructor = HrEvents;

HrEvents.prototype.init = function() {
    var self = this;
    $$('#add_' + this.module).removeEvents();
    $$('#add_' + this.module).addEvent('click', function(e) {
        self.createModalContainer();
    });
}

HrEvents.prototype.build = function() {

};

HrEvents.prototype.getAddModalFieldValues = function() {
    var fields = {};
    fields['title'] = $$('#title').get('value')[0];
    fields['location'] = $$('#location').get('value')[0];
    fields['start'] = $$('#start').get('value')[0];
    fields['end'] = $$('#end').get('value')[0];

    return [fields, Object.keys(fields)];
};

// HrEvents.prototype.getEditModalFieldValues = function() {
//     var fields = {};
//     fields['description'] = $$('#edit_description').get('value')[0];
//     return [fields, ['description']];
// }

window.addEvent('domready', function()
{
    var obj = new HrEvents();
    obj.init()
});
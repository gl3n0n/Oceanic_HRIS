var mecPHPPlugin = new Class({

    Implements: [Options, Events],
    options: {
        cEvents:[]
    },
    initialize: function(options){
        this.setOptions(options);
    },
    getEvents: function(that, eventRangeStart, eventRangeEnd){
        var thisObj = this;
        new Request.JSON({
            method: 'POST',
            data: {'action': 'view'},
            url: 'api/hr_events.php',
            onSuccess: function(responseJSON, responseText) {
                console.log(responseJSON['response']['hr_events']);
                that.options.cEvents = responseJSON['response']['hr_events'];
                that.gotEvents = true;
                $('loading').fade('out');

                that.loadCalEvents();
            }
        }).send();

        //'startDate=' + eventRangeStart.ymd() + '&endDate=' + eventRangeEnd.ymd()

        // Manual event entry without an AJAX request (used for troubleshooting)
        /*that.options.cEvents = [
            {
                title:'Dad\'s Birthday',
                start:'2009-01-12',
                end:'2009-01-13',
                location:''
            },
            {
                title:'MooTools Events Calendar v0.2.0',
                start:'2009-02-02',
                end:'2009-03-02',
                location:'DansNetwork.com'
            },
            {
                title:'Hair Cut',
                start:'2009-02-05T13:00:00-06:00',
                end:'2009-02-06T13:30:00-06:00',
                location:''
            },
            {
                title:'<a href="http://dansnetwork.com/mootools/events-calendar/">MooTools Events Calendar v0.2.1</a>',
                start:'2009-02-09',
                end:'2009-02-09',
                location:'DansNetwork.com'
            },
            {
                title:'Hair Cut',
                start:'2009-02-17T09:00:00-06:00',
                end:'2009-02-17T09:30:00-06:00',
                location:''
            },
            {
                title:'Oil Change',
                start:'2009-02-17T11:00:00-06:00',
                end:'2009-02-17T11:30:00-06:00',
                location:'Jiffy Lube'
            },
            {
                title:'Gym',
                start:'2009-02-17T13:00:00-06:00',
                end:'2009-02-17T13:30:00-06:00',
                location:''
            },
            {
                title:'Dinner',
                start:'2009-02-17T17:00:00-06:00',
                end:'2009-02-17T18:30:00-06:00',
                location:'Bob Chinns'
            },
            {
                title:'Movie',
                start:'2009-02-17T19:00:00-06:00',
                end:'2009-02-17T21:30:00-06:00',
                location:'Marcus'
            },
            {
                title:'Bedtime',
                start:'2009-02-17T23:00:00-06:00',
                end:'2009-02-17T23:00:00-06:00',
                location:'Home'
            }
        ];
        that.gotEvents = true;
        $('loading').fade('out');
        that.loadCalEvents();*/
    }
});
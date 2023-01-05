document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        eventRender: function (eventObj, $el) {
            $el.popover({
                title: eventObj.title,
                content: eventObj.description,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },    
        eventLimit: true,

        events: [{
                title: 'Front-End Conference',
                start: '2020-11-16',
                end: '2020-11-18'
            },
            {
                title: 'Agenda',
                start: '2020-12-5',
                end : '2020-12-5',
            },
            {
                title: 'Front-End Conference',
                start: '2020-12-05',
                end: '2020-11-18'
            },
            {
                title: 'Hair stylist with Mike',
                start: '2020-11-18',
            },
            {
                title: 'Car mechanic',
                start: '2020-11-14T09:00:00',
                end: '2020-11-14T11:00:00'
            },
            {
                title: 'Dinner with Mike',
                start: '2020-11-21T19:00:00',
                end: '2020-11-21T22:00:00'
            },
            {
                title: 'Chillout',
                start: '2020-11-15',
            },
            {
                title: 'Vacation',
                start: '2020-11-23',
                end: '2020-11-26'
            },
        ]
    });
    calendar.render();
});
document.addEventListener('DOMContentLoaded', function() {

    // $.post('http://localhost:8080/HTML/dashboard/app-assets/data/fullcalendar/json/events.json', function(data) {
    //     var data;
    //     console.log(data);
    // });
    // $.post('http://localhost:8080/HTML/dashboard/ajax/data.php', function(data1) {
    //     var data1;
    //     console.log(data1);
    // });
    // color object for different event types
    var colors = {
        primary: "#7367f0",
        success: "#28c76f",
        danger: "#ea5455",
        warning: "#ff9f43"
    };

    // chip text object for different event types
    var categoryText = {
        primary: "consoultation",
        success: "Business",
        danger: "Personal",
        warning: "Work"
    };
    var categoryBullets = $(".cal-category-bullets").html(),
        evtColor = "",
        eventColor = "";

    // calendar init
    var calendarEl = document.getElementById('fc-default');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ["dayGrid", "timeGrid", "interaction"],
        customButtons: {
            addNew: {
                text: ' ajouter',
                click: function() {
                    var calDate = new Date,
                        todaysDate = calDate.toISOString().slice(0, 10);
                    $(".modal-calendar").modal("show");
                    $(".modal-calendar .cal-submit-event").addClass("d-none");
                    $(".modal-calendar .remove-event").addClass("d-none");
                    $(".modal-calendar .cal-add-event").removeClass("d-none")
                    $(".modal-calendar .cancel-event").removeClass("d-none")
                    $(".modal-calendar .add-category .chip").remove();
                    $("#cal-start-date").val(todaysDate);
                    $("#cal-end-date").val(todaysDate);
                    $(".modal-calendar #cal-start-date").attr("disabled", false);
                }
            }
        },
        locale: 'fr',
        timeZone: 'UTC',
        weekNumbers: true,
        week: {
            dow: 1, // Monday is the first day of the week.
            doy: 4, // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {

            today: "Aujourd'hui",
            year: 'Année',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour',
            list: 'Planning',

        },
        weekText: 'Sem.',
        allDayText: 'Toute la journée',
        moreLinkText: 'en plus',
        noEventsText: 'Aucun événement à afficher',

        header: {
            left: "addNew",
            center: "dayGridMonth,timeGridWeek,timeGridMonth,timeGridDay,listMonth",
            right: "prev,title,next"
        },
        displayEventTime: false,
        navLinks: true,
        editable: true,
        allDay: true,
        selectable: true,


        select: function(info) {

            var vstar = moment(info.startStr).subtract(1, 'hours').format("YYYY-MM-DD HH:mm");
            var vend = moment(info.endStr).subtract(1, 'hours').format("YYYY-MM-DD HH:mm");

            $(".modal-calendar").modal("show");
            $(".modal-calendar #cal-event-title").val('ce jouer de travaille');
            $(".modal-calendar #cal-start-date").val(vstar);
            $(".modal-calendar #cal-end-date").val(vend);
        },

        eventSources: [{ // this object will be "parsed" into an Event Object

            // url: 'http://localhost:8080/HTML/dashboard/ajax/data.php',
            url: 'http://localhost:8080/HTML/dashboard/ajax/data.php',
            method: 'GET',

        }],
        // displays saved event values on click
        eventClick: function(info) {
            console.log('click');
        },

    });

    // render calendar
    calendar.render();

    // appends bullets to left class of header

    //Close modal on submit button
    $(".modal-calendar .cal-submit-event").on("click", function() {
        $(".modal-calendar").modal("hide");
    });

    // Remove Event
    $(".remove-event").on("click", function() {
        var removeEvent = calendar.getEventById('newEvent');
        removeEvent.remove();
    });


    // reset input element's value for new event
    if ($("td:not(.fc-event-container)").length > 0) {
        $(".modal-calendar").on('hidden.bs.modal', function(e) {
            $('.modal-calendar .form-control').val('');
        })
    }

    // remove disabled attr from button after entering info
    $(".modal-calendar .form-control").on("keyup", function() {
        if ($(".modal-calendar #cal-event-title").val().length <= 0) {
            $(".modal-calendar .modal-footer .btn").attr("disabled", true);
        } else {
            $(".modal-calendar .modal-footer .btn").removeAttr("disabled");

        }
    });

    // open add event modal on click of day
    $(document).on("click", ".fc-day", function() {
        $(".modal-calendar").modal("show");
        $(".calendar-dropdown .dropdown-menu").find(".selected").removeClass("selected");
        $(".modal-calendar .cal-submit-event").addClass("d-none");
        $(".modal-calendar .remove-event").addClass("d-none");
        $(".modal-calendar .cal-add-event").removeClass("d-none");
        $(".modal-calendar .cancel-event").removeClass("d-none");
        $(".modal-calendar .add-category .chip").remove();
        $(".modal-calendar .modal-footer .btn").attr("disabled", true);
        evtColor = colors.primary;
        eventColor = "primary";
    });

    // change chip's and event's color according to event type
    $(".calendar-dropdown .dropdown-menu .dropdown-item").on("click", function() {
        var selectedColor = $(this).data("color");
        evtColor = colors[selectedColor];
        eventTag = categoryText[selectedColor];
        eventColor = selectedColor;

        // changes event color after selecting category
        $(".cal-add-event").on("click", function() {
            calendar.addEvent({
                color: evtColor,
                dataEventColor: eventColor,
                className: eventColor
            });
        })

        $(".calendar-dropdown .dropdown-menu").find(".selected").removeClass("selected");
        $(this).addClass("selected");

        // add chip according to category
        $(".modal-calendar .chip-wrapper .chip").remove();
        $(".modal-calendar .chip-wrapper").append($("<div class='chip chip-" + selectedColor + "'>" +
            "<div class='chip-body'>" +
            "<span class='chip-text'> " + eventTag + " </span>" +
            "</div>" +
            "</div>"));
    });

    // calendar add event
    $(".cal-add-event").on("click", function() {
        $(".modal-calendar").modal("hide");
        var eventTitle = $("#cal-event-title").val(),
            startDate = $("#cal-start-date").val(),
            endDate = $("#cal-end-date").val(),
            eventDescription = $("#cal-description").val(),
            correctEndDate = new Date(endDate);
        calendar.addEvent({
            id: "newEvent",
            title: eventTitle,
            start: startDate,
            end: correctEndDate,
            description: eventDescription,
            color: evtColor,
            dataEventColor: eventColor,
            allDay: true
        });
    });

    //date picker
    $(".pickadate").pickadate({
        format: 'yyyy-mm-dd '
    });
});
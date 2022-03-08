<!DOCTYPE html>
<html>

<head>
    <title>How to Use Fullcalendar in Laravel 8</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt.min.js" integrity="sha512-4xyW5eQdikpmmms6saOpjcY1VSRigZZNso0a3BlDElGqjGYVyQqSZbxBvNGAWRoIKL7BEWIhyroNtUQNvPnNFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>










</head>

<body>
    <div class="container">
   
        <br>
        <br>
        <div id="calendar"></div>

    </div>

    <!-- modal -->


  



    <script>
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                locale: 'pt',

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: 'professores_actividades/{{$id}}',
                selectable: true,
                selectHelper: true,
                select: function(start,end,allday) {
                  //console.log(element);
                    resetForm('#form');
                    
                   var start = moment(start).format('DD-MM-YYYY HH:mm:ss');
                   var end = moment(end).format('DD-MM-YYYY HH:mm:ss');

                  
                    $("#start").val(start);
                    $("#end").val(end);

                 //   $("#modal").modal();

                },
                editable: true,
                eventResize: function(event, delta) {

                    var title = event.title;
                 
                    var id = event.id;
                    $.ajax({
                        url: "/horarios/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                         
                            id: id,
                            type: 'update'
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                  
                    var id = event.id;
                    $.ajax({
                        url: "/horarios/action",
                        type: "POST",
                        data: {
                        
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },

                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "/horarios/action",
                            type: "POST",
                            data: {
                                id: id,
                                type: "delete"
                            },
                            success: function(response) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Deleted Successfully");
                            }
                        })
                    }
                },

            });

            $('#save').click(function() {
                save();
              //  calendar.refetchEvents();

            });


        });

        function resetForm(form) {
            $(form)[0].reset();
        }

    
    </script>

</body>

</html>
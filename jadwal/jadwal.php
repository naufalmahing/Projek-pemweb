<?php 

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal bang</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <script>

    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },

            events:'load.php',
            selectable:true,
            selectHelper:true,
            select: function(start, end, allDay) {
                var title = prompt('Enter event title');
                // var email = prompt('Enter email');
                if(title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url:'insert.php',
                        type:'POST',
                        data:{title:title, start:start, end:end}, // hapus data email
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert('Berhasil ditambahkan');
                        }
                    })
                }
            },

            editable:true,
            eventResize:function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;

                $.ajax({
                    url:'update.php',
                    type:'POST',
                    data:{title:title, start:start, end:end, id:id},
                    success:function() {
                        calendar.fullCalendar('refetchEvents');
                        alert('Event update');
                    }
                })
            },

            eventDrop:function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:'update.php',
                    type:'POST',
                    data:{title:event.title, start:start, end:end, id:id},
                    success:function() {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated");
                    }
                })
            },

            eventClick:function(event) {
                if(confirm("Are you sure you want to remove it?")) {
                    var id = event.id;
                    $.ajax({
                        url:'delete.php',
                        type:'POST',
                        data:{id:id},
                        success:function() {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Removed");
                        }
                    })
                }
            }
        });
    })

    </script>
</head>

<body>
    <br>
    <h2 align="center">
        <!-- <a href="#">Kalendar</a> -->
        Kalendar
    </h2>

    <div class="container">
        <hr>
        <a align="right" href="../reader/index.php">Kembali</a>
        <br><br>
        <div id="calendar"></div>
    </div>

</body>
</html>
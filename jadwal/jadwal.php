<?php 

session_start();
if (isset($_SESSION['email'])) { 
    $email = $_SESSION['email'];
} else {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Login terlebih dahulu untuk dapat setel reminder'); window.location.href='../reader/index.php';</script>");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal bang</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
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
                var email= 'anakmalang@gmail.com';
                var title = prompt('Enter event title');
                if(title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url:'insert.php',
                        type:'POST',
                        data:{title:title, start:start, end:end, email:email},
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

    <style>
@import url('https://rsms.me/inter/inter-ui.css');
        @font-face {
            font-family: 'Uthmani';
            src: url('../assets/font/UthmanicHafs1Ver09.otf') format('truetype');
        }

        body {
            font-family: 'Inter UI', sans-serif;
        }

        h2 {
            margin: 0px;
        }

        h2 a {
            color:white;
            font-family: 'Inter UI', sans-serif;
            text-decoration: none;
        }

        h2 a:hover {
            color: white;
        }

        .header {
            background-color:#3bb78f;
        }

        .sticky {
            background-color:#3bb78f;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .arabic {
            font-family: 'Uthmani',serif;
            font-size: 20px;
            font-weight:normal;
            direction: rtl;
            padding: 5px;
            margin: 0;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .bot-header {
            background-image: linear-gradient(315deg, #7ee8fa 0%,#80ff72 74%);
            display: block;
            text-align: center;
        }

        .links {
            display: flex;
            justify-content: space-between; 
        }

        .links a {
            text-decoration: none;
            color: black;
            transition: 0.25s;
        }

        .links a:hover {
            color: white;
        }

        ul {
            list-style: none;
            display: flex;
            justify-content: space-between;
            padding-left: 0px;
        }
    </style>
</head>

<body>
    <div class="header sticky">
        <h2 class="text-center"><a href="../reader/">Quran Reader</a></h2>
    </div>

    <div class="container">
        <br>
        <h3 class="text-center">Reminder</h3>
        <br>
        <div id="calendar"></div>
    </div>
        <br>
</body>
</html>
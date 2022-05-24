<html>
    <head>
        <script>
            function showResult(str) {
                if (str.length == 0) {
                    document.getElementById("livesearch").innerHTML="";
                    document.getElementById("livesearch").style.border="0px";
                    return;
                } 
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                        document.getElementById("livesearch").innerHTML=this.responseText;
                        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                    }
                }
                xmlhttp.open("GET", "../search/livesearch.php?q="+str, true);
                xmlhttp.send();
            }
        </script>
        <style>
            input{
                display: block;
                height:40px;
                width:24rem;
                margin-left: auto;
                margin-right: auto;
                border:10px;
                border-radius:20px;
                padding-left: 12px;
            }

            #livesearch {
                position: absolute;
                background-color: white;
            }
        </style>
    </head>

    <body>
        <form>
            <input type="text" size="30" onkeyup="showResult(this.value)" placeholder="Al-Fatihah, 1">
            <div id="livesearch"></div>
        </form>
    </body>
</html>
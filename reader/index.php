<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <title>Quran Reader</title>
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
        }

        .arabic {
            font-family: 'Uthmani',serif;
            font-size: 20px;
            font-weight: 900;
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
    </style>

  </head>
  <body>
        <div class="header sticky">
            <h2 class="text-center"><a href="">Quran Reader</a></h2>
        </div>
        <div>
                <div class="bot-header">
                    <img src="../assets/tulisan_alquran.svg" alt="Italian Trulli" class="center">
                <?php
                    include '../search/search.php'; 

                ?>
                <br>
                    <div class="links row">
                <?php
                    session_start();
                    if (isset($_SESSION['email'])) {
                        echo "<div class='text-center'>Mari kita berbuat baik hari ini <b>$_SESSION[username]</b></div> <br>";
                ?>
                <br>
                <?php 
                    echo '<a class="col-sm-4" href="../login, register, forgot password/login.php" class="text-center">Log out</a>';
                    } else {
                    echo '<a class="col-sm-4" href="../login, register, forgot password/login.php" class="text-left">Login</a>';
                    }
                ?>
                    <a class="col-sm-4" href="../jadwal/jadwal.php" class="text-center">Setel Reminder</a>
                    <a class="col-sm-4" href="../download/download.php?path=al-qur'an.pdf" class="text-center">Download PDF</a>
                    </div>
                    <br>
                </div>
        </div>
        <div class="container">
        <br><br>
        <table class="table table-striped table-bordered text-center">
            <tr>
                <th>No</th>
                <th>Surah</th>
                <th>Arti</th>
                <th>Jumlah ayat</th>
                <th>Tempat turun</th>
                <th>Urutan Pewahyuan</th>
            </tr>
            <?php
            include "koneksi.php";
            $tampil = mysqli_query($koneksi, "SELECT * FROM daftarsurah");
            while($data = mysqli_fetch_array($tampil)):
            ?>
                <tr>
                    <td><?= $data['index']?></td>
                    <td>
                        <a href="detail.php?surah=<?=$data['index']?>&nama_surah=<?= $data['surah_indonesia']?>">
                        <?= $data['surah_indonesia']?>
                        </a><span class="arabic">(<?= $data['surah_arab']?>)</span></td>
                    <td><?= $data['arti']?></td>
                    <td><?= $data['jumlah_ayat']?></td>
                    <td><?= $data['tempat_turun']?></td>
                    <td><?= $data['urutan_pewahyuan']?></td>
                </tr> 
            <?php endwhile;?>
        </table>
      </div>
        


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
  </body>
</html>
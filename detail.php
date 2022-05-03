<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Quran Reader</title>
    <style>
        @font-face {
            font-family: 'Uthmani';
            src: url('assets/font/UthmanicHafs1Ver09.otf') format('truetype');
        }

        .arabic{
            font-family: 'Uthmani',serif;
            font-size: 20px;
            font-weight:normal;
            direction: rtl;
            padding: - 5px;
            margin: 0;
        }

        .latin{
            font-family:serif;
            font-size:14px;
            font-weight:normal;
            direction:ltr;
            padding:0;
            margin:0;
        }
    </style>
  </head>
  <body>
      <div class="container">
        <?php
            include "koneksi.php";

            //uji parameter surah tidak kosong
            if (isset($_GET['surah']) || isset($_GET["nama_surah"])){
                $surah = $_GET['surah'];
                $nama_surah = $_GET['nama_surah'];

                echo '<a href="index.php">Kembali</a>';
                echo '<h3 class="text-center">' . $nama_surah . '</h3>';
                echo '<hr>';
                echo '<h4 class="arabic text-center">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</h4>';
                echo '<br>';

                $tampil = mysqli_query($koneksi,"SELECT
                                                    a.text as arabic,
                                                    b.text as indonesia
                                                FROM
                                                    arabicquran a LEFT OUTER JOIN indonesianquran b
                                                ON  a.index=b.index
                                                WHERE a.surah = $surah
                                                ");
                $ayat = 1;
                while ($data = mysqli_fetch_array($tampil)) {
                    $str = $data['arabic'];
                    echo '<p class = "arabic">'. $str . format_arabic_number($ayat) .'</p>';
                    echo '<p class="latin">'.'['.$ayat.']'.$data['indonesia'].'</p>';
                    echo '<hr>';
                    $ayat++;
                }                              
                
        }

        function format_arabic_number($number){
            $arabic_number = array('٠', '١', '٢','٣', '٤','٥','٦','٧','٨','٩');
            $jum_karakter = strlen($number);
            $temp = "";

            for($i=0;$i<$jum_karakter;$i++){
                $char = substr($number, $i,1);
                $temp .= $arabic_number[$char];
            }

            return '<span class="arabic_number">'. $temp .'</span>';
        }

        ?>
        
        
      </div>
        


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>
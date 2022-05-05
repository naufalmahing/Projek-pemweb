<?php
$xmlDoc = new DOMDocument();
$xmlDoc->load("../assets/daftar_surah.xml");

$x=$xmlDoc->getElementsByTagName('surah');

$q=$_GET["q"];

if (strlen($q)>0) {
    $hint="";
    for($i=0; $i<($x->length); $i++) {
        $y=$x->item($i)->getElementsByTagName('index');
        $z=$x->item($i)->getElementsByTagName('surah_indonesia');
        if ($y->item(0)->nodeType==1 && $z->item(0)->nodeType==1) {
            if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q) || stristr($z->item(0)->childNodes->item(0)->nodeValue, $q)) {
                if ($hint=="") {
                    $hint="<a class='url' href='../reader/detail.php?surah=" . $y->item(0)->nodeValue . "&nama_surah=" . $z->item(0)->nodeValue . "' target='_blank'>" . $z->item(0)->nodeValue . "</a>";
                } else {
                    $hint=$hint . "<br /><a class='url' href='../reader/detail.php?surah=" . $y->item(0)->nodeValue . "&nama_surah=" . $z->item(0)->nodeValue . "' target='_blank'>" . $z->item(0)->nodeValue . "</a>";
                }
            }
        }
    }
}

if ($hint=="") {
    $response="no suggestion";
} else {
    $response=$hint;
}
  
//output the response
echo $response;
?>
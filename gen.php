<?php 
	$url = "https://juby210.com.pl/embed/f/";
    if(empty($_GET["st"])) {
        echo "Missing SmallTitle";
        die();
    }
    if(empty($_GET["t"])) {
        echo "Missing Title";
        die();
    }
    if(empty($_GET["d"])) {
        echo "Missing Description";
        die();
    }

    $random = RandomString(9);
    $file = fopen("f/".$random.".html", "w");
    if(empty($_GET['i'])) {
        fwrite($file, GetTxt($_GET['st'], $_GET['t'], $_GET['d']));
        fclose($file);
    } else {
        fwrite($file, GetITxt($_GET['st'], $_GET['t'], $_GET['d'], $_GET['i']));
        fclose($file);
    }
    echo $url.$random.".html";
    die();

    function RandomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
     
        $key = '';
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

    function GetTxt($st, $t, $d) {
        return '<html><head><meta charset="utf-8"><meta name="og:site_name" content="'.$st.'"><meta property="og:title" content="'.$t.'"><meta property="og:description" content="'.$d.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
    }
    function GetITxt($st, $t, $d, $i) {
        return '<html><head><meta charset="utf-8"><meta name="og:site_name" content="'.$st.'"><meta property="og:title" content="'.$t.'"><meta property="og:description" content="'.$d.'"><meta property="og:image" content="'.$i.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
    }
?>
<?php 
    $url = "https://juby210.com.pl/embed/f/";
    
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if(empty($_GET["t"])) {
        echo "Missing Title";
        die();
    }

    if(empty($_GET['method']) || $_GET['method'] == "file") {
        $random = RandomString(9);
        $file = fopen("f/".$random.".html", "w");
        fwrite($file, GetTxt($_GET['st'], $_GET['t'], $_GET['d'], $_GET['i']));
        fclose($file);
        echo $url.$random.".html";
        die();
    } else if ($_GET['method'] == "text") {
        echo str_replace('<body onload="home()"><script>function home() {window.location = "../index.html";}</script></body>', '<body><center><h3>This embed was created by <a href="https://github.com/juby210-PL/SiteEmbed">Juby210`s Embed Generator</a></h3></center></body>', GetTxt($_GET['st'], $_GET['t'], $_GET['d'], $_GET['i']));
        die();
    } else {
        echo "Method not found, methods: file, text";
        die();
    }

    function RandomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
     
        $key = '';
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

    function GetTxt($st, $t, $d, $i) {
        if(empty($st)) {
            if(empty($d) && empty($i)) {
                return '<html><head><meta charset="utf-8"><meta property="og:title" content="'.$t.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
            } else if (empty($i)) {
                return '<html><head><meta charset="utf-8"><meta property="og:title" content="'.$t.'"><meta property="og:description" content="'.$d.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
            } else {
                return '<html><head><meta charset="utf-8"><meta property="og:title" content="'.$t.'"><meta property="og:description" content="'.$d.'"><meta property="og:image" content="'.$i.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
            }
        }
        if(empty($d)) {
            if(empty($i)) {
                return '<html><head><meta charset="utf-8"><meta name="og:site_name" content="'.$st.'"><meta property="og:title" content="'.$t.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
            } else {
                return '<html><head><meta charset="utf-8"><meta name="og:site_name" content="'.$st.'"><meta property="og:title" content="'.$t.'"><meta property="og:image" content="'.$i.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
            }
        }
        if(empty($i)) {
            return '<html><head><meta charset="utf-8"><meta name="og:site_name" content="'.$st.'"><meta property="og:title" content="'.$t.'"><meta property="og:description" content="'.$d.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
        } else {
            return '<html><head><meta charset="utf-8"><meta name="og:site_name" content="'.$st.'"><meta property="og:title" content="'.$t.'"><meta property="og:description" content="'.$d.'"><meta property="og:image" content="'.$i.'"></head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
        }
    }
?>
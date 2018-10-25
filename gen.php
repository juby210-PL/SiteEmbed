<?php 
    // Config //
    $url = "https://juby210.com.pl/embed/f/";
    $ratelimit = 10; // in secs | RATELIMIT IS GLOBAL!
    $file_rl = true;
    $text_rl = false;
    $raw_rl = false;
    // End Config //
    
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if(empty($_GET["t"])) {
        echo "Missing Title";
        die();
    }

    if(empty($_GET['method']) || $_GET['method'] == "file") {
        if($file_rl) timeout($ratelimit);
        $random = RandomString(9);
        $file = fopen("f/".$random.".html", "w");
        fwrite($file, GetTxt($_GET['st'], $_GET['t'], $_GET['d'], $_GET['i'], $_GET['c']));
        fclose($file);
        echo $url.$random.".html";
        die();
    } else if ($_GET['method'] == "text") {
        if($text_rl) timeout($ratelimit);
        echo str_replace('<body onload="home()"><script>function home() {window.location = "../index.html";}</script></body>', '<body><center><h3>This embed was created by <a href="https://github.com/juby210-PL/SiteEmbed">Juby210`s Embed Generator</a></h3></center></body>', GetTxt($_GET['st'], $_GET['t'], $_GET['d'], $_GET['i'], $_GET['c']));
        die();
    } else if ($_GET['method'] == "raw") {
        if($raw_rl) timeout($ratelimit);
        echo nl2br(htmlspecialchars(GetRaw($_GET['st'], $_GET['t'], $_GET['d'], $_GET['i'], $_GET['c'])));
        die();
    } else {
        echo "Method not found, methods: file, text, raw";
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

    function GetTxt($st, $t, $d, $i, $c) {
        if(!empty($st)) {
            $st = '<meta name="og:site_name" content="'.$st.'">';
        }
        if(!empty($t)) {
            $t = '<meta property="og:title" content="'.$t.'"><meta name="twitter:title" content="'.$t.'">';
        }
        if(!empty($d)) {
            $d = '<meta property="og:description" content="'.$d.'"><meta name="twitter:description" content="'.$d.'">';
        }
        if(!empty($i)) {
            $i = '<meta property="og:image" content="'.$i.'"><meta name="twitter:image" content="'.$i.'">';
        }
        if(!empty($c)) {
            $c = '<meta name="theme-color" content="#'.$c.'">';
        }
        return '<html><head><meta charset="utf-8">'.$st.$t.$d.$i.$c.'</head><body onload="home()"><script>function home() {window.location = "../index.html";}</script></body></html>';
    }

    function GetRaw($st, $t, $d, $i, $c) {
        if(!empty($st)) {
            $st = '<meta name="og:site_name" content="'.$st.'">'."\n";
        }
        if(!empty($t)) {
            $t = '<meta property="og:title" content="'.$t.'"><meta name="twitter:title" content="'.$t.'">'."\n";
        }
        if(!empty($d)) {
            $d = '<meta property="og:description" content="'.$d.'"><meta name="twitter:description" content="'.$d.'">'."\n";
        }
        if(!empty($i)) {
            $i = '<meta property="og:image" content="'.$i.'"><meta name="twitter:image" content="'.$i.'">'."\n";
        }
        if(!empty($c)) {
            $c = '<meta name="theme-color" content="#'.$c.'">';
        }
        return $st.$t.$d.$i.$c;
    }

    function timeout($ratelimit) {
        $filetime = explode("\n", file_get_contents("time.txt"));
        if (time() < $filetime[0] + $ratelimit){
            echo "Error: Global timeout: Try again in ".($filetime[0] + $ratelimit - time())." sec";
            die();
        } else {
            $filetime2 = fopen("time.txt", "w");
            fwrite($filetime2, time());
            fclose($filetime2);
        }
    }
?>
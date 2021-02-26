<?php
    if (isset($_POST["pass"])) {
        if ($_POST["pass"] == "salasana") {
            setcookie("_LOGINMAIN",true, time() +2592000);
            header("Refresh:0");
        }   
    }
    if (isset($_COOKIE["_LOGINMAIN"]) && $_COOKIE["_LOGINMAIN"] == true) {
        include "./partials/alku.php";
        include "./partials/navi.php";

        $sallitut = array("sqlharj1","demo1","demo2","demo3","demo4","demo4_lomakkeenkasittelija","demo5","demo6","demo7","demo8","demo9","demo10","demo11","demo12a","demo12b","demo13","harj1","harj2","harj3","harj4","harj5","harj6","harj7","harj8","harj9","harj10","harj11","harj12","harj13","harj14","harj15");

        if (isset($_GET['sivu']) && isset($_GET['kansio'])) {
            $sivu = $_GET['sivu'];
            $kansio = $_GET['kansio'];
            if (in_array($sivu, $sallitut)) {
                require "./$kansio/$sivu.php"; 
                echo "<br><hr>";
                echo "<h2> Lähdekoodi </h2>";
                echo highlight_file("./$kansio/$sivu.php",1);
            }
        }

        if (isset($_GET['xmlsivu']) && isset($_GET['kansio'])) {
            $sivu = $_GET['xmlsivu'];
            $kansio = $_GET['kansio'];
            if (in_array($sivu, $sallitut)) {
                echo "<h2> Lähdekoodi </h2>";
                echo highlight_file("./$kansio/$sivu.xml",1);
            }
        }
        

        include "./partials/loppu.php";
    } else {
    ?>
        <head>
            <meta charset="utf-8">
            <title>PHP-harjoitukset</title>
            <link rel="stylesheet" href="./partials/tyyli.css">
            <link rel="icon" type="image/gif" href="./partials/favicon.gif"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </head>
        <body>
            <style>
            body {
                cursor: none !important;
            }
            </style>
            <div class="center">
                <form method="post" id="logn">
                    <input type="password" name="pass" placeholder="Salasana">
                    <input type="submit" name="logout" value="Kirjaudu sisään">
                </form>
                <script>

                    var $someElement = $("#logn");
                    $(document).mousemove(function (e) {
                        e.preventDefault();
                        $someElement.offset({ top: e.pageY - 5, left: e.pageX });
                    })
                </script>
            </div>
        </body> 
    <?php
    }
?>
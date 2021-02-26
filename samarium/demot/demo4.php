<html>
    <head>
         
    </head>
    <?php
        switch(value) {
            case 0:
                console.log();
            break;
        }
    ?>
    <body>
        <form action="./index.php?sivu=d4_lomakkeenkasittelija&kansio=demot" method="post">

        <label for="nimi">Kirjoita nimesi</label><br>
        <input type="text" name="nimi"><br>

        <input type="reset" value="Tyhjennä">
        <input type ="submit" value="Lähetä">
        </form>
    </body>
</html>
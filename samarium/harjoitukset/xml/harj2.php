<?php 
    echo "<h1>XML-Harjoitukset 2.2</h1>";

    require "../harjoitukset/yhteys.php";

    $sql = "SELECT race.name AS RaceName, class.name AS ClassName, characters.name AS PlayerName, characters.* FROM `characters`
    INNER JOIN race
        ON `characters`.raceID = race.raceID
    INNER JOIN class
        ON `characters`.classID = class.classID ";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
    
    $myfile = fopen("characters.xml", "w") or die ("Tiedostoa ei pystytty avaamaan.");
    fwrite($myfile, "<characters>\n");
    foreach ($rows as $row){

        $hahmonnimi=$row["PlayerName"];
        $class=$row["ClassName"];
        $race=$row["RaceName"];
        $ID=$row["characterID"];

        $charisma=$row["charisma"];
        $dexterity=$row["dexterity"];
        $intelligence=$row["intelligence"];
        $wisdom=$row["wisdom"];
        $strength=$row["strength"];

        $level=$row["level"];
        $hitpoints=$row["hitpoints"];

        $classID=$row["classID"];
        $raceID=$row["raceID"];
        
        fwrite($myfile,"<character>\n<charactername>$hahmonnimi</charactername>\n<class>$class</class>\n<race>$race</race>\n<charisma>$charisma</charisma>\n<intelligence>$intelligence</intelligence>\n<dexterity>$dexterity</dexterity>\n<strength>$strength</strength>\n<wisdom>$wisdom</wisdom>\n<characterID>$ID</characterID>\n<level>$level</level>\n<hitpoints>$hitpoints</hitpoints>\n<classID>$classID</classID>\n<raceID>$raceID</raceID>\n</character>\n");
    }
    fwrite($myfile, "</characters>");
    fclose($myfile);
    echo"Tiedosto characters.xml on luotu onnistuneesti<br>";

    echo "<img src='../harjoitukset/xml/svgesimerkki.svg' alt='yes'\><br>";
    echo "<img src='../temp/esim_svg_smile.png' alt='yes2'\>";
?>
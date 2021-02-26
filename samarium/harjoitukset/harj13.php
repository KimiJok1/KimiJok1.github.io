<h1>13.1</h1>

<?php
    require "yhteys.php";

    if (isset($_POST["password_reg"]) && isset($_POST["username_reg"])) {
        foreach($_POST as $key => $value) {
            if ($value != "Rekisteröidy") {
                echo htmlspecialchars("$value") . "<br>";
            }
        }
    }

    if (isset($_POST["filename"]) && isset($_POST["input"])) {
        $filename = $_POST["filename"];
        $input = $_POST["input"];
        
        $myfile = fopen("../temp/$filename.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $input);
        fclose($myfile);
    }
?>
<br>
<form method="post">
    <label>Rekisteröidy</label><br>
    <input type="text" name="realname_reg" placeholder="Nimi" required/><br>
    <input type="text" name="username_reg" placeholder="Käyttäjänimi" maxlength="20" required/><br>
    <input type="password" name="password_reg" placeholder="Salasana" maxlength="128" pattern="(?=.*\d).{6,}" required/><br>   
    <input type="date" name="birthday_reg" placeholder="Syntymäaika"/><br> 
    <input type="tel" name="phone_reg" placeholder="Puhelinnumero" pattern="[0-9]{3}[0-9]{3}[0-9]{4}"/><br>     
    <input type="email" name="email_reg" placeholder="Sähköpostiosoite" required/><br>
    <input type="url" name="url_reg" placeholder="Oma sivustosi"/><br>     
    <textarea name="intro_reg" rows="4" cols="50" placeholder="Esittele itsesi."></textarea><br>

    <input type="submit" value="Rekisteröidy" required/>
</form><br>

<h1>13.2</h1>

<form method="post">
    <label for="nimi">Tiedoston nimi</label><br>
    <input type="text" value="" name="filename"/><br>
    <label for="nimi">Sisältö</label><br>
    <textarea rows="4" cols="50" name="input">
    </textarea><br>
    <input type="submit" value="Kirjoita" />
</form>

<h1>13.3</h1>

<?php
    $uploadOk = 0;
    $uploaddir = '../temp/';
    if(isset($_POST["submit2"])) { 
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);
        if ($_FILES["fileToUpload"]["size"] > 200000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($check !== false) {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
                echo "Onnistui.\n";
                $uploadOk = 1;
            } else {
                echo "Epäonnistui.\n";
                $uploadOk = 0;
            }
        } else {
            echo "Tiedosto ei ole kuva.";
            $uploadOk = 0;
        }
    }
?>

<form method="post" enctype="multipart/form-data">
    Valitse kuvatiedosto:<br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Lataa kuva" name="submit2">
</form>

<h1>13.4</h1>

<?php
    $images = glob($uploaddir."*.jpg");
    foreach($images as $image) {
        echo '<img style="width: 15%; height: auto;" src='.$image.'><br>';
    }

    $images2 = glob($uploaddir."*.png");
    foreach($images2 as $image) {
        echo '<img style="width: 15%; height: auto;" src='.$image.'><br>';
    }
?>

<h2>13.5</h2>
<form method="post">
    <textarea name="palaute" id="" cols="30" rows="10"></textarea><br>
    <input type="submit" value="Lähetä">
</form>
<?php
    if(isset($_POST["palaute"])){
        $file = array($_POST["palaute"]);
        $ffile = fopen("palaute.csv","a");
        fputcsv($ffile, $file, ";");
        fclose($ffile);
    }
?>
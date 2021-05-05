<?php
    require "./database/connection.php";

    function getAllPlayers() 
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_kayttaja";
        $stm = $pdo->query($sql);
        $harj2_kayttaja = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $harj2_kayttaja;
    }

    function getAllSports() 
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_laji";
        $stm = $pdo->query($sql);
        $harj2_kayttaja = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $harj2_kayttaja;
    }

    function getAllEntries() 
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_merkinta";
        $stm = $pdo->query($sql);
        $harj2_kayttaja = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $harj2_kayttaja;
    }

    function getPlayerById($id)
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_kayttaja WHERE pid = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $id);
        $stm->execute();

        $player = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $player;
    }

    function getEntriesFromId($id)
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_merkinta WHERE user = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $id);
        $stm->execute();

        $entries = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $entries;
    }

    function getPlayerEntriesByUserId($id)
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_merkinta WHERE user = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $id);
        $stm->execute();

        $player = $stm->fetchAll(PDO::FETCH_ASSOC);
        return count($player);
    }

    function getLajiById($id)
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_laji WHERE lid = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $id);
        $stm->execute();

        $player = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $player;
    }

    function getPlayerByname($name)
    {
        global $pdo;

        $sql = "SELECT * FROM harj2_kayttaja WHERE name = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $name);
        $stm->execute();
        
        $player = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $player;
    }


    function addPlayer($data)
    {
        global $pdo; //yhteys

        $sql = "SELECT name,password FROM harj2_kayttaja WHERE email = ?";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(1,$data[2]);
        $stm->execute();

        $users = $stm->fetchAll(PDO::FETCH_ASSOC);
        if (count($users) > 0) {
            return false;
        } else {
            $sql = "INSERT INTO harj2_kayttaja (name,password,email) VALUES (?,?,?)";
            $stm = $pdo->prepare($sql);
            $ok = $stm->execute($data); //palauttaa true tai false
            return $ok;
        }
    }

    function addEntry($data)
    {
        global $pdo; //yhteys
        $sql = "INSERT INTO harj2_merkinta (user,sport,time,intensity,length) VALUES (?,?,?,?,?)";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data); //palauttaa true tai false
        return $ok;
    }

    function addSport($data)
    {
        global $pdo; //yhteys
        $sql = "INSERT INTO harj2_laji (name) VALUES (?)";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data); //palauttaa true tai false
        return $ok;
    }

    function editPlayer($data)
    {
        global $pdo;

        $sql ="UPDATE harj2_kayttaja SET name = ?, email = ?, current_character = ?, banned = ? WHERE pid = ?";

        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data); //palauttaa true tai false
        return $ok;
    }

    function deletePlayer($id)
    {
        global $pdo;

        $sql = "DELETE FROM harj2_merkinta WHERE user = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);
        $ok = $stm->execute();

        $sql = "DELETE FROM harj2_kayttaja WHERE pid = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);

        $ok = $stm->execute();
        return $ok;
    }

    function deleteEntry($id)
    {
        global $pdo;

        $sql = "DELETE FROM harj2_merkinta WHERE mid = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);

        $ok = $stm->execute();
        return $ok;
    }

    function deleteSport($id)
    {
        global $pdo;

        $sql = "DELETE FROM harj2_merkinta WHERE sport = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);

        $ok = $stm->execute();

        $sql = "DELETE FROM harj2_laji WHERE lid = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);

        $ok = $stm->execute();
        return $ok;
    }

    //funktio tarkistaa, löytyykö käyttäjä tietokannasta
    function loginPlayer($name,$password)
    {
        global $pdo; //yhteys

        $sql = "SELECT name,password FROM harj2_kayttaja WHERE name = ?";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(1,$name);
        $stm->execute();

        $player = $stm->fetchAll(PDO::FETCH_ASSOC);

        //tarkistetaan, vastaavatko salasanat toisiaan
        if($player) {
            if(password_verify($password,$player[0]["password"]))  {
                return TRUE;
            } else return FALSE;
        } else return FALSE;
    }
?>
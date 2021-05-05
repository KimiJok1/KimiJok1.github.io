<?php
    require "./database/connection.php";

    function getAllPlayers() 
    {
        global $pdo;

        $sql = "SELECT * FROM players";
        $stm = $pdo->query($sql);
        $players = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $players;
    }

    function getPlayerById($id)
    {
        global $pdo;

        $sql = "SELECT * FROM players WHERE playerID = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $id);
        $stm->execute();

        $player = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $player;
    }


    function getPlayerByNickname($nickname)
    {
        global $pdo;

        $sql = "SELECT * FROM players WHERE nickname = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $nickname);
        $stm->execute();
        
        $player = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $player;
    }


    function addPlayer($data)
    {
        global $pdo;
        $sql = "INSERT INTO players (nickname,password,email,current_character,lastLogin) VALUES (?,?,?,?,?)";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data); //palauttaa true tai false
        return $ok;
    }

    function editPlayer($data)
    {
        global $pdo;

        $sql ="UPDATE players SET nickname = ?, email = ?, current_character = ?, banned = ? WHERE playerID = ?";

        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data); //palauttaa true tai false
        return $ok;
    }

    function deletePlayer($id)
    {
        global $pdo;

        $sql = "DELETE FROM players WHERE playerID = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);

        $ok = $stm->execute();
        return $ok;
    }

    //funktio tarkistaa, löytyykö käyttäjä tietokannasta
    function loginPlayer($nickname,$password)
    {
        global $pdo; //yhteys

        $sql = "SELECT nickname,password FROM players WHERE nickname = ?";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(1,$nickname);
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
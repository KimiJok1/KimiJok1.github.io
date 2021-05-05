<?php
    require "./database/connection.php";

    function getAllNews() 
    {
        global $pdo;

        $sql = "SELECT * FROM uutinen";
        $stm = $pdo->query($sql);
        $Users = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $Users;
    }

    function addNews($data)
    {
        global $pdo;

        $sql = "INSERT INTO uutinen (otsikko,sisalto,poistamispvm,kirjoittaja) VALUES (?,?,?,?)";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data);
        return $ok;
    }

    function editNews($data)
    {
        global $pdo;

        $sql = "UPDATE uutinen SET otsikko = ?, sisalto = ? WHERE uutinenID = ?";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data);
        return $ok;
    }

    function deleteNews($id)
    {
        global $pdo;

        $sql = "DELETE FROM uutinen WHERE uutinenID = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);

        $ok = $stm->execute();
        return $ok;
    }

    function getNewsById($id)
    {
        global $pdo;

        $sql = "SELECT * FROM uutinen WHERE uutinenID = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $id);
        $stm->execute();

        $User = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $User;
    }

    ?>
<?php
    require "./database/connection.php";

    function getAllUsers() 
    {
        global $pdo;

        $sql = "SELECT * FROM kayttajat";
        $stm = $pdo->query($sql);
        $Users = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $Users;
    }

    function getUserById($id)
    {
        global $pdo;

        $sql = "SELECT * FROM kayttajat WHERE kayttajaID = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $id);
        $stm->execute();

        $User = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $User;
    }


    function getUserByUsername($kayttajatunnus)
    {
        global $pdo;

        $sql = "SELECT * FROM kayttajat WHERE kayttajatunnus = ?";
        $stm = $pdo->prepare($sql);

        $stm->bindValue(1, $kayttajatunnus);
        $stm->execute();
        
        $User = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $User;
    }


    function addUser($data)
    {
        global $pdo;
        $sql = "INSERT INTO kayttajat (kayttajatunnus,salasana) VALUES (?,?)";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute($data);
        return $ok;
    }

    function deleteUser($id)
    {
        global $pdo;

        $sql = "DELETE FROM kayttajat WHERE kayttajaID = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $id);

        $ok = $stm->execute();
        return $ok;
    }

    function loginUser($kayttajatunnus,$salasana)
    {
        global $pdo;

        $sql = "SELECT kayttajatunnus,salasana FROM kayttajat WHERE kayttajatunnus = ?";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(1,$kayttajatunnus);
        $stm->execute();

        $User = $stm->fetchAll(PDO::FETCH_ASSOC);

        if($User) {
            if(password_verify($salasana,$User[0]["salasana"]))  {
                return TRUE;
            } else return FALSE;
        } else return FALSE;
    }
?>
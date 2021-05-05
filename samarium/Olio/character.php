<?php

    class Character {
        private $name;
        private $strength;
        private $dexterity;
        private $wisdom;
        private $intelligence;
        private $charisma;
        private $level;
        private $hitpoints;
        private $characterID;
        private $classID;
        private $raceID;

        public function __construct($name) {
            $this->name = $name;
            $this->classID = rand(1,3);
            $this->raceID = rand(1,5);
            $this->strength = rand(1,50);
            $this->dexterity = rand(1,50);
            $this->wisdom = rand(1,50);
            $this->intelligence = rand(1,50);
            $this->charisma = rand(1,50);
            $this->level = rand(1,50);
            $this->hitpoints = rand(1,50);
        }

        public function setname($name) {
            $this->name = $name;
        }

        public function print_char() {
            echo "<h4><b>" . $this->name . "</b></h4>";
            echo "Class: " . $this->classID . "<br>";
            echo "Race: " . $this->raceID . "<br>";
            echo "Strength: " . $this->strength . "<br>";
            echo "Dexterity: " . $this->dexterity . "<br>";
            echo "Wisdom: " . $this->wisdom . "<br>";
            echo "Intelligence: " . $this->intelligence . "<br>";
            echo "Charisma: " . $this->charisma . "<br>";
            echo "Level: " . $this->level . "<br>";
            echo "Hitpoints: " . $this->hitpoints . "<br>";
        }

        public function print_all_chars() {
            require "yhteys.php";

            $sql = "SELECT * FROM characters";
            $stmt = $pdo->query($sql);
            $rows = $stmt->fetchAll();

            foreach ($rows as $row) {
                echo "<h4><b>" . $row["name"] . "</b></h4>";
                echo "Class: " . $row["classID"] . "<br>";
                echo "Race: " . $row["raceID"] . "<br>";
                echo "Strength: " . $row["strength"] . "<br>";
                echo "Dexterity: " . $row["dexterity"] . "<br>";
                echo "Wisdom: " . $row["wisdom"] . "<br>";
                echo "Intelligence: " . $row["intelligence"] . "<br>";
                echo "Charisma: " . $row["charisma"] . "<br>";
                echo "Level: " . $row["level"] . "<br>";
                echo "Hitpoints: " . $row["hitpoints"] . "<br>";
            }
        }

        public function save_char() {
            require "yhteys.php";
 
            $sql = "INSERT INTO `characters` (`name`, `strength`, `dexterity`, `wisdom`, `intelligence`, `charisma`, `level`, `hitpoints`, `classID`, `raceID`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $data = array ($this->name, $this->strength, $this->dexterity, $this->wisdom, $this->intelligence, $this->charisma, $this->level, $this->hitpoints, $this->classID, $this->raceID);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        }
    }

?>
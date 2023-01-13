<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

    class player extends CoreModel
    {
        //==============================
        // Propriétés
        //==============================

        protected $name;
        protected $genre;
        protected $won_parties;
        private $score;



        // Foreign Keys
        //none

        //==============================
        // Méthodes
        //==============================

        public static function find($id)
        {
            $pdo          = Database::getPDO();
            $statement    = $pdo->query("SELECT * FROM `player` WHERE `id` = " . $id);
            $resultObject = $statement->fetchObject("App\Models\Player");
            return $resultObject;
        }

        public static function findAll()
        {
            $pdo       = Database::getPDO();
            $statement = $pdo->query("SELECT * FROM `player`");
            $results   = $statement->fetchAll(PDO::FETCH_CLASS, "App\Models\Player");
            return $results;
        }

        public static function findAllNames()
        {
            $pdo       = Database::getPDO();
            $statement = $pdo->query("SELECT `name` FROM `player`");
            $results   = $statement->fetchAll(PDO::FETCH_COLUMN);
            return $results;
        }

        public static function findBestPlayers()
        {
            $pdo       = Database::getPDO();
            $statement = $pdo->query("SELECT * FROM `player` ORDER BY `won_parties` DESC LIMIT 10");
            $results   = $statement->fetchAll(PDO::FETCH_CLASS, "App\Models\Player");
            return $results;
        }

        public function insert()
        {
                $pdo       = Database::getPDO();
                $pdo->query( "INSERT INTO `player` (`name`) 
                VALUES ('$this->name')" );

                // Alors on récupère l'id auto-incrémenté généré par MySQL
                $this->id = $pdo->lastInsertId();

                // On retourne VRAI car l'ajout a parfaitement fonctionné
            
        }

        public function add1PlayedPartie()
        {
                $pdo       = Database::getPDO();
                $pdo->query( "UPDATE `player` SET `played_parties` = `played_parties` + 1 WHERE id = '$this->id' ;");
     
        }

        public function add1Victory()
        {
                $pdo       = Database::getPDO();
                $pdo->query( "UPDATE `player` SET `won_parties` = `won_parties` + 1 WHERE id = '$this->id' ;");
       
        }



        // Requete SDL qui link tous les tables
        //    SELECT * FROM `partie` INNER JOIN   `player` ON `partie`.`winner`=`player`.`id` INNER JOIN   `game` ON `partie`.`game_id`=`game`.`id`

        //==============================
        // Getters & Setters
        //==============================


        /**
         * Get the value of name
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */
        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }


        /**
         * Get the value of genre
         */ 
        public function getGenre()
        {
            return $this->genre;
        }

        /**
         * Set the value of genre
         *
         * @return  self
         */ 
        public function setGenre($genre)
        {
            $this->genre = $genre;

            return $this;
        }

        /**
         * Get the value of wonParties
         */ 
        public function getWonParties()
        {
            return $this->won_parties;
        }

        /**
         * Set the value of wonParties
         *
         * @return  self
         */ 
        public function setWonParties($won_parties)
        {
            $this->won_parties = $won_parties;

            return $this;
        }

        /**
         * Get the value of score
         */ 
        public function getScore()
        {
                return $this->score;
        }

        /**
         * Set the value of score
         *
         * @return  self
         */ 
        public function setScore($score)
        {
                $this->score = $score;

                return $this;
        }

        /**
         * Set the value of score
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
}
<?php

namespace App\Models;

use App\Utils\Database;;
use PDO;


        class Partie extends CoreModel
        {
        //==============================
        // Propriétés
        //==============================

        protected $game_id;
        protected $date;
        protected $players_number;
        protected $winner_id;
        protected $winning_score;



        // Foreign Keys
        //none

        //==============================
        // Méthodes 
        //==============================

        public static function find( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT * FROM `game` WHERE `id` = " . $id );
        $resultObject = $statement->fetchObject( "App\Models\Game" );      
        return $resultObject;
        }

        public static function findAll()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `partie`" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "App\Models\Partie" );
        return $results;
        }

        public static function findWinnersByGame($gameId)
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT winner_id, count(*) FROM partie WHERE game_id=". $gameId." GROUP BY winner_id"  );
        $results   = $statement->fetchAll( PDO::FETCH_KEY_PAIR);
        return $results;
        }

        public static function findAllByDate()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `partie` ORDER BY `date` DESC" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "App\Models\Partie" );
        return $results;
        }

        public static function findPartieWinningScore( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT `winning_score` FROM `partie` WHERE `id` = ".$id);
        $resultObject = $statement->fetchObject( "App\Models\Partie" );      
        return $resultObject;
        }

        public static function findPartieLowestScore( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT * FROM `partie` WHERE `id` = " . $id ." ORDER BY `player%_score` ASC LIMIT 1");
        $resultObject = $statement->fetchObject( "App\Models\Partie" );      
        return $resultObject;
        }

        public function insert()
        {
                $pdo       = Database::getPDO();
                $pdo->query( "INSERT INTO `partie` (`game_id`, `date`, `players_number`,`winner_id`, `winning_score`) 
                VALUES ('{$this->game_id}', '{$this->date}', {$this->players_number}, {$this->winner_id}, '{$this->winning_score}')" );

                $this->id = $pdo->lastInsertId();
        }



        //==============================
        // Getters & Setters 
        //==============================



        /**
         * Get the value of game_id
         */ 
        public function getGameId()
        {
                return $this->game_id;
        }

        /**
         * Set the value of game_id
         *
         * @return  self
         */ 
        public function setGameId($game_id)
        {
                $this->game_id = $game_id;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of players_number
         */ 
        public function getPlayersNumber()
        {
                return $this->players_number;
        }

        /**
         * Set the value of players_number
         *
         * @return  self
         */ 
        public function setPlayersNumber($players_number)
        {
                $this->players_number = $players_number;

                return $this;
        }

        /**
         * Get the value of winner
         */ 
        public function getWinnerId()
        {
                return $this->winner_id;
        }

        /**
         * Set the value of winner
         *
         * @return  self
         */ 
        public function setWinnerId($winner_id)
        {
                $this->winner_id = $winner_id;

                return $this;
        }


        /**
         * Get the value of winningScore
         */ 
        public function getWinningScore()
        {
                return $this->winning_score;
        }

        /**
         * Set the value of winningScore
         *
         * @return  self
         */ 
        public function setWinningScore($winning_score)
        {
                $this->winning_score = $winning_score;

                return $this;
        }
    }
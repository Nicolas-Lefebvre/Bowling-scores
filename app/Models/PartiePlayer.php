<?php

namespace App\Models;

use App\Utils\Database;;
use PDO;


class PartiePlayer
{

    private $player_id;
    private $partie_id;
    private $game_id;
    private $score;


    public function insert()
    {
            $pdo       = Database::getPDO();
            $pdo->query( "INSERT INTO `partie_player` (`player_id`, `partie_id`, `game_id`, `score`) 
            VALUES ('{$this->player_id}', '{$this->partie_id}', '{$this->game_id}', '{$this->score}')" );
    }

    public static function findPlayersMostVictories( $gameId )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT * FROM `partie_player` WHERE `game_id` = " . $gameId );
        $resultList = $statement->fetchAll( PDO::FETCH_CLASS, self::class );      
        return $resultList;
        }



    /**
     * Get the value of player_id
     */ 
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Set the value of player_id
     *
     * @return  self
     */ 
    public function setPlayerId($player_id)
    {
        $this->player_id = $player_id;

        return $this;
    }

    /**
     * Get the value of partie_id
     */ 
    public function getPartieId()
    {
        return $this->partie_id;
    }

    /**
     * Set the value of partie_id
     *
     * @return  self
     */ 
    public function setPartieId($partie_id)
    {
        $this->partie_id = $partie_id;

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
}
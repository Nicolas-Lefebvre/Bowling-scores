<?php

namespace App\Models;

use App\Utils\Database;
use PDO;


class Game extends CoreModel
{
        //==============================
        // Propriétés
        //==============================

        private $name;
        private $author;
        private $editor;
        private $picture;
        private $played_parties;
        private $win_type;
        private $min_players;
        private $max_players;
        private $cooperative;
        private $team_play;
        private $record;
        private $recordman_id;
        private $most_victories;
        private $champion_id;
        




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


        public static function findWinType( $id )
        {
        $pdo          = Database::getPDO();
        $statement    = $pdo->query( "SELECT `win_type` FROM `game` WHERE `id` = " . $id );
        $resultObject = $statement->fetchObject( "App\Models\Game" );      
        return $resultObject;
        }

        public static function findAll()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `game`" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "App\Models\Game" );
        return $results;
        }

        public static function findForHome()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `game` ORDER BY `played_parties` DESC LIMIT 10" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "App\Models\Game" );
        return $results;
        }

        public static function findTopPlayedGames()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT `name`, `played_parties` FROM `game` ORDER BY `played_parties` DESC LIMIT 10" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "App\Models\Game" );
        return $results;
        }

        public function findGamesRecord()
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT * FROM `partie` INNER JOIN ORDER BY `played_parties` DESC LIMIT 10" );
        $results   = $statement->fetchAll( PDO::FETCH_CLASS, "Game" );
        return $results;
        }

        public static function findGameRecord($gameId)
        {
        $pdo       = Database::getPDO();
        $statement = $pdo->query( "SELECT `record` FROM `game` WHERE `id` = " . $gameId );
        $results   = $statement->fetchObject(self::class);
        return $results;
        }

        function findChampionByGame($partiesList, $gameId){

                // on identifie pour chaque jeu, toutes les parties avec l'id du gagnant
                $allGamesWinners=[];

                foreach ($partiesList as $partie) {
                if($partie->getGameId() == $gameId){
                $allGamesWinners[] = $partie->getWinner();
                }
                }
                // d($allGamesWinners);

                // Ensuite on repère quel id de gagnant est le plus fréquent, en le placer en premiere valeur du tableau
                $freq=array_count_values($allGamesWinners);
                // d($freq);

                arsort($freq, SORT_NUMERIC);

                // Si une valeur id est renvoyée (si au moins une partie a été jouée pour ce jeu, il y aura un gagnant, sinon cela ne renvoit pas de valeur)
                // On renvoit le nom du joueur associé à cet id
                if(isset(array_values($freq)[0])):

                $playerModel = new Player();
                $playerObject = $playerModel->find(array_values($freq)[0]);
                return $playerObject->getName();
                // return array_values($freq)[0];

                // Sinon, on écrit qu'aucune partie n'a été jouée.
                else: 
                return "aucune partie jouée";
                endif;

                // d($freq);

                } 



        public function insert()
        {
                $pdo       = Database::getPDO();
                $pdo->query( "INSERT INTO `game` (`name`, `author`, `editor`, `min_players`,`max_players`, `win_type`, `cooperative`, `team_play`) 
                VALUES ('$this->name', '$this->author', '$this->editor', $this->min_players, $this->max_players, '$this->win_type', $this->cooperative, $this->team_play)" );
        }

        public function update()
        {
                // Récupération de l'objet PDO représentant la connexion à la DB
                $pdo = Database::getPDO();

                // Ecriture de la requête UPDATE
                $sql = "
                UPDATE `game`
                SET
                        record = :record,
                        recordman_id = :recordman_id,
                        played_parties = :played_parties,
                        most_victories = :most_victories,
                        champion_id = :champion_id

                WHERE `id` = :id
                ";

                // On envoie la requete à PDO avec des emplacements pour qu'il la prépare.
                $query = $pdo->prepare($sql);

                // Une fois que PDO est courant du format de la requete, on lui donne les valeurs à mettre dans les emplacements
                // Le 3ème argument permet de forcer la vérification d'un type de donnée (par défaut c'est string : PDO::PARAM_STR, si on veut vérifier un entier c'est PDO::PARAM_INT)
                $query->bindValue(':record', $this->record, PDO::PARAM_INT);
                $query->bindValue(':recordman_id', $this->recordman_id, PDO::PARAM_INT);
                $query->bindValue(':played_parties', $this->played_parties, PDO::PARAM_INT);
                $query->bindValue(':id', $this->id, PDO::PARAM_INT);
                $query->bindValue(':most_victories', $this->most_victories, PDO::PARAM_INT);
                $query->bindValue(':champion_id', $this->champion_id, PDO::PARAM_INT);

                // Execution de la requête de mise à jour avec la méthode execute
                $updatedRows = $query->execute();
                // On retourne VRAI, si au moins une ligne ajoutée
                return ($updatedRows);
        }


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
         * Get the value of status
         */ 
        public function getEditor()
        {
                return $this->editor;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setEditor($editor)
        {
                $this->editor = $editor;

                return $this;
        }


        /**
         * Get the value of picture
         */ 
        public function getPicture()
        {
                return $this->picture;
        }

        /**
         * Set the value of picture
         *
         * @return  self
         */ 
        public function setPicture($picture)
        {
                $this->picture = $picture;

                return $this;
        }


        /**
         * Get the value of playedParties
         */ 
        public function getPlayedParties()
        {
                return $this->played_parties;
        }

        /**
         * Set the value of playedParties
         *
         * @return  self
         */ 
        public function setPlayedParties($played_parties)
        {
                $this->played_parties = $played_parties;

                return $this;
        }

        /**
         * Get the value of win_type
         */ 
        public function getWinType()
        {
                return $this->win_type;
        }

        /**
         * Set the value of win_type
         *
         * @return  self
         */ 
        public function setWinType($win_type)
        {
                $this->win_type = $win_type;

                return $this;
        }

        /**
         * Get the value of min_players
         */ 
        public function getMinPlayers()
        {
                return $this->min_players;
        }

        /**
         * Set the value of min_players
         *
         * @return  self
         */ 
        public function setMinPlayers($min_players)
        {
                $this->min_players = $min_players;

                return $this;
        }

        /**
         * Get the value of max_players
         */ 
        public function getMaxPlayers()
        {
                return $this->max_players;
        }

        /**
         * Set the value of max_players
         *
         * @return  self
         */ 
        public function setMaxPlayers($max_players)
        {
                $this->max_players = $max_players;

                return $this;
        }

        /**
         * Get the value of cooperative
         */ 
        public function getCooperative()
        {
                return $this->cooperative;
        }

        /**
         * Set the value of cooperative
         *
         * @return  self
         */ 
        public function setCooperative($cooperative)
        {
                $this->cooperative = $cooperative;

                return $this;
        }

        /**
         * Get the value of team_play
         */ 
        public function getTeamPlay()
        {
                return $this->team_play;
        }

        /**
         * Set the value of team_play
         *
         * @return  self
         */ 
        public function setTeamPlay($team_play)
        {
                $this->team_play = $team_play;

                return $this;
        }



        /**
         * Get the value of record
         */ 
        public function getRecord()
        {
                return $this->record;
        }

        /**
         * Set the value of record
         *
         * @return  self
         */ 
        public function setRecord($record)
        {
                $this->record = $record;

                return $this;
        }

        /**
         * Get the value of recordman_id
         */ 
        public function getRecordmanId()
        {
                return $this->recordman_id;
        }

        /**
         * Set the value of recordman_id
         *
         * @return  self
         */ 
        public function setRecordmanId($recordman_id)
        {
                $this->recordman_id = $recordman_id;

                return $this;
        }

        /**
         * Get the value of most_victories
         */ 
        public function getMostVictories()
        {
                return $this->most_victories;
        }

        /**
         * Set the value of most_victories
         *
         * @return  self
         */ 
        public function setMostVictories($most_victories)
        {
                $this->most_victories = $most_victories;

                return $this;
        }

        /**
         * Get the value of champion_id
         */ 
        public function getChampionId()
        {
                return $this->champion_id;
        }

        /**
         * Set the value of champion_id
         *
         * @return  self
         */ 
        public function setChampionId($champion_id)
        {
                $this->champion_id = $champion_id;

                return $this;
        }

        /**
         * Get the value of author
         */ 
        public function getAuthor()
        {
                return $this->author;
        }

        /**
         * Set the value of author
         *
         * @return  self
         */ 
        public function setAuthor($author)
        {
                $this->author = $author;

                return $this;
        }
}
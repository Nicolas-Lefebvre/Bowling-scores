<?php
namespace App\Controllers;

use App\Models\Game;
use App\Models\Partie;
use App\Models\Player;
use App\Models\PartiePlayer;


class PartieController extends CoreController
{

    public function add( )
    {

      $playersList=Player::findAll();

      $gamesList=Game::findAll();

      //   $partieModel = new Partie();
      //   $partieObject = $partieModel->find( $params['partie_id'] );



      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'partie/add', [
        "playersList"   => $playersList,
        "gamesList"   => $gamesList,
        ] );
    }



    public function create()
    {
        $partieModel = new Partie;
        $playerList = Player::findAll();
        

        //RECUPERATION DES DONNEES ENVOYEES PAR LE FORMULAIRES POUR L'AJOUT D'UN NOUVEAU JEU DANS LA DATABASE
        if(!empty($_POST['gameId']) && !empty($_POST['playerNumber']) && !empty($_POST['partieDate']) && !empty($_POST['joueur1']) && !empty($_POST['scoreJoueur1']))
        {
          
            $gameId = $_POST['gameId'];
   
            $playerNumber = $_POST['playerNumber'];

            $date = $_POST['partieDate'];
            // d($date);

            //  Ajout du nouveau jeu à l'objet
            $partieModel->setGameId($gameId);
            $partieModel->setPlayersNumber($playerNumber);
            $partieModel->setDate($date);

            
            //dertermination du winner_id




            // on instancie un objet Player pour chaque particpant, et on lui attribut son nom, score, id (si joueurs existant)).
            $partiePlayers=[];
            for ($i=1; $i <= $playerNumber; $i++) 
            { 
              ${'playerObject' . $i} = new Player();
              ${'playerObject' . $i}->setName($_POST['joueur'.$i]);
              ${'playerObject' . $i}->setScore($_POST['scoreJoueur'.$i]);

              $existingPlayers = Player::findAll();
              foreach ($existingPlayers as $existingPlayer) 
              {
                if(${'playerObject' . $i}->getName() === $existingPlayer->getName())
                {
                  ${'playerObject' . $i}->setId($existingPlayer->getId());
                }
              }

              
              $partiePlayers[]=${'playerObject' . $i};
              
            }
            
            // d($partiePlayers);


            //On insère les nouveaux joueurs dans la BDD et on récupère au passage les id des nouveaux joueurs desormais insérés dans la BDD
            foreach ($partiePlayers as  $player) 
            {
              if( empty($player->getId()))
              {
                $player->insert();
              }

              //on ajoute un au nombre de parties played de chaque joueur
              $player->add1PlayedPartie();

            }



            // on cherche le winner id
           $winnerId="";
           $winnerName = $_POST['winnerName'];
           foreach($partiePlayers as $player)
           {
            if($winnerName === $player->getName())
            {
              $winnerId = $player->getId();
              //On ajoute un au nombre de parties gagnées à ce joueur;
              $player->add1Victory();
            }
           }

           // On regarde si le gagnant est le nouveau champion
           // on commence par faire remonter toutes les parties liées au jeu dans un tableau :
           $gameWinners = Partie::findWinnersByGame($gameId);
          //  d($gameWinners);
           $gameObject = Game::find($partieModel->getGameId());
          //  d($gameObject);
           if($gameWinners)
           {
              foreach ($gameWinners as $gameWinnerId => $numberOfVictories) 
              {
                if($winnerId == $gameWinnerId)
                {
                  if($numberOfVictories + 1 > $gameObject->getMostVictories())
                  {  
                    $gameObject->setMostVictories($numberOfVictories + 1 );
                    $gameObject->setChampionId($winnerId);
                  }
                }
              }
           }
           else
           {
            $gameObject->setMostVictories(1);
            $gameObject->setChampionId($winnerId);
           }
              //  if($winnerId == $gameWinnerId){

                // $gameObject->update();

           


           



           $winningScore="";
           // on cherche le winning score du coup 
           foreach($partiePlayers as $partiePlayer)
           {
            if($winnerId == $partiePlayer->getId())
            {
              $winningScore = $partiePlayer->getScore();
            }
           }
          //  d($winningScore);

           $partieModel->setWinnerId($winnerId);
           $partieModel->setWinningScore(intval($winningScore));

           $partieModel->insert();

          //  d($partieModel);


           //on instancie et on insère chqaue partiePlayer dans la BDD
              $i=0;
              foreach ($partiePlayers as $currentPartiePlayer) 
              {
                $i++;
                ${'partiePlayer' . $i} = new PartiePlayer();
                ${'partiePlayer' . $i}->setPlayerId($currentPartiePlayer->getId());
                ${'partiePlayer' . $i}->setPartieId($partieModel->getId());
                ${'partiePlayer' . $i}->setScore($currentPartiePlayer->getScore());
                ${'partiePlayer' . $i}->setGameId($partieModel->getGameId());
                ${'partiePlayer' . $i}->insert();
              }

          
            // On vérifie si le record du jeu est battu
            // $gameObject = Game::find($partieModel->getGameId());
            $gameRecord = $gameObject->getRecord();

            //Ajout d'une partie jouée au jeu
            $gameObject -> setPlayedParties($gameObject -> getPlayedParties() + 1);
            // $game = Game::find($partieModel->getGameId());
            // d($gameObject);


            // On vérifie si le score du gagnant est meilleur que le record du jeu, et si oui, on écrase ce dernier avec la nouvelle valeur
            $winType = $gameObject->getWinType();
            // d($winType);

            if($winType == "highest_score")
            {
              if($winningScore > $gameRecord || empty($gameRecord) )
              {
                $gameObject->setRecord($winningScore);
                $gameObject->setRecordmanId($winnerId);
                // $gameObject->update();
              }
            }
            elseif ($winType == "lowest_score")
            {
              if($winningScore < $gameRecord || empty($gameRecord))
              {
                $gameObject->setRecord($winningScore);
                
                $gameObject->setRecordmanId($winnerId);
                // $gameObject->update();
              }
            }
            elseif ($winType == "no_score")
            {
              
            }

            $gameObject->update();



            $this->redirect('partie-list');

            // $mostVictories = PartiePlayer::findPlayersMostVictories($gameObject->getId());
            // d($mostVictories);

           




           

        }
        else{
          echo "Tous les champs doivent être remplis";
        }

        // // l'ID du produit demandé est dispo dans $params['partie_id']
        // $this->show( 'game/add', [

        //     ] );

    }

    public function list()
    {

      // $playerModel = new Player();
      // $playersList=$playerModel->findAll();

      // $gameModel = new Game();
      // $gamesList=$gameModel->findAll();


      $partiesList = Partie::findAllByDate();

      $gamesList = Game::findAll();

      $playersList = Player::findAll();


      // ci-dessous, on fait correspondre l'index de chaque jeu avec son id afin de faire remonter ces infos facilement dans la vue.
      $orderedGamesList = [];
      foreach($gamesList as $currentgame)
      {
        $orderedGamesList[$currentgame->getId()] = $currentgame ;
      }

      // ci-dessous, on fait correspondre l'index de chaque joueur avec son id afin de faire remonter ces infos facilement dans la vue.
      $orderedPlayersList = [];
      foreach($playersList as $currentPlayer)
      {
        $orderedPlayersList[$currentPlayer->getId()] = $currentPlayer ;
      }

      // // ci-dessous, on fait correspondre l'index de chaque joueur avec son id afin de faire remonter ces infos facilement dans la vue.
      // $orderedPlayersList = [];
      // foreach($playersList as $currentPlayer)
      // {
      //   $orderedPlayersList[$currentPlayer->getId()] = $currentPlayer ;
      // }

      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'partie/list', [
        "partiesList"        => $partiesList,
        "orderedGamesList"   => $orderedGamesList,
        "orderedPlayersList" => $orderedPlayersList,
        ] );
    }















}
<?php

namespace App\Controllers;

use App\Models\Game;
use App\Models\Partie;
use App\Models\Player;


Class GameController extends CoreController
{

    public function add(  )
    {

      $gamesList=Game::findAll();


      


      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'game/add', [
        "gamesList"   => $gamesList,
        ] );
    }

    public function create()
    {
        $gameModel = new Game;

        //RECUPERATION DES DONNEES ENVOYEES PAR LE FORMULAIRES POUR L'AJOUT D'UN NOUVEAU JEU DANS LA DATABASE
        if (isset($_POST) && !empty($_POST)) {
            $gameNameToAdd = $_POST['gameName'];

            $gameAuthorToAdd = $_POST['gameAuthor'];
            
            // d($gameNameToAdd);
            $gameEditorToAdd = $_POST['gameEditor'];
            // d($gameEditorToAdd);
            $minPlayerNumberToAdd = $_POST['minPlayerNumber'];
            // d($minPlayerNumberToAdd);
            $maxPlayerNumberToAdd = $_POST['maxPlayerNumber'];
            // d($maxPlayerNumberToAdd);

            // on fait correspondre le winType choisi avec son nom exact dans la DB
            $winTypeToAdd = $_POST['scoreType'];

            
            if(isset($_POST['isCoopGame']) && $_POST['isCoopGame'] == '1' ){$isCoopGameToAdd =1;} else{$isCoopGameToAdd =0;}

            if(isset($_POST['isTeamGame']) && $_POST['isTeamGame'] == '1'){$isTeamGameToAdd =1;} else{$isTeamGameToAdd =0;}

            //  Ajout du nouveau jeu à l'objet
            $gameModel->setName($gameNameToAdd);
            $gameModel->setEditor($gameEditorToAdd);
            $gameModel->setAuthor($gameAuthorToAdd);
            $gameModel->setMinPlayers($minPlayerNumberToAdd);
            $gameModel->setMaxPlayers($maxPlayerNumberToAdd);
            $gameModel->setwinType($winTypeToAdd);
            $gameModel->setcooperative($isCoopGameToAdd);
            $gameModel->setTeamPlay($isTeamGameToAdd);

            $gameModel->insert();

            $this->redirect('game-list');

            // $gameModel->addNewGame($gameNameToAdd, $gameEditorToAdd, null, 0, $minPlayerNumberToAdd, $maxPlayerNumberToAdd, $scoreTypeToAdd, $isCoopGameToAdd, $isTeamGameToAdd );
            
        }

        // // l'ID du produit demandé est dispo dans $params['partie_id']
        // $this->show( 'game/add', [

        //     ] );

    }


    public function list(  )
    {

      // $gameModel = new Game();
      $gamesList=Game::findAll();

      // $partieModel = new Partie();
      $partiesList = Partie::findAll();

      // $playerModel = new Player();
      $playersList = Player::findAll();

      // $gameModel = new Game();
      // $gamesOject=$gameModel->find($id);

      $orderedgamesList = [];
      foreach($gamesList as $currentGame)
      {
        $orderedgamesList[$currentGame->getId()] = $currentGame ;
      }

      $orderedpartiesList = [];
      foreach($partiesList as $currentPartie)
      {
        $orderedpartiesList[$currentPartie->getId()] = $currentPartie ;
      }

      $orderedplayersList = [];
      foreach($playersList as $currentPlayer)
      {
        $orderedplayersList[$currentPlayer->getId()] = $currentPlayer ;
      }
      
      // function findChampionByGame($partiesList, $gameId){

      //   // on identifie pour chaque jeu, toutes les parties avec l'id du gagnant
      //   $allGamesWinners=[];

      //   foreach ($partiesList as $partie) {
      //     if($partie->getGameId() == $gameId){
      //       $allGamesWinners[] = $partie->getWinner();
      //     }
      //   }
      //   // d($allGamesWinners);

      //   // Ensuite on repère quel id de gagnant est le plus fréquent, en le placer en premiere valeur du tableau
      //   $freq=array_count_values($allGamesWinners);
      //   // d($freq);

      //   arsort($freq, SORT_NUMERIC);

      //   // Si une valeur id est renvoyée (si au moins une partie a été jouée pour ce jeu, il y aura un gagnant, sinon cela ne renvoit pas de valeur)
      //   // On renvoit le nom du joueur associé à cet id
      //   if(isset(array_values($freq)[0])):

      //     $playerModel = new Player();
      //     $playerObject = $playerModel->find(array_values($freq)[0]);
      //     return $playerObject->getName();
      //     // return array_values($freq)[0];

      //   // Sinon, on écrit qu'aucune partie n'a été jouée.
      //   else: 
      //     return '<i class="text-muted">aucune partie jouée</i>';
      //   endif;

      //   // d($freq);
      // } 


      // function findRecordByGame($partiesList, $gameId){

      //   // on identifie pour chaque jeu, toutes les parties avec l'id du gagnant
      //   $allGamesRecords=[];

      //   foreach ($partiesList as $partie) {
      //     if($partie->getGameId() == $gameId){
      //       $allGamesRecords[] = $partie->getWinningScore();
      //     }
      //   }
      //   // d($allGamesRecords);

      //   // Ensuite on repère quel score est le plus élevé, en le placer en premiere valeur du tableau
      //   if(!empty($allGamesRecords)){
      //   $maxScore=max($allGamesRecords);
      //   // d($maxScore);
      //   }

      //   // Si une valeur est renvoyée 
      //   // On renvoit ce score
      //   if(!empty($allGamesRecords) && ($maxScore) !== null):
      //       return $maxScore;
      //     // Sinon, on écrit qu'aucune partie n'a été jouée.
      //     else: 
      //       return '<i class="text-muted">aucune partie jouée</i>';
      //     endif;
      //   // d($freq);
      // } 

      



      // l'ID du produit demandé est dispo dans $params['partie_id']
      $this->show( 'game/list', [
        "gamesList"          => $gamesList,
        "orderedpartiesList" => $orderedpartiesList,
        "partiesList"        => $partiesList,
        "orderedplayersList" => $orderedplayersList
        ] );
    }













}
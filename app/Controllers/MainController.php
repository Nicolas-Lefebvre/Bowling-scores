<?php

namespace App\Controllers;


use App\Models\Game;
use App\Models\Player;
use App\Utils\Database;


class MainController extends CoreController
{


    public function home()
    {
      // Ici pour les catégories, plusieurs solutions
      // 1. Créer une méthode findForHome() sur notre Model Category
      // Pour récupérer celles sur la page d'accueil uniquelent

      $gameModel = new Game();
      $homeGames=$gameModel->findForHome();

      $gameModel = new Game();
      $topPlayedGames=$gameModel->findForHome();

      $playerModel = new Player();
      $bestPlayers=$playerModel->findBestPlayers();

      // 2. Réutiliser le tableau de toutes les catégories qu'on a dans 
      // la navigation pour n'afficher ici que ceux avec un home_order > 1
      // En revanche cette solution nous amenerai a faire un "traitement" de la données
      // directement dans la Vue. Ce n'est pas son rôle et donc on préfèrera la solution 1.

      $this->show( 'home', [ 
        "homeGames"     => $homeGames,
        "topPlayedGames"=> $topPlayedGames,
        "bestPlayers"   => $bestPlayers,
      ] );
    }


    public function game( $params )
    {
      $gameModel = new Game();
      $gameObject = $gameModel->find( $params['game_id'] );

      // l'ID du produit demandé est dispo dans $params['game_id']
      $this->show( 'game.view', [
        "currentObject" => $gameObject,
        ] );
    }


    
}
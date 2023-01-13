<?php


  // On inclus l'autoload de Composer qui require les libs automatiquement
  require_once __DIR__ . "/../vendor/autoload.php";
  




  //=========================
  // Routes
  //=========================

  // J'instancie la classe AltoRouter
  $router = new AltoRouter();

  $router->setBasePath( $_SERVER['BASE_URI'] );

  // Je défini ma première route d'AltoRouter avec ->map()
  $router->map(
    "GET",        
    "/",   
    [
      "controller" => "MainController",
      "method"     => "home"
    ],
    "main-home"
  );

  $router->map(
    "GET",         
    "/partie/list",   
    [
      "controller" => "PartieController",
      "method"     => "list"
    ],
    "partie-list"
  );

  $router->map(
    "GET",         
    "/partie/add",   
    [
      "controller" => "PartieController",
      "method"     => "add"
    ],
    "partie-add"
  );

  $router->map(
    "POST",         
    "/partie/add",   
    [
      "controller" => "PartieController",
      "method"     => "create"
    ],
    "partie-create"
  );

  $router->map(
    "GET",         
    "/game/list",   
    [
      "controller" => "GameController",
      "method"     => "list"
    ],
    "game-list"
  );

  $router->map(
    "GET",         
    "/game/add",   
    [
      "controller" => "GameController",
      "method"     => "add"
    ],
    "game-add"
  );

  $router->map(
    "POST",         
    "/game/add",   
    [
      "controller" => "GameController",
      "method"     => "create"
    ],
    "game-create"
  );



    // Une fois toute mes routes définies, je demande a AltoRouter
  // de trouver laquelle correspond a l'URL demandée
  // Cette méthode nous renvoi un tableau associatif contenant les clés suivants :
  //  "target" => Ce qu'on veut : 3e param de ->map
  //  "params" => Parties variables de l'URL, tableau vide si aucune
  //  "name"   => Le nom de la route qui match (4e param de ->map)
  // Elle renvoi false si aucune route qui match l'URL n'est trouvée
  // http://altorouter.com/usage/matching-requests.html
  $match = $router->match();

  //   d( $match );
  //   d(get_defined_vars());

//------------------------------------ALTO DISPATCHEUR---------------------------------
  $dispatcher = new Dispatcher($match, 'ErrorController::err404');

  // La méthode setControllersNamespace permet de définir un namespace commun à tous nos controllers. Ainsi on évite la répétition de ce namespace et donc les erreurs
  // fonctionne pour les routes et la déclaration du dispatcher ci-dessus. 
  $dispatcher->setControllersNamespace('App\Controllers');

  // Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
  $dispatcher->dispatch();
  //----------------------------------FIN ALTO DISPATCHEUR-------------------------------

  // if( $match !== false )
  // {
  //   // Si c'est le cas, je récupère les infos de cette route
  //   // Grace a AltoRouter, c'est directement dispo dans $match['target']
  //   $routeData = $match['target'];

  //   // A partir de là, ça marche comme avant !

  //   // J'en déduis, l'action a executer : le controller et la méthode
  //   $controllerName = $routeData['controller'];
  //   $methodToCall   = $routeData['method'];

  //   // J'ai donc désormais deux variables, sous forme de string
  //   // qui vont contenir respectivement le nom du controller à instancier
  //   // et le nom de la méthode à appeller
  //   // d( $controllerName ); // par exemple : "MainController"
  //   // d( $methodToCall   ); // par exemple : "home"

  //   // On doit maintenant executer l'action
  //   // Heureusement en PHP, on peut instancier une classe dont le nom se trouve dans une variable
  //   // Pareil pour l'appel d'une méthode.
  //   $controller = new $controllerName();            // Par exemple : $controller = new MainController();
  //   $controller->$methodToCall( $match['params'] ); // Par exemple : $controller->home()




  // }
  // else
  // {
  //   // Si aucune route ne correspond dans le tableau
  //   // On affiche une erreur 404
  //   http_response_code( 404 );
  //   exit( "404 Not Found" );
  // }


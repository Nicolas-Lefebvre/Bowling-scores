
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Pour réparer les liens des fichiers "statiques" (assets), on doit faire un lien absolu
  vers ces derniers, car un lien relatif sera cassé a cause de la réécriture d'URL
  Pour ça, on réutiliser BASE_URI qui nous fournit un lien absolu jusqu'au dossier public -->
  <link rel="stylesheet" href="<?= $_SERVER['BASE_URI'] ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_SERVER['BASE_URI'] ?>/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= $_SERVER['BASE_URI'] ?>/assets/css/styles.css">
  <title>Board Game Scores</title>
</head>

<body>
  <header>
    <!-- <div class="top-bar">
      <div class="container-fluid">
        <div class="row d-flex align-items-center">
          <div class="col-sm-7 d-none d-sm-block">
            <ul class="list-inline mb-0">
              <li class="list-inline-item pr-3 mr-0">
                <i class="fa fa-phone"></i> 01 02 03 04 05
              </li>
              <li class="list-inline-item px-3 border-left d-none d-lg-inline-block">Livraison offerte à partir de 100€</li>
            </ul>
          </div>
        </div>
      </div>
    </div> -->

    <nav class="navbar navbar-expand-lg navbar-sticky navbar-airy navbar-light">
      <div class="container-fluid">
        <!-- Navbar Header  -->
        <a href="<?= $router->generate('main-home') ?>" class="navbar-brand">
          Board Game Scores
        </a>
        <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
          aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
        <!-- Navbar Collapse -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav mx-auto d-flex align-items-end">
            
            <li class="nav-item">
              <a href="<?= $router->generate('main-home') ?>" class="nav-link active">
                Accueil
              </a>
            </li>

            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Jeux</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a  class="dropdown-item" href="<?= $router->generate('game-list') ?>">Liste des jeux</a>
                      <a  class="dropdown-item" href="<?= $router->generate('game-add') ?>">Ajouter un jeu</a>
                    </div>
                </div>
            </li>
            
            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Parties</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a  class="dropdown-item" href="<?= $router->generate('partie-list') ?>">Liste des parties</a>
                      <a  class="dropdown-item" href="<?= $router->generate('partie-add') ?>">Ajouter une partie</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
              <div class="dropdown">
              <a href="#" class="nav-link active">
                Scores
              </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
<img id="header-img" src="<?= $_SERVER['BASE_URI'] . "/assets/images/pexels-ylanite-koppens-776654 (1).jpg" ?>" alt="">

<section>

  <div class="container-fluid">

    <div class="col mx-0">
          <div class="col-md-10 col-lg-8 col-xl-6 mx-auto mb-4">
            <div class="card border-1 text-dark text-center mb-2">
              <!-- <div class="card-img-overlay d-flex align-items-center"> -->
                <div class="w-100 py-3">
                  <h2 class="display-4 font-weight-bold mb-4">
                    Top jeux
                  </h2>
                  <ol class="text-center">

                    <?php foreach($topPlayedGames as $game): ?>
                      <li>
                        <?= $game->getName() . " (" . $game->getPlayedParties() . " parties jouées)" ?>
                      </li>

                    <?php endforeach; ?>

                  </ol>
                  <a 
                    href="<?= $router->generate('game-list') ?>" 
                    class="btn btn-dark pull-right pull-right mr-4"
                  >
                    Voir plus
                  </a>
                </div>
              <!-- </div> -->
            </div>
          </div>
    

    <!-- <div class="row mx-0"> -->
          <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
            <div class="card border-1 text-dark text-center mb-2">
              <!-- <div class="card-img-overlay d-flex align-items-center"> -->
                <div class="w-100 py-3">
                  <h2 class="display-4 font-weight-bold mb-4">
                    Meilleurs joueurs
                  </h2>
                  <ol>
                   <?php foreach($bestPlayers as $player) : ?>
                    <li>
                      <?= $player->getName() . " - " . $player->getWonParties() . " victoire(s)" ?>
                    </li>
                   <?php endforeach ;  ?>
                  </ol>
                  <a 
                    href="#" 
                    class="btn btn-dark pull-right mr-4"
                  >
                    Voir plus
                  </a>
                </div>
              <!-- </div> -->
            </div>
          </div>
    </div>
    </div>

    <!-- <div class="row mx-0">   -->
    
<!-- 
          <div class="col-lg-4">
            <div class="card border-0 text-center text-white">
              <img 
                src="" 
                alt="Card image" class="card-img"
              >
              <div class="card-img-overlay d-flex align-items-center">
                <div class="w-100">
                  <h2 class="display-4 mb-4">
                    
                  </h2>
                  <a 
                    href="" 
                    class="btn btn-light"
                  >
                    
                    <i class="fa-arrow-right fa ml-2"></i>
                  </a>
                </div>
              </div>
            </div>
          </div> -->

      
    </div>
  </div>
</section>
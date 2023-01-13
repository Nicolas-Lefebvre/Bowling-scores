<section class="list-section">

    <h1 class="list-h1">
        Liste des parties
    </h1>

    <table class="table table-striped col-md-12 col-lg-8">
        <thead>
            <tr>
                    <th scope="col" class="text-center">N° Partie</th>
                    <th scope="col" class="text-center">Date Partie</th>
                    <th scope="col" class="text-center">Jeu</th>
                    <th scope="col" class="text-center">Nombre de Joueurs</th>
                    <th scope="col" class="text-center">Vainqueur</th>
                    <th scope="col" class="text-center">Score</th>
            </tr>
        </thead>

        <tbody>
        <?php  foreach($partiesList as $currentPartie):   ?>
            <tr>
                <th scope="row" class="text-center"><?= $currentPartie->getId(); ?></th>
                <th scope="row" class="text-center">
                    <time datetime="DD-MM-YYYY">
                        <?=date('d M Y',strtotime($currentPartie->getDate())); ?>
                            <i>
                                <?=date('H:i',strtotime($currentPartie->getDate())); ?>
                            </i>
                    </time>
                </th>
                <td class="text-center"><?=$orderedGamesList[$currentPartie->getGameId()]->getName() ?></td>
                <td class="text-center"><?= $currentPartie->getPlayersNumber(); ?></td>
                <td class="text-center"><?= $orderedPlayersList[$currentPartie->getWinnerId()]->getName(); ?></td>
                <td class="text-center"><?= $currentPartie->getWinningScore(); ?></td>


            </tr>

            <?php endforeach ;?>
        </tbody>




        </table>












</section>
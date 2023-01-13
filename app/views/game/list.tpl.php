<section class="list-section">

    <h1>
        Liste des jeux
    </h1>

    <table class="table table-striped col-md-12 col-lg-8">
        <thead>
            <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Nom</th>
                    <th scope="col" class="text-center">Editeur</th>
                    <th scope="col" class="text-center">Champion <img class="champion-icon" src="<?= $_SERVER['BASE_URI'] . "/assets/images/coupe.png" ?>" alt="icone de coupe"></th>
                    <th scope="col" class="text-center">meilleur score <img class="champion-icon" src="<?= $_SERVER['BASE_URI'] . "/assets/images/medaille.png" ?>" alt="icone de medaille"></th>
                    <th scope="col" class="text-center">Nombre de parties</th>

            </tr>
        </thead>

        <tbody>
        <?php
            $classementJeu = 0 ;
            foreach($gamesList as $currentGame):  
                $classementJeu++;   ?>
                <tr>

                    <td scope="row" class="text-center"><?= $classementJeu ?></td>
                    <td scope="row" class="text-left"><?= $currentGame->getName(); ?></td>
                    <td scope="row" class="text-left"><?= $currentGame->getEditor(); ?></td>
                    
                    <td class="text-center">
                        <?php 
                            if(isset($orderedplayersList[$currentGame->getChampionId()]))
                            {
                                echo $orderedplayersList[$currentGame->getChampionId()]->getName() . " (" . $currentGame->getMostVictories() ." victoires)";
                            }else{echo "<i>Non renseigné<i>";}   
                        ?>
                    </td>

                    <td class="text-center">
                        <?php
                            if(null != ($currentGame->getRecord()))
                            {
                                echo $currentGame->getRecord() . " (" . $orderedplayersList[$currentGame->getRecordmanId()]->getName() .")"; 
                            }else{echo "<i>Non renseigné<i>";}
                        ?>
                    </td>
                    <td class="text-center"><?= $currentGame->getPlayedParties(); ?></td>

                </tr>
            <?php endforeach ;?>
        </tbody>




        </table>












</section>
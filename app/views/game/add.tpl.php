<section>

  <?php 
  d($_GET);
  d($_POST);
  if (empty($_POST['gameName'])):
    
  ?>



<h1>Ajout d'un jeu à votre bibliothèque :</h1>


<div class="col-12">
    <form action="" method="post">

      <div class="form-group">
        <label for="gameName">Nom du jeu :</label>
        <input type="text" id="gameName" name="gameName">
      </div>

      <div class="form-group">
        <label for="author">Auteur :</label>
        <input type="text" id="gameAuthor" name="gameAuthor">
      </div>

      <div class="form-group">
        <label for="editor">Editeur :</label>
        <input type="text" id="gameEditor" name="gameEditor">
      </div>



      <div class="form-group">
        <label for="playersNumber">Nombre de joueurs min:</label>
        <input type="number" id="minPlayerNumber" name="minPlayerNumber" min="1">
      </div>

      <div class="form-group">
        <label for="playersNumber">Nombre de joueurs max:</label>
        <input type="number" id="maxPlayerNumber" name="maxPlayerNumber" min="1">
      </div>


      <div class="form-group">
        <label for="scoreType">Type de victoire :</label>
        <select class="form-control" id="gameName" name="scoreType">
                <option value="highest_score">Le score le plus élevé gagne</option>
                <option value="lowest_score">Le score le plus bas gagne</option>
                <option value="no_score">Pas de score</option>
        </select>
      </div>

      <fieldset>
        <legend>Propriétés du jeu:</legend>
        <div>
          <input type="checkbox" id="cooperativeGame" name="isCoopGame" value="1">
          <label for="isCoopGame">jeu Coopératif (soit les joueurs gagnent, soit le jeu gagne)</label>
        </div>

        <div>
          <input type="checkbox" id="teamGame" name="isTeamGame" value="1">
          <label for="isTeamGame">Jeu en équipe autorisé</label>
        </div>
      </fieldset>


      <button type="submit">
        Valider
      </button>
    </form>
</div>

<?php elseif(!empty($_POST['gameName'])): ?>
  <h2>Jeu ajouté avec succés !</h2>

<?php endif;?>
</section>
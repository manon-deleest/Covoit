<h1>Ajouter une ville</h1>
<?php

$villeManager=new VilleManager($db);

if (empty($_POST["vil_nom"])){?>
  <form action="#" method = "post" id = "AjouterVille">
    <label>Nom : </label><input type="text" id="nomVille" name ="vil_nom">
    <input type="submit" id="valider" value="Valider">
  </form>
<?php 
}else{
  $ville=new Ville($_POST);
  $retour= $villeManager->add($ville);
  
  if ($retour) { ?>
		<p> <img src="image/valid.png" alt="valide"> La ville "<b> <?php echo $_POST["vil_nom"] ?> </b>" a bien été ajouté. </p>
	<?php
	} else { ?>
		<p> <img src="image/erreur.png" alt="erreur"> La ville "<b> <?php echo $_POST["vil_nom"] ?> </b>" n'a pas pu être ajouté. </p>
	<?php
	}
}
?>

    
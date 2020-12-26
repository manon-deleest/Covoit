<?php
$personneManager = new PersonneManager($db);
$listePer = $personneManager->getAllPersonne();

if (empty($_GET["per_num"])){
    ?>

    <h1>Liste des personnes enregistrées</h1>
    <p>Actuellement <?php echo sizeof($listePer) ?> personnes enregistrées</p>
    <table><tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th></th>
        </tr> <?php
    foreach ($listePer as $elem){
        ?> <tr>
        <td><?php echo $elem->getPerNom();  ?></td>
        <td><?php echo $elem->getPerPrenom(); ?></td>
        <td><a href="index.php?page=4&per_num=<?php echo $elem->getPerNum() ?>">Supprimer</a> 
        </tr> 
    <?php } ?>
    </table>
    <?php
} 
if (!empty($_GET["per_num"])) {
    if ($personneManager->supprimerPer($_GET["per_num"])) { ?>
       <p><img src="image/valid.png" alt="valide"> La personne a été supprimée ainsi que tous ses trajets</p>
   <?php 
   if (!empty($_SESSION["utilisateur"])){
       $user = unserialize($_SESSION["utilisateur"]);
       if ($user->getPerNum() == $_GET["per_num"]) {
           unset($_SESSION["utilisateur"]);
           header('Refresh: 0');
       }
   }
   } else { ?>
       <p><img src="image/erreur.png" alt="valide"> La personne n'a pas été supprimée</p>
<?php } }
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
        <td><a href="index.php?page=3&per_num=<?php echo $elem->getPerNum() ?>">Modifier</a> 
        </tr> 
    <?php } ?>
    </table>
    <?php 
} if (empty($_POST["per_nom"]) && empty($_POST["per_prenom"]) && empty($_POST["per_mail"]) && !empty($_GET["per_num"])) {
    $personne = $personneManager->getPerByNum($_GET["per_num"]);
    $etuManager = new EtudiantManager($db);
    $salManager = new SalarieManager($db);
    if ($etudiant = $etuManager->getEtudiantByNum($_GET["per_num"])){ ?> 
        <h1>Modifier l'étudiant <?php echo $personne->getPerNom() ?></h1>
    <?php } else { 
        $salarie = $salManager->getSalarieByNum($_GET["per_num"]); ?> 
        <h1>Modifier le salarié <?php echo $personne->getPerNom() ?></h1>
    <?php } ?> 
    <form action="#" method="post">
    <div>
        <div>
            <label>Nom :</label>
            <input type="text" name="per_nom" value="<?php echo $personne->getPerNom() ?>" required>
        </div>
        <div>
            <label>Prénom :</label>
            <input type="text" name="per_prenom" value="<?php echo $personne->getPerPrenom() ?>" required>
        </div>
        <div>
            <label>Téléphone :</label>
            <input type="tel" name="per_tel" value="<?php echo $personne->getPerTel() ?>" required>
        </div>
        <div>
            <label>Mail :</label>
            <input type="email" name="per_mail" value="<?php echo $personne->getPerMail() ?>" required>
        </div>
    </div>
    <input type="submit" value="Valider">
</form>
    
<?php } 
if (!(empty($_POST["per_nom"]) || empty($_POST["per_prenom"]) || empty($_POST["per_mail"]))) {

    $tab= [
        "per_num"=>$_GET["per_num"], 
        "per_nom"=>$_POST["per_nom"], 
        "per_prenom"=>$_POST["per_prenom"],
        "per_tel"=>$_POST["per_tel"],
        "per_mail"=>$_POST["per_mail"]];

    $personneModifie = new Personne($tab);

    if ($personneManager->modifPer($personneModifie)){
        ?><p><img src="image/valid.png" alt="valide"> Les modifications ont été pris en compte </p><?php
    }
}
?>


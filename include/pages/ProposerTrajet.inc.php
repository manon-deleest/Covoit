<?php
if (!empty($_SESSION["utilisateur"])){
    ?>
        <h1>Proposer un trajet</h1>
    <?php
        date_default_timezone_set('Europe/Paris'); 
        $parcoursManager = new ParcoursManager($db);
        $listeVille = $parcoursManager->getVilleDep();
    ?>


    <?php if (empty($_POST["villeDep"]) && empty($_POST["villeArr"]) && empty($_POST["time"]) && empty($_POST["date"]) && 
        empty($_POST["place"])) { ?>
        <form action="#" method="post">
            <label>Ville de départ : </label>
            <select onchange="this.form.submit()" name="villeDep">
                <?php foreach ($listeVille as $elem){ ?>
                    <option value="<?php echo $elem->getVilNum() ?>"><?php echo $elem->getVilNom()?></option>
                <?php } ?>
            </select>
        </form>
    <?php } 
    if (!empty($_POST["villeDep"]) && empty($_POST["villeArr"]) && empty($_POST["time"]) && empty($_POST["date"]) && 
            empty($_POST["place"])) { 
            $_SESSION["villeDep"] = $_POST["villeDep"];
            ?>
            <form action="#" method="post">
            <div class="colonnes">
                <div>
                    <label>Ville de départ : <?php
                    $villeManager = new VilleManager($db);
                    echo $villeManager->getVilleByNum($_POST["villeDep"])->getVilNom(); ?></label>
                </div>
                <div>
                    <label>Ville d'arrivée : </label>
                        <select name="villeArrive" >
                        <?php 
                            $listeVillesPossibles = $parcoursManager->getVillepossibleForVille($_POST["villeDep"]);
                            foreach ($listeVillesPossibles as $elem){ ?>
                                <option value="<?php echo $elem->getVilNum() ?>"><?php echo $elem->getVilNom()?></option>
                        <?php } ?>
                        </select>
                </div>
                <div>
                    <label>Date de depart : </label>
                    <input type="date" value="<?php  echo date('Y-m-d'); ?>" name="date" required>
                </div>
                <div> 
                    <label>Heure de départ : </label>
                    <input type="time" name="time" value="<?php echo date('H:i:s'); ?>" required>
                </div>
            </div>
            <div>
                <label>Nombre de places : </label>
                <input min="1" type="number" name="place" required>
            </div>    
            
            <input type="submit" value="Valider">
            </form>
        <?php } ?>

    <?php 
    if (!empty($_SESSION["villeDep"]) && !empty($_POST["villeArrive"]) && !empty($_POST["time"]) && !empty($_POST["date"]) && 
    !empty($_POST["place"])){

        $proposeManager = new ProposeManager($db);
        $parcours = $parcoursManager->getParcoursByVilles($_SESSION["villeDep"], $_POST["villeArrive"]);
        $utilisateur = unserialize($_SESSION["utilisateur"]);
        $sens = ($_SESSION["villeDep"] == $parcours->getVilNum1()) ? 0 : 1;
        $tab= ["par_num"=>$parcours->getParNum(),
            "per_num"=>$utilisateur->getPerNum(), 
            "pro_date"=>$_POST["date"], 
            "pro_time"=>$_POST["time"], 
            "pro_place"=>$_POST["place"], 
            "pro_sens"=>$sens];
        $propose = new Propose($tab);
        $retour=$proposeManager->add($propose);
        if($retour){
            ?><p> <img src="image/valid.png" alt="valide"> Le trajet a bien été proposé. </p><?php
        }else{
            ?><p> <img src="image/erreur.png" alt="erreur"> Le trajet n'a pas pu être proposé. </p><?php
        }        
        unset($_SESSION["villeDep"]);
    }
}else{
    ?><p> <img src="image/erreur.png" alt="erreur"> Page non autorisé ! </p><?php
}
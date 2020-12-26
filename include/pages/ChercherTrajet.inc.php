<?php
if (!empty($_SESSION["utilisateur"])){
    ?>
    <h1>Rechercher un trajet</h1>
    <?php
        date_default_timezone_set('Europe/Paris'); 
        $parcoursManager = new ParcoursManager($db);
        $listeVille = $parcoursManager->getVilleDep();
        $villeManager = new VilleManager($db);

    if (empty($_POST["villeDep"]) && empty($_POST["villeArr"]) && empty($_POST["time"]) && empty($_POST["date"])) { ?>
        <form action="#" method="post">
            <label>Ville de départ</label>
            <select onchange="this.form.submit()" name="villeDep">
                <option value='0'>Chosissez</option>
                <?php foreach ($listeVille as $elem){ ?>
                    <option value="<?php echo $elem->getVilNum() ?>"><?php echo $elem->getVilNom()?></option>
                <?php } ?>
            </select>
        </form>
    <?php } 
    if (!empty($_POST["villeDep"]) && empty($_POST["villeArr"]) && empty($_POST["time"]) && empty($_POST["date"])) {
        $_SESSION["villeDep"] = $_POST["villeDep"];
    ?>
    <form action="#" method="post">
    <div class="colonnes">
        <div>
            <label>Ville de départ : <?php
            echo $villeManager->getVilleByNum($_POST["villeDep"])->getVilNom(); ?></label>
        </div>
        <div>
            <label>Ville d'arrivée :</label>
                <select name="villeArr" required>
                <?php 
                    $listeVillesPossibles = $parcoursManager->getVillepossibleForVille($_POST["villeDep"]);
                    foreach ($listeVillesPossibles as $elem){ ?>
                        <option value="<?php echo $elem->getVilNum() ?>"><?php echo $elem->getVilNom()?></option>
                <?php } ?>
                </select>
        </div>
        <div>
            <label>Date de depart :</label>
            <input type="date" value="<?php  echo date('Y-m-d'); ?>" name="date" required>
        </div>
        <div>
            <label>Précision :</label>
            <select name="precision">
                <option value="0">Ce jour</option>
                <option value="1">+/- 1 jour</option>
                <option value="2">+/- 2 jour</option>
                <option value="3">+/- 3 jour</option>
            </select>
        </div>
        <div>
                <label>A partir de :</label>
                    <select name="time">
                        <?php for($i =0; $i<24; $i++){
                            ?> <option value="<?php echo "$i:00:00" ?> "><?php echo $i ?>h</option> 
                    <?php } ?>
                    </select>
        </div>
    </div>
    <input type="submit" value="Valider">
    </form>
    <?php
    } 
    if (!empty($_SESSION["villeDep"]) && !empty($_POST["villeArr"]) && !empty($_POST["time"]) && !empty($_POST["date"])){
        $proposeManager = new ProposeManager($db);
        $villeManager=new VilleManager($db); 
            

        $listeProposition = $proposeManager->getProposition( $_SESSION["villeDep"],$_POST["villeArr"], $_POST["time"], $_POST["date"], $_POST["precision"]);

        if (!empty($listeProposition)){
        ?> <table><tr><th>Ville départ</th><th>Ville arrivé</th><th>Date départ</th><th>Heure départ</th><th>Nombre de place(s)</th><th>Nom du covoitureur</th></tr>
        <?php foreach ($listeProposition as $elem){
            ?> <tr>
                <td><?php $parcours = $parcoursManager->getParcoursByParNum($elem->getParNum());
                        if($elem->getProSens()==0){
                            $vil_num= $parcours->getVilNum1(); 
                            $ville=$villeManager->getVilleByNum($vil_num); 
                            echo $ville->getVilNom();
                        }else{
                            $vil_num= $parcours->getVilNum2(); 
                            $ville=$villeManager->getVilleByNum($vil_num); 
                            echo $ville->getVilNom();
                        }
                    ?></td>    
                    <td><?php $parcours = $parcoursManager->getParcoursByParNum($elem->getParNum());
                        if($elem->getProSens()==0){
                            $vil_num= $parcours->getVilNum2(); 
                            $ville=$villeManager->getVilleByNum($vil_num); 
                            echo $ville->getVilNom();
                        }else{
                            $vil_num= $parcours->getVilNum1(); 
                            $ville=$villeManager->getVilleByNum($vil_num); 
                            echo $ville->getVilNom();
                        }
                ?></td>
                <td><?php echo($elem->getProDate()); ?></td>
                <td><?php echo $elem->getProTime(); ?></td>
                <td><?php echo $elem->getProPlace(); ?></td>
                <td><span class="nom"><p><?php 
                    $personneManager = new PersonneManager($db);
                    $personne = $personneManager->getPerByNum($elem->getPerNum());
                    $prenom = $personne->getPerPrenom();
                    $nom = $personne->getPerNom();
                    echo "$prenom $nom" ?> </p> 
                    <span class="avis "> 
                        Moyenne des avis <?php
                            $avisManager = new AvisManager($db);
                            echo round($avisManager->getAvisMoyenne($elem->getPerNum()), 2.22)  ?: "N/A" ;
                        ?> Dernier avis : <?php
                            echo $avisManager->getAvisLastCom($elem->getPerNum()) ?: "N/A";
                        ?>
                    </span>
                    </td>
            </tr>
        <?php } ?>
        </table>
         <?php
        } else { 
            ?><p> <img src="image/erreur.png" alt="erreur"> Désolé, pas de trajet disponible ! </p><?php
        }
        unset($_SESSION["villeDep"]);
    } 
}else{
    ?><p> <img src="image/erreur.png" alt="erreur"> Page non autorisé ! </p><?php
}
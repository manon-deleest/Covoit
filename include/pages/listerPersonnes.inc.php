<?php
    
    $personneManager=new PersonneManager($db);
    $listePer = $personneManager->getAllPersonne();

if (empty($_GET["per_num"])){
    ?>
    <h1>Liste des personnes enregistrées </h1>

    <p>Actuellement <?php echo sizeof($listePer) ?> personnes enregistrées</p>
    <table><tr>
                <th>Numéro</th>
                <th>Nom</th>
                <th>Prénom</th>
            </tr> <?php
        foreach ($listePer as $per){
            ?> <tr>
            <td><b><a href="index.php?page=2&per_num=<?php echo $per->getPerNum() ?>"><?php echo $per->getPerNum(); ?></a></b></td>
            <td><?php echo $per->getPerNom();  ?></td>
            <td><?php echo $per->getPerPrenom(); ?></td>
            </tr> 
            <?php echo "\n" ;
        } ?>
    </table>
    <?php
    
}
else{
    $num=$_GET["per_num"]; 
    $pers = $personneManager->getPerByNum($num); 
    $etManager = new EtudiantManager($db);
    $salManager = new SalarieManager($db);
    $etudiant= $etManager->getEtudiantByNum($num); 

    if(!empty($etudiant)){ 
        $depManager= new DepartementManager($db);
        $villeManager= new VilleManager($db);  ?>
        <h1>Détail sur l'étudiant <?php echo $pers->getPerNom() ?></h1></br>
        
        <table>
            <tr>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>Département</th>
                <th>Ville</th>
            </tr>
            <tr>
                <td><?php echo $pers->getPerPrenom()?></td>
                <td><?php echo $pers->getPerMail()?></td>
                <td><?php echo $pers->getPerTel()?></td>
                <?php $depnum = $etudiant->getDepNum() ;
                $dep= $depManager->getDepartementByNum($depnum) ?>
                <td><?php echo $dep->getDepNom()?></td>
                <?php $villenum = $dep->getVilNumDep() ;
                $ville= $villeManager->getVilleByNum($villenum) ?>
                <td><?php echo $ville->getVilNom()?></td>
                
            </tr>
        </table>
        </br>
    <?php 
    } 
    else {
        $salarie= $salManager->getSalarieByNum($num);

        if(empty($salarie)){
            ?><h1><img src="image/erreur.png" alt="erreur"><?php echo $pers->getPerNom() ?> n'est pas un étudiant ni un salarié. </h1><?php
        }else{
            $fonctionManager= new FonctionManager($db);  ?>
            <h1>Détail sur le salarié <?php echo $pers->getPerNom() ?></h1></br>
            
        <table>
            <tr>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>TelPro</th>
                <th>Fonction</th>
            </tr>
            <tr>
                <td><?php echo $pers->getPerPrenom()?></td>
                <td><?php echo $pers->getPerMail()?></td>
                <td><?php echo $pers->getPerTel()?></td>
                <td><?php echo $salarie->getTelPro()?></td>

                <?php $fonnum = $salarie->getFonNum() ;
                $fon= $fonctionManager->getFonctionByNum($fonnum) ?>
                <td><?php echo $fon->getFonNom()?></td>
                
            </tr>
        </table>
        </br>
    <?php 
        }
    }
}
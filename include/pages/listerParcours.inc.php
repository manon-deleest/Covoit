<?php 
$ParcoursManager =new ParcoursManager($db); 
$VilleManager = new  VilleManager($db); 
$listeParcours = $ParcoursManager->getAllParcours(); 

?>
<h1>Liste des Parcours</h1>

<p>Actuellement <?php echo sizeof($listeParcours);?> parcours sont enregistrées</p>
<table>
	<tr><th>Numéro</th>
		<th>Nom Ville</th>
		<th>Nom Ville</th>
		<th>Nombre de kilomètre</th>
	</tr>
	<?php 
	foreach ($listeParcours AS $key =>$parcours){ 
		$ville1=$VilleManager->getVilleByNum($parcours->getVilNum1()); 
		$ville2=$VilleManager->getVilleByNum($parcours->getVilNum2());
		?>
		<tr><td><?php echo $parcours->getParNum();?></td>
        <td><?php echo $ville1->getVilNom();?> </td>
        <td><?php echo $ville2->getVilNom();?> </td>
        <td><?php echo $parcours->getParKm();?> </td></tr>
	<?php }?>
	</table>
	<br />
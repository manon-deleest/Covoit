<?php
$VilleManager =new VilleManager($db); 
$listeVille = $VilleManager->getAllVille(); 

?>
<h1>Liste des villes </h1>

<p>Actuellement <?php echo sizeof($listeVille);?> villes sont enregistré</p>
<table>
	<tr><th>Numéro</th><th>Nom</th></tr>
	<?php 
	foreach ($listeVille AS $key =>$ville){ ?>
		<tr><td><?php echo $ville->getVilNum();?></td>
        <td><?php echo $ville->getVilNom();?> </td></tr>
	<?php }?>
	</table>
	<br />



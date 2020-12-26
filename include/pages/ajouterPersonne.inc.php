
<?php
if (empty($_POST["rang"])&& (empty($_POST["per_nom"])||empty($_POST["per_prenom"])||empty($_POST["per_tel"])
||empty($_POST["per_mail"])||empty($_POST["per_pwd"]))&& empty($_POST["dep_libelle"]) 
&& empty($_POST["fon_libelle"])){?>
	<h1>Ajouter une personne</h1>
	<form action="#" method = "post" id = "AjouterVille" >
		<div >
			<label class="colonne1">Nom : </label><input type="text" id="nom" name ="per_nom">
			<label class="colonne2">Prenom : </label><input type="text" id="prenom" name ="per_prenom">
		</div>
		<div >
			<label class="colonne1">Téléphone : </label><input type="tel" id="tel" name ="per_tel">
	   		<label class="colonne2">Mail : </label><input type="email" id="mail" name ="per_mail">
		</div>
	   <div>
			<label class="colonne1">Login : </label><input type="text" id="login" name ="per_login">
			<label class="colonne2">Mot de passe : </label><input type="password" id="pwd" name ="per_pwd">
	   </div>
		
		<div >
			<label>Catégorie : </label>
  			<input type="radio" name="rang" value="etudiant" checked>
  			<label>Etudiant</label>
			<input type="radio" name="rang" value="salarie">
 			<label>Personel</label>
		</div>
   		<input type="submit" id="valider" value="Valider">
 	</form>
 <?php } 

 if (!empty($_POST["rang"])&& !empty($_POST["per_nom"])&& !empty($_POST["per_prenom"])&& !empty($_POST["per_tel"])
 && !empty($_POST["per_mail"]) && !empty($_POST["per_pwd"])){
	
	$mdpCrypte = sha1(sha1(mb_convert_encoding($_POST["per_pwd"],"UTF-8")).SALT); 
	
	$personneManager=new PersonneManager($db);
	$tab=[
        "per_nom"=>$_POST["per_nom"], 
        "per_prenom"=>$_POST["per_prenom"],
        "per_tel"=>$_POST["per_tel"],
		"per_mail"=>$_POST["per_mail"],
		"per_login"=>$_POST["per_login"],
		"per_pwd"=>$mdpCrypte
	];
	$personne=new Personne($tab);
	$retour= $personneManager->add($personne);
	$_SESSION["per_num"]=$personneManager->getIdFromNomTelMail($_POST["per_nom"], $_POST["per_tel"], $_POST["per_mail"]);  
	
	if ($_POST["rang"]=="etudiant"){?>
			<h1>Ajouter un étudiant </h1>
			<form action="#" method = "post" id = "AjouterEt">
			<label>Année : </label><select name="annee_libelle" id="depA">
				<?php
				$DivManager =new DivisionManager($db); 
				$listeanne = $DivManager->getAllDivision();             
				foreach ($listeanne AS $key =>$div){ ?>
					<option value="<?php echo $div->getDivNum();?>"><?php echo $div->getDivNom();?></option>
				<?php }
				echo "\n";?>           
				</select>

			<label>Département : </label><select name="dep_libelle" id="dep">
				<?php  
				$DepManager =new DepartementManager($db); 
				$listedep = $DepManager->getAllDepartement();  
				foreach ($listedep AS $key =>$dep){ ?>
					<option value="<?php echo $dep->getDepNum();?>"><?php echo $dep->getDepNom();?></option>
				<?php }
				echo "\n";?>           
				</select>
			<input type="submit" id="valider" value="Valider">
		</form>

			<?php
	}
	else{?>
			<h1>Ajouter un Salarié </h1>
			<form action="#" method = "post" id = "AjouterSal">
			<label>Téléphone professionnel : </label><input type="text" id="tel_pro" name ="sal_telPro">
			<label>Fonction : </label><select name="fon_libelle" id="fonct">
				<?php      
				$FonManager =new FonctionManager($db); 
				$listeFonct = $FonManager->getAllFonction();       
				foreach ($listeFonct AS $key =>$fonct){ ?>
					<option value="<?php echo $fonct->getFonNum();?>"><?php echo $fonct->getFonNom();?></option>
				<?php }
				echo "\n";?>           
				</select>
				<input type="submit" id="valider" value="Valider">
			</form>
			<?php
		}
}
	
if (!empty($_POST["annee_libelle"]) && !empty($_POST["dep_libelle"]) && !empty($_SESSION["per_num"])){
	$etudiantManager=new EtudiantManager($db); 
	$tab= ["per_num"=>$_SESSION["per_num"], "dep_num"=>$_POST["annee_libelle"],"div_num"=>$_POST["dep_libelle"] ]; 
	$etudiant=new Etudiant($tab); 
	$retour= $etudiantManager->add($etudiant);
	
	if ($retour) { ?>
		<p> <img src="image/valid.png" alt="valide"> L'étudiant a bien été ajouté. </p>
	<?php
	} else { ?>
		<p> <img src="image/erreur.png" alt="erreur"> L'étudiant n'a pas pu être ajouté. </p>
	<?php
	}
	
	unset($_SESSION['per_num']); //libereration de la variable de session.
}

if (!empty($_POST["sal_telPro"])  && !empty($_POST["fon_libelle"])){
	$salManager = new SalarieManager($db);
	$tab= ["per_num"=>$_SESSION["per_num"], "sal_telprof"=>$_POST["sal_telPro"], "fon_num"=>$_POST["fon_libelle"]]; 
	$salarie = new Salarie($tab);
	$retour = $salManager->add($salarie); 
	if ($retour) { ?>
		<p> <img src="image/valid.png" alt="valide"> Le salarié a bien été ajouté. </p>
	<?php 
	} else { ?>
		<p> <img src="image/erreur.png" alt="erreur"> Le salarié n'a pas pu être ajouté. </p>
	<?php 
	}
	
	unset($_SESSION['per_num']); //libereration de la variable de session.
}

?>
	
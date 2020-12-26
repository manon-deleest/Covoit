<?php
if(empty($_POST["par_km"])){ ?>
    </br>
    <form name="client" id="client" action="#" method="POST">
        <label>Ville 1 : </label>    
        <select name="vil_num1" id="ville1">
            <?php
            $VilleManager =new VilleManager($db); 
            $listeVille = $VilleManager->getAllVille(); 
            
            foreach ($listeVille AS $key =>$ville){ ?>
                <option value="<?php echo $ville->getVilNum();?>"><?php echo $ville->getVilNom();?></option>
            <?php }
            echo "\n";?>           
        </select>
        <label>Ville 2 : </label>    
        <select name="vil_num2" id="ville2">
            <?php            
            foreach ($listeVille AS $key =>$ville){ ?>
                <option value="<?php echo $ville->getVilNum();?>"><?php echo $ville->getVilNom();?></option>
            <?php }
            echo "\n";?>           
        </select>
        <label>Kilomètre  : </label><input min="1" required type="number" id="nomVille" name ="par_km">
        <input type="submit" id="valider" value="Valider">
    </form>
<?php
}else{
     
   $parcoursManager=new ParcoursManager($db);
   $parcours=new Parcours($_POST);
   $retour= $parcoursManager->add($parcours);
   if ($retour){
        ?> <p> <img src="image/valid.png" alt="valide"> Le parcours a bien été ajouté. </p><?php
   }else{
        ?> <p> <img src="image/erreur.png" alt="erreur"> Le parcours n'a pas pu être ajouté. </p><?php
   }
}
?>
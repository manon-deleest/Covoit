<?php
if (empty($_POST["Nombre"])){
    $_SESSION["nombre"] = serialize(new Nombre());
}
$personneManager = new PersonneManager($db); 
$_SESSION["nombre"] = serialize(new Nombre());
$valideNombre = unserialize($_SESSION["nombre"])->getSomme();

if (empty($_POST["utilisateur"]) ){ ?> 
    <h1>Pour vous connecter</h1>
    <form action="#" method="post" id="connexion">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="utilisateur" required>
        <label>Mot de passe :</label>
        <input type="password" name="mdp" required>       
        <div>
            <img src="./image/nb/<?php echo unserialize($_SESSION["nombre"])->getNombre1()?>.jpg" alt="rand1">
            <p>+</p>
            <img src="./image/nb/<?php echo unserialize($_SESSION["nombre"])->getNombre2()?>.jpg" alt="rand2">
            <p>=</p>
            <input type="text" name="Nombre" required>
        </div>
        <?php 
        $_SESSION["valideNombre"]=$valideNombre; 
        ?>
        <input type="submit" value="Valider">
    </form> <?php
    
} else {
    if($_SESSION["valideNombre"]!=$_POST["Nombre"]){
        ?><p><img src="image/erreur.png" alt="erreur"> Incorrect</></p><?php
    }else{
        if (empty($_SESSION["utilisateur"])){
            
            $utilisateur = $personneManager->getPersByLoginPwd($_POST["utilisateur"],sha1(sha1(mb_convert_encoding($_POST["mdp"],"UTF-8")).SALT));
            if (empty($utilisateur)) {
                ?> <p> <img src="image/erreur.png" alt="erreur"> Identifiant ou mot de passe incorrecte</p> <?php
            } else {
                $_SESSION["utilisateur"] = serialize($utilisateur);
                header('Location: index.php?page=0');
            }
        } else {
            header('Location: index.php?page=0');
        }
    }
    unset($_SESSION["valideNombre"]);
}

    
    
    
  


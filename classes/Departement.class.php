<?php
class Departement{
	// Attributs
	private $dep_num;
	private $dep_nom;
	private $vil_num; 
	
	public function __construct($valeurs = array()){
		if (!empty($valeurs))
			 	$this->affecte($valeurs);
	}

	public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'dep_num': $this->setDepNum($valeur); break;
							case 'dep_nom': $this->setDepNom($valeur); break;
							case 'vil_num': $this->setVilNumDep($valeur); break; 
				}
			}
	}

	public function getDepNum(){
    	return $this->div_num;
	}
	public function setDepNum($id){
        $this->div_num = $id;
	}

	public function getDepNom(){
    	return $this->dep_nom;
	}
	public function setDepNom($nom){
        $this->dep_nom = $nom;
	}

	public function getVilNumDep() {
		return $this->vil_num;
	}
	public function setVilNumDep($num){
	$this->vil_num=$num;
	}
}
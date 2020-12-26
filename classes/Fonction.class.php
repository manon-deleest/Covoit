<?php
class Fonction{
	private $fon_num;
	private $fon_libelle;
	
	public function __construct($valeurs = array()){
		if (!empty($valeurs))
			 	$this->affecte($valeurs);
	}

	public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'fon_num': $this->setFonNum($valeur); break;
							case 'fon_libelle': $this->setFonNom($valeur); break;
				}
			}
	}

	public function getFonNum(){
    	return $this->fon_num;
	}
	public function setFonNum($id){
        $this->fon_num = $id;
	}

	public function getFonNom(){
    	return $this->fon_libelle;
	}
	public function setFonNom($nom){
        $this->fon_libelle = $nom;
	}

	
	
}
<?php
class Salarie{
	private $per_num;
	private $sal_telprof;
	private $fon_num;
	
	public function __construct($valeurs = array()){
		if (!empty($valeurs))
			 	$this->affecte($valeurs);
	}

	public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'per_num': $this->setPerNumSal($valeur); break;
							case 'sal_telprof': $this->setTelPro($valeur); break;
							case 'fon_num': $this->setFonNum($valeur); break;
				}
			}
	}

	public function getPerNumSal(){
    	return $this->per_num;
	}
	public function setPerNumSal($id){
        $this->per_num = $id;
	}

	public function getTelPro(){
    	return $this->sal_telprof;
	}
	public function setTelPro($num){
        $this->sal_telprof = $num;
	}

	public function getFonNum(){
    	return $this->fon_num;
	}
	public function setFonNum($num){
        $this->fon_num = $num;
	}
	
}
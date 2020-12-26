<?php
class Propose{
	private $par_num;
	private $per_num;
	private $pro_date;
	private $pro_time; 
	private $pro_place;
	private $pro_sens; 
	
	public function __construct($valeurs = array()){
		if (!empty($valeurs))
			 	$this->affecte($valeurs);
	}

	public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'par_num': $this->setParNum($valeur); break;
							case 'per_num': $this->setPerNum($valeur); break;
							case 'pro_date': $this->setProDate($valeur); break;
							case 'pro_time': $this->setProTime($valeur); break;
							case 'pro_place': $this->setProPlace($valeur); break;
							case 'pro_sens': $this->setProSens($valeur); break;
				}
			}
	}

	public function getParNum(){
    	return $this->par_num;
	}
	public function setParNum($id){
        $this->par_num = $id;
	}

	public function getPerNum(){
    	return $this->per_num;
	}
	public function setPerNum($id){
        $this->per_num = $id;
	}

	public function getProDate(){
    	return $this->pro_date;
	}
	public function setProDate($date){
        $this->pro_date = $date;
	}

	public function getProTime(){
    	return $this->pro_time;
	}
	public function setProTime($time){
        $this->pro_time = $time;
	}

	public function getProPlace(){
    	return $this->pro_place;
	}
	public function setProPlace($nb_place){
        $this->pro_place = $nb_place;
	}

	public function getProSens(){
    	return $this->pro_sens;
	}
	public function setProSens($num){
        $this->pro_sens = $num;
	}
	
}
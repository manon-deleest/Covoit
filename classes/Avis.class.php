<?php
class Avis {
	// Attributs
    private $per_num;
    private $per_per_num;
	private $par_num;
	private $avi_comm;
    private $avi_note;
    private $avi_date;

	public function __construct($valeurs = array()){
		if (!empty($valeurs))
			 	$this->affecte($valeurs);
	}

	public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
                        case 'per_num': $this->setPerNum($valeur); break;
                        case 'per_per_num': $this->setPerPerNum($valeur); break;
                        case 'par_num': $this->setParNum($valeur); break;
						case 'avi_comm': $this->setAviComm($valeur); break;
						case 'avi_note': $this->setAviNote($valeur); break;
						case 'avi_date': $this->setAviDate($valeur); break;
				}
			}
	}

    public function getPerNum(){
    	return $this->per_num;
	}
	public function setPerNum($id){
        $this->per_num = $id;
    }
    
    public function getPerPerNum(){
    	return $this->per_per_num;
	}
	public function setPerPerNum($id){
        $this->per_per_num = $id;
    }
    
	public function getParNum(){
    	return $this->par_num;
	}
	public function setParNum($id){
        $this->par_num = $id;
	}

    public function getAviComm(){
    	return $this->avi_comm;
	}
	public function setAviComm($elem){
        $this->avi_comm = $elem;
    }
    
    public function getAviNote(){
    	return $this->avi_note;
	}
	public function setAviNote($elem){
        $this->avi_note = $elem;
    }
    
    public function getAviDate(){
    	return $this->avi_note;
	}
	public function setAviDate($elem){
        $this->avi_note = $elem;
	}
	
}

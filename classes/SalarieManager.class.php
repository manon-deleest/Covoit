<?php
class SalarieManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        public function add($salarie){

			$per_num= $salarie->getPerNumSal();
			$sal_telprof= $salarie->getTelPro(); 
			$fon_num= $salarie->getFonNum(); 
			

            $requete = $this->db->prepare(
				"INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES ('$per_num', '$sal_telprof', '$fon_num')");
			$retour=$requete->execute();
			
			$requete->closeCursor();
			return $retour;
        }

		public function getAllSalarie(){
            $listePersonne = array();

            $sql = 'SELECT * FROM salarie ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                $listePersonne[] = new Personne($personne);

            $requete->closeCursor();
            return $listePersonne;
		}

		public function getSalarieByNum($per_num){

			$salarie = NULL;
	
			$sql = "SELECT * FROM salarie WHERE per_num=$per_num";
			$requete = $this->db->prepare($sql);
            $requete->execute();
	
			while ($Salarie = $requete->fetch(PDO::FETCH_OBJ))
				$salarie = new Salarie($Salarie);
			
	
			$requete->closeCursor();
			return $salarie;
		}
	
}
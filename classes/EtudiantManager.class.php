<?php
class EtudiantManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        public function add($etudiant ){
			$per_num= $etudiant->getPerNumEt();
			$dep_num= $etudiant->getDepNum(); 
			$div_num= $etudiant->getDivNum(); 
			

            $requete = $this->db->prepare(
				"INSERT INTO etudiant (per_num, dep_num, div_num) VALUES ($per_num, $dep_num, $div_num)");
			$retour=$requete->execute();
			
			$requete->closeCursor();
			return $retour;
        }

		public function getAllEtudiant(){
            $listePersonne = array();

            $sql = 'SELECT per_num, dep_num, div_num FROM etudiant ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                $listePersonne[] = new Personne($personne);

            $requete->closeCursor();
            return $listePersonne;
		}

		public function getEtudiantByNum($per_num){

			$etudiantRetour = NULL;
	
			$sql = "SELECT * FROM etudiant  WHERE per_num=$per_num";
			$requete = $this->db->prepare($sql);
			$requete->execute();
			
	
			while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
				$etudiantRetour = new Etudiant($etudiant);
			
			$requete->closeCursor();
			return $etudiantRetour;
		}
	
}
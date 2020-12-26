<?php
class VilleManager {
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        public function add($ville){
            $requete = $this->db->prepare(
						'INSERT INTO ville (vil_nom) VALUES (:vil_nom);');

            $requete->bindValue(':vil_nom',$ville->getVilNom());

            $retour=$requete->execute();
			
			$requete->closeCursor();
			return $retour;
        }

		public function getAllVille(){
            $listeVille = array();

            $sql = 'SELECT vil_num, vil_nom FROM ville ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($ville = $requete->fetch(PDO::FETCH_OBJ))
                $listeVille[] = new Ville($ville);

            $requete->closeCursor();
            return $listeVille;
        }
        
        public function getVilleByNum($vil_num){

			$villeRetour = NULL;
	
			$sql = "SELECT * FROM ville  WHERE vil_num=$vil_num";
			$requete = $this->db->prepare($sql);
			$requete->execute();
			
	
			while ($ville = $requete->fetch(PDO::FETCH_OBJ))
				$villeRetour = new Ville($ville);
			
			$requete->closeCursor();
			return $villeRetour;
		}
}

?>


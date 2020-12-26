<?php
class FonctionManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        
		public function getAllFonction(){
            $listeFonction = array();

            $sql = 'SELECT fon_num, fon_libelle FROM fonction ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($fonct = $requete->fetch(PDO::FETCH_OBJ))
                $listeFonction[] = new Fonction($fonct);

            $requete->closeCursor();
            return $listeFonction;
        }
        
        public function getFonctionByNum($fon_num){

            $fonctionRetour = NULL;
            	
			$sql = "SELECT * FROM fonction WHERE fon_num=$fon_num";
			$requete = $this->db->prepare($sql);
            $requete->execute();
	
			while ($fonction = $requete->fetch(PDO::FETCH_OBJ))
				$fonctionRetour = new Fonction($fonction);
			
	
			$requete->closeCursor();
			return $fonctionRetour;
		}
	
}
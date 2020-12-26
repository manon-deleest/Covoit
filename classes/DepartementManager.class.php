<?php
class DepartementManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        
		public function getAllDepartement(){
            $listeDep = array();

            $sql = 'SELECT dep_num, dep_nom, vil_num FROM departement ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($departement = $requete->fetch(PDO::FETCH_OBJ))
                $listeDep[] = new Departement($departement);

            $requete->closeCursor();
            return $listeDep;
        }
        
        public function getDepartementByNum($dep_num){

			$depRetour = NULL;
	
			$sql = "SELECT * FROM departement  WHERE dep_num=$dep_num";
			$requete = $this->db->prepare($sql);
			$requete->execute();
			
	
			while ($dep = $requete->fetch(PDO::FETCH_OBJ))
				$depRetour = new Departement($dep);
			
			$requete->closeCursor();
			return $depRetour;
		}
}
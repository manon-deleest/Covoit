<?php
class ParcoursManager {
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
	   
		public function add($parcours ){
			$par_km=$parcours->getParKm();
			$vil_num1=$parcours->getVilNum1();
			$vil_num2=$parcours->getVilNum2(); 
			
            $requete = $this->db->prepare(
				"INSERT INTO parcours (par_km, vil_num1, vil_num2) VALUES ( $par_km, $vil_num1, $vil_num2)");
			$retour=$requete->execute();
			
			$requete->closeCursor();
			return $retour;
		}
		
		public function getAllParcours(){
            $listeParcours = array();

            $sql = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
                $listeParcours[] = new Parcours($parcours);

            $requete->closeCursor();
            return $listeParcours;
		}

		public function getVille(){

			$listeVilles = array();
	
			$req = $this->db->prepare("SELECT distinct vil_num, vil_nom 
			FROM parcours, ville 
			WHERE parcours.vil_num1 = ville.vil_num OR parcours.vil_num2 = ville.vil_num");
			$req->execute();
	
			while($ville = $req->fetch(PDO::FETCH_OBJ)){
				$listeVilles[] = new Ville($ville);
			}
	
			$req->closeCursor();
			return $listeVilles;
		}

		public function getVilleDep(){
			$listeVilles = array();
	
			$req = $this->db->prepare("SELECT distinct vil_num, vil_nom 
			FROM (
				SELECT vil_num1 FROM parcours 
				)T1, (
					SELECT vil_num2 FROM parcours
				)T2, ville
			WHERE T1.vil_num1 = ville.vil_num OR T2.vil_num2 = ville.vil_num");
			$req->execute();
	
			while($ville = $req->fetch(PDO::FETCH_OBJ)){
				$listeVilles[] = new Ville($ville);
			}
	
			$req->closeCursor();
			return $listeVilles;
		}

		public function getVillepossibleForVille($ville_num){
			$listeVilles = array();
	
			$req = $this->db->prepare(
				"SELECT vil_num, vil_nom FROM ville v, (
					SELECT v1.vil_num as vil1, v2.vil_num as vil2
					FROM parcours p, ville v1, ville v2 
					WHERE (vil_num1=$ville_num OR vil_num2 = $ville_num) AND p.vil_num1 = v1.vil_num AND p.vil_num2 = v2.vil_num 
				)Tab
				WHERE (Tab.vil1 = v.vil_num OR Tab.vil2 = v.vil_num) and v.vil_num != $ville_num");
			$req->execute();
	
			while($ville = $req->fetch(PDO::FETCH_OBJ)){
				$listeVilles[] = new Ville($ville);
			}
	
			$req->closeCursor();
			return $listeVilles;
		}

		public function getParcoursByVilles($ville1, $ville2){

			$req = $this->db->prepare("SELECT par_num, par_km ,V1.vil_num as vil_num1, V2.vil_num as vil_num2
				FROM parcours P, ville V1, ville V2 WHERE P.vil_num1 = V1.vil_num AND P.vil_num2 = V2.vil_num 
				AND (P.vil_num1 = $ville1 OR P.vil_num1 = $ville2) AND (P.vil_num2 = $ville2 OR P.vil_num2 = $ville1) 
				ORDER BY par_num");
			$req->execute();
			
			while($parcours = $req->fetch(PDO::FETCH_OBJ)){
				$parcoursTemp = new Parcours($parcours);
			}
			
	
			$req->closeCursor();
			return $parcoursTemp;
		}

		public function getParcoursByParNum($par_num){

			$req = $this->db->prepare("SELECT par_num, par_km ,vil_num1,vil_num2 
				FROM parcours
				WHERE par_num = $par_num");
			$req->execute();
	
			while($parcour = $req->fetch(PDO::FETCH_OBJ)){
				$parcoursTemp = new Parcours($parcour);
			}
	
			$req->closeCursor();
			return $parcoursTemp;
		}
}

?>


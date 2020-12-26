<?php
class ProposeManager {
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        public function add($propose){

			$par_num=$propose->getParNum();
			$per_num=$propose->getPerNum();
			$pro_date=$propose->getProDate();
			$pro_time=$propose->getProTime() ;
			$pro_place=$propose->getProPlace();
			$pro_sens=$propose->getProSens(); 
			

            $requete = $this->db->prepare("INSERT INTO propose (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES ($par_num, $per_num, '$pro_date', '$pro_time', $pro_place, $pro_sens)");
			$retour=$requete->execute();
			
			$requete->closeCursor();
			return $retour;
        }

		public function getProposition($villeDep, $villeArr, $time, $date, $precision){

			
			$listeProposition = array();
			$date_max = date('Y-m-d', strtotime($date.' +'.$precision.' days'));
        	$date_min = date('Y-m-d', strtotime($date.' -'.$precision.' days'));
			

			$req = $this->db->prepare("SELECT * FROM propose pr, parcours pa 
			WHERE pa.par_num=pr.par_num AND pro_time > '$time' AND pro_date BETWEEN '$date_min' AND 
			'$date_max' AND ((pa.vil_num1 = $villeDep AND pa.vil_num2 =$villeArr AND pro_sens= 0) 
			OR (pa.vil_num2 = $villeDep AND pa.vil_num1 =$villeArr AND pro_sens= 1))");
			$req->execute();
			
			while ($proposition = $req->fetch(PDO::FETCH_OBJ)){
				$listeProposition[] = new Propose($proposition);
			}

	
			$req->closeCursor();
			return $listeProposition;
		}

}

?>


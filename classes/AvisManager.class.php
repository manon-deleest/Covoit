<?php
class AvisManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        
		public function getAllAvis(){
            $listeAvis = array();

            $sql = 'SELECT per_num, per_per_num, par_num, avi_comm, avi_note, avi_date FROM avis';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($avis = $requete->fetch(PDO::FETCH_OBJ))
                $listeAvis[] = new Avis($avis);

            $requete->closeCursor();
            return $listeAvis;
        }

        public function getAvisMoyenne($per_num){
            
            $sql=("SELECT AVG(avi_note) as avi_moyenne FROM avis WHERE per_per_num=$per_num");
            
            $requete = $this->db->prepare($sql);
            $requete->execute();
    
            $moyenne = $requete->fetch(PDO::FETCH_OBJ)->avi_moyenne;
    
            return $moyenne;
        }
    
        public function getAvisLastCom($per_num){
            $sql=("SELECT max(avi_date), avi_comm FROM avis WHERE per_per_num=$per_num GROUP BY avi_date, avi_comm");
            
            $requete = $this->db->prepare($sql);
            $requete->execute();
            
            if($requete){
                $comment= $requete->fetch(PDO::FETCH_OBJ)->avi_comm;
            }else{
                return null; 
            }
            
    
            return $comment;
        }
        
        
}
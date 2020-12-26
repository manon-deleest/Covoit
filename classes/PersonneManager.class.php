<?php
class PersonneManager {
	private $db;

		public function __construct($db){
			$this->db = $db;
		}
        public function add($personne){

			$per_nom= $personne->getPerNom();
			$per_prenom= $personne->getPerPrenom();
			$per_tel= $personne->getPerTel();
			$per_mail= $personne->getPerMail();
			$per_login= $personne->getPerLogin();
			$per_pwd = $personne->getPerPwd();

            $requete = $this->db->prepare(
				"INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) 
				VALUES ('$per_nom', '$per_prenom', '$per_tel', '$per_mail', '$per_login', '$per_pwd')");
			$retour=$requete->execute();
			
			$requete->closeCursor();
			return $retour;
        }

		public function getAllPersonne(){
            $listePersonne = array();

            $sql = 'SELECT per_num,per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd 
				FROM personne ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                $listePersonne[] = new Personne($personne);

            $requete->closeCursor();
            return $listePersonne;
		}

		public function getIdFromNomTelMail($per_nom, $per_tel, $per_mail){
			
			$sql = "SELECT per_num FROM personne WHERE per_tel='$per_tel' AND per_nom='$per_nom' AND per_mail='$per_mail'"; 

			$requete = $this->db->prepare($sql);
            $requete->execute();

			$num = $requete->fetch(PDO::FETCH_OBJ)->per_num;
            $requete->closeCursor();
            return $num;
		}

		public function getPerByNum($per_num){
			$personne = array();

            $sql = "SELECT * FROM personne WHERE per_num = $per_num";

            $requete = $this->db->prepare($sql);
			$requete->execute();
			
            while ($pers = $requete->fetch(PDO::FETCH_OBJ))
                $personne = new Personne($pers);

            $requete->closeCursor();
            return $personne;
		}


		public function modifPer($personne){
			$per_num = $personne->getPerNum();
			$per_nom= $personne->getPerNom();
			$per_prenom= $personne->getPerPrenom();
			$per_tel= $personne->getPerTel();
			$per_mail= $personne->getPerMail();
			
			$sql=("UPDATE personne SET per_nom='$per_nom', per_prenom='$per_prenom', per_mail='$per_mail', per_tel='$per_tel' WHERE per_num=$per_num");
			$requete = $this->db->prepare($sql);
			$retour = $requete->execute();
			
			$requete->closeCursor();
			return $retour;
		}

		public function supprimerPer($per_num){
			$sql=("DELETE FROM propose WHERE per_num=$per_num");
			$requete = $this->db->prepare($sql);
			$requete->execute();

			$sql=("DELETE FROM avis WHERE per_num=$per_num OR per_per_num=$per_num");
			$requete = $this->db->prepare($sql);
			$retour =$requete->execute();

			$sql=("DELETE FROM etudiant WHERE per_num=$per_num");
			$requete = $this->db->prepare($sql);
			$requete->execute();

			$sql=("DELETE FROM salarie WHERE per_num=$per_num");
			$requete = $this->db->prepare($sql);
			$requete->execute();

			$sql=("DELETE FROM personne WHERE per_num=$per_num");
			$requete = $this->db->prepare($sql);
			$retour =$requete->execute();

			$requete->closeCursor();
	
			return $retour;
		}

		public function getPersByLoginPwd($login, $pwd){

			$personneRetour = null;
	
			$req = $this->db->prepare("SELECT * FROM personne WHERE per_login='$login' AND per_pwd='$pwd'");
			$req->execute();
	
			while ($personne = $req->fetch(PDO::FETCH_OBJ)){
				$personneRetour = new Personne($personne);
			}
			$req->closeCursor();
			return $personneRetour;
		}

}

?>


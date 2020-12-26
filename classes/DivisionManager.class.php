<?php 
class DivisionManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}

		public function getAllDivision(){
            $listeDiv = array();

            $sql = 'SELECT div_num, div_nom FROM division ORDER BY 2';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($division = $requete->fetch(PDO::FETCH_OBJ))
                $listeDiv[] = new Division($division);

            $requete->closeCursor();
            return $listeDiv;
		}
}
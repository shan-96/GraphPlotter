<?php
class dataset {
    private $db;
	
	function __construct($db){
	//	parent::__construct();
	
		$this->_db = $db;
	}

	public function is_present_datasetid($id){	

		try {

			$stmt = $this->_db->prepare('SELECT id FROM dataset WHERE id = :id');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			$row = $stmt->rowCount();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function isPresent ($uid,$did){	

		try {

			$stmt = $this->_db->prepare('SELECT * FROM uac WHERE uid = :uid AND did = :did');
			$stmt->bindParam(':uid',$uid);
			$stmt->bindParam(':did',$did);
			$stmt->execute();
			$row = $stmt->rowCount();
			if($row != 0) return TRUE;
			else return FALSE;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function all_names (){	

		try {

			$stmt = $this->_db->prepare(' SELECT id,name FROM dataset');
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}
	public function all_names1 ($uid){	

		try {

			$stmt = $this->_db->prepare(' SELECT id,name FROM dataset where id not in (select did from uac where uid = :uid)');
			$stmt->bindParam(':uid',$uid);
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	public function uac_names ($uid){	

		try {

			$stmt = $this->_db->prepare(' SELECT did,name FROM uac inner join dataset on uac.did = dataset.id AND uac.uid = :uid');
			$stmt->bindParam(':uid',$uid);
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}


	public function details ($id){	

		try {

			$stmt = $this->_db->prepare(' SELECT name,label_x,label_y FROM dataset WHERE id = :id ');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			
			$row = $stmt->fetch();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	public function delete ($id){	

		try {

			$stmt = $this->_db->prepare(' DELETE FROM dataset WHERE id = :id ');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			
			//$row = $stmt->fetch();
			//return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	
	public function insert ($name,$label_x,$label_y,$uid){	

		try {

			$stmt = $this->_db->prepare(' SELECT max(id) as x FROM dataset');
			$stmt->execute();
			$row = $stmt->fetch();
			$max=$row['x']+1;

			$stmt = $this->_db->prepare('INSERT INTO dataset (id,name,label_x,label_y) values (:max,:name,:xlabel,:ylabel)');
			$stmt->bindParam(':max',$max);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':xlabel',$label_x);
			$stmt->bindParam(':ylabel',$label_y);
			$stmt->execute();

			$stmt = $this->_db->prepare('INSERT INTO uac (uid,did) values (:uid,:max)');
			$stmt->bindParam(':max',$max);
			$stmt->bindParam(':uid',$uid);
			$stmt->execute();

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}


	public function update ($id,$name,$label_x,$label_y){	

		try {
			
			
			$stmt = $this->_db->prepare('UPDATE dataset set name=:name , label_x=:xlabel ,label_y=:ylabel  where id=:id ');
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':xlabel',$label_x);
			$stmt->bindParam(':ylabel',$label_y);
			$stmt->execute();
			//return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}	
	
	
}


?>
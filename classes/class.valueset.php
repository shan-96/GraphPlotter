<?php
class valueset {
    private $db;
	
	function __construct($db){
	//	parent::__construct();
	
		$this->_db = $db;
	}

	public function is_present_valueid($id,$did){	

		try {

			$stmt = $this->_db->prepare('SELECT id FROM valueset WHERE id = :id AND dataset_id= :did');
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':did',$did);
			$stmt->execute();
			$row = $stmt->rowCount();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function delete($id){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM valueset WHERE id = :id');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}


	public function delete_dataset($id){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM valueset WHERE dataset_id = :id');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function delete_valueset($id,$vid){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM valueset WHERE dataset_id = :id AND valueset_id=:vid');
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':vid',$vid);
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function delete_name($id,$vid){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM valueset_name WHERE dataset_id = :id AND valueset_id=:vid');
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':vid',$vid);
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function delete_name2($id){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM valueset_name WHERE dataset_id = :id');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}



	
	public function details ($id){	

		try {

			$stmt = $this->_db->prepare(' SELECT dataset_id,valueset_id,coord_x,coord_y,pos_no FROM valueset WHERE id = :id ');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			
			$row = $stmt->fetch();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}
	

	public function dataset_details ($dataset_id){	

		try {

			$stmt = $this->_db->prepare(' SELECT id,valueset_id,coord_x,coord_y,pos_no FROM valueset WHERE dataset_id = :id order by valueset_id,pos_no');
			$stmt->bindParam(':id',$dataset_id);
			$stmt->execute(); 
			
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	public function valueset_details ($dataset_id,$valueset_id){	

		try {

			$stmt = $this->_db->prepare(' SELECT id,coord_x,coord_y,pos_no FROM valueset WHERE dataset_id = :id AND valueset_id = :vid');
			$stmt->bindParam(':id',$dataset_id);
			$stmt->bindParam(':vid',$valueset_id);
			$stmt->execute();
			
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}
	
	public function get_valueset ($dataset_id){	

		try {

			$stmt = $this->_db->prepare(' SELECT distinct valueset_id FROM valueset WHERE dataset_id = :id ');
			$stmt->bindParam(':id',$dataset_id);
			
			$stmt->execute();
			
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	public function valueset_name ($dataset_id,$valueset_id){	

		try {

			$stmt = $this->_db->prepare(' SELECT name FROM valueset_name WHERE dataset_id = :id AND valueset_id = :vid');
			$stmt->bindParam(':id',$dataset_id);
			$stmt->bindParam(':vid',$valueset_id);
			$stmt->execute();
			
			$row = $stmt->fetch();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}



	public function insert ($coord_x,$coord_y,$dataset_id,$valueset_id,$pos_no){	

		try {

	
			$stmt = $this->_db->prepare('INSERT INTO valueset (coord_x,coord_y,dataset_id,valueset_id,pos_no) values (:xc,:yc,:did,:vsid,:pno)');
			
			$stmt->bindParam(':xc',$coord_x);
			$stmt->bindParam(':yc',$coord_y);
			$stmt->bindParam(':did',$dataset_id);
			$stmt->bindParam(':vsid',$valueset_id);
			$stmt->bindParam(':pno',$pos_no);
	//		$stmt->execute(array ('name'	=> $name,'xlabel'=>$label_x,'ylabel'=>$label_y));
			$stmt->execute();
		

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	public function insert_name ($dataset_id,$valueset_id,$name){	

		try {

	
			$stmt = $this->_db->prepare('INSERT INTO valueset_name (dataset_id,valueset_id,name) values (:did,:vsid,:name)');
			
			
			$stmt->bindParam(':did',$dataset_id);
			$stmt->bindParam(':vsid',$valueset_id);
			$stmt->bindParam(':name',$name);
	//		$stmt->execute(array ('name'	=> $name,'xlabel'=>$label_x,'ylabel'=>$label_y));
			$stmt->execute();
		

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}




	public function update ($id,$coord_x,$coord_y,$dataset_id,$valueset_id,$pos_no){	

		try {

			$stmt = $this->_db->prepare('UPDATE valueset set  coord_x= :xc ,coord_y=:yc , dataset_id= :did ,valueset_id=:vsid ,pos_no=:pno where id=:id ');
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':xc',$coord_x);
			$stmt->bindParam(':yc',$coord_y);
			$stmt->bindParam(':did',$dataset_id);
			$stmt->bindParam(':vsid',$valueset_id);
			$stmt->bindParam(':pno',$pos_no);
			//echo $stmt;
			$stmt->execute();
			//return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}	
	

	public function update_name ($dataset_id,$valueset_id,$name){	

		try {

			$stmt = $this->_db->prepare('UPDATE valueset_name set  name=:name where dataset_id= :did  AND valueset_id=:vsid');
			
			$stmt->bindParam(':did',$dataset_id);
			$stmt->bindParam(':vsid',$valueset_id);
			$stmt->bindParam(':name',$name);
			//echo $stmt;
			$stmt->execute();
			//return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}


	
}


?>
<?php
class graph_db {
    private $db;
	
	function __construct($db){
	//	parent::__construct();
	
		$this->_db = $db;
	}

	public function is_present($gid,$vid){	

		try {

			$stmt = $this->_db->prepare('SELECT count(*) as x FROM graph2 WHERE gid = :id AND vid = :vid');
			$stmt->bindParam(':id',$gid);
			$stmt->bindParam(':vid' , $vid);
			$stmt->execute();
			$row = $stmt->fetch();
			return $row['x'];

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function isPresent($uid,$gid){	

		try {

			$set = $this -> details($gid);
			$did = $set['did'];
			$stmt = $this->_db->prepare('SELECT * FROM uac where uid = :uid AND did = :did ');
			//$stmt->bindParam(':id',$gid);
			$stmt->bindParam(':uid' , $uid);
			$stmt ->bindParam(':did',$did);
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

			$stmt = $this->_db->prepare(' SELECT gid,name FROM graph1');
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	public function all_names1 ($uid){	

		try {

			$stmt = $this->_db->prepare(' SELECT gid,name FROM graph1 WHERE did NOT in (select did from uac where uid = :uid)');
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

			$stmt = $this->_db->prepare(' SELECT gid,name FROM uac inner join graph1 on uac.did = graph1.did AND uac.uid = :uid');
			$stmt->bindParam(':uid',$uid);
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}


	public function delete($id){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM graph1 WHERE gid = :id');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			$stmt = $this->_db->prepare('DELETE FROM graph2 WHERE gid = :id');
			$stmt->bindParam(':id',$id);
			$stmt->execute();

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}



	public function delete_valueset($gid,$vid){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM graph2 WHERE gid = :gid AND vid=:vid');
			$stmt->bindParam(':gid',$gid);
			$stmt->bindParam(':vid',$vid);
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function delete_allvalueset($gid){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM graph2 WHERE gid = :gid');
			$stmt->bindParam(':gid',$gid);
			
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}
	
	public function delete_type1($did){	

		try {
			
			$stmt = $this->_db->prepare(' SELECT gid FROM graph1 WHERE did = :did ');
			$stmt->bindParam(':did',$did);
			$stmt->execute();
			
			$row = $stmt->fetch();

			$stmt = $this->_db->prepare('DELETE FROM graph1 WHERE did = :did');
			$stmt->bindParam(':did',$did);
			$stmt->execute();
			foreach($row as $r){
				$stmt = $this->_db->prepare('DELETE FROM graph2 WHERE gid = :gid');
				$stmt->bindParam(':gid',$r);
				$stmt->execute();
			}
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}
	
	

	public function delete_type2($did,$vid){	

		try {

			$stmt = $this->_db->prepare('DELETE FROM graph2 WHERE gid IN (SELECT gid FROM graph1 WHERE did = :did) AND vid = :vid');
			$stmt->bindParam(':did',$did);
			$stmt->bindParam(':vid',$vid);
			$stmt->execute();
			

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	
	public function details ($id){	

		try {

			$stmt = $this->_db->prepare(' SELECT * FROM graph1 WHERE gid = :id ');
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			
			$row = $stmt->fetch();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}
	


	public function valueset_details ($id){	

		try {

			$stmt = $this->_db->prepare(' SELECT vid FROM graph2 WHERE gid = :id ');
			$stmt->bindParam(':id',$id);
		
			$stmt->execute();
			
			$row = $stmt->fetchAll();
			return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}


	public function insert_graph1 ($did,$name,$type,$subtitle,$tooltip,$mousetracking,$datalabels,$shadow,$backgroundColor,$legendBackgroundColor,$borderColor,$borderWidth,$height,$width,$minimum,$plotBackgroundColor){	

		try {
			//$uid = $_SESSION['id'];
			$stmt = $this->_db->prepare(' SELECT max(gid) as x FROM graph1');
			$stmt->execute();
			$row = $stmt->fetch();
			$max=$row['x']+1;
			$stmt = $this->_db->prepare('INSERT INTO graph1 (gid,did,name,type,subtitle,tooltip,mousetracking,datalabels,shadow,backgroundColor,legendBackgroundColor,borderColor,borderWidth,height,width,minimum, plotBackgroundColor) values (:gid,:did,:name,:type,:subtitle,:tooltip,:mousetracking,:datalabels,:shadow,:backgroundColor,:legendBackgroundColor,:borderColor,:borderWidth,:height,:width,:minimum,:plotBackgroundColor)');
			
			$stmt->bindParam(':did',$did);
			
			$stmt->bindParam(':gid',$max);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':type',$type);
			$stmt->bindParam(':subtitle',$subtitle);
			$stmt->bindParam(':tooltip',$tooltip);
			$stmt->bindParam(':mousetracking',$mousetracking);
			$stmt->bindParam(':datalabels',$datalabels);
			$stmt->bindParam(':shadow',$shadow);
			$stmt->bindParam(':backgroundColor',$backgroundColor);
			$stmt->bindParam(':legendBackgroundColor',$legendBackgroundColor);
			$stmt->bindParam(':borderColor',$borderColor);
			$stmt->bindParam(':borderWidth',$borderWidth);
			$stmt->bindParam(':height',$height);
			$stmt->bindParam(':width',$width);
			$stmt->bindParam(':minimum',$minimum);
			$stmt->bindParam(':plotBackgroundColor',$plotBackgroundColor);

	//		$stmt->execute(array ('name'	=> $name,'xlabel'=>$label_x,'ylabel'=>$label_y));
			$stmt->execute();
			//$set=$stmt->fetch();	
			return $max;
		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}

	public function insert_graph2 ($gid,$vid){	

		try {

			foreach($vid as $i){
			$stmt = $this->_db->prepare('INSERT INTO graph2 (gid,vid) values (:gid,:vid)');
			
			
			$stmt->bindParam(':gid',$gid);
			$stmt->bindParam(':vid',$i);
			
	//		$stmt->execute(array ('name'	=> $name,'xlabel'=>$label_x,'ylabel'=>$label_y));
			$stmt->execute();
		}

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}




	public function update ($gid,$did,$name,$type,$subtitle,$tooltip,$mousetracking,$datalabels,$shadow,$backgroundColor,$legendBackgroundColor,$borderColor,$borderWidth,$height,$width,$minimum,$plotBackgroundColor){	

		try {

			$stmt = $this->_db->prepare('UPDATE graph1 set  name=:name ,type=:type , subtitle=:subtitle ,tooltip=:tooltip ,mousetracking=:mousetracking,datalabels=:datalabels,shadow=:shadow,backgroundColor=:backgroundColor,legendBackgroundColor=:legendBackgroundColor	
			 ,borderColor=:borderColor,borderWidth=:borderWidth,height=:height,width=:width,minimum=:minimum, plotBackgroundColor=:plotBackgroundColor where gid=:id ');
			
			$stmt->bindParam(':id',$gid);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':type',$type);
			$stmt->bindParam(':subtitle',$subtitle);
			$stmt->bindParam(':tooltip',$tooltip);
			$stmt->bindParam(':mousetracking',$mousetracking);
			$stmt->bindParam(':datalabels',$datalabels);
			$stmt->bindParam(':shadow',$shadow);
			$stmt->bindParam(':backgroundColor',$backgroundColor);
			$stmt->bindParam(':legendBackgroundColor',$legendBackgroundColor);
			$stmt->bindParam(':borderColor',$borderColor);
			$stmt->bindParam(':borderWidth',$borderWidth);
			$stmt->bindParam(':height',$height);
			$stmt->bindParam(':width',$width);
			$stmt->bindParam(':minimum',$minimum);
			$stmt->bindParam(':plotBackgroundColor',$plotBackgroundColor);
			$stmt->execute();
			//return $row;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}	
	}
	
/*
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
*/

	
}


?>
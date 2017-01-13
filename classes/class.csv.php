<?php

class csv {
    private $db;
	
	//public $file = "../csv/filename.csv"
	
	function __construct($db){
	//	parent::__construct();
	
		$this->_db = $db;
	}
	
	public function validate_file($file){
		$result = array();
		$fileptr = fopen($file, "r") or die("Unable to open file!");
		$filedata = fgets($fileptr);
		$filedata = explode("\r",$filedata);
		$numbers = array("1","2","3","4","5","6","7","8","9","0");
		
		if(!in_array($filedata[1],$numbers)){
			$result["success"] = false;
			$result["msg"] = "You need to specify number of valuesets on line 2";
			return $result;
		}
		
		$dataset = explode(",",$filedata[0]);
		
		if(count($dataset) != 3){
			$result["success"] = false;
			$result["msg"] = "Dataset format uncorrect.";
			return false;
		}
		
		for($i=2; $i<((int)$filedata[1]+2); $i++){
			$valueset = explode(",",$filedata[$i]);
			if(count($valueset) != (int)$filedata[1]){
				$result["success"] = false;
				$result["msg"] = "Valueset format uncorrect.";
				return $result;
			}
		}
		
		while($i<count($filedata)){
			$values = explode(",",$filedata[$i]);
			if(count($values) != 4){
				$result["success"] = false;
				$result["msg"] = "Values not entered as per format";
				return $result;
			}
			$i++;
		}
		
		if($i != count($filedata)){
			$result["success"] = false;
			$result["msg"] = "Something went wrong. Check the file. Strictly follow the rules above.";
			return $result;
		}else{
			//validation success
			$result["success"] = true;
			$result["msg"] = " Your file is validated";
			return $result;
		}
		
		fclose($fileptr);
	}
	
	public function parseData($file){
		$fileptr = fopen($file, "r") or die("Unable to open file!");
		$filedata = fgets($fileptr);
		$filedata = explode("\r",$filedata);
		$linedata = explode(",",$filedata[0]);
		$datasetname = $linedata[0];
		$xlabel = $linedata[1];
		$ylabel = $linedata[2];
		
		try {

			$stmt = $this->_db->prepare(' SELECT max(id) as x FROM dataset');
			$stmt->execute();
			$row = $stmt->fetch();
			$max=$row['x']+1;

			$stmt = $this->_db->prepare('INSERT INTO dataset (id,name,label_x,label_y) values (:max,:name,:xlabel,:ylabel)');
			$stmt->bindParam(':max',$max);
			$stmt->bindParam(':name',$datasetname);
			$stmt->bindParam(':xlabel',$xlabel);
			$stmt->bindParam(':ylabel',$ylabel);
			$stmt->execute();
			$uid = $_SESSION['id'];
			$stmt = $this->_db->prepare('INSERT INTO uac (uid,did) values (:uid,:max)');
			$stmt->bindParam(':max',$max);
			$stmt->bindParam(':uid',$uid);
			$stmt->execute();
			
			//dataset inserted. now insert valueset names. for that we need did.			
			try{
				$stmt = $this->_db->prepare('SELECT id FROM dataset WHERE id = :max');
				$stmt->bindParam(':max',$max);
				$stmt->execute();	
				$row = $stmt->fetch();
				$did = $row['id'];
				$result = " Dataset created.";
				
				$n = (int)$filedata[1];
				$vids = array(); $vnames = array();
				for($i=0;$i<$n;$i++){
					$vlist = explode(",",$filedata[2+$i]);
					$vids[$i] = $vlist[0];
					$vnames[$i] = $vlist[1];
					//we have vids and vnames for the valueset_name table.
					try {
						$stmt = $this->_db->prepare('INSERT INTO valueset_name (dataset_id,valueset_id,name) values (:did,:vsid,:name)');
						$stmt->bindParam(':did',$did);
						$stmt->bindParam(':vsid',$vids[$i]);
						$stmt->bindParam(':name',$vnames[$i]);
						$stmt->execute();
						$result .= " valueset names inserted.";
					} catch(PDOException $e) {
							echo '<p class="error">'.$e->getMessage().'</p>';
					}
				}
				
				while(isset($filedata[$i+$n])){
					$vdata = explode(",",$filedata[$i+$n]);
					$vid = $vdata[0];
					$xc = $vdata[1];
					$yc = $vdata[2];
					$pos = $vdata[3];
					$i++;
					//now insert the data into valueset table
					try {	
						$stmt = $this->_db->prepare('INSERT INTO valueset (coord_x,coord_y,dataset_id,valueset_id,pos_no) values (:xc,:yc,:did,:vsid,:pno)');								
						$stmt->bindParam(':xc',$xc);
						$stmt->bindParam(':yc',$yc);
						$stmt->bindParam(':did',$did);
						$stmt->bindParam(':vsid',$vid);
						$stmt->bindParam(':pno',$pos);
						$stmt->execute();
					} catch(PDOException $e) {
						echo '<p class="error">'.$e->getMessage().'</p>';
					}
				}
				$result .= " valueset data is inserted.<br>Your dataset is ready!";
				
			}catch(PDOException $e){
				echo '<p class="error">'.$e->getMessage().'</p>';
			}
		
		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}		
		
		return $result;
	}
	
}


?>
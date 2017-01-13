<!DOCTYPE html>
<?php require_once("header.php");
	if( !$user2->is_logged_in() ){ header('Location: login.php'); }
?> 


  <?php
    if(isset($_GET['type'])){

     $type=$_GET['type'];
     $did=$_GET['did'];
		//$set2 = $dataset->details($did);
    $uid = $_SESSION['id'];
	if($dataset->isPresent($uid,$did)){
      if($type==1){

                
        $valueset->delete_dataset($did);
        $valueset->delete_name2($did);
        $dataset->delete($did);
        $graph_db->delete_type1($did);


      }

       if($type==2){

          $did=$_GET['did'];
          $vid=$_GET['vid'];


        $valueset->delete_name($did,$vid);
        $valueset->delete_valueset($did,$vid);
        $graph_db->delete_type2($did,$vid);

      }

       if($type==3){

        $id=$_GET['id'];
        $valueset->delete($id);

       
      }

	if($type==1) header('Location: index.php' );
    header('Location: display_dataset.php?id='.$did );
	}
	else
		
    header('Location: index.php' );
    
    }


  ?>

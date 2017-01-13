<!DOCTYPE html>
<?php require_once("header.php");
	if( !$user2->is_logged_in() ){ header('Location: login.php'); }
?> 
 <style>
table, th, td {
    text-align: center;
    border-collapse: collapse;
    padding: 3px;
}
</style> 
  
<?php

    if(isset($_GET['id'])){ 
        $id= $_GET['id'] ; 
        if(! $dataset->is_present_datasetid($id)) 
            header('Location: index.php');
        $set = $valueset->dataset_details($id);
        $set2 = $dataset->details($id);
        $uid = $_SESSION['id'];
        echo "<h3> DATASET : &nbsp ".$set2['name']."</h3>&nbsp <b>X Label :</b> ".$set2['label_x']."&nbsp&nbsp&nbsp <b> Y Label : </b>".$set2['label_y']."&nbsp&nbsp&nbsp&nbsp&nbsp";
		if($dataset->isPresent($uid,$id)){
        echo "<a href='edit.php?type=1&did=".$id."'> edit </a>";
        echo "&nbsp&nbsp<a  href='delete.php?type=1&did=".$id."'> delete </a><br><br><br>";
		}
        $i=0;
        $pre_vid=0;
        $pos=0;
        
        echo "<h4> VALUESETS </h4><table>";
        while (isset($set[$i]))
            {
              if ($pre_vid != $set[$i]['valueset_id'])
                  {
                    echo "</table>";
					if($dataset->isPresent($uid,$id)){
                      if($pre_vid!=0)
                              echo " <a href='add_value.php?did=".$id."&vid=".$pre_vid."&pos=".$pos."'> Add value </a><br><br><br> ";
                    }
                    $set3=$valueset->valueset_name($id,$set[$i]['valueset_id']);
                    echo "<b> Name  : ".$set3['name'];
					if($dataset->isPresent($uid,$id)){
                    echo "</b><a href='edit.php?type=2&did=".$id."&vid=".$set[$i]['valueset_id']."'>&nbsp&nbsp edit </a>";
                    echo "<a  href='delete.php?type=2&did=".$id."&vid=".$set[$i]['valueset_id']."'> &nbsp &nbsp delete </a>";
					}
                    echo "<table>";
                    echo "<tr><td><b> Position </td><td><b> X coord value </td><td><b> Y coord value </td><td> </td><td> </td></tr> </b>  ";
                    $pre_vid = $set[$i]['valueset_id'];
                    
                  }

              echo "<tr><td> ".$set[$i]["pos_no"]."</td><td> ".$set[$i]['coord_x']."</td><td> ".$set[$i]['coord_y']."";
			  if($dataset->isPresent($uid,$id)){
              echo "</td><td> <a href='edit.php?type=3&did=".$id."&id=".$set[$i]['id']."'> edit </a>";
              echo "</td><td> <a href='delete.php?type=3&did=".$id."&id=".$set[$i]['id']."'> delete </a></td></tr>";
			  }

              $pos= $set[$i]["pos_no"]+1;
              $i++; 
            }
             
        echo "</table>";
		if($dataset->isPresent($uid,$id)){
        if($pre_vid!=0)
            echo " <a href='add_value.php?did=".$id."&vid=".$pre_vid."&pos=".$pos."'> Add value </a><br><br>";

        $pre_vid++;
            echo "<br><br><br> <a href='add_value.php?did=".$id."&vid=".$pre_vid."'> Add Value Set </a>";
		}
    }
      
  else  header('Location: index.php');
?>
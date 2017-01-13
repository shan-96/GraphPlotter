<!DOCTYPE html>
<?php require_once("header.php");
	if( !$user2->is_logged_in()  ){ header('Location: login.php'); }
?> 

  <?php
    if(isset($_POST['type'])){

     $did=$_POST['did'];
      if($_POST['type']==1){

         
        $dataset->update($did,$_POST['name'],$_POST['label_x'],$_POST['label_y']);
        

      }

       if($_POST['type']==2){

        $name=$_POST['name'];
       
        $vid=$_POST['vid'];
        $valueset->update_name($did,$vid,$name);
       
        

      }

       if($_POST['type']==3){

        $id=$_POST['id'];
        //echo $id;
        $valueset->update($id,$_POST['coord_x'],$_POST['coord_y'],$_POST['dataset_id'],$_POST['valueset_id'],$_POST['pos_no']);
       
      }
      echo $did;

    header('Location: display_dataset.php?id='.$did );

    }


  ?>
  
<?php 
$did=$_GET['did'];

if(isset($_POST['did'])){ $did =$_POST['did'] ;}


	$set2 = $dataset->details($did);
  $type = $_GET['type'];
  $uid = $_SESSION['id'];
  if ($type>4  || $type < 0 || !$dataset->isPresent($uid,$did) )  header('Location: index.php');

  else if($type==1){

    $did = $_GET['did'];
    $set= $dataset->details($did);
    ?>

    <div class="container">
	<form method= 'post' action ='edit.php'>
    <table>
    <input type='hidden' name = 'type' value = '1'>
    <input type='hidden' name= 'did' value = <?php echo $did?>>
    <tr><td>name: </td><td> <input type = 'text' name = 'name' value = '<?php echo $set['name']?>' > </td></tr> 
    <tr><td>XLabel: </td><td><input type = 'text' name = 'label_x' value = '<?php echo $set['label_x']?>' ></td></tr>
    <tr><td>YLabel: </td><td> <input type = 'text' name = 'label_y' value = '<?php echo $set['label_y']?>' ></td></tr>
    </table><br>
    <input class="btn" type='submit' name = 'submit'>
    </form>
	</div>
  

  <?php
    }
      else if($type==2){
        $did = $_GET['did'];
        $vid = $_GET['vid'];
		$set3=$valueset->valueset_name($did,$vid);
  ?>

	<div class="container">
    <form method= 'post' action ='edit.php'>
    <table>

    <input type='hidden' name = 'type' value = '2'>
    <input type='hidden' name= 'did' value = '<?php echo $did?>'>
    <input type='hidden' name= 'vid' value = '<?php echo $vid?>'>
    <tr><td>name: </td><td> <input type = 'text' name = 'name' value = '<?php echo $set3['name'] ;?>' > </td></tr>
     </table><br>
    <input class="btn" type='submit' name = 'submit'>
    </form>
	</div>

    <?php
    }
      else if($type==3){
         $did = $_GET['did'];
         $id = $_GET['id'];
         $set = $valueset->details($id);
      ?>    
      <form method='post' action= 'edit.php'>
      <input type='hidden' name= 'did' value = '<?php echo $did?>'>
      <table>
      <input type='hidden' name = 'type' value = '3'>
      <input type='hidden' name = 'id' value = '<?php echo $id ?>' readonly>
      <tr><td>Valueset_id: </td><td>
      <input type = 'text' name = 'valueset_id' value = '<?php echo $set['valueset_id']?>'  readonly> </td></tr>
      <tr><td>dataset_id: </td><td>
      <input type = 'text' name = 'dataset_id' value = '<?php echo $set['dataset_id']?>'  readonly></td></tr>
      <tr><td>X: </td><td>
      <input type = 'text' name = 'coord_x'  value = '<?php echo $set['coord_x']?>' required="true" ></td></tr>
      <tr><td>Y: </td><td>
      <input type = 'text' name = 'coord_y'  value = '<?php echo $set['coord_y']?>'  required="true" ></td></tr>
      <tr><td>Pos_no:</td><td>
      <input type = 'text' name = 'pos_no'  value =  '<?php echo $set['pos_no']?>'  ></td></tr>
      </table>
      <input type = 'submit' value = 'submit' >  
      </form>

    <?php 
  }
  ?>
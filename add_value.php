<!DOCTYPE html>
<?php require_once("header.php");
	if( !$user2->is_logged_in() ){ header('Location: login.php'); }
?> 

  

	<div class="container">
	<form method= "post" action ="add_value.php">
    <table>
	 <?php
	if(!isset($_GET['pos'])) echo "<tr><td>name :</td><td>  <input type = 'text' name = 'name'  placeholder = '' required='true' > </td></tr>";
	?>
	
    <tr><td>Valueset_id: </td><td>
    	<input type = 'int' name = 'valueset_id' value = <?php echo $_GET['vid']?>  readonly> </td></tr>
    <tr><td>dataset_id: </td><td>
    	<input type = 'int' name = 'dataset_id' value = <?php echo $_GET['did']?>  readonly></td></tr>
    <tr><td>X: </td><td>
    	<input type = 'text' name = 'coord_x'  placeholder = '' required="true" ></td></tr>
    <tr><td>Y: </td><td>
     	<input type = 'text' name = 'coord_y'  placeholder = '' required="true" ></td></tr>
    <?php 
		   	if(isset ($_GET['pos']))
					echo "<tr><td>Pos_no:</td><td> <input type = 'text' name = 'pos_no'  value =  ".$_GET['pos']." readonly ></td></tr>";
		    
		    else 
		    		echo "<tr><td>Pos_no:</td><td> <input type = 'text' name = 'pos_no'  value = '1' readonly ></td></tr>";

    ?>
    </table>
    <br>


    <input class="btn" type = 'submit' value = 'submit' >  
  	</form>
	</div>

	<?php 
	if(isset($_POST['coord_x'])&&$_POST['coord_x']!=null)
	{
		if(isset($_POST["name"]))	{$valueset->insert_name($_POST['dataset_id'],$_POST['valueset_id'],$_POST['name']);}

		$valueset->insert($_POST['coord_x'],$_POST['coord_y'],$_POST['dataset_id'],$_POST['valueset_id'],$_POST['pos_no']);
		header('Location: display_dataset.php?id='.$_POST['dataset_id'] );

	}

?>

</body>
</html>
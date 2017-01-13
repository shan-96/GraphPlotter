<?php
	require_once("header.php");
	$uid = $_SESSION['id'];
	$sets=$dataset->uac_names($uid);
	
?>
<body>
<div class="container">
	<form method="post" action="graph2.php">
		<div class="form-group">
		  <label for="did">Select Dataset ID:</label>
		  <select class="form-control" id="did" name="did" required>
			
			<?php
				foreach ($sets as $set){
					echo "<option value=".$set[0].">".$set[1]."</option>";
				}
			?>
		  </select>
		  <br/>
		  <input type='submit' class="btn" name='submitdid'>
		</div>
	</form>
<body>
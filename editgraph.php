<?php
	require_once("header.php");
	
	if(isset($_GET['gid'])){
		$gid=$_GET['gid'];
		$uid = $_SESSION['id'];
		$graph=$graph_db->details($gid);
		if(!$graph_db->isPresent($uid,$gid))
			header('Location: index.php');
		
		
	}
	else
		header('Location: index.php');
?>
<header>
	<script src="style/jscolor.js">
	$(document).ready(function(){
        $("#tp").hide();
    
    $("#show").click(function(){
        $("#tp").show();
    });
});

	</script>
</header>

<body>

<?php
	if(isset($_POST['submit'])){
		$_POST['borderWidth'] = (int)$_POST['borderWidth'];
		$_POST['height'] = (int)$_POST['height'];
		$_POST['width'] = (int)$_POST['width'];
		$graph_db->update($_POST['gid'],$_POST['did'],$_POST['name'],$_POST['type'],$_POST['subtitle'],$_POST['tooltip'],$_POST['mousetracking'],
		$_POST['datalabels'],$_POST['shadow'],$_POST['backgroundColor'],$_POST['legendBackgroundColor'],$_POST['borderColor'],$_POST['borderWidth'],
		$_POST['height'],$_POST['width'],$_POST['minimum'], $_POST['plotBackgroundColor']);
		$graph_db->delete_allvalueset($gid);
		$graph_db->insert_graph2($gid,$_POST['checkbox']);
		header('Location: editgraph.php?gid='.$gid);
	}





?>

<!--div class="container" -->
<div style="float: right; width: 60%;"  >
	
<iframe  src ="plotter2.php?id=<?php echo $gid ?> " name ="frame" WIDTH ='100%' HEIGHT = '100%'  frameBorder="0" ></iframe>
</div>


	<div style="float: left; width: 30%;">
	<form method='post' class="form-horizontal" action='' onsubmit="return validateCheck()">
		<div class="form-group">
		<input type="hidden" name="did" value="<?php echo $graph['did'] ?>" />
		<input type="hidden" name="gid" value="<?php echo $gid ?>" />
		 <center> <label for="vid">Select Valueset ID:</label><br>
			<?php
				$vsets = $valueset->get_valueset($graph['did']);
				$k=0;
				foreach ($vsets as $vset){
					$vname=$valueset->valueset_name($graph['did'],$vset[0]);
					if($graph_db->is_present($gid,$vset[0])){
					echo "<input id='vid' type='checkbox' value=".$vset[0]." name='checkbox[]'  checked>".$vname[0].'&nbsp;&nbsp;<br>';
					$k++;
					}else{
					echo "<input id='vid' type='checkbox' value=".$vset[0]." name='checkbox[]'  >".$vname[0].'&nbsp;&nbsp;<br>';
					}
				}
			?>
		  <center>
		  <label for="type">Select Graph type:</label>
		  <select class="form-control" id="type" name="type" required>
			<option value="bar" <?php if($graph['type']=='bar') echo "selected";?> >BAR</option>
			<option value="line" <?php if($graph['type']=='line') echo "selected";?>>LINE</option>
			<option value="column" <?php if($graph['type']=='column') echo "selected";?>>COLUMN</option>
			<option value="area" <?php if($graph['type']=='area') echo "selected";?>>AREA</option>
			<option value="pie" <?php if($graph['type']=='pie') echo "selected";?>>PIE</option>
		  </select>
		  <br/>
		  <b>Select the properties:</b><br/>
		  <table>
			  <tr><td>Graph Name: </td><td><input name="name" type="text" value= "<?php echo $graph['name']; ?>" required/></td></tr>
			  <tr><td>Graph Subtitle: </td><td><input name="subtitle" type="text" value="<?php echo $graph["subtitle"]; ?>"  required/></td></tr>
			  <tr><td>Graph Height (px): </td><td><input name="height" type="number" min="400" value=<?php echo $graph["height"]; ?> required/></td></tr>
			  <tr><td>Graph Width (px): </td><td><input name="width" type="number" min="400" value=<?php echo $graph["width"]; ?> required/></td></tr>
			  <tr><td>Border Width (px): </td><td><input name="borderWidth" max="20" type="number" value=<?php echo $graph["borderWidth"]; ?>  required/></td></tr>
			  <tr><td>Background Color: </td><td><input name="backgroundColor" class="jscolor" value="#<?php  echo $graph["backgroundColor"];?>" required/></td></tr>
			  <tr><td>Legend Color: </td><td><input name="legendBackgroundColor" class="jscolor" value="#<?php  echo $graph["legendBackgroundColor"];?>" required /></td></tr>
			  <tr><td>Border Color: </td><td><input name="borderColor" class="jscolor" value="#<?php  echo $graph["borderColor"];?>" required/></td></tr>
			  <tr><td>Plot Background Color: </td><td><input name="plotBackgroundColor" class="jscolor" value="#<?php  echo $graph["plotBackgroundColor"];?>" required /></td></tr>
			  <tr><td>Tooltip: </td><td><input id="tooltip" name="tooltip" type="text" value="<?php echo$graph["tooltip"]; ?>" required/></td></tr>
			  <tr><td>Minimum: </td><td><input name="minimum" type="number" value="<?php echo $graph["minimum"]; ?>" required/></td></tr>
			  <tr><td>Label: </td><td>
						True: <input type="radio" value="1" name="datalabels" <?php if($graph['datalabels']) echo"checked";?> /> &nbsp;&nbsp;
						False: <input type="radio" value="0" name="datalabels" <?php if(!$graph['datalabels']) echo"checked";?> />
			  </td></tr>
			  <tr><td>Mousetracking: </td><td>
						True: <input type="radio" value="1"  name="mousetracking" <?php if($graph['mousetracking']) echo"checked";?> /> &nbsp;&nbsp;
						False: <input type="radio" value="0" name="mousetracking"  <?php if(!$graph['mousetracking']) echo"checked";?>/>
			  </td></tr>
			  <tr><td>Shadow: </td><td>
						True: <input type="radio" value="1" name="shadow" <?php if($graph['shadow']) echo"checked";?> /> &nbsp;&nbsp;
						False: <input type="radio" value="0" name="shadow" <?php if(!$graph['shadow']) echo"checked";?> />
			  </td></tr>
		  <table>
		  <br/>
		 <center> <input type='submit' class="btn" name='submit'></center>
		</div>
		  </form>
	
		
	</div>
	
	<script>
	function validateCheck(){
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
		if(checkedOne){
			return true;
		}else{
			alert("you have to select atleast one valueset.");
			return false;
		}
	}
</script>



</body>
</html>
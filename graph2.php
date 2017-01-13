<?php
	require_once("header.php");
	
	if(isset($_POST['submitdid'])&&isset($_POST['did'])){
		$did = $_POST['did'];	
		$vsets = $valueset->get_valueset($did);
	}
?>
<header>
	<script src="style/jscolor.js"></script>
</header>

<body>

<?php
	if(isset($_POST['submitall'])){
		
		$gid=$graph_db->insert_graph1($_POST['did'],$_POST['name'],$_POST['type'],$_POST['subtitle'],$_POST['tooltip'],$_POST['mousetracking'],
		$_POST['datalabels'],$_POST['shadow'],$_POST['backgroundColor'],$_POST['legendBackgroundColor'],$_POST['borderColor'],$_POST['borderWidth'],
		$_POST['height'],$_POST['width'],$_POST['minimum'], $_POST['plotBackgroundColor']);
		
		if(isset($_POST['checkbox'])){
			$graph_db->insert_graph2($gid,$_POST['checkbox']);
			header('Location: editgraph.php?gid='.$gid);
		}
	}



?>

<div class="container">
	<form method='post' class="form-horizontal" action='' name="myForm" id="myForm" onsubmit="return validateCheck()">
		<div class="form-group">
		<input type="hidden" name="did" value="<?php echo $did; ?>" />
		  <label for="vid">Select Valueset ID:</label>
			<?php
				foreach ($vsets as $vset){
					$vname=$valueset->valueset_name($did,$vset[0]);
					echo "<input id='vid' type='checkbox' value=".$vset[0]." name='checkbox[]'>".$vname[0].'&nbsp;&nbsp;';
				}
			?>
		  <br/>
		  <label for="type">Select Graph type:</label>
		  <select class="form-control" id="type" name="type" required>
			<option value="bar">BAR</option>
			<option value="line">LINE</option>
			<option value="column">COLUMN</option>
			<option value="area">AREA</option>
			<option value="pie">PIE</option>
		  </select>
		  <br/>
		  <b>Select the properties:</b><br/>
		  <table>
			  <tr><td>Graph Name: </td><td><input name="name" type="text" required/></td></tr>
			  <tr><td>Graph Subtitle: </td><td><input name="subtitle" type="text" required/></td></tr>
			  <tr><td>Graph Height (px): </td><td><input name="height" type="number" min="400" required/></td></tr>
			  <tr><td>Graph Width (px): </td><td><input name="width" type="number" min="400" required/></td></tr>
			  <tr><td>Border Width (px): </td><td><input name="borderWidth" type="number" max="20" required/></td></tr>
			  <tr><td>Background Color: </td><td><input name="backgroundColor" class="jscolor" value="#FFFFFF" required/></td></tr>
			  <tr><td>Legend Color: </td><td><input name="legendBackgroundColor" class="jscolor" value="#FFFFFF" required /></td></tr>
			  <tr><td>Border Color: </td><td><input name="borderColor" class="jscolor" value="#FFFFFF" required/></td></tr>
			  <tr><td>Plot Background Color: </td><td><input name="plotBackgroundColor" class="jscolor" value="#FFFFFF" required /></td></tr>
			  <tr><td>Tooltip: </td><td><input id="tooltip" name="tooltip" type="text" type="text" required/></td></tr>
			  <tr><td>Minimum: </td><td><input name="minimum" type="number" value=0 required/></td></tr>
			  <tr><td>Label: </td><td>
						True: <input type="radio" value="1" name="datalabels" checked /> &nbsp;&nbsp;
						False: <input type="radio" value="0" name="datalabels"/>
			  </td></tr>
			  <tr><td>Mousetracking: </td><td>
						True: <input type="radio" value="1" name="mousetracking" checked /> &nbsp;&nbsp;
						False: <input type="radio" value="0" name="mousetracking"/>
			  </td></tr>
			  <tr><td>Shadow: </td><td>
						True: <input type="radio" value="1" name="shadow" checked /> &nbsp;&nbsp;
						False: <input type="radio" value="0" name="shadow"/>
			  </td></tr>
		  <table>
		  <br/>
		  <input type="submit" name="submitall" class="btn" value="Submit">
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
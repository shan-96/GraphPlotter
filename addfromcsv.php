<?php
require_once('header.php');

$target_dir = "csv/";
$error = "";
$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check if file already exists
	if (file_exists($target_file)) {
		$error .= "Sorry, filename already exists. Try another name.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		$error .= "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "csv" && $imageFileType != "txt") {
		$error .= "File format incompatible.";
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$error .= " Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$x = "csv/".basename( $_FILES["fileToUpload"]["name"]);
			$error .= " The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			//start csv manipulation here;
			$result = $csv->validate_file($x);
			$error .= $result["msg"];
			if($result["success"]==true){
				//start insertion here. delete file after successful insertion.
				$result = $csv->parseData($x);
				$error .= $result;
				
				unlink($x);
			}
		} else {
			$error .= " Sorry, there was an error uploading your file.";
		}
	}
}

?>
<body>
<div class="container">
	<h2>Making a csv file for graph plotter dataset</h2>
	<ul>
		<li>Line separator is carriage return</li>
		<li>Field separator is comma</li>
		<li>First line should contain dataset fields - name, x-label, y-label (in order)</li>
		<li>Second line should specify number of valuesets in the file (N)</li>
		<li>Next N lines should contain valueset fields as - valueset id, name (in order) for above dataset</li>
		<li>Succeeding lines should contain data input as - valueset id of data ,x-value, y-value, position in graph</li>
		<li>File terminator is EOF</li>
		<li>Compatible extensions are .csv and .txt</li>
	</ul>
	
	<form method="post" enctype="multipart/form-data" action="">
		Upload CSV: <input type="file" name="fileToUpload" id="fileToUpload" /><br>
		<input type="submit" value="Upload" name="submit" class="btn btn-default" />
	</form>
	<?php if($error != ""){ ?> <p><?php echo $error; ?></p> <?php } ?>
	</div>
</div>
</body>
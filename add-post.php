<?php //include config
require_once('header.php');

//if not logged in redirect to login page
if(!$user2->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script src="js/blog/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>
<div class="container">
<div id="wrapper">



	<h2>Add Post</h2>
	<hr>
	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($graphUrl ==''){
			$error[] = 'Please enter the graph Url.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate,graphUrl) VALUES (:postTitle, :postDesc, :postCont, :postDate,:graphUrl)') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d H:i:s'),
					':graphUrl' => $graphUrl
				));

				//redirect to index page
				header('Location: blog-control.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Title</label><br />
		<input type='text' size="100%" name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

		<p><label>Graph Url</label><br />
		<input type='text' size="100%" name='graphUrl' value='<?php if(isset($error)){ echo $_POST['graphUrl'];}?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='5'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>
		<br>
		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

		<p><input class="btn btn-default" type='submit' name='submit' value='Post'></p>

	</form>

</div>
</div>
</body>
</html>
<?php require_once('header.php'); 
if (isset ($_POST['comment'])) 
{				$_GET['id']=$_POST['id'];
				//insert into database
				$stmt = $db->prepare('INSERT INTO comments (blog_id,memberId,text,timestamp) VALUES (:p1, :p2, :p3, :p4)') ;
				$stmt->execute(array(
					':p1' => $_POST['id'],
					':p2' => $_SESSION['id'],
					':p3' => $_POST['comment'],
					':p4' => date('Y-m-d H:i:s')
					
				));

}


$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate,graphUrl FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
	<style>
		.blogdiv{
			background-color: rgba(0,0,0,0.6);
		}
		
		.user{
			color: #000000;
		}
		
		.comment{
			background-color: rgba(255,255,255,0.3);
			width: 90%;
		}
	</style>
</head>
<body>
<div class="container blogdiv">
	<div id="wrapper">

		<h1>Blog</h1>
		<hr />
		<p><a href="blog.php">Blog Index</a></p>
		<div class="blogdiv">
			<div style="float: right; width: 50%;"  >
			
			<iframe  src ="<?php echo $row['graphUrl'] ?>" name ="frame" WIDTH ='100%' HEIGHT = '100%'  frameBorder="0" ></iframe>
			</div>
			<div style="float: left; width: 50%">

			<?php	
				echo '<br>';
					echo '<h1>'.$row['postTitle'].'</h1>';
					echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
					echo '<p>'.$row['postCont'].'</p>';				
			
			?>
				<br>
				<h4>Comments</h4>
				<?php
				try {

								$stmt = $db->prepare('SELECT * FROM comment_view where blog_id= :id order by timestamp asc');
								$stmt->bindParam(':id',$_GET['id']);
								$stmt->execute();
								while($row = $stmt->fetch()){
								?>
								<br> <div class="comment"><p class="user"> <?php echo $row['username'];?>
								     <?php 
									 $currtime = time();//date_create(date('l jS \of F Y h:i:s A'));
									 $timestamp = strtotime($row['timestamp']);
									 $interval = $currtime - $timestamp;
									 $ccc = secondsToTime($interval);
									 echo ' - '.$ccc; ?>
								     </p>
									 <p><?php echo $row['text'];?></p></div> 
								<?php
								}

							} catch(PDOException $e) {
								echo $e->getMessage();
							}

				?>
				<form method= "post" action ="">
				add comment : <br>
				<input type="hidden" name= "id" value ="<?php echo $_GET['id'] ; ?> " >  </input>
				<input type = "text" size="75%" name ="comment"></input><br><br>
				 <input class="btn" type = 'submit' value = 'comment' >  
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
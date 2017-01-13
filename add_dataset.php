<!DOCTYPE html>
<?php require_once("header.php");
	if( !$user2->is_logged_in() ){ header('Location: login.php'); }
?> 
  <?php 
    if (isset ($_POST['name'])&&isset($_POST['x_label'])&&isset($_POST['y_label'])&&$_POST['name']!=null&&$_POST['x_label']!=null&&$_POST['y_label']!=null)
        {
          $name =$_POST['name'];
          $x_label=$_POST['x_label'];
          $y_label=$_POST['y_label'];
          $uid = $_SESSION['id'];
          $dataset->insert($name,$x_label,$y_label,$uid);

          header('Location: index.php');

        }

    else {
          if (isset($_POST['name']))
                      $name =$_POST['name'];
          else $name = 'name';

          if (isset ($_POST['x_label']))
                      $x_label=$_POST['x_label'];
          else $x_label ='x_label';

          if (isset ($_POST['y_label']))
                      $y_label=$_POST['y_label'];
          else $y_label ='y_label';
         }
      ?>
  
   <div class="container">
   <form method= "post" action ="add_dataset.php">
    <table>
    <tr><td>Name : </td><td><input type = 'text' name = 'name'  placeholder = <?php echo $name ?> required="true"></td></tr>
    <tr><td>X Label : </td><td><input type = 'text' name = 'x_label'  placeholder = <?php echo $x_label ?> required="true" ></td></tr>
    <tr><td>Y Label : </td><td><input type = 'text' name = 'y_label'  placeholder = <?php echo $y_label ?> required="true" ></td></tr>
    <tr><td><br><input class="btn" type = 'submit' value = 'submit' ></td> </tr>
    </table> 
  </form>
  <br>
  <a href='addfromcsv.php'>Add from a csv instead</a>
  </div>
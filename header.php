<?php 
require("includes/config.php");
?>
<header>
  <link rel="stylesheet" href="style/bootstrap.min.css">
  <link rel="stylesheet" href="style/custom.css">

  <script src="style/jquery.min_2.js"></script>
  <script src="style/bootstrap.min.js"></script>
  <script src="js/clipboard/dist/clipboard.js"></script>
</header>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Graph Plotter</a>
    </div>
    <ul class="nav navbar-nav">

     <li class="active"><a href="">Welcome <?php if($user2->is_logged_in()){echo htmlspecialchars($_SESSION['username']);}?></a></li>
      <li><a href="blog.php">View blog</a></li>
      <li><a href="blog-control.php">Control blog</a></li>
    <!--  
     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
    -->
    </ul>
  
    <ul class="nav navbar-nav navbar-right"><?php if(!$user2->is_logged_in()){ ?>
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  <?php } else{?>
    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
  <?php } ?>
    </ul>
  </div>
</nav>

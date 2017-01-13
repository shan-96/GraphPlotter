<!DOCTYPE html>
<?php require_once("header.php");?> 
 <html lang="en" class="no-js">
    <head>
      <!-- Basic Page Needs
    ================================================== -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Welcome</title>
    </head>
  <body>
	<!--h2>Make a graph, amigo!</h2>
  <a href="logout.php"> Logout </a-->
  <?php
  if( $user2->is_logged_in()){
	  
    ?>
  <div class="container" >

  <div id="snackbar">Link URL Copied!</div>
    
  <div style="float: left; width: 50%;">

    <h3> Data Sets </h3>
    <table>
      <tr><td>&nbsp&nbsp</td><td><b><h4>Your Datasets</b></h4></td></tr>
      <?php
      $uid = $_SESSION['id'];
        $set= $dataset->uac_names($uid);
        $i=0;

        while(isset($set[$i][0]))
            { $k=$i+1;
              echo "<tr><td>&nbsp $k) &nbsp</td><td><a href='display_dataset.php?id=".$set[$i][0]."'>".$set[$i][1]."</a></td></tr>";
            $i++;
          }
      ?>
      <tr><td>&nbsp&nbsp</td><td><b><h4>Other Datasets</b></h4></td></tr>
      <?php
      $uid = $_SESSION['id'];
        $set= $dataset->all_names1($uid);
        $i=0+$k;

        while(isset($set[$i][0]))
            { $k=$i+1;
              echo "<tr><td>&nbsp $k) &nbsp</td><td><a href='display_dataset.php?id=".$set[$i][0]."'>".$set[$i][1]."</a></td></tr>";
            $i++;
          }
      ?>
    </table>
    <br>
    <h5> <a href='add_dataset.php'> Add a new Dataset </a></h5>
	
  </div>

  <div style="float: right; width: 50%;">
    <h3> Graphs </h3>
    <table>
      <tr><td>&nbsp&nbsp</td><td><b><h4>Your Graphs</b></h4></td></tr>
      <?php
        $set= $graph_db->uac_names($uid);
		    $k=0;
        $i=0;

        while(isset($set[$i][0]))
            { $k=$i+1;
				$gid=$set[$i][0];
				$set2= $graph_db->details($gid);
				echo "<tr><td>&nbsp $k) &nbsp</td><td><a target='iframe_a' id='$k' href='plotter2.php?id=".$set[$i][0]."'>".$set[$i][1]." 
			  </a></td>
			
			<script>
				$(document).ready(function(){
					$('#$k').click(function(){
						$('#myModal').modal();
					});
				});
				
				function resizeIframe(obj) {
					obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
				  }
				
				var clipboard = new Clipboard('#copy$k', {
					text: function() {
						return 'localhost/dbms/8/plotter2.php?id=".$set[$i][0]."';
					}
				});
				
			</script>
			  
			  <!-- Modal -->
			  <div class='modal fade' id='myModal' role='dialog'>
				<div class='modal-dialog modal-lg'>
				
				  <!-- Modal content-->
				  <div class='modal-content'>
					<div class='modal-header'>
					  <button type='button' class='close' data-dismiss='modal'>&times;</button>
					  <h4 class='modal-title'>".$set[$i][1]."</h4>
					</div>
					<div class='modal-body'>
					  <iframe name='iframe_a' frameborder='0' onload='resizeIframe(this)' width='100%'></iframe>
					</div>
				  </div>
				  
				</div>
			  </div>
			  
			";
			  
              echo " <td><a href=editgraph.php?gid=".$set[$i][0]."> edit </a></td>";
              ?>
              <td><a onclick="return confirm('Are you sure?')" href="deletegraph.php?gid=<?php echo $set[$i][0]; ?>">&nbsp;delete</a></td>
			  <td>&nbsp;&nbsp;<a href="#" onclick="showSnack();" id="copy<?php echo $k; ?>">embed</a></td>
			  
			  </tr>
              <?php
			  
            $i++;
          }
      ?>
      <tr><td>&nbsp&nbsp</td><td><b><h4>Other Graphs</b></h4></td></tr>
      <?php
        $set= $graph_db->all_names1($uid);
      
        $i=0;

        while(isset($set[$i][0]))
            { $l=$i+$k+1;
        $gid=$set[$i][0];
        $set2= $graph_db->details($gid);
        echo "<tr><td>&nbsp $l) &nbsp</td><td><a target='iframe_a' id='$l' href='plotter2.php?id=".$set[$i][0]."'>".$set[$i][1]."&nbsp;&nbsp;&nbsp;
        </a></td>
        
      <script>
        $(document).ready(function(){
          $('#$l').click(function(){
            $('#myModal').modal();
          });
        });
        
        function resizeIframe(obj) {
          obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
          }
		  
		var clipboard = new Clipboard('#copy$l', {
					text: function() {
						return 'localhost/dbms/8/plotter2.php?id=".$set[$i][0]."';
					}
				});  
        
      </script>
        
        <!-- Modal -->
        <div class='modal fade' id='myModal' role='dialog'>
        <div class='modal-dialog modal-lg'>
        
          <!-- Modal content-->
          <div class='modal-content'>
          <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal'>&times;</button>
            <h4 class='modal-title'>".$set[$i][1]."</h4>
          </div>
          <div class='modal-body'>
            <iframe name='iframe_a' frameborder='0' onload='resizeIframe(this)' width='100%'></iframe>
          </div>
          </div>
          
        </div>
        </div>
        
			";?>
			<td><a href="#" onclick="showSnack();" id="copy<?php echo $l; ?>">embed</a></td></tr>
       <?php
            $i++;
          }
      ?>
	  
    </table>
    <br>
    <h5> <a href='graph.php'> Add a new graph </a></h5>
  
  </div>
  
</div>

<?php }else{ ?>
	<div class="container">
		<center>
		<h2>Welcome to Graph Plotter!</h2>
		<h5>A graph generation analytic tool.<h5>
			<hr>
			<h4>5th Semester DBMS Project from</h4> 
					Sarthak Chhillar - 141100010<br>
					Shantanu Patil - 141100011<br>
					Vinay Shah - 141100012<br>
			<br>
			<h4>Project Mentor</h4>
			Dr. Jaya Thomas
			<br>Department of CSE, NIT Delhi
		<center>
	</div>
<?php } ?>
	<script>
		function showSnack(){
			var x = document.getElementById("snackbar");
			x.className = "show";
			setTimeout(function(){
				x.className = x.className.replace("show","");
			},3000);
		}
	</script>
</body>
</html>

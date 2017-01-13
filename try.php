<?php
require_once("header.php");


		$did=1;
		$vid=2;
  		$set1 =$dataset->details($did);
        $set  =$valueset->valueset_details($did,$vid);   
        $set2 =$valueset->valueset_name($did,$vid);

        $gr['title'] =$set1['name'];
        $gr['label_x'] =$set1['label_x'];
        $gr['label_y'] =$set1['label_y'];
        $gr['set_name']=$set2['name'];
                
       
        $i=0;
        $j=0;
        
        while (isset($set[$i]))
            {
                  $y_axis[$j]=$set[$i]['coord_y'];
                  $x_axis[$j]=$set[$i]['coord_x'];
                  $j++;
              	  $i++;
			}

		$gr['x_axis']="[";
		$gr['y_axis']="[";

		for($x=0;$x<$i;$x++)
				{
					$gr['x_axis']=$gr['x_axis']."'".$x_axis[$x]."'";
					$gr['y_axis']=$gr['y_axis'].$y_axis[$x];
					if($x!=$i-1){
						$gr['x_axis']=$gr['x_axis'].',';
						$gr['y_axis']=$gr['y_axis'].',';
					}

				}

		$gr['x_axis']=$gr['x_axis'].']';
		$gr['y_axis']=$gr['y_axis'].']';


foreach ($gr as $key => $value) {
    echo "$key : $value <br>";
}



?>
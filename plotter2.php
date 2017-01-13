
<?php
require_once("includes/config.php");
        
        $gid=$_GET['id'];
        $set8=$graph_db->details($gid);
        $set9=$graph_db->valueset_details($gid);
        
        
        $vid_count=0;
        $did=$set8['did'];
        $graph;
        
        $set1=$dataset->details($did);
        $k=0;
        while (isset($set9[$k]['vid']) ) 
        {       
                
                $vid=$set9[$k]['vid'];
                
               
                $vid_count++;
                $set  =$valueset->valueset_details($did,$vid);   
                $set2 =$valueset->valueset_name($did,$vid);
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
                
                if ($k==0) 
                    $graph['x_axis']= $gr['x_axis'];
                else 
                    if ($graph['x_axis']!=$gr['x_axis']) 
                        {echo "Incompatible Valuesets used"; return 0 ;}

                $graph[$k]['name']=$gr['set_name'];
                $graph[$k]['y_axis']=$gr['y_axis'];
            $k++;
            }



$graph['title']= $set1['name'];
$graph['sub_title']= $set8['subtitle'];
$graph['x_label'] =$set1['label_x'];
$graph['y_label'] =$set1['label_y'];


$graph['set_count'] =$vid_count;


$graph['type'] = $set8['type'];;

$graph['ht'] =  $set8['height'];;
$graph['wd'] =  $set8['width'];;
$graph['border_wd']= $set8['borderWidth'];;
$graph['min']=$set8['minimum'];;

$graph['bg_colour'] =  $set8['backgroundColor'];;
$graph['plot_colour'] = $set8['plotBackgroundColor'] ;
$graph['legend_colour'] = $set8['legendBackgroundColor'];;
$graph['border_colour'] =  $set8['borderColor'];

$graph['tooltip'] = $set8['tooltip'];;

$graph['labels']  =  "true";
$graph['mtrack'] ="true";
$graph['shadow'] ="true";
if (!$set8['datalabels'])
    $graph['labels']  ="false" ; 
if(!$set8['mousetracking'])
        $graph['mtrack'] ="false";
if(!$set8['shadow'])
$graph['shadow']="false" ;

?>
 
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">


$(function () {
    $('#container').highcharts({
        chart: {
            style: {
            fontFamily: 'calibri',
            fontSize : 20 
            },
            type: '<?php echo $graph['type'] ;?>',
            backgroundColor: '#<?php echo $graph['bg_colour'] ;?>',
            plotBackgroundColor: '#<?php echo $graph['plot_colour'] ;?>' ,
            borderWidth: <?php echo $graph['border_wd'] ;?>  ,
            height: <?php echo $graph['ht'] ;?>,
            width: <?php echo $graph['wd'] ;?>,
            borderColor: '#<?php echo $graph['border_colour'] ;?>',
            shadow : <?php echo $graph['shadow'] ;?>
            
        },
        title: {
            text: ' <?php echo $graph['title'] ;?> '
        },
        subtitle: {
            text: ' <?php echo $graph['sub_title'] ;?> '
        },
        xAxis: {
            categories: <?php echo $graph['x_axis'] ; ?> ,
                        
            title: {
                text: '<?php echo $graph['x_label'] ;?>'
            }
        },
        yAxis: {
            min: <?php echo $graph['min'] ;?>,
            title: {
                     
                    text: '<?php echo $graph['y_label'] ;?>',
                align: 'middle'
            },
            
            labels: {
                overflow: 'justify'
            }
        },
        
        tooltip: {
            valueSuffix: '<?php echo $graph['tooltip'] ;?>'
        },
        
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: <?php echo $graph['labels'] ;?>
                },
                enableMouseTracking: <?php echo $graph['mtrack'] ;?>
            },
            bar: {
                dataLabels: {
                    enabled: <?php echo $graph['labels'] ;?>
                },
                enableMouseTracking: <?php echo $graph['mtrack'] ;?>
            },
            area: {
                dataLabels: {
                    enabled: <?php echo $graph['labels'] ;?>
                },
                enableMouseTracking: <?php echo $graph['mtrack'] ;?>
            },
            column: {
                dataLabels: {
                    enabled: <?php echo $graph['labels'] ;?>
                },
                enableMouseTracking: <?php echo $graph['mtrack'] ;?>
            },
            pie: {
                dataLabels: {
                    
                    enabled: <?php echo $graph['labels'] ;?>

                },
                enableMouseTracking: <?php echo $graph['mtrack'] ;?>
            }


        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 0,
            y: 0,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#<?php echo $graph['legend_colour'] ;?>'),
             shadow: false
        },
        credits: {
            enabled: false
        },
        series: [
            <?php 
            for ($i=0;$i<$graph['set_count'];$i++)
            {    echo "{ name : '".$graph[$i]['name']."' , data : ".$graph[$i]['y_axis']."}" ;
                    if( $i != $graph['set_count']-1 ) echo ", \n";
            }
            ?>


        ]
    });
});
		</script>
	</head>
	<body>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<script src="js/modules/offline-exporting.js"></script>  

<!--<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script> -->


<center><div id="container" style="width: 100%; max-width: 810px; height: auto;"></div></center>

	</body>
</html>

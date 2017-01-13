
<?php

$graph['title']= "TITLE";
$graph['sub_title']= "SUB TITLE";
$graph['x_label'] ="X LABLEL";
$graph['y_label'] ="Y LABEL";
$graph['x_axis'] = "['Label','Label','Label','Label']";

$graph['set_count'] =3 ;

$graph[0]['name'] = "plot 1";
$graph[0]['y_axis'] ="[13,15,16,19]";

$graph[1]['name'] = "plot 2";
$graph[1]['y_axis'] ="[19,-12,12,10]";


$graph[2]['name'] = "plot 3";
$graph[2]['y_axis'] ="[25,-21,-21,17]";


$graph['type'] = "line";

$graph['ht'] = "500";
$graph['wd'] = "900";
$graph['border_wd']="0";
$graph['min']=-30;

$graph['bg_colour'] = "#ffffff";
$graph['plot_colour'] = "#eeeeee";
$graph['legend_colour'] = "#ffffee";
$graph['border_colour'] = "#000000";

$graph['tooltip'] ="units";

$graph['labels']  = "true";
$graph['mtrack'] ="true";
$graph['shadow'] ="true"; 

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
            fontFamily: 'serif'
            },
            type: '<?php echo $graph['type'] ;?>',
            backgroundColor: '#<?php echo $graph['bg_colour'] ;?>',
            plotBackgroundColor: '#<?php echo $graph['plot_colour'] ;?>' ,
            borderWidth: <?php echo $graph['border_wd'] ;?>  ,
            height: <?php echo $graph['ht'] ;?>,
            width: <?php echo $graph['wd'] ;?>,
            borderColor: '#<?php echo $graph['border_colour'] ;?>'
            
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
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'top',
          //  x: -40,
          //  y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '<?php echo $graph['legend_colour'] ;?>'),
            shadow: true
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
<script src="js/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>

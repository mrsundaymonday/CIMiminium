    <?php
     
    $dataPoints1 = array(
    	array("label"=> "2010", "y"=> 36.12),
    	array("label"=> "2011", "y"=> 34.87),
    	array("label"=> "2012", "y"=> 40.30),
    	array("label"=> "2013", "y"=> 35.30),
    	array("label"=> "2014", "y"=> 39.50),
    	array("label"=> "2015", "y"=> 50.82),
    	array("label"=> "2016", "y"=> 74.70)
    );
    $dataPoints2 = array(
    	array("label"=> "2010", "y"=> 64.61),
    	array("label"=> "2011", "y"=> 70.55),
    	array("label"=> "2012", "y"=> 72.50),
    	array("label"=> "2013", "y"=> 81.30),
    	array("label"=> "2014", "y"=> 63.60),
    	array("label"=> "2015", "y"=> 69.38),
    	array("label"=> "2016", "y"=> 98.70)
    );
    	
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>  
    <script>
    window.onload = function () {
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	animationEnabled: true,
    	theme: "light2",
    	title:{
    		text: "Average Amount Spent on Real and Artificial X-Mas Trees in U.S."
    	},
    	legend:{
    		cursor: "pointer",
    		verticalAlign: "center",
    		horizontalAlign: "right",
    		itemclick: toggleDataSeries
    	},
    	data: [{
    		type: "column",
    		name: "Real Trees",
    		indexLabel: "{y}",
    		yValueFormatString: "$#0.##",
    		showInLegend: true,
    		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
    	}]
    });
    chart.render();
     
    function toggleDataSeries(e){
    	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    		e.dataSeries.visible = false;
    	}
    	else{
    		e.dataSeries.visible = true;
    	}
    	chart.render();
    }
     
    }
    </script>
    </head>
    <body>
        <?php
        $ng = "NG";
        $num = "NG181026001";
        
            echo "Format Slip Laporan: ".$ng.date("d").date("m").date("y")."<br>";
            echo $num."<br>";
            $my_val=substr($num, -3);
            echo "before ".$my_val."<br>";
            $my_val=$my_val+1;
            echo "after substring ".$my_val."<br>";
            printf('%03d',$my_val);

        ?>

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
    </html>                              
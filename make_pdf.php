<?php
	include "common.php";
	$company=trim($_REQUEST['user']);
	$dbh = Db::db_connect();
	$data= exportData::makePdf($dbh, $company);
?>
<!DOCTYPE html>  
<html>  
    <head>  
        <title>Advert Clicks Per Day</title>
	   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
	   <script type="text/javascript">
	   google.charts.load('current', {'packages':['corechart']});
	   google.charts.setOnLoadCallback(drawChart);
	  function drawChart()
	  {
	    var data = google.visualization.arrayToDataTable([
	     ['Date', 'Clicks'],
	     <?php
	     foreach($data as $row)
		     {
			 echo "['".$row["click_date"]."', ".$row["clicks"]."],";
		     }
	     ?>
	    ]);

	    var options = {
	     title : 'Advert Clicks Per Day',
	     pieHole : 0.4,
	     chartArea:{left:150,top:70,right:150,width:'80%',height:'60%'}
	    };
	    var chart_area = document.getElementById('barchart');
	    var chart = new google.visualization.BarChart(chart_area);

	    google.visualization.events.addListener(chart, 'ready', function(){
	     chart_area.innerHTML = '<img src="' + chart.getImageURI() + '" class="img-responsive">';
	    });
	    chart.draw(data, options);
	   }
		
	    </script>  
    </head>  
    <body>
	<div id="makepdf">     
   	    <div class="panel-body" align="center">
	     <div align="right"class="col-sm-10">
		   <form method="post" id="make_pdf" action="save_pdf.php">
		    <input type="hidden" name="hidden_html" id="hidden_html" />
		    <button type="button" name="create_pdf" id="create_pdf" class="btn btn-primary btn-sm">Export To PDF</button>
		   </form>
	     </div>
	     <div id="barchart" align="left"style="width: ; max-width:90%; height:auto; "></div>
	    </div>
	</div>
 
    </body>  
</html>

<script>
	$(document).ready(function(){
		$('#create_pdf').click(function(){
		$('#hidden_html').val($('#makepdf').html());
		$('#make_pdf').submit();
		});
	});
</script>


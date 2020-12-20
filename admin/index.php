<?php

require_once 'lock.php';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CMS NBOutlet | Главная</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">

	<!-- Шапка -->   
	<div class="header"></div>
        <div class="content">
            <div class="contentcontent clearfix">
            
            <!--Меню-->
			<?php require_once('blocks/sidebar.php'); ?>
                
             <!--Контент-->
            <div class="right-column">
            <div class="title">Онлайн статистика: <?= $_SERVER['HTTP_HOST']; ?></div>
			
			<?php	
			$sth = mysql_query("SELECT * FROM visits");		 
			$rows = array();
			$table = array();		
			$table['cols'] = array(
				array('label' => 'hosts', 'type' => 'string'),
				array('label' => 'уникальные', 'type' => 'number'),
				array('label' => 'просмотры', 'type' => 'number'),
			);		 
			$rows = array();
			while($r = mysql_fetch_assoc($sth)) {
				$temp = array();
				$temp[] = array('v' => (string) $r['date']);
				$temp[] = array('v' => (int) $r['hosts']);
				$temp[] = array('v' => (int) $r['views']);
				$rows[] = array('c' => $temp);
			}
			$table['rows'] = $rows;
			$jsonTable = json_encode($table);
			?>
	        
	        <script type="text/javascript">
			google.load('visualization', '1', {'packages':['corechart']});
			google.setOnLoadCallback(drawChart);
			function drawChart() {
				
			var data = new google.visualization.DataTable(<?=$jsonTable?>);
			var options = {
				is3D: 'true',
				width: 794,
				height: 375,
	         	pointSize: 4,
	         	 backgroundColor: "transparent",
	            series: {
	                0: { pointShape: 'circle' },
	            }
			  };  
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));	
			chart.draw(data, options);
			}
			</script>

	    	<div id="chart_div"></div>
			
            </div>
        </div>
</div>

<!--Подвал-->
<?php require_once('blocks/footer.php'); ?>
</body>
</html>
<?php
	include "../function/db.php";
	include "../function/func.php";
	$sql="select nip from pegawai order by nip desc";
	
	$umur=array();
	$i="www";
	$today = new DateTime();
	if ($result = $mysqli->query($sql)) { 
		while($obj = $result->fetch_object()){		
			$i=substr($obj->nip,0,4)."-".substr($obj->nip,4,2)."-".substr($obj->nip,6,2);
			$biday = new DateTime($i);		
			$diff = $today->diff($biday);
			array_push($umur,$diff->y);
		}
	}	
	$kel_umur=array_count_values($umur);
	$labels = " [";
	$data1 = " [";
	foreach($kel_umur as $key => $val){
		//echo "Key: $key, Value: $val<br/>\n";
		$labels.="'".$key."',";
		$data1.=$val.",";
	}

	$labels=substr($labels,0,(strlen($labels)-1));
	$labels .= "]";
	$data1 .= "]";
	/* echo $labels;
	echo $data1;
	echo $data2; */
?>
<script src="../js/Chart.bundle.js"></script>
<script src="../js/utils.js"></script>
<style>
canvas {
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}
</style>
<div id="container_chart" style="width: 98%;">
	<canvas id="canvas"></canvas>
</div>
<script>
	var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var color = Chart.helpers.color;
	var barChartData = {
		labels: <?php echo $labels; ?>,
		datasets: [{
			label: 'Umur Pegawai',
			backgroundColor: color(window.chartColors.blue).alpha(0.6).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: <?php echo $data1; ?>
		}]

	};

	window.onload = function() {
		var ctx = document.getElementById('canvas').getContext('2d');
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: ''
				}
			}
		});

	};

	var colorNames = Object.keys(window.chartColors);
	document.getElementById('addDataset').addEventListener('click', function() {
		var colorName = colorNames[barChartData.datasets.length % colorNames.length];
		var dsColor = window.chartColors[colorName];
		var newDataset = {
			label: 'Dataset ' + (barChartData.datasets.length + 1),
			backgroundColor: color(dsColor).alpha(0.5).rgbString(),
			borderColor: dsColor,
			borderWidth: 1,
			data: []
		};

		for (var index = 0; index < barChartData.labels.length; ++index) {
			newDataset.data.push(randomScalingFactor());
		}

		barChartData.datasets.push(newDataset);
		window.myBar.update();
	});

</script>
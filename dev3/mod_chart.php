<?php
	include "../function/db.php";
	include "../function/func.php";
	$sql="select substring(nip,15,1) as jk, wilker, count(status) as jml 
		from pegawai p, jabatan j, jabatan_pegawai jp 
		where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan 
		group by jk, wilker order by jk, wilker";
	
	//echo $sql;
		
	$labels = " [";
	$data1 = " [";
	$data2 = " [";
	$jmllk = 0;
	$jmlpr = 0;
	if ($result = $mysqli->query($sql)) { 
		while($obj = $result->fetch_object()){			
			if($obj->jk=='1'){
				$labels.="'".$obj->wilker."',";
				$data1.=$obj->jml.",";
				$jmllk+=$obj->jml;
			}else{
				$data2.=$obj->jml.",";
				$jmlpr+=$obj->jml;
			}
		}
	}
	$labels=substr($labels,0,(strlen($labels)-1));
	$labels .= "]";
	$data1 .= "]";
	$data2 .= "]";
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
			label: 'Laki-laki',
			backgroundColor: color(window.chartColors.blue).alpha(0.6).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: <?php echo $data1; ?>
		}, {
			label: 'Perempuan',
			backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data:  <?php echo $data2; ?>
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
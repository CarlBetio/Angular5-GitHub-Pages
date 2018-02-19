<?php
$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
$res = $conn->query("SELECT * FROM `products` GROUP BY prod_name") or die(mysqli_error());
$data_points = array();
while($result = $res->fetch_array()){
	$R = $result['prod_name'];
	$q1 = $conn->query("SELECT * FROM `products` WHERE `prod_name` = '$R'") or die(mysqli_error());
	$f1 = $q1->fetch_array();
	$FR = intval($f1['balance']);
	$point = array('label' => $R, 'y' => $FR);
	array_push($data_points, $point);
}
json_encode($data_points);
?>
<script type="text/javascript"> 
	window.onload = function(){

		$("#products").CanvasJSChart({
			theme: "light2",
			zoomEnabled: true,
			zoomType: "x",
			panEnabled: true,
			animationEnabled: true,
			animationDuration: 1000,
			exportFileName: "Available Stocks", 
			exportEnabled: true,
			toolTip: {
				shared: true  
			},
			title: { 
				text: "Products Available in Stocks",
				fontSize: 20
			},
			legend: {
				cursor: "pointer",
				itemclick: function (e) {
					if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
						e.dataSeries.visible = false;
					} else {
						e.dataSeries.visible = true;
					}
					e.chart.render();
				}
			},
			data: [ 
				{ 
					type: "doughnut", 
					//showInLegend: true, 
					toolTipContent: "{label} <br/> {y}", 
					indexLabel: "{y}", 
					//legendText: "<?php echo $f1['prod_name']?>",
					//name: "Total Patients this year",
					dataPoints: <?php echo json_encode($data_points); ?>
				}
					] 
				}); 
				}
</script>
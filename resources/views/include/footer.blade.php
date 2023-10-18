
		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- Dashboard js-->
		<script src="{{ URL::asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
		<script src="{{ URL::asset('assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
		<script src="{{ URL::asset('assets/js/vendors/jquery.sparkline.min.js')}}"></script>
		<script src="{{ URL::asset('assets/js/vendors/circle-progress.min.js')}}"></script>
		<script src="{{ URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

		<!--Side-menu js-->
		<script src="{{ URL::asset('assets/plugins/toggle-sidemenu/toggle-sidemenu.js')}}"></script>

	
		<?php

		

		$array = array();

		$array1 = array();

		if(!empty($dash->completeProfile)){
			$completeProfile = $dash->completeProfile;
		  foreach($completeProfile->all() as $profile){ 
		    $array[] = array("y" => $profile->total, "label" => $profile->profile_completed."%");
		  }
		}
		else
		{
		  $array[] = array("y" => 0, "label" => "10%");
		}

		$dataPoints = $array;

		
		if(!empty($dash->appDown)){
			$appDown = $dash->appDown;
		  foreach($appDown->all() as $down){ 
		  	// echo date('F', strtotime('2020-'.$down->month.'-01'));
		    $array1[] = array("y" => $down->total, "label" => date('M', strtotime('2020-'.$down->month.'-01')));
		  }
		}
		else
		{
		  $array1[] = array("y" => 0, "label" => "Jan");
		}

		$dataPoints1 = $array1;
?>
		<?php
 
$dataPoints2 = array(
	array("y" => 0, "label" => "Jan"),
				array("y" => 100, "label" => "Fab"),
				array("y" => 200, "label" => "March"),
				array("y" => 300, "label" => "Apr"),
				array("y" => 400, "label" => "May"),
				array("y" => 500, "label" => "June"),
				array("y" => 600, "label" => "July"),
				array("y" => 700, "label" => "Aug"),
);
 
?>

<?php
 
 $dataPoints3 = array(
	array("y" => 0, "label" => "Jan"),
				array("y" => 100, "label" => "Fab"),
				array("y" => 200, "label" => "March"),
				array("y" => 300, "label" => "Apr"),
				array("y" => 400, "label" => "May"),
				array("y" => 500, "label" => "June"),
				array("y" => 600, "label" => "July"),
				array("y" => 700, "label" => "Aug"),
 );
 
?>
		<!-- Search js-->
		<script src="{{ URL::asset('assets/js/prefixfree.min.js')}}"></script>

		<!-- Custom scroll bar js-->
		<script src="{{ URL::asset('assets/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

		<!-- Sidebar js-->
		<script src="{{ URL::asset('assets/plugins/sidebar/sidebar.js')}}"></script>

		<!-- <script src="assets/js/elements.js"></script> -->

		<script src="{{ URL::asset('assets/plugins/fileupload/js/fileupload.js')}}"></script>
		<script src="{{ URL::asset('assets/plugins/fileupload/js/fileupload-demo.js')}}"></script>
		<!-- Custom js-->

		<script src="{{ URL::asset('assets/js/custom.js')}}"></script>

		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script>
			window.onload = function() {
			 
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				theme: "light2",
				title:{
					text: "Profile Completion"
				},
				axisY: {
				//	title: "Gold Reserves (in tonnes)"
				},
				data: [{
					type: "column",
					yValueFormatString: "#,##0.## tonnes",
					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();


			var chart1 = new CanvasJS.Chart("chartContainer1", {
				theme: "light2",
				title: {
				text: "App Download"
			},
			axisY: {
				//title: "Number of App Download"
			},
			data: [{
				type: "line",
				dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
			}]
			});
			chart1.render();

			var chart2 = new CanvasJS.Chart("chartContainer2", {
				theme: "light2",
				title: {
					text: "Bar's NY"
				},
				subtitles: [{
					text: "2007 to 2016"
				}],
				axisY: {
				//	title: "Number of People Employed"
				},
				data: [{
					type: "stepLine",
					dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart2.render();

			var chart3 = new CanvasJS.Chart("chartContainer3", {
				animationEnabled: true,
				theme: "light2",
				title:{
					text: "Bar's CT"
				},
				axisY: {
				//	title: "Revenue in USD",
					
				},
				data: [{
					type: "spline",
					markerSize: 5,
					xValueFormatString: "YYYY",
					yValueFormatString: "$#,##0.##",
					xValueType: "dateTime",
					dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
				}]
			});
			 
			chart3.render();

			var chart4 = new CanvasJS.Chart("chartContainer4", {
				animationEnabled: true,
				theme: "light2",
				title:{
					text: "Bar's State"
				},
				axisY: {
				//	title: "Revenue in USD"
				},
				data: [{
					type: "spline",
					markerSize: 5,
					xValueFormatString: "YYYY",
					yValueFormatString: "$#,##0.##",
					xValueType: "dateTime",
					dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
				}]
			});
			 
			chart4.render();
			 
			}
		</script>

		
<!-- 		<script>
window.onload = function () {
 
var chart1 = new CanvasJS.Chart("chartContainer12", {
	title: {
		text: "Push-ups Over a Week"
	},
	axisY: {
		title: "Number of Push-ups"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
 VB. ' NJBVc z'
</script>
 -->

 <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 

		<!--Side-menu js-->

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
</script>
		

	</body>
</html>
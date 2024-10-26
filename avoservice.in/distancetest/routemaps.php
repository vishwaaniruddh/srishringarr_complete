<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Google Map</title>
</head>
<style type="text/css">
	#map{
		height: 80%;
	}
	html , body {
		height: 100%;
	}
</style>
<body onload="myfunction();">
<div class="container-fluid upper">
	<div class="row">
		<div class="col-md-2">
			<input type="button" value="Get Direction" name="btn" class="form-control" id="getdirection" />
		</div>
	</div>
</div>
<div id="map">
</div>
</body>
</html>
<script type="text/javascript">
	function myfunction(){
		var map;
		var bhilai = new google.maps.LatLng(21.152519712328164,81.32422654288021);
		var raipur = new google.maps.LatLng(21.217754149148618,81.63206235634682);
		var option ={
			zoom : 10,
			center : bhilai 
		};
		map = new google.maps.Map(document.getElementById('map'),option);
		var display = new google.maps.DirectionsRenderer();
		var services = new google.maps.DirectionsService();
		display.setMap(map);
		function calculateroute(){
			var request ={
				origin : bhilai,
				destination:raipur,
				travelMode: 'DRIVING'
			};
			services.route(request,function(result,status){
				//console.log(result,status);
				if(status =='OK'){
					display.setDirections(result);
				}
			});
		}
		document.getElementById('getdirection').onclick= function(){
			calculateroute();
		}
	}
</script>
<!-- google map api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&libraries=places"></script>
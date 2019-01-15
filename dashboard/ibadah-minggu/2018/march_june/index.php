<!DOCTYPE html>
<html lang="en">
	<!-- start: HEAD -->
	<head>
		<title>GPIB Kharis</title>
		<style type="text/css">
			.btn {
				border: none;
			    display: inline-block;
			    padding: 8px 16px;
			    vertical-align: middle;
			    overflow: hidden;
			    text-decoration: none;
			    color: inherit;
			    background-color: inherit;
			    text-align: center;
			    cursor: pointer;
			    white-space: nowrap;
			}
			.btn-color {
				background-color: #607D8B!important;
			}
			.btn-text {
				font-size: 14px;
			}
			.text-color {
				color: #ffffff;
			}
			.slider {
				display: none
			}
			.container{
				height: 530px;
				white-space: nowrap;
				overflow-x: auto;
			}
		</style>
	</style>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<div>
			<div id="container-1" class="container slider"></div>
			<div id="container-2" class="container slider"></div>
			<div id="container-3" class="container slider"></div>
		</div>
		<br>
		<div style="text-align: center;">
		  	<button class="btn btn-action" onclick="currentDiv(1)"><span class="btn-text">Subuh</span></button> 
		  	<button class="btn btn-action" onclick="currentDiv(2)"><span class="btn-text">Pagi</span></button> 
		  	<button class="btn btn-action" onclick="currentDiv(3)"><span class="btn-text">Sore</span></button> 
		</div>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="js/subuh.js<?="?".mt_rand();?>"></script>
		<script src="js/pagi.js<?="?".mt_rand();?>"></script>
		<script src="js/sore.js<?="?".mt_rand();?>"></script>
		<script type="text/javascript">
			var slideIndex = 1;
			showDivs(slideIndex);

			function currentDiv(n) {
				showDivs(slideIndex = n);
			}

			function showDivs(n) {
			  	var i;
			  	var x = document.getElementsByClassName("slider");
			  	var dots = document.getElementsByClassName("btn-action");
			  	var texts = document.getElementsByClassName("btn-text");
			  	if (n > x.length) {slideIndex = 1}
			  	if (n < 1) {slideIndex = x.length}
			  	for (i = 0; i < x.length; i++) {
			     	x[i].style.display = "none";
			  	}
			  	for (i = 0; i < dots.length; i++) {
			     	dots[i].className = dots[i].className.replace(" btn-color", "");
			     	texts[i].className = texts[i].className.replace(" text-color", "");
			  	}
			  	x[slideIndex-1].style.display = "block";
			  	dots[slideIndex-1].className += " btn-color";
			  	texts[slideIndex-1].className += " text-color";
			}
		</script>
	</body>
	<!-- end: BODY -->
</html>
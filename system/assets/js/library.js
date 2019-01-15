var pathArray = window.location.pathname.split("/");
var PATH = pathArray[5] != "" ? "../../../" : "../../";
var LIBS = {
	// Chart libraries
	plot: [
		PATH + "libs/misc/flot/jquery.flot.min.js",
		PATH + "libs/misc/flot/jquery.flot.pie.min.js",
		PATH + "libs/misc/flot/jquery.flot.stack.min.js",
		PATH + "libs/misc/flot/jquery.flot.resize.min.js",
		PATH + "libs/misc/flot/jquery.flot.curvedLines.js",
		PATH + "libs/misc/flot/jquery.flot.tooltip.min.js",
		PATH + "libs/misc/flot/jquery.flot.categories.min.js"
	],
	chart: [
		PATH + "libs/misc/echarts/build/dist/echarts-all.js",
		PATH + "libs/misc/echarts/build/dist/theme.js",
		PATH + "libs/misc/echarts/build/dist/jquery.echarts.js"
	],
	circleProgress: [
		PATH + "libs/bower/jquery-circle-progress/dist/circle-progress.js"
	],
	sparkline: [
		PATH + "libs/misc/jquery.sparkline.min.js"
	],
	maxlength: [
		PATH + "libs/bower/bootstrap-maxlength/src/bootstrap-maxlength.js"
	],
	tagsinput: [
		PATH + "libs/bower/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
		PATH + "libs/bower/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
	],
	TouchSpin: [
		PATH + "libs/bower/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css",
		PATH + "libs/bower/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"
	],
	selectpicker: [
		PATH + "libs/bower/bootstrap-select/dist/css/bootstrap-select.min.css",
		PATH + "libs/bower/bootstrap-select/dist/js/bootstrap-select.min.js"
	],
	filestyle: [
		PATH + "libs/bower/bootstrap-filestyle/src/bootstrap-filestyle.min.js"
	],
	timepicker: [
		PATH + "libs/bower/bootstrap-timepicker/js/bootstrap-timepicker.js"
	],
	datetimepicker: [
		PATH + "libs/bower/moment/moment.js",
		PATH + "libs/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css",
		PATH + "libs/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"
	],
	select2: [
		PATH + "libs/bower/select2/dist/css/select2.min.css",
		PATH + "libs/bower/select2/dist/js/select2.full.min.js"
	],
	vectorMap: [
		PATH + "libs/misc/jvectormap/jquery-jvectormap.css",
		PATH + "libs/misc/jvectormap/jquery-jvectormap.min.js",
		PATH + "libs/misc/jvectormap/maps/jquery-jvectormap-us-mill.js",
		PATH + "libs/misc/jvectormap/maps/jquery-jvectormap-world-mill.js",
		PATH + "libs/misc/jvectormap/maps/jquery-jvectormap-africa-mill.js"
	],
	summernote: [
		PATH + "libs/bower/summernote/dist/summernote.css",
		PATH + "libs/bower/summernote/dist/summernote.min.js"
	],
	DataTable: [
		PATH + "libs/misc/datatables/datatables.min.css",
		PATH + "libs/misc/datatables/datatables.min.js"
	],
	fullCalendar: [
		PATH + "libs/bower/moment/moment.js",
		PATH + "libs/bower/fullcalendar/dist/fullcalendar.min.css",
		PATH + "libs/bower/fullcalendar/dist/fullcalendar.min.js"
	],
	dropzone: [
		PATH + "libs/bower/dropzone/dist/min/dropzone.min.css",
		PATH + "libs/bower/dropzone/dist/min/dropzone.min.js"
	],
	counterUp: [
		PATH + "libs/bower/waypoints/lib/jquery.waypoints.min.js",
		PATH + "libs/bower/counterup/jquery.counterup.min.js"
	],
	others: [
		PATH + "libs/bower/switchery/dist/switchery.min.css",
		PATH + "libs/bower/switchery/dist/switchery.min.js",
		PATH + "libs/bower/lightbox2/dist/css/lightbox.min.css",
		PATH + "libs/bower/lightbox2/dist/js/lightbox.min.js"
	]
};
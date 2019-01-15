Highcharts.chart('container', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Pelkat GP<br>Periode: Maret - Juni 2018'
	},
	subtitle: {
	    text: 'Source: Database dari April 2017 - Maret 2018'
	},
	xAxis: {
	    categories: [
	        '10-Mar-2018',
	        '17-Mar-2018',
	        '24-Mar-2018',
	        '31-Mar-2018',
	        '7-Apr-2018',
	        '13-Apr-2018',
	        '21-Apr-2018',
	        '27-Apr-2018',
	        '5-May-2018',
	        '12-May-2018',
	        '19-May-2018',
	        '26-May-2018',
	        '2-Jun-2018',
	        '8-Jun-2018',
	        '14-Jun-2018',
	        '23-Jun-2018',
	        '30-Jun-2018',
	    ],
	    crosshair: true
	},
	yAxis: {
		min : 0,
        max : 144,
        tickPositions: [0, 25, 50, 75, 100, 125, 144],
        startOnTick: false,
        endOnTick: false,
        title: {
	        text: 'Jumlah Kehadiran'
	    }
    },
	tooltip: {
	    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	        '<td style="padding:0"><b>{point.y} Jemaat</b></td></tr>',
	    footerFormat: '</table>',
	    shared: true,
	    useHTML: true
	},
	plotOptions: {
	    column: {
	        pointPadding: 0.2,
	        borderWidth: 0,
	        dataLabels: {
                enabled: true
            }
	    }
	},
	series: [{
	    name: 'GP',
	    color: '#2196F3',
	    data: [0, 4, 0, 8, 11, 8, 8, 10, 9, 8, 5, 4, 5, 10, 7, 8, 0]
	}]
});
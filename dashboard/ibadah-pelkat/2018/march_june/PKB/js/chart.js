Highcharts.chart('container', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Pelkat PKB<br>Periode: Maret - Juni 2018'
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
	        '14-Apr-2018',
	        '21-Apr-2018',
	        '28-Apr-2018',
	        '5-May-2018',
	        '12-May-2018',
	        '19-May-2018',
	        '26-May-2018',
	        '2-Jun-2018',
	        '9-Jun-2018',
	        '16-Jun-2018',
	        '23-Jun-2018',
	        '30-Jun-2018',
	    ],
	    crosshair: true
	},
	yAxis: {
		min : 0,
        max : 127,
        tickPositions: [0, 25, 50, 75, 100, 127],
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
	    name: 'PKB',
	    color: '#795548',
	    data: [0, 20, 0, 26, 0, 15, 11, 0, 0, 11, 0, 12, 0, 11, 0, 14, 0]
	}]
});
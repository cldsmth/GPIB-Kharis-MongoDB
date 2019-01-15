Highcharts.chart('container', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Pelkat PKLU<br>Periode: Maret - Juni 2018'
	},
	subtitle: {
	    text: 'Source: Database dari April 2017 - Maret 2018'
	},
	xAxis: {
	    categories: [
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
	        '9-Jun-2018',
	        '14-Jun-2018',
	        '23-Jun-2018',
	        '30-Jun-2018',
	    ],
	    crosshair: true
	},
	yAxis: {
		min : 0,
        max : 84,
        tickPositions: [0, 25, 50, 70, 84],
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
	    name: 'PKLU',
	    color: '#FF9800',
	    data: [35, 0, 20, 0, 23, 0, 28, 0, 25, 0, 0, 25, 0, 26]
	}]
});
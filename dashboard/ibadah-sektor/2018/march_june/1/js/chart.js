Highcharts.chart('container', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Sektor 1<br>Periode: Maret - Juni 2018'
	},
	subtitle: {
	    text: 'Source: Database dari April 2017 - Maret 2018'
	},
	xAxis: {
	    categories: [
	        '21-Mar-2018',
	        '28-Mar-2018',
	        '4-Apr-2018',
	        '11-Apr-2018',
	        '18-Apr-2018',
	        '25-Apr-2018',
	        '2-May-2018',
	        '9-May-2018',
	        '16-May-2018',
	        '23-May-2018',
	        '13-Jun-2018',
	        '20-Jun-2018'
	    ],
	    crosshair: true
	},
	yAxis: {
		min : 0,
        max : 74,
        tickPositions: [0, 25, 50, 74],
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
	    name: 'Sektor 1',
	    color: '#9C27B0',
	    data: [17, 32, 32, 22, 17, 19, 17, 20, 15, 30, 23, 18]
	}]
});
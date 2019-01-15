Highcharts.chart('container', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Pelkat PKP<br>Periode: Maret - Juni 2018'
	},
	subtitle: {
	    text: 'Source: Database dari April 2017 - Maret 2018'
	},
	xAxis: {
	    categories: [
	        '20-Mar-2018',
	        '27-Mar-2018',
	        '3-Apr-2018',
	        '10-Apr-2018',
	        '17-Apr-2018',
	        '24-Apr-2018',
	        '1-May-2018',
	        '8-May-2018',
	        '15-May-2018',
	        '22-May-2018',
	        '29-May-2018',
	        '5-Jun-2018',
	        '12-Jun-2018',
	        '19-Jun-2018',
	        '26-Jun-2018',
	    ],
	    crosshair: true
	},
	yAxis: {
		min : 0,
        max : 158,
        tickPositions: [0, 25, 50, 75, 100, 130, 158],
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
	    name: 'PKP',
	    color: '#9C27B0',
	    data: [19, 23, 23, 33, 25, 32, 16, 27, 21, 21, 16, 14, 12, 19, 17]
	}]
});
Highcharts.chart('container-2', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Minggu Pagi<br>Periode: Maret - Juni 2018'
	},
	subtitle: {
	    text: 'Source: Database dari April 2017 - Maret 2018'
	},
	xAxis: {
	    categories: [
	    	'30-Mar-2018',
	        '1-Apr-2018',
	        '8-Apr-2018',
	        '15-Apr-2018',
	        '22-Apr-2018',
	        '29-Apr-2018',
	        '6-May-2018',
	        '13-May-2018',
	        '20-May-2018',
	        '27-May-2018',
	        '3-Jun-2018',
	        '10-Jun-2018',
	        '17-Jun-2018',
	        '24-Jun-2018'
	    ],
	    crosshair: true
	},
	yAxis: {
		min : 0,
        max : 513,
        tickPositions: [0, 100, 200, 300, 400, 513],
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
	    name: 'Pukul 09:00',
	    color: '#F06292',
	    data: [272, 133, 173, 145, 102, 105, 107, 159, 120, 122, 121, 93, 117, 117]
	}]
});
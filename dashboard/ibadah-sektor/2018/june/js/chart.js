Highcharts.chart('container', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Sektor<br>Periode: Juni 2018'
	},
	subtitle: {
	    text: 'Source: GPIB Kharis Pulo Gebang'
	},
	xAxis: {
	    categories: [
	        'Minggu Pertama',
	        'Minggu Kedua',
	        'Minggu Ketiga',
	        'Minggu Keempat'
	    ],
	    crosshair: true
	},
	yAxis: {
	    min: 0,
	    title: {
	        text: 'Jumlah Kehadiran'
	    }
	},
	labels: {
        items: [{
            html: 'Total Kehadiran Jemaat bulan ini',
            style: {
                left: '50px',
                top: '18px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
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
	    data: [0, 23, 18, 0]
	}, {
	    name: 'Sektor 2',
	    color: '#FF9800',
	    data: [0, 14, 11, 0]
	}, {
	    name: 'Sektor 3',
	    color: '#4CAF50',
	    data: [0, 35, 15, 0]
	}, {
	    name: 'Sektor 4',
	    color: '#2196F3',
	    data: [0, 0, 22, 0]
	}, {
        type: 'pie',
        name: 'Total',
        data: [{
            name: 'Sektor 1',
            y: 41,
            color: '#9C27B0'
        }, {
            name: 'Sektor 2',
            y: 25,
            color: '#FF9800'
        }, {
            name: 'Sektor 3',
            y: 50,
            color: '#4CAF50'
        }, {
            name: 'Sektor 4',
            y: 22,
            color: '#2196F3'
        }],
        center: [100, 80],
        size: 100,
        showInLegend: false,
        dataLabels: {
            enabled: true,
            format: '{y}'
        }
	}]
});
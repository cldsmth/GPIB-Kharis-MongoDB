Highcharts.chart('container', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Pelkat<br>Periode: Mei 2018'
	},
	subtitle: {
	    text: 'Source: GPIB Kharis Pulo Gebang'
	},
	xAxis: {
	    categories: [
	        'Minggu Pertama',
	        'Minggu Kedua',
	        'Minggu Ketiga',
	        'Minggu Keempat',
	        'Minggu Kelima',
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
	    name: 'PA',
	    color: '#F44336',
	    data: [0, 0, 0, 0, 0]
	}, {
	    name: 'PT',
	    color: '#009688',
	    data: [0, 0, 0, 0, 0]
	}, {
	    name: 'GP',
	    color: '#2196F3',
	    data: [9, 8, 5, 4, 0]
	}, {
	    name: 'PKP',
	    color: '#9C27B0',
	    data: [16, 27, 21, 21, 16]
	}, {
	    name: 'PKB',
	    color: '#795548',
	    data: [0, 11, 0, 12, 0]
	}, {
	    name: 'PKLU',
	    color: '#FF9800',
	    data: [0, 28, 0, 25, 0]
	}, {
        type: 'pie',
        name: 'Total',
        data: [{
            name: 'PA',
            y: 0,
            color: '#F44336'
        }, {
            name: 'PT',
            y: 0,
            color: '#009688'
        }, {
            name: 'GP',
            y: 12,
            color: '#2196F3'
        }, {
            name: 'PKP',
            y: 101,
            color: '#9C27B0'
        }, {
            name: 'PKB',
            y: 23,
            color: '#795548'
        }, {
            name: 'PKLU',
            y: 53,
            color: '#FF9800'
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
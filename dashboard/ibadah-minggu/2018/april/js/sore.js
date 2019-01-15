Highcharts.chart('container-3', {
	chart: {
	    type: 'column'
	},
	title: {
	    text: 'Jumlah Kehadiran Ibadah Minggu Sore<br>Periode: April 2018'
	},
	subtitle: {
	    text: 'Source: GPIB Kharis Pulo Gebang'
	},
	xAxis: {
	    categories: [
	        '1-Apr-2018',
	        '8-Apr-2018',
	        '15-Apr-2018',
	        '22-Apr-2018',
	        '29-Apr-2018'
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
	    name: 'Laki-laki',
	    color: '#2196F3',
	    data: [50, 71, 106, 129, 144]
	}, {
	    name: 'Perempuan',
	    color: '#F06292',
	    data: [83, 78, 98, 93, 52]
	}, {
	    name: 'Anak-anak',
	    color: '#4CAF50',
	    data: [42, 33, 34, 39, 106]
	}, {
        type: 'pie',
        name: 'Total',
        data: [{
            name: 'Laki-laki',
            y: 500,
            color: '#2196F3'
        }, {
            name: 'Perempuan',
            y: 458,
            color: '#F06292'
        }, {
            name: 'Anak-anak',
            y: 200,
            color: '#4CAF50'
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
$(document).ready(function() {

    Highcharts.chart('chart1', {

        title: {
        text: 'Solar Employment Growth by Sector, 2010-2016'
        },

        subtitle: {
        text: 'Source: thesolarfoundation.com'
        },

        yAxis: {
        title: {
            text: 'Number of Employees'
        }
        },

        xAxis: {
            categories: ['Jan','Feb','Maret','Apr','Mei'],
            accessibility: {
                rangeDescription: 'Range: 2010 to 2017'
            }
        },

        legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
        },

        plotOptions: {
        series: {
            label: {
            connectorAllowed: false
            },
            pointStart: 2010
        }
        },

        series: [{
        name: 'Rendah',
        data: [1, 1, 1, 1, 0]
        }],

        responsive: {
        rules: [{
            condition: {
            maxWidth: 500
            },
            chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
            }
        }]
        }

        });
})
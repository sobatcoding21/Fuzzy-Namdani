$(document).ready(function() {

    //Disaster
    var catD = ["0","1","4","8","10"];
    var seriesD = [
        {
            name: 'Rendah',
            data: [1, 1, 0, 0, 0]
        },
       {
            name: 'Sedang',
            data: [0, 0, 1, 0, 0]
        },
        {
            name: 'Tinggi',
            data: [0, 0, 0, 1, 1]
        },
        
    ];
    SetDiagram('chartD', 'Variable Bencana (D)', catD, seriesD);

    //Populasi
    var catPD = ["0","2760","23269","43778","6000"];
    var seriesPD = [
        {
            name: 'Rendah',
            data: [1, 1, 0, 0, 0]
        },
       {
            name: 'Sedang',
            data: [0, 0, 1, 0, 0]
        },
        {
            name: 'Tinggi',
            data: [0, 0, 0, 1, 1]
        },
        
    ];
    SetDiagram('chartPD', 'Variable Populasi (PD)', catPD, seriesPD);

    //Bangunan Terdampak
    var catNB = ["0","500","1000","2000","3000"];
    var seriesNB = [
        {
            name: 'Rendah',
            data: [1, 1, 0, 0, 0]
        },
       {
            name: 'Sedang',
            data: [0, 0, 1, 0, 0]
        },
        {
            name: 'Tinggi',
            data: [0, 0, 0, 1, 1]
        },
        
    ];
    SetDiagram('chartNB', 'Var Bang.Terdam (NB)', catNB, seriesNB);

    //Faskes
    var catHF = ["0","500","1000","2000","3000"];
    var seriesHF= [
        {
            name: 'Rendah',
            data: [1, 1, 0, 0, 0]
        },
       {
            name: 'Sedang',
            data: [0, 0, 1, 0, 0]
        },
        {
            name: 'Tinggi',
            data: [0, 0, 0, 1, 1]
        },
        
    ];
    SetDiagram('chartHF', 'Variable Faskes (HF)', catHF, seriesHF);



    function SetDiagram(elm, title, categories, series)
    {
        Highcharts.chart(elm, {
            chart: {
                type: 'line'
            },
            title: {
                text: title
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: false
                    },
                    enableMouseTracking: false
                }
            },
            series: series
        });

    }
    
    
})
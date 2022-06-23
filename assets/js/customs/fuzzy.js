$(document).ready(function() {

    //Disaster
    var catD = ["0","2","4","6","8"];
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
    SetDiagram('chartD', 'Diagram Fuzzy Variable Bencana (D)', catD, seriesD);

    //Populasi
    var catPD = ["0","2000","4000","6000","8000"];
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
    SetDiagram('chartPD', 'Diagram Fuzzy Variable Populasi (PD)', catPD, seriesPD);

    //Bangunan Terdampak
    var catNB = ["0","10","20","30","40"];
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
    SetDiagram('chartNB', 'Diagram Fuzzy Variable Bangunan Terdampak (NB)', catNB, seriesNB);

    //Faskes
    var catHF = ["0","2","4","6","8"];
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
    SetDiagram('chartHF', 'Diagram Fuzzy Variable Faskes (HF)', catHF, seriesHF);



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
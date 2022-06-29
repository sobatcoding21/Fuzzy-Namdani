var map;
var examp = 
{
	"type": "FeatureCollection",
    "features": [
                    {
                        "type": "Feature",
                        "properties": {
                            "fillColor": "blue"
                        },
                        "geometry": {
                            "type": "Polygon",
                            "coordinates": [
                                [
                                    [-73.98779153823898, 40.718233223261],
                                    [-74.004946447098, 40.723575517498],
                                    [-74.006771211624, 40.730592217474],
                                    [-73.99010896682698, 40.746712376146],
                                    [-73.973135948181, 40.73974615047701],
                                    [-73.975120782852, 40.736128627654],
                                    [-73.973997695541, 40.730787341083],
                                    [-73.983317613602, 40.716639396436],
                                    [-73.98779153823898, 40.718233223261]
                                ]
                            ]
                        }
                    },
                    {
                        "type": "Feature",
                        "properties": {
                            "name": "KEMASAN",
                            "display_name": "Kemasan, Kediri",
                            "fillColor": "red"
                        },
                        "geometry": {
                            "type": "Polygon",
                            "coordinates": [
                                [112.012457, -7.819167],
                                [112.018968, -7.821123],
                                [112.019222, -7.819465],
                                [112.012914, -7.818147]
                            ]
                        }
                    }
                ]
};

function initMap() {
    $('#map').css('width', ($('.card-body:last').width() - 20) + 'px');
    

    $.get(BASE_URL+ 'getgeojson?tahun='+$('#tahun').val()+'&bencana='+ $('#q').val() + '&indeks=' + $('#indeks').val(), function(data,success) {
        
        var map = L.map('map').setView([-7.8422463, 111.9461471], 12.6);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors',
            id: 'mapbox/streets-v11'
        }).addTo(map);
    
        L.geoJson(data, {
                onEachFeature: function(feature, layer) {
                    var label = L.marker(layer.getBounds().getCenter(), {
                    icon: L.divIcon({
                        className: 'label',
                        html: feature.properties.name,
                        iconSize: [100, 40]
                    })
                    }).addTo(map);
                },
                style: style
            }).bindPopup(function (layer) {
            return layer.feature.properties.display_name;
        }).addTo(map);

        var legend = L.control({position: 'bottomright'});
        legend.onAdd = function (map) {

            var div = L.DomUtil.create('div', 'info legend'),
                grades = ['Tinggi', 'Sedang', 'Rendah'],
                labels = [];

            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length; i++) {
                div.innerHTML +=
                    '<i style="background:' + getColor(grades[i]) + '"></i> ' +
                    grades[i] + '<br>';
            }

            return div;
        };

        legend.addTo(map);


    });

}

function getColor(d) {
    return d == 'Tinggi' ? '#BD0026' :
           d == 'Sedang'  ? '#FC4E2A' : '#add19e';
}

function style(feature) {
    return {
        fillColor: feature.properties.output != undefined ? getColor(feature.properties.output) : '#93bcf4',
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}

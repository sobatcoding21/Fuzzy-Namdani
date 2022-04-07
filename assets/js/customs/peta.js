var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: new google.maps.LatLng(-7.8422463, 111.9461471),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    map.data.loadGeoJson(
        "https://mapforenvironment.org/api/feature/json/1332/265/Indonesia-Level-Kota-dan-Kabupaten.geojson"
      );

    $.get(BASE_URL+ 'peta-bencana?bencana='+ $('#q').val() + '&indeks=' + $('#indeks').val(), function(data,success) {
        console.log(data);
        console.log(success);

        for(var i=0;i< data.length;i++)
        {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(data[i]['lat'], data[i]['long']),
                map: map,
                title : data[i]['nama']
            });
        }
    });
}

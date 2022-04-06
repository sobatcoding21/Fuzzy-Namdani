var map;


initMap();
function initMap() {
    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: new google.maps.LatLng(-7.8422463, 111.9461471),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    map.data.loadGeoJson(
        "https://mapforenvironment.org/api/feature/json/1332/265/Indonesia-Level-Kota-dan-Kabupaten.geojson"
      );
    
}
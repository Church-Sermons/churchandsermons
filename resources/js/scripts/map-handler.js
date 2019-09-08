(function() {
    GoogleMapsApi({
        key: "AIzaSyD-UgvAr46AOs_pnTWgSNAah9FuFKyjJ8M"
    })
        .then(function initMap(googleMaps) {
            // elements
            const mapContainer = document.getElementById("map");
            // get location
            if (mapContainer) {
                // lat and lon
                const location = {
                    lat: 40.74,
                    lng: -73.99
                };

                console.log(location);
                // use location
                // create map
                const map = new googleMaps.Map(mapContainer, {
                    zoom: 4,
                    center: location
                });
                // The marker, positioned at Uluru
                const marker = new googleMaps.Marker({
                    position: location,
                    map: map
                });
            }
        })
        .catch(error => console.log(error));
})();

// Reference - https://themeforest.net/item/luxury-responsive-bootstrap-4-admin-template/20881509

!function() {
    window.initMap = function() {
      var chicago = {lat: 41.85, lng: -87.65};
      var indianapolis = {lat: 39.79, lng: -86.14};

      var map = new google.maps.Map(document.getElementById('map-google'), {
        center: chicago,
        scrollwheel: false,
        zoom: 7
      });

      var directionsDisplay = new google.maps.DirectionsRenderer({ map: map });

      // Set destination, origin and travel mode.
      var request = {
        destination: indianapolis,
        origin: chicago,
        travelMode: 'DRIVING'
      };

      // Pass the directions request to the directions service.
      var directionsService = new google.maps.DirectionsService();
      directionsService.route(request, function(response, status) {
        if (status == 'OK') {
          // Display the route on the map.
          directionsDisplay.setDirections(response);
        }
      });
    }
}();
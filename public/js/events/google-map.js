function initMap() {
  initialize();
}

// Wait until the entire DOM is fully loaded before running the initialize function
document.addEventListener('DOMContentLoaded', function() {
  initMap();
});

// Initialize Google Maps Places Autocomplete for the address input field
function initialize() {
  var input = document.getElementById('autocomplete');
  var autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener('place_changed', function () {
    var place = autocomplete.getPlace();
    document.getElementById('latitude').value = place.geometry['location'].lat();
    document.getElementById('longitude').value = place.geometry['location'].lng();
  });
}

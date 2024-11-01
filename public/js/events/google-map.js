// Wait until the entire DOM is fully loaded before running the initialize function
document.addEventListener('DOMContentLoaded', function() {
  initMap();
});

// Initialize Google Maps Places Autocomplete for the address input field
function initMap() {
  var inputautocomplete = document.getElementById('autocomplete');
  var autocomplete = new google.maps.places.Autocomplete(inputautocomplete);

  autocomplete.addListener('place_changed', function () {
    var place = autocomplete.getPlace(); 
    document.getElementById('latitude').value = place.geometry['location'].lat();
    document.getElementById('longitude').value = place.geometry['location'].lng();
  });
}

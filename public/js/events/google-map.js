// Wait until the entire DOM is fully loaded before running the initialize function
document.addEventListener('DOMContentLoaded', function() {
  initialize();
});

// Initialize Google Maps Places Autocomplete for the address input field
function initialize() {
  // Get the address input element
  var input = document.getElementById('autocomplete');
  
  // Create a new Autocomplete object for the input field
  var autocomplete = new google.maps.places.Autocomplete(input);

  // Add an event listener for when the user selects a place
  autocomplete.addListener('place_changed', function () {
    // Get the selected place details
    var place = autocomplete.getPlace();
    
    // Set the latitude and longitude hidden fields with the selected place's coordinates
    document.getElementById('latitude').value = place.geometry['location'].lat();
    document.getElementById('longitude').value = place.geometry['location'].lng();
  });
}

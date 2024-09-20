function showMap() {
  var address = '{{ urlencode($event->address) }}';
  var mapFrame = document.getElementById('mapFrame');
  mapFrame.src = 'https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=' + address;
  document.getElementById('map').style.display = 'block';
}
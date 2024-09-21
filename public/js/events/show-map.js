function showMap() {
  const address = document.querySelector('p[data-address]').dataset.address;
  const mapUrl = `https://www.google.com/maps/search/?api=1&query=${address}`;
  window.open(mapUrl, '_blank');
}


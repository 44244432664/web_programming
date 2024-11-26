<div>
  <h1>Locations</h1>
  <div id="map" style="width:100%;height:600px;"></div>
</div>

<script>
  const mapboxAccessToken = "pk.eyJ1IjoicmVnbHciLCJhIjoiY20zZmM1b2xnMG12YjJrb2x4bmFnbGcydSJ9.WN6mwV9GB1_e65_OVk5cfw";

  // Initialize the map
  mapboxgl.accessToken = mapboxAccessToken;
  const map = new mapboxgl.Map({
    container: "map",
    center: [106.700981, 10.775659], // Center of Ho Chi Minh City
    zoom: 13,
    style: "mapbox://styles/mapbox/streets-v11",
  });

  // Define four fixed locations in Ho Chi Minh City
  const fixedLocations = [
    { coords: [106.700981, 10.775659], name: "Ben Thanh Market" },
    { coords: [106.709981, 10.762622], name: "Notre-Dame Cathedral" },
    { coords: [106.707754, 10.779826], name: "Independence Palace" },
    { coords: [106.703335, 10.776858], name: "Saigon Opera House" },
  ];

  // Add markers for each fixed location
  fixedLocations.forEach((location) => {
    new mapboxgl.Marker()
      .setLngLat(location.coords)
      .setPopup(new mapboxgl.Popup().setText(location.name)) // Add name to the popup
      .addTo(map);
  });
</script>

<div class="container">
    <h1>Contact Us</h1>
    <div class="contact-info">
      <p><strong>Phone:</strong> +84 123 456 789</p>
      <p><strong>Email:</strong> <a href="mailto:contact@company.com">contact@company.com</a></p>
      <p><strong>Mailing Address:</strong> 268 Ly Thuong Kiet Street, Ward 14, District 10, Ho Chi Minh City, Vietnam</p>
    </div>
    <div id="map"></div>
</div>
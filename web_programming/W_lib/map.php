<div>
<h1>Maps location search</h1>
</div>
<!-- <div class="d-inline-flex justify-content-center">
  <form action="" method="post" class="d-inline-flex justify-content-center">
    <input type="text" name="address" placeholder="enter the address" class="form-control">
    <button type="submit" class="btn btn-md me-2 btn-primary">
        <i class="fa fa-send"></i>
    </button>
  </form>
</div> -->

<!-- <div id="map" style="width:100%;height:600px;" class="bg-light"></div> -->
<div id='search-box-container'></div>
<div id="map" style="width:100%;height:600px;"></div>
<?php


// https://api.mapbox.com/search/geocode/v6/forward?q=497&proximity=ip&access_token=pk.eyJ1IjoicmVnbHciLCJhIjoiY20zZmM1b2xnMG12YjJrb2x4bmFnbGcydSJ9.WN6mwV9GB1_e65_OVk5cfw

?>
<!-- 
<script>
      accessToken = "pk.eyJ1IjoicmVnbHciLCJhIjoiY20zZmM1b2xnMG12YjJrb2x4bmFnbGcydSJ9.WN6mwV9GB1_e65_OVk5cfw";
  
      mapboxgl.accessToken = "pk.eyJ1IjoicmVnbHciLCJhIjoiY20zZmM1b2xnMG12YjJrb2x4bmFnbGcydSJ9.WN6mwV9GB1_e65_OVk5cfw";
      const map = new mapboxgl.Map({
        container: 'map',
        center: [106.6296638,10.8230989],
        zoom: 13,
        style: 'mapbox://styles/reglw/cm3fcgh0z000m01sdezm3fq8m',
        // config: {
        //     // Initial configuration for the Mapbox Standard style set above. By default, its ID is `basemap`.
        //     basemap: {
        //         // Here, we're setting the light preset to `night`.
        //         lightPreset: 'night'
        //     }
        // }
      });

    </script> -->

    <script>
  const script = document.getElementById('search-js');
  // wait for the Mapbox Search JS script to load before using it
  script.onload = function () {
    const mapboxAccessToken = 'pk.eyJ1IjoicmVnbHciLCJhIjoiY20zZmM1b2xnMG12YjJrb2x4bmFnbGcydSJ9.WN6mwV9GB1_e65_OVk5cfw';

    // instantiate a map
    const map = new mapboxgl.Map({
        accessToken: mapboxAccessToken,
        container: 'map',
        center: [106.6296638, 10.8230989],
        zoom: 13,
        style: 'mapbox://styles/reglw/cm3fcgh0z000m01sdezm3fq8m',
    });

    // instantiate a search box instance
    const searchBox = new mapboxsearch.MapboxSearchBox()

    // set the mapbox access token, search box API options
    searchBox.accessToken = mapboxAccessToken
    searchBox.options = {
      language: 'en'
    }

    // set the mapboxgl library to use for markers and enable the marker functionality
    searchBox.mapboxgl = mapboxgl
    searchBox.marker = true

    // bind the search box instance to the map instance
    searchBox.bindMap(map)

    // add the search box instance to the DOM
    document.getElementById('search-box-container').appendChild(searchBox)
  }
</script>
</body>
</html>
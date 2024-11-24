
    <!-- <h2 class="text-center primary">Select Your Location</h2> -->
    <div class="d-flex justify-content-center">
    <form id="locationForm" action="" method="POST">
        <div class="mb-3">
        <img src="img/Wanderer_s_Library.png" style="width:50%;" alt="The Wanderer's Library" class="center">
        <h2 class="text-center primary">Select Your Location</h2>
        </div>
        
        <div class="mb-3">
        <label for="country" class="form-label">Country:</label>
        <select id="country" class="form-select" name="country" required onchange="populateStates()">
            <option value="">Select a country</option>
            <option value="USA">United States</option>
            <option value="Canada">Canada</option>
        </select>
        </div>
        
        <div class="mb-3">
        <label for="state" class="form-label">State:</label>
        <select id="state" class="form-select" name="state" required onchange="populateCities()" disabled>
            <option value="">Select a state</option>
        </select>
        </div>
        
        <!-- <br><br> -->
        
        <div class="mb-3">
        <label for="city" class="form-label">City:</label>
        <select id="city" class="form-select" name="city" required disabled>
            <option value="">Select a city</option>
        </select>
        </div>
        
        <!-- <br><br> -->
        <div class="d-flex justify-content-center">
        <button class="btn btn-primary hover m-1" type="submit">Submit</button>
        </div>
    </form>
    </div>

    <script>
        // Example data
        const locationData = {
            "USA": {
                "California": ["Los Angeles", "San Francisco", "San Diego"],
                "Texas": ["Houston", "Dallas", "Austin"],
            },
            "Canada": {
                "Ontario": ["Toronto", "Ottawa"],
                "Quebec": ["Montreal", "Quebec City"],
            }
        };

        function populateStates() {
            const countrySelect = document.getElementById("country");
            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");
            const selectedCountry = countrySelect.value;

            // Reset and disable dependent dropdowns
            stateSelect.innerHTML = '<option value="">Select a state</option>';
            citySelect.innerHTML = '<option value="">Select a city</option>';
            citySelect.disabled = true;

            if (selectedCountry) {
                const states = Object.keys(locationData[selectedCountry]);
                states.forEach(state => {
                    const option = document.createElement("option");
                    option.value = state;
                    option.textContent = state;
                    stateSelect.appendChild(option);
                });
                stateSelect.disabled = false;
            } else {
                stateSelect.disabled = true;
            }
        }

        function populateCities() {
            const countrySelect = document.getElementById("country");
            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");
            const selectedCountry = countrySelect.value;
            const selectedState = stateSelect.value;

            citySelect.innerHTML = '<option value="">Select a city</option>';

            if (selectedCountry && selectedState) {
                const cities = locationData[selectedCountry][selectedState];
                cities.forEach(city => {
                    const option = document.createElement("option");
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
            } else {
                citySelect.disabled = true;
            }
        }

        // Form submit event (for demonstration only)
        document.getElementById("locationForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const country = document.getElementById("country").value;
            const state = document.getElementById("state").value;
            const city = document.getElementById("city").value;
            alert(`Selected Location: ${country}, ${state}, ${city}`);
            // Here you would normally submit the form
            // this.submit();  // Uncomment this line to allow form submission
        });
    </script>
</body>
</html>



    <!-- let map;
        let geocoder;
        let marker;

        async function initMap() {
            // Default location (optional)
            const { Map } = await google.maps.importLibrary("maps");
            const defaultLocation = { lat: 37.7749, lng: -122.4194 }; // San Francisco
            
            // Initialize map and geocoder
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: defaultLocation,
            });
            geocoder = new google.maps.Geocoder();

            // Check if PHP has provided an address or coordinates
            <?php // if (!empty($address)) : ?>
                geocodeAddress("<?php // echo addslashes($address); ?>");
            <?php // elseif (!empty($latitude) && !empty($longitude)) : ?>
                const location = { lat: parseFloat("<?php // echo $latitude; ?>"), lng: parseFloat("<?php // echo $longitude; ?>" )};
                setMapLocation(location);
            <?php // endif; ?>
        }

        function geocodeAddress(address) {
            geocoder.geocode({ address: address }, function(results, status) {
                if (status === "OK") {
                    setMapLocation(results[0].geometry.location);
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }

        function setMapLocation(location) {
            map.setCenter(location);
            placeMarker(location);
        }

        function placeMarker(location) {
            // Remove existing marker, if any
            if (marker) marker.setMap(null);
            
            // Place a new marker
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        initMap(); -->
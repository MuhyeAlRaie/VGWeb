// Sample JSON data for apartment details
var apartmentData = {
    "apartment1": {
        "video": "asset/apartmentsVid.mp4",
        "image": "asset/FloorPlane.jpg",
        "price": 250000,
        "surface": 100,
        "availability": "Available",
        "bedroom": 2,
        "bathroom": 1
    },
    "apartment2": {
        "video": "asset/apartmentsVid.mp4",
        "image": "asset/FloorPlane.jpg",
        "price": 200000,
        "surface": 60,
        "availability": "Reserved",
        "bedroom": 1,
        "bathroom": 1
    },
    "apartment3": {
        "video": "asset/apartmentsVid.mp4",
        "image": "asset/FloorPlane.jpg",
        "price": 150000,
        "surface": 60,
        "availability": "Available",
        "bedroom": 1,
        "bathroom": 1
    },  
     "apartment4": {
        "video": "asset/apartmentsVid.mp4",
        "image": "asset/FloorPlane.jpg",
        "price": 140000,
        "surface": 50,
        "availability": "Available",
        "bedroom": 1,
        "bathroom": 1
    },
    "apartment5": {
        "video": "asset/apartmentsVid.mp4",
        "image": "asset/FloorPlane.jpg",
        "price": 180000,
        "surface": 80,
        "availability": "Reserved",
        "bedroom": 2,
        "bathroom": 1
    },
    // Add details for other apartments as needed
};


function changeVideo(videoSource, button) {
    document.getElementById('background-video').src = videoSource;

    // Remove 'active' class from all buttons
    document.querySelectorAll('.navbar-button').forEach(function (btn) {
        btn.classList.remove('active');
    });

    // Add 'active' class to the clicked button
    button.classList.add('active');
}

function openSidebar(type, button) {
    var sidebar = document.getElementById('sidebar');
    var secondSidebar = document.getElementById('second-sidebar');

    sidebar.innerHTML = ''; // Clear previous content
    secondSidebar.style.display = 'none'; // Hide second sidebar

    // Remove 'active' class from all buttons
    document.querySelectorAll('.navbar-button').forEach(function (btn) {
        btn.classList.remove('active');
    });

    // Add 'active' class to the clicked button
    button.classList.add('active');

    if (type === 'apartments') {
        // Change video source and dynamically generate buttons for apartments
        changeVideo('asset/apartmentsVid.mp4', button);
        sidebar.innerHTML ='<div id="filter-section" class="position-relative top-20 start-50 translate-middle-x z-index-1 d-grid">'+
        '<label for="filter-price">Price:</label>'+
        '<input type="text" id="filter-price" placeholder="Enter price">'+
       ' <label for="filter-surface">Surface:</label>'+
        '<input type="text" id="filter-surface" placeholder="Enter surface">'+
        '<label for="filter-availability">Availability:</label>'+
        '<select id="filter-availability">'+
           ' <option value="">All</option>'+
            '<option value="Available">Available</option>'+
            '<option value="Reserved">Reserved</option>'+
        '</select>'+
        '<button onclick="applyFilters()">Apply Filters</button>'+
    '</div>';
        // Loop through the apartmentData and generate buttons
        var apartmentWrapperDiv = document.createElement('div');
        apartmentWrapperDiv.className = 'apartment-wrapper';
        
        // Loop through the apartmentData and generate buttons
        for (var apartmentKey in apartmentData) {
            if (apartmentData.hasOwnProperty(apartmentKey)) {
                var apartmentButton = document.createElement('button');
                apartmentButton.textContent = apartmentKey;
                apartmentButton.onclick = (function (key) {
                    return function () {
                        changeVideo(apartmentData[key].video, button);
                        showApartmentDetails(key);
                    };
                })(apartmentKey);
                
                // Append each button to the wrapper div
                apartmentWrapperDiv.appendChild(apartmentButton);
            }
        }
        
        // Append the wrapper div with apartment buttons to the sidebar
        sidebar.appendChild(apartmentWrapperDiv);
    } else if (type === 'home') {
// Change video source and add custom content for Home
changeVideo('asset/HomeVid.mp4', button);

var wrapperDiv = document.createElement('div');
wrapperDiv.className = 'home-wrapper';

// Set innerHTML for the wrapper div
wrapperDiv.innerHTML = '<h2>Your Project on Earth</h2>' +
    '<p>We are developing a sophisticated complex tailored for individuals who appreciate contemporary urban living. This innovative concept is designed to impeccably align with the distinctive standards of Dubai.</p>' +
    '<div class="statistics-wrapper">' +
    '<div class="item"><div class="number">4</div><div class="description">minutes to the bus station</div></div>' +
    '<div class="item"><div class="number">7</div><div class="description">minutes to the shopping center</div></div>' +
    '<div class="item"><div class="number">25</div><div class="description">minutes from the airport</div></div>' +
    '</div>'+
    '<div class="svg-with-text-wrapper"><img class="your-svg-class" src="asset/location-sign-svgrepo-com.svg" alt="Your SVG"><span class="svg-text">Riyadh, saudi arabia</span></div>';
    ;

// Append the wrapper div to the sidebar
sidebar.appendChild(wrapperDiv);
    } else if (type === 'features') {
        // Change video source and add buttons for features
        changeVideo('asset/FeaturesVid.mp4', button);
        var features = ['RoofTopGarden', 'PlayGround', 'Parking', 'ShoppingMall'];

        // Create a wrapper div
        var wrapperDiv = document.createElement('div');
        wrapperDiv.className = 'Feature-wrapper';

        for (var j = 0; j < features.length; j++) {
            var featureButton = document.createElement('button');
            featureButton.textContent = features[j];
            featureButton.onclick = function () {
                changeVideo('asset/Bgvid.mp4', button);
                // Handle feature click
                // You can customize this function to display more information about the feature
                console.log('Feature Clicked: ' + features[j]);
            };

            // Append each button to the wrapper div
            wrapperDiv.appendChild(featureButton);
        }

        // Append the wrapper div to the sidebar
        sidebar.appendChild(wrapperDiv);

    } else if (type === 'contact') {
        // Change video source and add buttons for features
        changeVideo('asset/Bgvid.mp4', button);

        // Create a wrapper div for contact information
        var contactWrapperDiv = document.createElement('div');
        contactWrapperDiv.className = 'contact-wrapper';

        // Set innerHTML for the wrapper div
        contactWrapperDiv.innerHTML = '<h2>CONTACT US</h2>' +
            '<p>We are excited to hear from you and assist with any inquiries or feedback you may have. Please do not hesitate to reach out through one of the following methods:</p>' +
            '<h3>Our Address</h3>' +
            '<p>Queen Rania Street, Amman, Jordan</p>' +
            '<h3>Email Us</h3>' +
            '<p>MR@VORTIGATE.COM</p>' +
            '<h3>Call Us</h3>' +
            '<p>+966 50 971 1777</p>' +
            '<p>+962 781313782</p>';

        // Append the wrapper div with contact information to the sidebar
        sidebar.appendChild(contactWrapperDiv);
    }
    sidebar.style.display = 'block';
}

function showApartmentDetails(apartmentKey) {
    var secondSidebar = document.getElementById('second-sidebar');
    var apartmentImage = document.getElementById('apartment-image');
    var apartmentPrice = document.getElementById('apartment-price');
    var apartmentSurface = document.getElementById('apartment-surface');
    var apartmentAvailability = document.getElementById('apartment-availability');
    var apartmentBedroom = document.getElementById('apartment-bedroom');
    var apartmentBathroom = document.getElementById('apartment-bathroom');

    var filterSection = document.getElementById('filter-section');
    var sidebar = document.getElementById('sidebar');

    // Get the apartment details from the JSON data
    var apartmentDetails = apartmentData[apartmentKey];

    // Set apartment details
    apartmentImage.src = apartmentDetails.image;
    apartmentPrice.textContent = 'Price: $' + apartmentDetails.price.toLocaleString(); // Format price
    apartmentSurface.textContent = 'Surface: ' + apartmentDetails.surface + ' m²';
    apartmentAvailability.textContent = 'Availability: ' + apartmentDetails.availability;
    apartmentBedroom.textContent = 'Bedroom: ' + apartmentDetails.bedroom;
    apartmentBathroom.textContent = 'Bathroom: ' + apartmentDetails.bathroom;

    // Show the filter section
    filterSection.style.display = 'flex';

    // Hide the second sidebar
    secondSidebar.style.display = 'block';

    // Hide the sidebar
    sidebar.style.display = 'block';
}

// Function to apply filters and update the list of apartments
function applyFilters() {
    var filterPrice = parseFloat(document.getElementById('filter-price').value) || 0;
    var filterSurface = parseFloat(document.getElementById('filter-surface').value) || 0;
    var filterAvailability = document.getElementById('filter-availability').value;

    var filteredApartments = {};

    // Apply filters to the apartment data
    for (var apartmentKey in apartmentData) {
        if (apartmentData.hasOwnProperty(apartmentKey)) {
            var apartment = apartmentData[apartmentKey];
            if (
                (filterPrice === 0 || apartment.price <= filterPrice) &&
                (filterSurface === 0 || apartment.surface <= filterSurface) &&
                (filterAvailability === "" || apartment.availability === filterAvailability)
            ) {
                filteredApartments[apartmentKey] = apartment;
            }
        }
    }

    // Update the sidebar with filtered apartments
    updateSidebar(filteredApartments);
}

// Function to update the sidebar with the filtered apartments
function updateSidebar(apartments) {
    var sidebar = document.getElementById('sidebar');

    sidebar.innerHTML ='<div id="filter-section" class="position-relative top-20 start-50 translate-middle-x z-index-1 d-grid">'+
    '<label for="filter-price">Price:</label>'+
    '<input type="text" id="filter-price" placeholder="Enter price">'+
   ' <label for="filter-surface">Surface:</label>'+
    '<input type="text" id="filter-surface" placeholder="Enter surface">'+
    '<label for="filter-availability">Availability:</label>'+
    '<select id="filter-availability">'+
       ' <option value="">All</option>'+
        '<option value="Available">Available</option>'+
        '<option value="Reserved">Reserved</option>'+
    '</select>'+
    '<button onclick="applyFilters()">Apply Filters</button>'+
'</div>';


// Clear previous content
    // sidebar.innerHTML = ''; 

    for (var apartmentKey in apartments) {
        if (apartments.hasOwnProperty(apartmentKey)) {
            var apartmentButton = document.createElement('button');
            apartmentButton.textContent = apartmentKey;
            apartmentButton.onclick = (function (key) {
                return function () {
                    changeVideo(apartments[key].video, apartmentButton);
                    showApartmentDetails(key);
                };
            })(apartmentKey);
            sidebar.appendChild(apartmentButton);
        }
    }
}
function openIframe() {
    // Create an iframe element
    var iframe = document.createElement('iframe');
    iframe.src = 'https://momento360.com/e/u/a9b53aa8f8b0403ba7a4e18243aabc66'; // Set the URL for your iframe content
    iframe.width = '800'; // Set the width of the iframe
    iframe.height = '600'; // Set the height of the iframe

    // Create a container div for the iframe
    var iframeContainer = document.createElement('div');
    iframeContainer.className = 'iframe-container';

    // Append the iframe to the container
    iframeContainer.appendChild(iframe);

    // Append the container to the body
    document.body.appendChild(iframeContainer);

    // Center the iframe on the screen
    iframeContainer.style.position = 'fixed';
    iframeContainer.style.top = '50%';
    iframeContainer.style.left = '50%';
    iframeContainer.style.transform = 'translate(-50%, -50%)';
    iframeContainer.style.zIndex = '9999';

    // Add a close button to the iframe
    var closeButton = document.createElement('button');
    closeButton.textContent = 'Close';
    closeButton.onclick = function () {
        document.body.removeChild(iframeContainer);
    };

    // Append the close button to the container
    iframeContainer.appendChild(closeButton);
}

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
        // Change video source and add buttons for apartments
        changeVideo('video1.mp4', button);
        for (var i = 1; i <= 10; i++) {
            var apartmentButton = document.createElement('button');
            apartmentButton.textContent = 'Apartment' + (i < 10 ? '0' + i : i);
            apartmentButton.onclick = (function (index) {
                return function () {
                    changeVideo('video' + index + '.mp4', button);
                    showApartmentDetails(index);
                };
            })(i);
            sidebar.appendChild(apartmentButton);
        }
    } else if (type === 'home') {
        // Change video source and add custom content for Home
        changeVideo('HomeVid.mp4', button);
        sidebar.innerHTML = '<h2>Your Project on Earth</h2>' +
            '<p>We are developing a sophisticated complex tailored for individuals who appreciate contemporary urban living. This innovative concept is designed to impeccably align with the distinctive standards of Dubai.</p>' +
            '<h3>Public Places Nearby</h3>' +
            '<p>4<br> minutes to the bus station</p>' +
            '<p>7<br> minutes to the shopping center</p>' +
            '<p>25 <br>minutes from the airport</p>';
    } else if (type === 'features') {
        // Change video source and add buttons for features
        changeVideo('FeaturesVid.mp4', button);
        var features = ['RoofTopGarden', 'PlayGround', 'Parking', 'ShoppingMall'];
        for (var j = 0; j < features.length; j++) {
            var featureButton = document.createElement('button');
            featureButton.textContent = features[j];
            featureButton.onclick = function () {
                // Handle feature click
                // You can customize this function to display more information about the feature
                console.log('Feature Clicked: ' + features[j]);
            };
            sidebar.appendChild(featureButton);
        }
    }

    sidebar.style.display = 'block';
}

function showApartmentDetails(apartmentIndex) {
    var secondSidebar = document.getElementById('second-sidebar');
    var apartmentImage = document.getElementById('apartment-image');
    var apartmentPrice = document.getElementById('apartment-price');
    var apartmentSurface = document.getElementById('apartment-surface');
    var apartmentAvailability = document.getElementById('apartment-availability');

    // Set apartment details
    // apartmentImage.src = 'apartment' + apartmentIndex + '.jpg'; // Replace with actual image path
    apartmentImage.src = 'FloorPlane.jpg'; // Replace with actual image path

    apartmentPrice.textContent = 'Price: $250,000'; // Replace with actual price
    apartmentSurface.textContent = 'Surface: 50 m²'; // Replace with actual surface area
    apartmentAvailability.textContent = 'Availability: Available'; // Replace with actual availability status

    // Show the second sidebar
    secondSidebar.style.display = 'block';
}

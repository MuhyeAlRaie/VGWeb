async function fetchApartments() {
    try {
        const response = await fetch('http://localhost:3000/apartments');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching apartments:', error);
        return [];
    }
}

async function openSidebar(type, button) {
    var sidebar = document.getElementById('sidebar');
    var secondSidebar = document.getElementById('second-sidebar');

    sidebar.innerHTML = '';
    secondSidebar.style.display = 'none';

    document.querySelectorAll('.navbar-button').forEach(function (btn) {
        btn.classList.remove('active');
    });

    button.classList.add('active');

    if (type === 'apartments') {
        // Fetch apartment data from the backend
        const apartments = await fetchApartments();

        // Display apartment buttons dynamically
        apartments.forEach((apartment, index) => {
            var apartmentButton = document.createElement('button');
            apartmentButton.textContent = apartment.name;
            apartmentButton.onclick = function () {
                changeVideo('asset/' + apartment.video, button);
                showApartmentDetails(apartment);
            };
            sidebar.appendChild(apartmentButton);
        });
        changeVideo('asset/HomeVid.mp4', button);
    } else if (type === 'home') {
        sidebar.innerHTML = '<h2>Your Project on Earth</h2>' +
            '<p>We are developing a sophisticated complex tailored for individuals who appreciate contemporary urban living. This innovative concept is designed to impeccably align with the distinctive standards of Dubai.</p>' +
            '<h3>Public Places Nearby</h3>' +
            '<p>4<br> minutes to the bus station</p>' +
            '<p>7<br> minutes to the shopping center</p>' +
            '<p>25 <br>minutes from the airport</p>';
        changeVideo('asset/HomeVid.mp4', button);
    } else if (type === 'features') {
        // Display feature buttons dynamically
        var features = ['RoofTopGarden', 'PlayGround', 'Parking', 'ShoppingMall'];
        features.forEach((feature) => {
            var featureButton = document.createElement('button');
            featureButton.textContent = feature;
            featureButton.onclick = function () {
                console.log('Feature Clicked: ' + feature);
                // Handle feature click as needed
            };
            sidebar.appendChild(featureButton);
        });
        changeVideo('asset/FeaturesVid.mp4', button);
    }

    sidebar.style.display = 'block';
}

function showApartmentDetails(apartment) {
    var secondSidebar = document.getElementById('second-sidebar');
    var apartmentImage = document.getElementById('apartment-image');
    var apartmentPrice = document.getElementById('apartment-price');
    var apartmentSurface = document.getElementById('apartment-surface');
    var apartmentAvailability = document.getElementById('apartment-availability');

    // Set apartment details
    apartmentImage.src = 'asset/' + apartment.image;
    apartmentPrice.textContent = 'Price: ' + apartment.price;
    apartmentSurface.textContent = 'Surface: ' + apartment.surface;
    apartmentAvailability.textContent = 'Availability: ' + apartment.availability;

    // Show the second sidebar
    secondSidebar.style.display = 'block';
}

function changeVideo(videoSource, button) {
    document.getElementById('background-video').src = videoSource;

    // Remove 'active' class from all buttons
    document.querySelectorAll('.navbar-button').forEach(function (btn) {
        btn.classList.remove('active');
    });

    // Add 'active' class to the clicked button
    button.classList.add('active');
}

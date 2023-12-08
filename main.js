// Sample JSON data for apartment details
var apartmentData = {
    "apartment1": {
        "video": "asset/apartmentsVid.mp4",
        "image": "asset/FloorPlane.jpg",
        "price": "$250,000",
        "surface": "60 m²",
        "availability": "Available"
    },
    "apartment2": {
        "video": "asset/apartmentsVid.mp4",
        "image": "asset/FloorPlane.jpg",
        "price": "$200,000",
        "surface": "50 m²",
        "availability": "Reserved"
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
                sidebar.appendChild(apartmentButton);
            }
        }
    } else if (type === 'home') {
        // Change video source and add custom content for Home
        changeVideo('asset/HomeVid.mp4', button);
        sidebar.innerHTML = '<h2>Your Project on Earth</h2>' +
        '<p>We are developing a sophisticated complex tailored for individuals who appreciate contemporary urban living. This innovative concept is designed to impeccably align with the distinctive standards of Dubai.</p>' +
        '<p>4<br> minutes to the bus station</p>' +
        '<p>7<br> minutes to the shopping center</p>' +
        '<p>25 <br>minutes from the airport</p>';
    } else if (type === 'features') {
        // Change video source and add buttons for features
        changeVideo('asset/FeaturesVid.mp4', button);
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
    }else if (type === 'contact') {
        // Change video source and add buttons for features
        changeVideo('asset/Bgvid.mp4', button);
        sidebar.innerHTML = '<h2>CONTACT US</h2>' +
        '<p>We are excited to hear from you and assist with any inquiries or feedback you may have. Please do not hesitate to reach out through one of the following methods:</p>' +
        '<h3>Our Address</h3>' +
        '<p>Queen Rania Street,Amman ,Jordan</p>' +
        '<h3>Email Us</h3>' +
        '<p>MR@VORTIGATE.COM</p>' +
        '<h3>Call Us</h3>' +
        '<p>+966 50 971 1777</p>'+
        '<p>+962 781313782</p>';
    }
    sidebar.style.display = 'block';
}

function showApartmentDetails(apartmentKey) {
    var secondSidebar = document.getElementById('second-sidebar');
    var apartmentImage = document.getElementById('apartment-image');
    var apartmentPrice = document.getElementById('apartment-price');
    var apartmentSurface = document.getElementById('apartment-surface');
    var apartmentAvailability = document.getElementById('apartment-availability');

    // Get the apartment details from the JSON data
    var apartmentDetails = apartmentData[apartmentKey];

    // Set apartment details
    apartmentImage.src = apartmentDetails.image;
    apartmentPrice.textContent = 'Price: ' + apartmentDetails.price;
    apartmentSurface.textContent = 'Surface: ' + apartmentDetails.surface;
    apartmentAvailability.textContent = 'Availability: ' + apartmentDetails.availability;

    // Show the second sidebar
    secondSidebar.style.display = 'block';
}

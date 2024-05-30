// Sample JSON data for apartment details
var apartmentData = {
    "apartment1": {
        "video": "assets/apartmentsVid.mp4",
        "image": "assets/FloorPlane.jpg",
        "price": 250000,
        "surface": 100,
        "availability": "Available",
        "bedroom": 2,
        "bathroom": 1,
        "iframeSrc": "https://momento360.com/e/u/e89f13d9187b4fb1a809c49d7344e60a?utm_campaign=embed&utm_source=other&heading=0&pitch=0&field-of-view=75&size=medium&display-plan=true"
    },
    "apartment2": {
        "video": "assets/apartmentsVid.mp4",
        "image": "assets/FloorPlane.jpg",
        "price": 200000,
        "surface": 60,
        "availability": "Reserved",
        "bedroom": 1,
        "bathroom": 1,
        "iframeSrc": "https://momento360.com/e/u/e89f13d9187b4fb1a809c49d7344e60a?utm_campaign=embed&utm_source=other&heading=0&pitch=0&field-of-view=75&size=medium&display-plan=true"
    },
    "apartment3": {
        "video": "assets/apartmentsVid.mp4",
        "image": "assets/FloorPlane.jpg",
        "price": 150000,
        "surface": 60,
        "availability": "Available",
        "bedroom": 1,
        "bathroom": 1,
        "iframeSrc": "https://momento360.com/e/u/e89f13d9187b4fb1a809c49d7344e60a?utm_campaign=embed&utm_source=other&heading=0&pitch=0&field-of-view=75&size=medium&display-plan=true"
    },
    "apartment4": {
        "video": "assets/apartmentsVid.mp4",
        "image": "assets/FloorPlane.jpg",
        "price": 140000,
        "surface": 50,
        "availability": "Available",
        "bedroom": 1,
        "bathroom": 1,
        "iframeSrc": "https://momento360.com/e/u/e89f13d9187b4fb1a809c49d7344e60a?utm_campaign=embed&utm_source=other&heading=0&pitch=0&field-of-view=75&size=medium&display-plan=true"
    },
    "apartment5": {
        "video": "assets/apartmentsVid.mp4",
        "image": "assets/FloorPlane.jpg",
        "price": 180000,
        "surface": 80,
        "availability": "Reserved",
        "bedroom": 2,
        "bathroom": 1,
        "iframeSrc": "https://momento360.com/e/u/e89f13d9187b4fb1a809c49d7344e60a?utm_campaign=embed&utm_source=other&heading=0&pitch=0&field-of-view=75&size=medium&display-plan=true"
    },
    // Add details for other apartments as needed
};

function fetchBasicInfo() {
    // Return a Promise
    return new Promise((resolve, reject) => {
        // Fetch data from the API endpoint
        fetch('NiceAdmin/API/GET_Basic_info.php')
            .then(response => {
                // Check if response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Parse JSON response
                return response.json();
            })
            .then(data => {
                // Resolve the Promise with the retrieved data
                resolve(data[0]);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Reject the Promise with the error
                reject(error);
            });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Call fetchFeatures function when the DOM content is loaded
    fetchFeatures()
        .then(features => {
            // If features are successfully fetched, display them
            // Assuming features data is an array of objects with 'ID', 'Feature', and 'Link' properties

        })
        .catch(error => {
            // If there's an error while fetching features, log the error
            console.error('Error fetching features:', error);
        });
});


function fetchFeatures() {
    // Return a Promise
    return new Promise((resolve, reject) => {
        // Fetch data from the API endpoint
        fetch('NiceAdmin/API/GET-Features.php')
            .then(response => {
                // Check if response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Parse JSON response
                return response.json();
            })
            .then(data => {
                // Resolve the Promise with the retrieved data
                resolve(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Reject the Promise with the error
                reject(error);
            });
    });
}

function fetchApartments() {
    // Return a Promise
    return new Promise((resolve, reject) => {
        // Fetch data from the API endpoint
        fetch('NiceAdmin/API/GET_Apartment.php')
            .then(response => {
                // Check if response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Parse JSON response
                return response.json();
            })
            .then(data => {
                // Resolve the Promise with the retrieved data
                resolve(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Reject the Promise with the error
                reject(error);
            });
    });
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
        fetchApartments()
        .then(apartmentData => {
            // Logic to handle the 'apartments' type
            if (type === 'apartments') {
                // Change video source and dynamically generate buttons for apartments
                changeVideo('assets/apartmentsVid.mp4', button);
                sidebar.innerHTML = '<div id="filter-section" class="position-relative top-20 start-50 translate-middle-x z-index-1 d-grid">' +
                    '<label for="filter-price">Price:</label>' +
                    '<input type="text" id="filter-price" placeholder="Enter price">' +
                    ' <label for="filter-surface">Surface:</label>' +
                    '<input type="text" id="filter-surface" placeholder="Enter surface">' +
                    '<label for="filter-availability">Availability:</label>' +
                    '<select id="filter-availability">' +
                    ' <option value="">All</option>' +
                    '<option value="Available">Available</option>' +
                    '<option value="Reserved">Reserved</option>' +
                    '</select>' +
                    '<button onclick="applyFilters()">Apply Filters</button>' +
                    '</div>';
    
                // Loop through the apartmentData and generate buttons
                var apartmentWrapperDiv = document.createElement('div');
                apartmentWrapperDiv.className = 'apartment-wrapper';
    
                // Loop through the apartmentData and generate buttons
                for (var i = 0; i < apartmentData.length; i++) {
                    var apartment = apartmentData[i];
                    var apartmentName = apartment.Name;
    
                    var apartmentButton = document.createElement('button');
                    apartmentButton.textContent = apartmentName;
                    apartmentButton.onclick = (function (apartmentData) {
                        return function () {
                            changeVideo(apartmentData.video, button);
                            showApartmentDetails(apartmentData.ID);
                        };
                    })(apartment);
    
                    apartmentWrapperDiv.appendChild(apartmentButton);
                }
    
                // Append the wrapper div with apartment buttons to the sidebar
                sidebar.appendChild(apartmentWrapperDiv);
            }
        })
        .catch(error => {
            // Handle errors if any
            console.error('Error fetching apartment data:', error);
        });
    } else if (type === 'home') {
        // Change video source and add custom content for Home
        changeVideo('assets/HomeVid.mp4', button);

        var wrapperDiv = document.createElement('div');
        wrapperDiv.className = 'home-wrapper';


        // item = fetchBasicInfo();
        fetchBasicInfo().then(result => {
            wrapperDiv.innerHTML = '<h2>' + result['Title'] + '</h2>' +
                '<p class="main-desc">' + result['Description'] + '</p>' +
                '<div class="statistics-wrapper">' +
                '<div class="item"><div class="number">' + result['statistic_value_1'] + '</div><div class="description">' + result['statistic_title_1'] + '</div></div>' +
                '<div class="item"><div class="number">' + result['statistic_value_2'] + '</div><div class="description">' + result['statistic_title_2'] + '</div></div>' +
                '<div class="item"><div class="number">' + result['statistic_value_3'] + '</div><div class="description">' + result['statistic_title_3'] + '</div></div>' +
                '</div>' +
                '<div class="svg-with-text-wrapper"><img class="your-svg-class" src="assets/location-sign-svgrepo-com.svg" alt="Your SVG"><span class="svg-text">' + result['Location'] + '</span></div>';;
        });
        // Set innerHTML for the wrapper div


        // Append the wrapper div to the sidebar
        sidebar.appendChild(wrapperDiv);
    } else if (type === 'features') {
        fetchFeatures()
            .then(features => {
                // Change video source to the features video
                changeVideo('assets/FeaturesVid.mp4', button);

                // Create a wrapper div
                var wrapperDiv = document.createElement('div');
                wrapperDiv.className = 'Feature-wrapper';

                Object.keys(features).forEach(function(key) {

                    var featureButton = document.createElement('button');
                    featureButton.textContent = features[key]['Feature'];
                    featureButton.onclick = function () {
                        changeVideo('assets/Bgvid.mp4', button);
                        // Handle feature click
                        // You can customize this function to display more information about the feature
                    };
            
                    // Append each button to the wrapper div
                    wrapperDiv.appendChild(featureButton);
                });

                // Append the wrapper div to the sidebar
                sidebar.appendChild(wrapperDiv);

            })
            .catch(error => {
                console.error('Error fetching features:', error);
            });

    } else if (type === 'contact') {
// Change video source and add buttons for features
changeVideo('assets/Bgvid.mp4', button);

// Create a wrapper div for contact information
var contactWrapperDiv = document.createElement('div');
contactWrapperDiv.className = 'contact-wrapper';

// Set innerHTML for the wrapper div with the form element
contactWrapperDiv.innerHTML = `
  <form
    action="https://formspree.io/f/mjvnqbzz"
    method="POST"
  >
    <h3>Contact us</h3>
    <div class="row input-container">
      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Name" required />
          <label>Name</label>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="styled-input">
          <input type="email" name="Email" required />
          <label>Email</label>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="styled-input">
          <input type="text" name="Phone Number" required />
          <label>Phone Number</label>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="styled-input wide">
          <textarea name="Message" required></textarea>
          <label>Message</label>
        </div>
      </div>
      <div class="col-xs-12">
        <button type="submit" class="btn-lrg submit-btn">Send Message</button>
      </div>
    </div>
  </form>
`;

// Append the wrapper div with contact form to the sidebar
sidebar.appendChild(contactWrapperDiv);

// Show sidebar
sidebar.style.display = 'block';

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
  
    // Fetch apartment details from the API
    fetchApartments()
      .then(data => {
        // Find the apartment details by matching the key
        const apartmentDetails = data.find(apartment => apartment.ID === apartmentKey);
  
        if (!apartmentDetails) {
          console.error(`Apartment "${apartmentKey}" not found in API response`);
          return; // Handle the case where the apartment key is not found
        }
  
        // Set apartment details (assuming property names match your API response)
        apartmentImage.src = apartmentDetails.iframeSrc || ""; // Use iframeSrc for image if available
        apartmentPrice.textContent = 'Price: $' + apartmentDetails.price.toLocaleString(); // Format price
        apartmentSurface.textContent = 'Surface: ' + apartmentDetails.surface + ' m²';
        apartmentAvailability.textContent = 'Availability: ' + apartmentDetails.availability;
        apartmentBedroom.textContent = 'Bedroom: ' + apartmentDetails.bedroom;
        apartmentBathroom.textContent = 'Bathroom: ' + apartmentDetails.bathroom;
  
        // Create a wrapper div for apartments (used by updateSidebar)
        var apartmentWrapper = document.createElement('div');
        apartmentWrapper.classList = 'apartment-wrapper';
  
        // Show the filter section
        filterSection.style.display = 'flex';
  
        // Clear previous content in the sidebar (handled by updateSidebar)
        sidebar.innerHTML = '';
  
        // Create and append filter section (handled by updateSidebar)
        // ... (code for creating and appending filter section is already in updateSidebar)
  
        // Append the apartmentWrapper to the sidebar (handled by updateSidebar)
        // ... (code for appending apartmentWrapper is already in updateSidebar)
  
        // Create a button for each apartment in the sidebar (handled by updateSidebar)
        // ... (code for creating apartment buttons is already in updateSidebar)
  
        // Hide the second sidebar
        secondSidebar.style.display = 'block';
  
        // Hide the sidebar (handled by updateSidebar)
        // ... (code for hiding sidebar is already in updateSidebar)
  
        // Check if there is an iframe source for the virtual tour
        if (apartmentDetails.iframeSrc) {
          // Remove the previous "Virtual Tour" button if it exists
          var previousVirtualTourButton = document.getElementById('virtualTourButton');
          if (previousVirtualTourButton) {
            secondSidebar.removeChild(previousVirtualTourButton);
          }
  
          // Create a "Virtual Tour" button
          var virtualTourButton = document.createElement('button');
          virtualTourButton.id = 'virtualTourButton';
          virtualTourButton.textContent = 'Virtual Tour';
          virtualTourButton.onclick = function () {
            openIframe(apartmentDetails.iframeSrc);
          };
  
          // Append the "Virtual Tour" button to the second sidebar
          secondSidebar.appendChild(virtualTourButton);
        }
      })
      .catch(error => {
        console.error('Error fetching apartment details:', error);
        // Handle errors gracefully, e.g., display an error message to the user
      });
  }

  function applyFilters() {
    var filterPrice = parseFloat(document.getElementById('filter-price').value) || 0;
    var filterSurface = parseFloat(document.getElementById('filter-surface').value) || 0;
    var filterAvailability = document.getElementById('filter-availability').value;
  
    var filteredApartments = {};
  
    // Call fetchApartments to get the dynamic data
    fetchApartments()
      .then(data => {
        // Apply filters to the fetched data
        for (const apartment of data) {
            console.log(apartment.availability)
          const isAvailable = apartment.availability === 1; // Check for availability (1 = available)
  
          if (
            (filterPrice === 0 || apartment.price <= filterPrice) &&
            (filterSurface === 0 || apartment.surface <= filterSurface) &&
            (filterAvailability === "" || (filterAvailability === "Available" && isAvailable) || (filterAvailability === "Reserved" && !isAvailable))
          ) {
            filteredApartments[apartment.ID || apartmentKey] = apartment; // Use ID or apartmentKey for filtering
          }
        }
  
        // Update the sidebar with filtered apartments
        updateSidebar(filteredApartments);
      })
      .catch(error => {
        console.error('Error fetching apartment details:', error);
        // Handle errors gracefully, e.g., display an error message to the user
      });
  }
  
  function updateSidebar(apartments) {
    var sidebar = document.getElementById('sidebar');
  
    // Create a wrapper div for apartments
    var apartmentWrapper = document.createElement('div');
    apartmentWrapper.classList = 'apartment-wrapper';
  
    // Clear previous content in the sidebar
    sidebar.innerHTML = '';
  
    // Create and append filter section
    var filterSection = document.createElement('div');
    filterSection.id = 'filter-section';
    filterSection.className = 'position-relative top-20 start-50 translate-middle-x z-index-1 d-grid';
    filterSection.innerHTML =
      '<label for="filter-price">Price:</label>' +
      '<input type="text" id="filter-price" placeholder="Enter price">' +
      '<label for="filter-surface">Surface:</label>' +
      '<input type="text" id="filter-surface" placeholder="Enter surface">' +
      '<label for="filter-availability">Availability:</label>' +
      '<select id="filter-availability">' +
      '<option value="">All</option>' +
      '<option value="Available">Available</option>' +
      '<option value="Reserved">Reserved</option>' +
      '</select>' +
      '<button onclick="applyFilters()">Apply Filters</button>';
  
    sidebar.appendChild(filterSection);
  
    // Append the apartmentWrapper to the sidebar
    sidebar.appendChild(apartmentWrapper);
  
    for (var apartmentKey in apartments) {
      if (apartments.hasOwnProperty(apartmentKey)) {
        var apartmentButton = document.createElement('button');
  
        // Use "name" property from the API response to display apartment name
        apartmentButton.textContent = apartments[apartmentKey].Name || apartmentKey; // Use name if available, fallback to ID

        apartmentButton.onclick = (function (key) {
          return function () {
            changeVideo(apartments[key].video, apartmentButton);
            showApartmentDetails(key);
          };
        })(apartmentKey);
  
        apartmentWrapper.appendChild(apartmentButton);
      }
    }
  }
  
  
// function openIframe() {
//     // Create an iframe element
//     var iframe = document.createElement('iframe');
//     iframe.src = 'https://momento360.com/e/u/e89f13d9187b4fb1a809c49d7344e60a?utm_campaign=embed&utm_source=other&heading=0&pitch=0&field-of-view=75&size=medium&display-plan=true'; // Set the URL for your iframe content
//     iframe.width = '800'; // Set the width of the iframe
//     iframe.height = '600'; // Set the height of the iframe

//     // Create a container div for the iframe
//     var iframeContainer = document.createElement('div');
//     iframeContainer.className = 'iframe-container';

//     // Append the iframe to the container
//     iframeContainer.appendChild(iframe);

//     // Append the container to the body
//     document.body.appendChild(iframeContainer);

//     // Center the iframe on the screen
//     iframeContainer.style.position = 'fixed';
//     iframeContainer.style.top = '50%';
//     iframeContainer.style.left = '50%';
//     iframeContainer.style.transform = 'translate(-50%, -50%)';
//     iframeContainer.style.zIndex = '9999';

//     // Add a close button to the iframe
//     var closeButton = document.createElement('button');
//     closeButton.textContent = 'Close';
//     closeButton.onclick = function () {
//         document.body.removeChild(iframeContainer);
//     };

//     // Append the close button to the container
//     iframeContainer.appendChild(closeButton);
// }

function isDeviceRotated() {

    // If it's a mobile device and in landscape orientation, return true
    if (window.matchMedia("(orientation: landscape) and (max-device-width: 1200px)").matches) {
        return true;
    }
}


function openIframe(iframeSrc) {
    // Create an iframe element
    var iframe = document.createElement('iframe');
    iframe.src = iframeSrc;
    iframe.width = '1000'; // Set the width of the iframe (adjust as needed)
    iframe.height = '500'; // Set the height of the iframe (adjust as needed)

    if (isDeviceRotated()) {
        iframe.width = '600'; // Set the width of the iframe (adjust as needed)
        iframe.height = '200'; // Set the height of the iframe (adjust as needed)
    }
    // Create a container div for the iframe and button
    var container = document.createElement('div');
    container.className = 'iframe-container';

    // Create a close button with an "X" icon
    var closeButton = document.createElement('button');
    closeButton.innerHTML = '&#10006;'; // HTML entity for "X"
    closeButton.onclick = function () {
        document.body.removeChild(container);
    };

    // Append the iframe and close button to the container
    container.appendChild(iframe);
    container.appendChild(closeButton);

    // Append the container to the body
    document.body.appendChild(container);

    // Center the container on the screen
    container.style.position = 'fixed';
    container.style.top = '50%';
    container.style.left = '50%';
    container.style.transform = 'translate(-50%, -50%)';
    container.style.zIndex = '9999';

    // Set the innerHTML of the container
    container.innerHTML = '';

    // Append the iframe and close button to the container
    container.appendChild(iframe);
    container.appendChild(closeButton);

    // Style the iframe
    iframe.style.width = '1000';
    iframe.style.height = '800';
    iframe.style.border = 'none';

    // Style the close button
    closeButton.style.position = 'absolute';
    closeButton.style.top = '10px';
    closeButton.style.right = '10px';
    closeButton.style.fontSize = '24px'; // Adjust the font size as needed
    closeButton.style.border = 'none';
    closeButton.style.background = 'none';
    closeButton.style.color = '#000'; // Set the color of the "X"
    closeButton.style.cursor = 'pointer';
}

document.getElementById('home-btn').click();
document.addEventListener('DOMContentLoaded', function () {
    console.log("sss");

    const loginForm = document.getElementById('loginForm');
    const errorMessage = document.getElementById('error-message');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Send login request to your server
        fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password }),
        })
        .then(response => {
            if (response.ok) {
                // Login successful
                window.location.href = 'dashboard/dashboard.html'; // Redirect to dashboard or another page
            } else {
                // Login failed
                return response.json();
            }
        })
        .then(data => {
            errorMessage.textContent = data.error || 'An error occurred during login.';
        })
        .catch(error => {
            console.error('Error during login:', error);
            errorMessage.textContent = 'An unexpected error occurred.';
        });
    });
});

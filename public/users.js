document.addEventListener('DOMContentLoaded', function () {
    console.log('ssss');
    // Fetch all users and populate the table
    fetch('/api/users')
        .then(response => response.json())
        .then(users => {
            const usersTable = document.getElementById('dataTable');
            const tbody = usersTable.querySelector('tbody');

            // Clear existing rows
            tbody.innerHTML = '';

            // Populate the table with user data
            users.forEach(user => {
                const row = document.createElement('tr');

                // Modify this part to include additional fields
                const nameCell = document.createElement('td');
                const phoneNumberCell = document.createElement('td');
                const emailCell = document.createElement('td');
                const positionCell = document.createElement('td');

                nameCell.textContent = user.username; // Replace 'name' with the actual field name in your schema
                phoneNumberCell.textContent = user.phone_number; // Replace 'phoneNumber' with the actual field name in your schema
                emailCell.textContent = user.email; // Replace 'email' with the actual field name in your schema
                positionCell.textContent = user.position; // Replace 'position' with the actual field name in your schema

                row.appendChild(nameCell);
                row.appendChild(phoneNumberCell);
                row.appendChild(emailCell);
                row.appendChild(positionCell);

                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching users:', error));
});

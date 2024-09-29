<?php
// Database configuration
define('DB_HOST', 'localhost:3305');  // Server name
define('DB_USER', 'root');       // Username for MySQL (default is 'root' for XAMPP)
define('DB_PASS', '');           // Password for MySQL (leave blank for XAMPP default)
define('DB_NAME', 'pet_adoption_shelter'); // Name of your database

// App base URL
define('BASE_URL', 'http://localhost/pet-adoption-shelter/');

// Other configurations can be added here as needed

// Establish the database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

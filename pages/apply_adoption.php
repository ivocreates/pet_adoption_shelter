<?php
session_start();
include '../includes/dbconnect.php';
include '../includes/header.php';

// Check if user is logged in as an adopter
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Check if user ID is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-danger'>User ID is not set. Please log in again.</div>";
    exit();
}

// Check if the pet_id is set and is a valid integer
if (isset($_POST['pet_id']) && filter_var($_POST['pet_id'], FILTER_VALIDATE_INT)) {
    $pet_id = intval($_POST['pet_id']);
    $user_id = $_SESSION['user_id']; // Get user ID from session

    // Prepare an SQL statement to insert the application into the database
    $stmt = $conn->prepare("INSERT INTO adoption_applications (user_id, pet_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $pet_id);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Your application has been submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error submitting application: " . htmlspecialchars($conn->error) . "</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>Invalid pet selection. Please try again.</div>";
}
?>

<div class="container">
    <button onclick="window.location.href='adopter.php'" class="btn btn-primary">Back to Dashboard</button>
</div>

<?php include '../includes/footer.php'; ?>

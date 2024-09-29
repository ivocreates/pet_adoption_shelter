<?php
session_start();
include '../includes/dbconnect.php';

// Check if the admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Deny application
if (isset($_POST['application_id'])) {
    $application_id = intval($_POST['application_id']);
    
    // Update application status to 'rejected' (or 'denied')
    $stmt = $conn->prepare("UPDATE adoption_applications SET status = 'rejected' WHERE id = ?");
    $stmt->bind_param("i", $application_id);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Application denied successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error denying application: " . htmlspecialchars($conn->error) . "</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>Invalid application ID.</div>";
}

echo "<a href='manage_applications.php' class='btn btn-primary'>Back to Applications</a>";
?>

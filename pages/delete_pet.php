<?php
session_start();
include '../includes/dbconnect.php';

// Check if user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header("Location: admin.php"); // Redirect to admin login if not logged in as admin
    exit();
}

// Handle the pet deletion
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM pets WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Pet deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
}

// Redirect back to admin dashboard
header("Location: admin_dashboard.php");
exit();
?>

<?php
// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}

// Sanitize user inputs
function sanitizeInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars($data));
}

// Redirect to a different page
function redirect($url) {
    header("Location: " . $url);
    exit();
}

// Function to display messages (success, error)
function displayMessage() {
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-{$_SESSION['msg_type']}'>{$_SESSION['message']}</div>";
        unset($_SESSION['message'], $_SESSION['msg_type']);
    }
}
?>

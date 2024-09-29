<?php 
session_start();
include '../includes/dbconnect.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify password and set session variables
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username']; // Assuming username is stored in the database
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['loggedin'] = true; // Indicate that the user is logged in

        // Redirect to the appropriate dashboard based on user role
        header("Location: " . ($user['role'] == 'admin' ? 'admin.php' : 'adopter.php'));
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<div class="container">
    <h1>Login</h1>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

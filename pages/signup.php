<?php
session_start();
include '../includes/dbconnect.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Signup successful!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
}
?>

<div class="container">
    <h1>Signup</h1>
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="adopter">Adopter</option>
                <option value="volunteer">Volunteer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

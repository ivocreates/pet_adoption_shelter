<?php
session_start();
include '../includes/dbconnect.php';
include '../includes/header.php';

// Check if user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login page if not logged in or not admin
    exit();
}

// Fetch adoption applications from the database
$query = "SELECT aa.*, u.username, p.name AS pet_name FROM adoption_applications aa
          JOIN users u ON aa.user_id = u.id
          JOIN pets p ON aa.pet_id = p.id";
$result = $conn->query($query);
?>

<div class="container">
    <h1>Manage Adoption Applications</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Application ID</th>
                <th>User</th>
                <th>Pet</th>
                <th>Application Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($application = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($application['id']) ?></td>
                    <td><?= htmlspecialchars($application['username']) ?></td>
                    <td><?= htmlspecialchars($application['pet_name']) ?></td>
                    <td><?= htmlspecialchars($application['application_date']) ?></td>
                    <td><?= htmlspecialchars($application['status']) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="application_id" value="<?= $application['id'] ?>">
                            <?php if ($application['status'] == 'pending'): ?>
                                <button type="submit" name="accept" class="btn btn-success">Accept</button>
                                <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                            <?php else: ?>
                                <span class="text-muted">Action not available</span>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
// Handle application acceptance or rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = intval($_POST['application_id']);
    
    if (isset($_POST['accept'])) {
        $stmt = $conn->prepare("UPDATE adoption_applications SET status = 'approved' WHERE id = ?");
        $stmt->bind_param("i", $application_id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Application approved successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    } elseif (isset($_POST['reject'])) {
        $stmt = $conn->prepare("UPDATE adoption_applications SET status = 'rejected' WHERE id = ?");
        $stmt->bind_param("i", $application_id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Application rejected successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
}
?>

<?php include '../includes/footer.php'; ?>

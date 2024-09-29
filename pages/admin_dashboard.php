<?php
session_start();
include '../includes/dbconnect.php';

// Check if user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch pets from the database
$queryPets = "SELECT * FROM pets";
$resultPets = $conn->query($queryPets);

// Fetch adoption applications from the database
$queryApplications = "SELECT * FROM adoption_applications";
$resultApplications = $conn->query($queryApplications);
?>

<div class="container">
    <h1>Admin Dashboard</h1>
    <a href="add_pet.php" class="btn btn-primary">Add New Pet</a>
    
    <h2>Available Pets</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Health Status</th>
                <th>Adoption Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pet = $resultPets->fetch_assoc()): ?>
                <tr>
                    <td><?= $pet['id'] ?></td>
                    <td><?= $pet['name'] ?></td>
                    <td><?= $pet['breed'] ?></td>
                    <td><?= $pet['age'] ?></td>
                    <td><?= $pet['health_status'] ?></td>
                    <td><?= $pet['adoption_status'] ?></td>
                    <td>
                        <a href="edit_pet.php?id=<?= $pet['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_pet.php?id=<?= $pet['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <h2>Adoption Applications</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Pet ID</th>
                <th>Application Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($application = $resultApplications->fetch_assoc()): ?>
                <tr>
                    <td><?= $application['id'] ?></td>
                    <td><?= $application['user_id'] ?></td>
                    <td><?= $application['pet_id'] ?></td>
                    <td><?= $application['application_date'] ?></td>
                    <td><?= $application['status'] ?></td>
                    <td>
                        <a href="approve_application.php?id=<?= $application['id'] ?>" class="btn btn-success">Approve</a>
                        <a href="deny_application.php?id=<?= $application['id'] ?>" class="btn btn-danger">Deny</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>

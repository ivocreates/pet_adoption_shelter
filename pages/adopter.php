<?php
session_start();
include '../includes/dbconnect.php';
include '../includes/header.php';

// Check if user is logged in as adopter
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch available pets
$query = "SELECT * FROM pets WHERE adoption_status = 'available'";
$result = $conn->query($query);
?>

<div class="container">
    <h1>Adopter Dashboard</h1>
    <h2>Available Pets for Adoption</h2>
    <div class="row">
        <?php while ($pet = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="pet-card">
                    <img src="<?= htmlspecialchars($pet['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($pet['name']) ?>">
                    <h5><?= htmlspecialchars($pet['name']) ?></h5>
                    <p>Breed: <?= htmlspecialchars($pet['breed']) ?></p>
                    <p>Age: <?= htmlspecialchars($pet['age']) ?></p>
                    <p>Status: <?= htmlspecialchars($pet['health_status']) ?></p>
                    
                    <!-- Form to apply for adoption -->
                    <form action="apply_adoption.php" method="post">
                        <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                        <button type="submit" class="btn btn-primary">Apply for Adoption</button>
                    </form>
                    
                    <a href="pet_profile.php?id=<?= $pet['id'] ?>" class="btn btn-success">View Profile</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <button onclick="goBack()" class="btn btn-secondary">Go Back</button>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include '../includes/footer.php'; ?>

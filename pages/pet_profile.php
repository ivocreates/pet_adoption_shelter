<?php
session_start();
include '../includes/dbconnect.php';
include '../includes/header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$pet_id = intval($_GET['id']);

// Fetch pet details
$query = "SELECT * FROM pets WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $pet_id);
$stmt->execute();
$result = $stmt->get_result();
$pet = $result->fetch_assoc();

if (!$pet) {
    header("Location: adopter.php");
    exit();
}
?>

<div class="container">
    <h1><?= htmlspecialchars($pet['name']) ?>'s Profile</h1>
    <img src="<?= htmlspecialchars($pet['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($pet['name']) ?>">
    <p><strong>Breed:</strong> <?= htmlspecialchars($pet['breed']) ?></p>
    <p><strong>Age:</strong> <?= htmlspecialchars($pet['age']) ?> years</p>
    <p><strong>Health Status:</strong> <?= htmlspecialchars($pet['health_status']) ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($pet['description']) ?></p>
    
    <form action="apply_adoption.php" method="post">
        <input type="hidden" name="pet_id" value="<?= htmlspecialchars($pet['id']) ?>">
        <button type="submit" class="btn btn-primary">Apply for Adoption</button>
    </form>
    
    <button onclick="goBack()" class="btn btn-secondary">Go Back</button>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php include '../includes/footer.php'; ?>

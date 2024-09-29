<?php
session_start();
include '../includes/dbconnect.php';
include '../includes/header.php';

$search_query = '';
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

$query = "SELECT * FROM pets WHERE name LIKE '%$search_query%'";
$result = $conn->query($query);
?>

<div class="container">
    <h1>Search Pets</h1>
    <form method="post" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?= htmlspecialchars($search_query) ?>">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    <h2>Search Results</h2>
    <div class="row">
        <?php while ($pet = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="pet-card">
                    <img src="<?= $pet['image'] ?>" class="img-fluid" alt="<?= $pet['name'] ?>">
                    <h5><?= $pet['name'] ?></h5>
                    <p>Breed: <?= $pet['breed'] ?></p>
                    <p>Age: <?= $pet['age'] ?></p>
                    <a href="pet_profile.php?id=<?= $pet['id'] ?>" class="btn btn-success">View Profile</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <button onclick="goBack()" class="btn btn-secondary">Go Back</button>

</div>

<?php include '../includes/footer.php'; ?>

<?php
    // Include header
    include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption Shelter</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <!-- Hero Section -->
    <section class="hero bg-light text-center py-5">
        <div class="container">
            <h1>Welcome to the Pet Adoption Shelter</h1>
            <p>Your companion is waiting for you. Adopt, foster, or volunteer today!</p>
            <a href="pages/search.php" class="btn btn-primary btn-lg">Find Your Pet</a>
        </div>
    </section>

    <!-- Featured Pets -->
    <section class="featured-pets py-5">
        <div class="container">
            <h2 class="text-center">Meet Our Featured Pets</h2>
            <div class="row">
                <!-- Example of a featured pet -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="uploads/pet_images/sample_pet.jpg" class="card-img-top" alt="Pet Image">
                        <div class="card-body">
                            <h5 class="card-title">Buddy</h5>
                            <p class="card-text">A friendly Labrador looking for a loving home.</p>
                            <a href="pages/pet_profile.php?pet_id=1" class="btn btn-info">Learn More</a>
                        </div>
                    </div>
                </div>
                <!-- Add more pets dynamically from the database -->
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="call-to-action bg-primary text-white text-center py-5">
        <div class="container">
            <h2>Want to Help?</h2>
            <p>Become a volunteer or donate to support our shelter.</p>
            <a href="pages/signup.php" class="btn btn-light">Get Involved</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

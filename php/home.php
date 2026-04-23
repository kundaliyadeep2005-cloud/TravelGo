<?php
include 'db.php'; // Include the database connection

// Fetch carousel images
$carouselQuery = "SELECT * FROM carousel";
$carouselResult = $conn->query($carouselQuery);

if (!$carouselResult) {
    die("Error: " . $conn->error);
}


// Fetch best places (home cards)
$placesQuery = "SELECT * FROM best_places";
$placesResult = $conn->query($placesQuery);

if (!$placesResult) {
    die("Error: " . $conn->error);
}


// Fetch "About Section" Data
$sql = "SELECT * FROM about_section ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// Check if data exists
$about = $result->fetch_assoc();


// Fetch footer
$contactQuery = "SELECT * FROM contact_info LIMIT 1";
$contactResult = $conn->query($contactQuery);
$contact = $contactResult->fetch_assoc();

?>

<?php 
$page_title = 'TravelGo - Home';
$custom_css = '../css/home.css';
include '../includes/header.php'; 
?>

<!-- Carousel Section -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php 
        $active = true;
        while ($row = $carouselResult->fetch_assoc()) { ?>
            <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                <img src="../<?php echo $row['image']; ?>" class="d-block w-100 img-fluid" alt="<?php echo $row['title']; ?>">
                <div class="carousel-caption d-block text-center">
                    <h5><?php echo $row['title']; ?></h5>
                    <p><?php echo $row['description']; ?></p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="package.php" class="btn btn-primary btn-sm">Explore Now</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php 
            $active = false;
        } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Best Places Section -->
<div class="container my-5">
    <h1 class="best-places-heading text-center mb-4">Best Places</h1>
    <div class="row justify-content-center">
        <?php while ($place = $placesResult->fetch_assoc()) { ?>
            <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="horizontal-card w-100 h-100 d-flex flex-column">
                    <img src="../<?php echo $place['image']; ?>" class="card-img-top flex-shrink-0" alt="<?php echo $place['title']; ?>" style="object-fit: cover; height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $place['title']; ?></h5>
                        <p class="card-text flex-grow-1"><?php echo $place['description']; ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="booking.php?pkg_name=<?php echo urlencode($place['title']); ?>" class="btn-custom mt-auto">Book Now</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<div class="container">
    <div class="our-story">
        <div class="square-box">
            <h1 class="centered-heading">OUR GOALS</h1>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="container-fluid my-5">
    <div class="row justify-content-center">
        <div class="col-xxl-10 col-xl-12">
            <div class="card big-about-card">
                <img src="../<?php echo $about['image']; ?>" class="card-img-top" alt="About Us Image">
                <div class="card-body">
                    <h2 class="card-title text-center"><?php echo $about['title']; ?></h2>
                    <p class="card-text"><?php echo nl2br($about['description']); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Footer Section -->
<?php include '../includes/footer.php'; ?>

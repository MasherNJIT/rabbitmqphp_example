<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/icon.ico">
    <style>
        .filter-dropdown {
            margin-right: 20px;
            margin-top: 4px;
        }
        .dropdown-menu {
            padding: 15px;
            min-width: 250px;
        }
        .btn-apply {
            width: 100%;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px 0;
        }
        .footer .text-muted {
            text-align: center;
        }
    </style>
</head>
<body style="min-height: 100vh; position: relative; padding-bottom: 50px; box-sizing: border-box;">
<div class="container-fluid">
    <div class="row">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md justify-content-start bg-dark navbar-dark col-12">
            <a class="navbar-brand" href="#">Explore!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="booking.php">Search a Location</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Review a Location</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-bs-toggle="dropdown" aria-expanded="false">Booking</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="booking.php">Book a Flight</a>
                            <a class="dropdown-item" href="vent_box.html">Book a Hotel</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="row mt-4">
        <div class="col-md-12 d-flex align-items-start">
            <!-- Filter Dropdown -->
            <div class="filter-dropdown dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter Options
                </button>
                <div class="dropdown-menu" aria-labelledby="filterDropdown">
                    <form id="filterForm">
                        <?php
                        // Include the database connection
                        $mysqli = require 'database.php';

                        // Fetch minimum and maximum prices from the database
                        $result = $mysqli->query("SELECT MIN(price) AS minPrice, MAX(price) AS maxPrice FROM Recommendations");
                        $prices = $result->fetch_assoc();

                        // Set default values if no results
                        $minPrice = $prices['minPrice'] ?? 0;
                        $maxPrice = $prices['maxPrice'] ?? 1000;
                        ?>
                        <!-- Min Price -->
                        <div class="mb-3">
                            <label for="minPrice" class="form-label">Min Price:</label>
                            <input type="number" id="minPrice" name="minPrice" class="form-control" value="<?php echo $minPrice; ?>" min="0">
                        </div>
                        <!-- Max Price -->
                        <div class="mb-3">
                            <label for="maxPrice" class="form-label">Max Price:</label>
                            <input type="number" id="maxPrice" name="maxPrice" class="form-control" value="<?php echo $maxPrice; ?>" min="0">
                        </div>
                        <!-- Apply Button -->
                        <button type="button" class="btn btn-primary btn-apply" id="applyFilters">Apply</button>
                    </form>
                </div>
            </div>
            <div>
                <h2>Welcome to our travel site!</h2>
                <h3>Here are our recommended locations:</h3>
            </div>
        </div>
        <div id="recommendations" class="row gy-4 mt-3">
            <!-- Dynamic results will be displayed here -->
        </div>
    </div>
</div>

<footer class="footer page-footer font-small">
    <div class="container">
        <div class="row">
            <span class="text-muted">&copy; Team BackOfTheRoom, 2024 | Terms Of Use | Privacy Statement</span>
        </div>
    </div>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Event listener for the filter button
    document.getElementById('applyFilters').addEventListener('click', async () => {
        const minPrice = document.getElementById('minPrice').value || 0;
        const maxPrice = document.getElementById('maxPrice').value || 100000; // Large default value

        try {
            // Fetch filtered results
            const response = await fetch(`filter.php?minPrice=${minPrice}&maxPrice=${maxPrice}`);
            const results = await response.json();

            // Display results
            const recommendationsContainer = document.getElementById('recommendations');
            recommendationsContainer.innerHTML = ''; // Clear previous results

            if (results.length > 0) {
                results.forEach(item => {
                    const card = `
                        <div class="col-md-4">
                            <div class="card">
                                <img src="${item.image_url}" class="card-img-top" alt="${item.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${item.name}</h5>
                                    <p class="card-text"><strong>Location:</strong> ${item.location}</p>
                                    <p class="card-text"><strong>Price:</strong> $${item.price}</p>
                                </div>
                            </div>
                        </div>`;
                    recommendationsContainer.innerHTML += card;
                });
            } else {
                recommendationsContainer.innerHTML = '<p>No results found with the selected filters.</p>';
            }
        } catch (error) {
            console.error('Error fetching results:', error);
        }
    });
</script>
</body>
</html> 

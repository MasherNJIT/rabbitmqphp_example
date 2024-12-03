<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #5f6f96;
            color: #fff;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="card shadow-lg p-4" style="max-width: 500px; margin: auto; background-color: #ffffff; color: #333;">
            <h1 class="card-title text-center mb-4">Flight Booking</h1>
            <form action="rate-review-handler.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="ticketOwner" class="form-label">Name of Ticket Owner</label>
                    <input type="text" class="form-control" name="ticketOwner" id="ticketOwner" required>
                </div>
                
                <div class="mb-3">
                    <label for="origin" class="form-label">Where Are You Flying From?</label>
                    <input type="text" class="form-control" name="origin" id="origin" required>
                </div>
                
                <div class="mb-3">
                    <label for="destination" class="form-label">What Is Your Destination?</label>
                    <input type="text" class="form-control" name="destination" id="destination" required>
                </div>
                
                <div class="mb-3">
                    <label for="departureDate" class="form-label">When Are You Departing?</label>
                    <input type="date" class="form-control" name="departureDate" id="departureDate" required>
                </div>
                
                <div class="mb-3">
                    <label for="returnDate" class="form-label">When Are You Returning?</label>
                    <input type="date" class="form-control" name="returnDate" id="returnDate">
                </div>
                
                <!-- Notifications Section -->
                <div class="mb-3">
                    <label class="form-label">Would you like to receive notifications about your booking?</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="notifyYes" name="notifications" value="yes" required>
                            <label class="form-check-label" for="notifyYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="notifyNo" name="notifications" value="no" required>
                            <label class="form-check-label" for="notifyNo">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3" id="emailSection" style="display: none;">
                    <label for="email" class="form-label">Enter your email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="e.g., yourname@example.com">
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Book Now</button>
            </form>
        </div>
    </div>

    <script>
        const notifyYes = document.getElementById('notifyYes');
        const notifyNo = document.getElementById('notifyNo');
        const emailSection = document.getElementById('emailSection');

        notifyYes.addEventListener('change', function () {
            if (this.checked) {
                emailSection.style.display = 'block';
            }
        });

        notifyNo.addEventListener('change', function () {
            if (this.checked) {
                emailSection.style.display = 'none';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>

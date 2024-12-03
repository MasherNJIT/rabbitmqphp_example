<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif; 
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #5f6f96;
        }
        .form-container {
            background-color: #E2E2E2;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 500px;
            text-align: left;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 700;
            color: #333;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: 700;
            font-size: 14px;
            color: #333;
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="time"], input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #bfbfbf;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #3d4afa;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 700; 
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background-color: #3e2df7;
        }
        .message {
            color: green;
            margin-bottom: 10px;
        }
        #emailSection {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Hotel Booking</h1>
        <form action="booking-send.php" method="post" enctype="multipart/form-data">
            <label for="bookerName">Name of Booker</label>
            <input type="text" name="bookerName" id="bookerName" required>
            
            <label for="numGuest">Number of Guests</label>
            <input type="number" name="numGuest" id="numGuest" min="1" required>
            
            <label for="checkinDate">Expected Check-In Date</label>
            <input type="date" name="checkinDate" id="checkinDate" required>
            
            <label for="checkinTime">Expected Check-In Time</label>
            <input type="time" name="checkinTime" id="checkinTime" required>
            
            <label for="checkoutDate">Expected Check-Out Date</label>
            <input type="date" name="checkoutDate" id="checkoutDate" required>
            
            <label for="checkoutTime">Expected Check-Out Time</label>
            <input type="time" name="checkoutTime" id="checkoutTime" required>
            
            <label for="hotelName">Which Hotel Will You Be Booking?</label>
            <input type="text" name="hotelName" id="hotelName" required>

            <!-- Notifications Section -->
            <label>Would you like to receive notifications about your booking?</label>
            <input type="radio" id="notifyYes" name="notifications" value="yes" required>
            <label for="notifyYes" style="display: inline;">Yes</label>
            <input type="radio" id="notifyNo" name="notifications" value="no" required>
            <label for="notifyNo" style="display: inline;">No</label>
            
            <div id="emailSection" style="display: none;">
                <label for="email">Enter your email address</label>
                <input type="email" name="email" id="email" placeholder="e.g., yourname@example.com">
            </div>
            
            <button type="submit">Book Now</button>
        </form>
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
</body>
</html>>

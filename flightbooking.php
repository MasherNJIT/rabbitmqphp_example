<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Flight</title>
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
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: 700;
            color: #333;
        }
        label {
            display: block;
            text-align: left;
            margin-top: 15px;
            font-weight: 700;
            font-size: 14px;
            color: #333;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #bfbfbf;
            border-radius: 5px;
            font-size: 16px;
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
    </style>
</head>
<body>
    <div class="form-container">
        
        <?php
        /*
        if (isset($_SESSION['message'])) {
            echo "<p class='message'>{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        */
        ?>
        
        <h1>Flight Booking</h1>
        <form action="rate-review-handler.php" method="post" enctype="multipart/form-data">
            <label for="ticketOwner">Name of Ticket Owner</label>
            <input type="text" name="ticketOwner" id="ticketOwner" required>
            
            <label for="origin">Where Are You Flying From?</label>
            <input type="text" name="origin" id="origin" required>
            
            <label for="destination">What Is Your Destination?</label>
            <input type="text" name="destination" id="destination" required>
            
            <label for="departureDate">When Are You Departing?</label>
            <input type="date" name="departureDate" id="departureDate" required>
            
            <label for="returnDate">When Are You Returning?</label>
            <input type="date" name="returnDate" id="returnDate">
            
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>


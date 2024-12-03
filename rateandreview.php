<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate and Review</title>
    <!-- Link to Roboto Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif; 
            background-color: #5f6f96;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            color: #333;
            height: 100vh;
        }
        .form-container {
            background-color: #E2E2E2;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: left;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
        }
        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="file"], textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        textarea {
            resize: none;
            height: 100px;
        }
        .rating {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }
        .rating input {
            display: none;
        }
        .rating label {
            flex: 1;
            padding: 15px;
            background-color: #ccc;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .rating label:hover,
        .rating input:checked + label {
            background-color: #FFD700;
            transform: scale(1.05);
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #3d4afa;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
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
        <h2>Rate and Review</h2>
        <form action="submit-review.php" method="post" enctype="multipart/form-data">
            <p class="section-title">Location:</p>
            <input type="text" id="location" name="location" placeholder="Enter the location name" required>

            <p class="section-title">Rate:</p>
            <div class="rating">
                <input type="radio" id="rate1" name="rating" value="1">
                <label for="rate1">1</label>
                <input type="radio" id="rate2" name="rating" value="2">
                <label for="rate2">2</label>
                <input type="radio" id="rate3" name="rating" value="3">
                <label for="rate3">3</label>
                <input type="radio" id="rate4" name="rating" value="4">
                <label for="rate4">4</label>
                <input type="radio" id="rate5" name="rating" value="5">
                <label for="rate5">5</label>
            </div>

            <p class="section-title">Review:</p>
            <textarea name="review" id="review" placeholder="Write your review here..." required></textarea>

            <p class="section-title">Upload Photo:</p>
            <input type="file" name="photo" id="photo" accept="image/*">

            <button type="submit">Submit Review</button>
        </form>
    </div>
</body>
</html>

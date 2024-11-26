<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Preferences</title>
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
        label {
            font-weight: 700;
            margin-left: 10px;
        }
        input[type="radio"], input[type="checkbox"], input[type="text"] {
            margin-right: 10px;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
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
        .header {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Choose Your Preferences</h2>
        <form>
            <p class="section-title">Location:</p>
            <input type="text" id="location" name="location" placeholder="Enter a city or area"><br>
            
            <p class="section-title">Budget:</p>
            <input type="radio" id="cheap" name="budget" value="Cheap">
            <label for="cheap">Cheaper Spots</label><br>
            <input type="radio" id="expensive" name="budget" value="Expensive">
            <label for="expensive">Expensive Spots</label><br>

            <p class="section-title">Destinations:</p>
            <input type="checkbox" id="parks" name="spaces" value="Parks">
            <label for="parks">Parks</label><br>
            <input type="checkbox" id="restaurants" name="spaces" value="Restaurants">
            <label for="restaurants">Restaurants</label><br>
            <input type="checkbox" id="shopping" name="spaces" value="Shopping Stores">
            <label for="shopping">Shopping Stores</label><br>
            <input type="checkbox" id="tourist" name="spaces" value="Tourist Spots">
            <label for="tourist">Tourist Spots</label><br>
            
            <button type="search">Search</button>
        </form>
    </div>
    <div class="header">
        Here are some spots we feel like you'd like!
    </div>
</body>
</html>

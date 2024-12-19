<?php
// This file contains the connection to the database ($mysqli variable)
$mysqli = require 'database.php';

// The 'category' determines whether the user is searching for Flights (1) or Hotels (2)
// The 'query' is the user's search term
$category = $_GET['category'] ?? null; // Default to null if 'category' is not provided
$query = $_GET['query'] ?? null;      // Default to null if 'query' is not provided

// Validate input
// Ensure both 'category' and 'query' parameters are provided; if not, return an error message as JSON
if (!$category || !$query) {
    echo json_encode(['error' => 'Invalid or missing parameters']);
    exit; // Stop further execution
}

// Sanitize inputs to prevent SQL injection attacks
// Escape special characters in the input to ensure safe queries
$category = $mysqli->real_escape_string($category);
$query = $mysqli->real_escape_string($query);

// SQL Query based on the 'category' parameter
if ($category == '1') { // If the category is '1', search in the Flights table
    $sql = "SELECT * FROM Flights WHERE departure LIKE '%$query%' OR arrival LIKE '%$query%'";
} elseif ($category == '2') { // If the category is '2', search in the Hotels table
    $sql = "SELECT * FROM Hotels WHERE location LIKE '%$query%'";
} else { // If the category is invalid, return an error message as JSON
    echo json_encode(['error' => 'Invalid category']);
    exit; // Stop further execution
}

// Execute the SQL query on the database
$result = $mysqli->query($sql);

// Check if the query returned any results
if ($result && $result->num_rows > 0) {
    $data = []; // Initialize an empty array to hold the results
    while ($row = $result->fetch_assoc()) { // Fetch each row as an array
        $data[] = $row; // Add the row to the results array
    }
    // Return the results as a JSON-encoded array
    echo json_encode($data);
} else {
    // If no results are found, return an error message as JSON
    echo json_encode(['error' => 'No results found']);
}

// Close the database connection to free up resources
$mysqli->close();
?>



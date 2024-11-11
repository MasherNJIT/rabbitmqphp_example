<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/js/validation.js" defer></script>
</head>
<body>

    <h1>Signup</h1>

    <!-- Form to collect user data -->
    <form action="" method="post" id="signup" novalidate>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Repeat password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Sign up</button>
    </form>

</body>
</html>

<?php
require_once('vendor/autoload.php');
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        die("Name is required");
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("Valid email is required");
    }

    if (strlen($_POST["password"]) < 8) {
        die("Password must be at least 8 characters");
    }

    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        die("Password must contain at least one letter");
    }

    if (!preg_match("/[0-9]/", $_POST["password"])) {
        die("Password must contain at least one number");
    }

    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        die("Passwords must match");
    }

    $password = $_POST['password'];
    $email = $_POST["email"];
    $name = $_POST["name"];

    // Establish connection with RabbitMQ
    try {
        $connection = new AMQPStreamConnection('10.241.109.75', 5672, 'test', 'test', 'testHost');
        $channel = $connection->channel();

        $channel->queue_declare('testQueue', true);
        $channel->queue_declare('responseQueue', true);

        $channel->exchange_declare('testExchange', 'topic', true, true, false);

        // Create a JSON object with user data
        $registerCreds = json_encode(['name' => $name, 'email' => $email, 'password' => $password]);

        // Send the message
        $msg = new AMQPMessage($registerCreds);
        $channel->basic_publish($msg, 'testExchange', 'user');
        echo "Message sent successfully!";

        // Attempt to consume message
        $channel->consume();
        
    } catch (\Throwable $exception) {
        echo $exception->getMessage(), " - Error while processing", "\n";
    }

    // Close the channel and connection
    $channel->close();
    $connection->close();

    header("Location: process-signup.php");
    exit();

  
}
?>

<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'php-pipeline-server.mysql.database.azure.com';
$username = 'phpadmin';
$password = 'farhan@1234';
$database = 'test';
$port = 3306;

$ssl_ca = 'DigiCertGlobalRootCA.crt.pem';
// Establish a connection
// Create a new mysqli instance
$conn = mysqli_init();

// Set SSL options
$conn->ssl_set(NULL, NULL, $ssl_ca, NULL, NULL);

// Connect with SSL
if (!$conn->real_connect($host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

// Connection is successful
echo "Connected successfully with SSL";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $number);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

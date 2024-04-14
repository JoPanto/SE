<?php
session_start();

// Database connection
$servername = "localhost"; // Change this if your MySQL server is on a different host
$username = "root"; // Change this if your MySQL username is different
$password = ""; // Change this if your MySQL password is different
$database = "pickle_test"; // Change this to your database name
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to check if the user exists
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User exists, verify password
        $row = $result->fetch_assoc();
        if ($password === $row["password"]) { // Compare plaintext passwords directly
            // Password is correct, set session variables
            $_SESSION["username"] = $row["username"];

            // Redirect to dashboard or another webpage
            header("Location: menu.php");
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password";
        }
    } else {
        // User does not exist
        echo "User does not exist";
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu</title>
<link rel="stylesheet" type="text/css" href="menu.css">
</head>
<body>

<div class="navbar">
    <a href="#" class="active">Users</a>
    <a href="#">Delete</a>
</div>

<!-- Table to display users -->
<div class="user-table">
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "pickle_test";
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve user data from the database
            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);

            // Loop through each user and display their details in a table row
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td><img src='" . $row["photo"] . "' alt='User Photo' style='width: 100px; height: auto;'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }

            // Close database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

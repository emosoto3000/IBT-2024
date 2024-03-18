<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "belot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE result(
id INT(8) UNSIGNED PRIMARY KEY,
nie VARCHAR(64) NOT NULL,
vie VARCHAR(64) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
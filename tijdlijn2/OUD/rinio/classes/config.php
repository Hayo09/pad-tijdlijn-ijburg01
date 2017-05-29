<?php

//open connection to mysql db
$servername = "localhost";
$username = "tijdlijn";
$password = "PADijburg01";
$dbname = "u6488d13571_tijdlijn";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
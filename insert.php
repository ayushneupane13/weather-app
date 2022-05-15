<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_2204685";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO weather (weather_description, weather_temprature, weather_wind,weather_when,city,weather_humidity,pressure,weather_name,icon_id)
VALUES ('windy', 20, 12, '2021', 'kdathdfas', 21, 32, 'cloudy', 'fd')";

if ($conn->query($sql) === TRUE) {
    echo ' alert("JavaScript Alert Box by PHP")';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
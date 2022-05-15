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
        $string = file_get_contents("http://api.openweathermap.org/data/2.5/weather?lat=52.4862&lon=-1.8904&appid=1bfcb9d1b1beb70f9960eeb0caf20cce");
        $json = json_decode($string, true);

        // echo $string;
        $description = $json['weather'][0]['description'];
        $temp = $json['main']['temp'];
        $wind = $json['wind']['speed'];
        $date = date("Y-m-d H:i:s");
        $name = $json['name'];
        $humidity = $json['main']['humidity'];
        $pressure = $json['main']['pressure'];
        $weather_name = $json['weather'][0]['main'];
        $icon_id = $json['weather'][0]['icon'];

        $sql1 = "SELECT * FROM weather WHERE city = '$name' AND weather_when >= DATE_SUB(NOW(), INTERVAL 10 SECOND) ORDER BY weather_when DESC limit 1";
        $result = ($conn->query($sql1));
        if($result->num_rows == 0){

            $sql = "INSERT INTO weather (weather_description, weather_temperature, weather_wind, weather_when, city, weather_humidity, pressure, weather_name, icon_id)
            VALUES ('$description', '$temp', '$wind', '$date', '$name', '$humidity', '$pressure', '$weather_name', '$icon_id')";

            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }

        //retrieve data

        $sql = "select * from weather ORDER BY weather_when DESC limit 1";
        $result = ($conn->query($sql));
        //declare array to store the data of database
        $row = []; 
    
        if ($result->num_rows > 0) 
        {
            // fetch all data from db into array 
            $row = $result->fetch_all(MYSQLI_ASSOC);  
        }  

        $conn->close();
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather App - JavaScript</title>
    <link rel="stylesheet" href="font/Rimouski.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <div class="app-title">
            <p>Weather</p>
        </div>
        <div class="notification"> </div>
        <div class="weather-container">


        <?php
               if(!empty($row))
               foreach($row as $rows)
              { 
            ?>
            
            <div class="temperature-value">
                <p><?php echo $rows['weather_tempegit initrature']; ?>°<span>K</span></p>
            </div>
            <div class="temperature-description">
                <p><?php echo $rows['weather_description']; ?></p>
            </div>
            <div class="location">
                <p><?php echo $rows['city']; ?></p>
            </div>

            <?php } ?>

        </div>
    </div>
    
    <p id="myWeather"></p>
    <p id="myTemperature"></p>
    <p id="myLastUpdated"></p>
    
    <script src="app.js"></script>
</body>
</html>
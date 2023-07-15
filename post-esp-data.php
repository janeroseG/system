<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datalog";

/*$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);*/

$apiKeyValue = "tPmAT5Ab3j7F9";

$apiKeyValue = $location = $temperature = $humidity = $temperature1 = $humidity1 = $tempCelsius= $pHvalue= $conductivity;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
    
        $location = test_input($_POST["location"]);
        $temperature = test_input($_POST["temperature"]);
        $humidity = test_input($_POST["humidity"]);
        $temperature1 = test_input($_POST["temperature1"]);
        $humidity1 = test_input($_POST["humidity1"]);
        $tempCelsius = test_input($_POST["tempCelsius"]);
        $pHvalue = test_input($_POST["pHvalue"]);
        $conductivity = test_input($_POST["conductivity"]);
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO sensordata (location, temperature, humidity, temperature1, humidity1,tempCelsius,pHvalue, conductivity)
        VALUES ( '" . $location . "', '" . $temperature . "', '" . $humidity . "', '" . $temperature1 . "', '" . $humidity1 . "','" . $tempCelsius . "','" . $pHvalue . "','" . $conductivity . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
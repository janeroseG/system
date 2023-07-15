<?php
$msg = "";
define('TITLE', 'Dashboard');
define('PAGE', 'SubmitRequest');
include('includes/header.php');
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'</script>";
}
?>


<div class="col-sm-9 col-md-10">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datalog";
// Set the number of records to display per page
$recordsPerPage = 12;

// Get the current page number from the URL
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
// Calculate the OFFSET value for the SQL query
$offset = ($currentPage - 1) * $recordsPerPage;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) AS total FROM sensordata";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql = "SELECT id, location, temperature, humidity, temperature1, humidity1, reading_time FROM sensordata ORDER BY id DESC LIMIT $offset, $recordsPerPage";

$dataPoints = array();
$dataPoints2 = array();

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_temperature = $row["temperature"];
        $row_humidity = $row["humidity"];
        $row_temperature2 = $row["temperature1"];
        $row_humidity2 = $row["humidity1"];

        $dataPoints[] = array("x" => strtotime($row["reading_time"]) * 1000, "y" => $row_temperature, "name" => "Temperature");
        $dataPointsh[] = array("x" => strtotime($row["reading_time"]) * 1000, "y" => $row_humidity, "name" => "Humidity");

        $dataPoints2[] = array("x" => strtotime($row["reading_time"]) * 1000, "y" => $row_temperature2, "name" => "Temperature2");
        $dataPoints2h[] = array("x" => strtotime($row["reading_time"]) * 1000, "y" => $row_humidity2, "name" => "Humidity2");
    }
    $result->free();
}
$conn->close();

?>
<!DOCTYPE HTML>
<html>
<head>

<script>
window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "Temperature and Humidity Inside"
        },
        axisY: {
            title: "Temperature / Humidity",
            valueFormatString: "#0.##",
            suffix: "Cel",
            prefix: ""
        },
        axisX: {
            title: "Time",
            valueFormatString: "h:mm TT", // Format time as 12-hour with AM/PM
            interval: 120, // Set interval to 2 hours (120 minutes)
            intervalType: "minute",
            labelAngle: -45, // Rotate labels for better readability (optional)
            timeZoneOffset: new Date().getTimezoneOffset()
        },
        data: [{
            type: "spline",
            markerSize: 5,
            xValueFormatString: "h:mm TT",
            yValueFormatString: "#0.##",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
            showInLegend: true,
            legendText: "{name}",
            color: "red", // Set color as red for temperature
            markerColor: "red" // Set marker color as red for temperature
        }, {
            type: "spline",
            markerSize: 5,
            xValueFormatString: "h:mm TT",
            yValueFormatString: "#0.##",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($dataPointsh, JSON_NUMERIC_CHECK); ?>,
            showInLegend: true,
            legendText: "{name}",
            color: "blue", // Set color as blue for humidity
            markerColor: "blue" // Set marker color as blue for humidity
        }]
    });

    chart.render();

    var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title:{
            text: "Temperature2 and Humidity2 Outside"
        },
        axisY: {
            title: "Temperature2 / Humidity2",
            valueFormatString: "#0.##",
            suffix: "Cel",
            prefix: ""
        },
        axisX: {
            title: "Time",
            valueFormatString: "h:mm TT", // Format time as 12-hour with AM/PM
            interval: 120, // Set interval to 2 hours (120 minutes)
            intervalType: "minute",
            labelAngle: -45, // Rotate labels for better readability (optional)
            timeZoneOffset: new Date().getTimezoneOffset()
        },
        data: [{
            type: "spline",
            markerSize: 5,
            xValueFormatString: "h:mm TT",
            yValueFormatString: "#0.##",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>,
            showInLegend: true,
            legendText: "{name}",
            color: "green", // Set color as green for temperature2
            markerColor: "green" // Set marker color as green for temperature2
        }, {
            type: "spline",
            markerSize: 5,
            xValueFormatString: "h:mm TT",
            yValueFormatString: "#0.##",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($dataPoints2h, JSON_NUMERIC_CHECK); ?>,
            showInLegend: true,
            legendText: "{name}",
            color: "purple", // Set color as purple for humidity2
            markerColor: "purple" // Set marker color as purple for humidity2
        }]
    });

    chart2.render();

}
</script>

</head>
<body>

<div id="chartContainer" style="height: 370px; width: 50%;"></div>

<style>
.container {
  display: flex;
  float: right;
  flex-direction: row;
  
}

.chart-container {
  width: 50%;
  margin-right: 10px;
  position: absolute;
  top: 0;
  right: 0;
}

</style>

<div class="container">
  <div class="chart-container">
    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
  </div>
  <!-- Add other content or charts here -->
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
setTimeout(function() {
    location.reload();
}, 5 * 60 * 1000);
</script>
</body>
</html>
</div>
<?php
include('includes/footer.php');
?>

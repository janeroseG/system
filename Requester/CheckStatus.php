<?php
define('TITLE', 'DataStatus');
define('PAGE', 'CheckStatus');
include('../dbConnection.php');
include('includes/header.php');
session_start();
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php';</script>";
}
?>

<div class="col-sm-9 col-md-10">
    <!-- Start User Change Pasword  Form 2nd Column -->
    <?php
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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "datalog";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT(*) AS total FROM sensordata";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalRecords = $row['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);

    $sql = "SELECT id, location, temperature, humidity, temperature1, humidity1,tempCelsius,pHvalue,conductivity,reading_time FROM sensordata ORDER BY id DESC LIMIT $offset, $recordsPerPage";

    echo '<div class="table-container"><table cellspacing="5" cellpadding="5">
      <tr> 
        <th>ID</th> 
        <th>Date &amp; Time</th> 
        <th>Location</th> 
        <th>Temperature Outside &deg;C</th> 
        <th>Humidity Outside &#37;</th>
        <th>Temperature Inside &deg;C</th> 
        <th>Humidity1 Inside &#37;</th>
        <th>Water Temperature &deg;C</th>
        <th>PH level</th>
        <th>Water Conductivity</th>
        <th>Operation</th>          
      </tr>';

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["id"];
            $row_reading_time = $row["reading_time"];

            $row_location = $row["location"];
            $row_temperature = $row["temperature"];
            $row_humidity = $row["humidity"];
            $row_temperature1 = $row["temperature1"];
            $row_humidity1 = $row["humidity1"];
            $row_tempCelsius = $row["tempCelsius"];
            $row_pHvalue = $row["pHvalue"];
            $row_conductivity = $row["conductivity"];

            echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_reading_time . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_temperature . '</td> 
                <td>' . $row_humidity . '</td>
                <td>' . $row_temperature1 . '</td> 
                <td>' . $row_humidity1 . '</td> 
                <td>' . $row_tempCelsius . '</td> 
                <td>' . $row_pHvalue . '</td> 
                <td>' . $row_conductivity . '</td> 
                <td>
                    <a href="delete.php?id=' . $row["id"] . '" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>
               </td> 
              </tr>';
        }
        $result->free();
    }
    $conn->close();
    ?>
 </table></div> <!-- End User Change Pasword  Form 2nd Column -->


 <link rel="stylesheet" href="../css/table.css">
<link rel="stylesheet" href="../css/page.css">
<div class="pagination">
<?php if ($currentPage > 1) : ?>
    <a href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
<?php endif; ?>

<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
    <?php if ($i == $currentPage) : ?>
        <span class="current-page"><?php echo $i; ?></span>
    <?php else : ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if ($currentPage < $totalPages) : ?>
    <a href="?page=<?php echo $currentPage + 1; ?>">Next</a>
<?php endif; ?>
</div>
<?php
include('includes/footer.php');
?>

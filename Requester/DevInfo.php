<?php
$msg = "";
define('TITLE', 'Developers');
define('PAGE', 'DevInfo');
include('includes/header.php');
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'</script>";
}
?>

<?php
include('includes/footer.php');
?>
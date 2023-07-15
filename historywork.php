<?php 
define('PAGE', 'history work');
include('includes/header.php');
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'</script>";
}
?>
<!-- Start 2nd Column -->
<div class="col-sm-6 mt-5 mx-3">
    <h3 class="text-center">Assigned Work Details</h3> 
<?php 
    if(isset($_REQUEST['view'])){
        $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc(); ?>
        <table class="table table-bordered">
            <tbody>
            <tr>
            <td>Request ID</td>
            <td><?php if(isset($row['request_id'])){echo $row['request_id'];} ?>
        </td>
        </tr>
        <tr>
            <td>Type of Request</td>
            <td><?php if(isset($row['request_info'])){echo $row['request_info'];} ?>
        </td>
        </tr>
        <tr>
            <td>Request Description</td>
            <td><?php if(isset($row['request_desc'])){echo $row['request_desc'];} ?>
        </td>
        </tr>
        <tr>
            <td>Name</td>
            <td><?php if(isset($row['requester_name'])){echo $row['requester_name'];} ?>
        </td>
        </tr>
        <tr>
            <td>Laboratory Number</td>
            <td><?php if(isset($row['requester_labnumb'])){echo $row['requester_labnumb'];} ?>
        </td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php if(isset($row['requester_email'])){echo $row['requester_email'];} ?>
        </td>
        </tr>
        <tr>
            <td>Mobile Number</td>
            <td><?php if(isset($row['requester_mobile'])){echo $row['requester_mobile'];} ?>
        </td>
        </tr>
        <tr>
            <td>Assigned Date</td>
            <td><?php if(isset($row['assign_date'])){echo $row['assign_date'];} ?>
        </td>
        </tr>
        <tr>
            <td>Technician Name</td>
            <td><?php if(isset($row['assign_tech'])){echo $row['assign_tech'];} ?>
        </td>
        </tr>
        <tr>
            <td>Customer Sign</td>
            <td></td>
        </tr>
        <tr>
            <td>Technician Sign</td>
            <td></td>
        </tr>
        </tbody>
        </table>
        <div class="text-center">
            <form action="" class="mb-3 d-print-none d-inline">
        </form>
                <form action="history.php" class="mb-3 d-print-none d-inline"><input class="btn btn-secondary" type="submit" value="Close">
            </form>
        </div>
<?php  } ?>
</div>
<!-- End 2nd Column -->
<?php include('includes/footer.php')?>
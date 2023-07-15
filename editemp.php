<?php
define('TITLE', 'Update Technician');
define('PAGE', 'technician');
include('includes/header.php');
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}
        if(isset($_REQUEST['empupdate'])){
            if(($_REQUEST['empName'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "") || ($_REQUEST['empStatus'] =="")){
                $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
            } else {
                $eId = $_REQUEST['empId'];
                $eName = $_REQUEST['empName'];
                $eMobile = $_REQUEST['empMobile'];
                $eEmail = $_REQUEST['empEmail'];
                $eStatus = $_REQUEST['empStatus'];
                $sql = "UPDATE technician_tb SET empName = '$eName', empMobile = '$eMobile', empEmail = '$eEmail', empStatus = '$eStatus' WHERE empid = '$eId'";
                if($conn->query($sql) == TRUE){
                    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
                } else {
                    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
                }
            }
        }
        ?>
        <div class="col-sm-6 mt-5 mx-3 jumbotron">
            <h3 class="text-center">Update Technician Details</h3>
        <?php
        if(isset($_REQUEST['edit'])){
            $sql = "SELECT * FROM technician_tb WHERE empid = {$_REQUEST['id']}";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }
    ?>
    <form action="" method="POST" name="frm">
        <div class="form-group">
        <?php if(isset($msg)) {echo $msg;} ?>
        <label for="empId">Emp ID</label>
        <input type="text" class="form-control" name="empId" id="empId" Value="<?php if(isset($row['empid'])) {echo $row['empid']; } ?>" readonly>
</div>
<div class="form-group">
        <label for="empName">Name</label>
        <input type="text" class="form-control" name="empName" id="empName" Value="<?php if(isset($row['empName'])) {echo $row['empName']; } ?>" readonly >
</div>
<div class="form-group">
        <label for="empMobile">Mobile Number</label>
        <input type="text" class="form-control" name="empMobile" id="empMobile" Value="<?php if(isset($row['empMobile'])) {echo $row['empMobile']; } ?>" >
</div>
<div class="form-group">
        <label for="empEmail">Email</label>
        <input type="text" class="form-control" name="empEmail" id="empEmail" Value="<?php if(isset($row['empEmail'])) {echo $row['empEmail']; } ?>" readonly>
</div>
<div class="form-group">
        <label for="empStatus">Status</label>
        <input type="text" class="form-control" name="empStatus" id="empStatus" Value="<?php if(isset($row['empStatus'])) {echo $row['empStatus']; } ?>" >
</div>
<div class="text-center">
    <button type="submit" class="btn btn-danger" id="empupdate" name="empupdate" onclick="return val()">Update</button>
    <a href="technician.php" class="btn btn-secondary">Close</a>
</div>

</div>
</form>
</div>
<!-- Only Number for input fields -->
<script>
      function val () {
            if(frm.empMobile.value=="")
            {
                alert("Please Enter Phone number");
                frm.empMobile.focus();
                return false;
            }
            if(isNaN(frm.empMobile.value))
            {
                alert("Invalid phone number");
                frm.empMobile.focus();
                return false;
            }
            if((frm.empMobile.value).length < 11)
            {
                alert("Phone number should be 11 digits");
                frm.empMobile.focus();
                return false;
            }
            return true;
    }
    </script>

<?php
include('includes/footer.php');
?>
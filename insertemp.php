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
 if(isset($_REQUEST['empsubmit'])){
    if(($_REQUEST['empName'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "") || ($_REQUEST['empStatus'] =="")){
        $msg ='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields </div>';
    } else {
        $eName = $_REQUEST['empName'];
        $eMobile = $_REQUEST['empMobile'];
        $eEmail = $_REQUEST['empEmail'];
        $eStatus = $_REQUEST['empStatus'];
        $sql = "INSERT INTO technician_tb (empName, empMobile, empEmail, empStatus) VALUES ('$eName', '$eMobile', '$eEmail', '$eStatus')";
        if($conn->query($sql) == TRUE){
            $msg ='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Added Successfully </div>';
        } else {
            $msg ='<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Add </div>';
        }
    }
 }
?>
<!-- Start 2nd Column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Technician</h3>
    <?php if(isset($msg)) {echo $msg;} ?>
    <form action="" method="POST" name="frm" onsubmit="return namevalidate()" value="Validate Name" >
        <div class="form-group">
        <label for="empName">Name</label>
        <input type="text" class="form-control" id="empName" name="empName">
</div>
<div class="form-group">
        <label for="empMobile">Mobile Number</label>
        <input type="text" class="form-control" id="empMobile" name="empMobile">
</div>
<div class="form-group">
        <label for="empEmail">Email</label>
        <input type="email" class="form-control" id="empEmail" name="empEmail">
</div>
<div class="form-group">
    <label for="empStatus">Status</label>
    <input type="text" class="form-control" id="empStatus" name="empStatus">
</div>
<div class="text-center">
    <button type="submit" class="btn btn-danger" id="empsubmit" name="empsubmit" onclick="return val()" >Submit</button>
    <a href="technician.php" class="btn btn-secondary">Close</a>
</div>

</form>
</div>
<!-- Only Number for input fields -->
<script type="text/javascript">
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
            if((frm.empMobile.value).length < 10)
            {
                alert("Phone number should be 10 digits");
                frm.empMobile.focus();
                return false;
            }
            return true;
    }

    function namevalidate(){

var regName = /^[a-zA-Z]+ [a-zA-Z]+ [a-zA-Z]+$/;

var empName = document.getElementById('empName').value;
if(!regName.test(empName)){
    alert('Name should only accept letters and spaces');
    document.getElementById('empName').focus();
    return false;
}else{
    return true;
}
    }
    </script>
<?php
include('includes/footer.php');
?>
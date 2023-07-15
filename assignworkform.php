<?php 
if(session_id() == ''){
    session_start();
}
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'</script>";
}
if(isset($_REQUEST['view'])){
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id= {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if(isset($_REQUEST['close'])){
    $sql = "DELETE FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    if($conn->query($sql) == TRUE){
        echo '<meta http-equiv="refresh" content= "0;URL=?closed"/>';
    } else {
        echo "Unable to Delete";
    }
}
if(isset($_REQUEST['assign'])){
    if(($_REQUEST['request_id'] == "") || ($_REQUEST['request_info'] == "") || ($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['requesterlabnum'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['assigntech'] == "") || ($_REQUEST['inputdate'] == "")){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        $rid = $_REQUEST['request_id'];
        $rinfo = $_REQUEST['request_info'];
        $rdesc = $_REQUEST['requestdesc'];
        $rname = $_REQUEST['requestername'];
        $rlabnum = $_REQUEST['requesterlabnum'];
        $remail = $_REQUEST['requesteremail'];
        $rmobile = $_REQUEST['requestermobile'];
        $rassigntech = $_REQUEST['assigntech'];
        $rdate = $_REQUEST['inputdate'];
        $sql = "INSERT INTO assignwork_tb (request_id ,request_info, request_desc, requester_name, requester_labnumb, requester_email, requester_mobile, assign_tech, assign_date) VALUES ('$rid', '$rinfo', '$rdesc', '$rname', '$rlabnum', '$remail','$rmobile', '$rassigntech', '$rdate')";
        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Work Assigned Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Assign Work</div>';
        }
    }
}
?>


<div class="col-sm-5 mt-5 jumbotron"> <!-- Start Assigned Work 3rd Column-->
<form action="" method="POST">
    <h5 class="text-center">Assign Work Order Request</h5>
    <?php if(isset($msg)){echo $msg; } ?>
    <div class="form-group">
        <label for="request_id">Request ID</label>
        <input type="text" class="form-control" id="request_id" name="request_id" value="<?php if(isset($row['request_id']))echo $row['request_id']; ?>" readonly>
</div>
<div class="form-group">
    <label for="request_info">Type of Request</label>
    <input type="text" class="form-control" id="request_info" name="request_info" value="<?php if(isset($row['request_info']))echo $row['request_info']; ?>">
</div>
<div class="form-group">
    <label for="requestdesc">Description</label>
    <input type="text" class="form-control" id="requestdesc" name="requestdesc" value="<?php if(isset($row['request_desc']))echo $row['request_desc']; ?>">
</div>
<div class="form-group">
    <label for="requestername">Name</label>
    <input type="text" class="form-control" id="requestername" name="requestername" value="<?php if(isset($row['requester_name']))echo $row['requester_name']; ?>">
</div>
<div class="form-group">
    <label for="requesterlabnum">Laboratory Number</label>
    <input type="text" class="form-control" id="inputlabNum" name="requesterlabnum" value="<?php if(isset($row['requester_labnumb']))echo $row['requester_labnumb']; ?>">
</div>
<div class="form-row">
    <div class="form-group col-md-8">
        <label for="requesteremail">Email</label>
        <input type="email" class="form-control" id="requesteremail" name="requesteremail" value="<?php if(isset($row['requester_email']))echo $row['requester_email']; ?>">
</div>
<div class="form-group col-md-4">
    <label for="requestermobile">Mobile Number</label>
    <input type="text" class="form-control" id="requestermobile" name="requestermobile" value="<?php if(isset($row['requester_mobile']))echo $row['requester_mobile']; ?>" onkeypress="isInputNumber(event)">
</div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="assigntech">Assign to Technician</label>
        <input type="text" class="form-control" id="assigntech" name="assigntech">
</div>
<div class="form-group col-md-6">
    <label for="inputDate">Date</label>
    <input type="date" class="form-control" id="inputDate" name="inputdate">
</div>
</div>
<div class="float-right">
    <button type="submit" class="btn btn-success" name="assign">Assign</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
</div>
</form>
</div> <!-- End Assigned Work 3rd Column -->
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if(!(/[0-9]/.test(ch))) {
            evt.preventDefault();
        }
    }
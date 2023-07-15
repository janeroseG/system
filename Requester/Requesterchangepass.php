<?php
define('TITLE', 'Analytics');
define('PAGE', 'Requesterchangepass');
include('includes/header.php');
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'</script>";
}
$sql = "SELECT r_name, r_email, r_password FROM requesterlogin_tb WHERE r_email = '$rEmail'";
$result = $conn->query($sql);
if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $rName = $row['r_name'];
}

$rEmail = $_SESSION['rEmail'];
if(isset($_REQUEST['passupdate'])){
   if($_REQUEST['rPassword'] == "" ){
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
   } else {
    $rPass = $_REQUEST['rPassword'];
    $sql = "UPDATE requesterlogin_tb SET r_password = '$rPass' WHERE r_email = '$rEmail'";
    if($conn->query($sql) == TRUE){
        $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Updated Successfully</div>';
    } else {
        $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Update</div>';
    }
   }
}

?>
<div class="col-sm-9 col-md-10">    <!-- Start User Change Pasword  Form 2nd Column -->
<form class="mt-5 mx-5" action="" method="POST">
    <div class="form-group">
    <?php if(isset($passmsg)){echo $passmsg;} ?>
    <label for="inputEmail">Email</label>
    <input type="email" class="form-control" id="inputEmail" value="<?php echo $rEmail; ?>" readonly>
    </div>
    <div class="form-group">
            <label for="rName">Name</label><input type="text" class="form-control" name="rName" id="rName" value="<?php echo $rName?>"readonly>
        </div>
    <div class="form-group">
    <label for="inputnewpassword">New Password</label>
    <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="rPassword" onkeyup="return validate ()">
    </div>
    <ul>
                                <li id='upper'> Atleast one uppercase </li>
                                <li id='lower'> Atleast one lowercase</li>
                                <li id='special_char'> Atleast one special symbol</li>
                                <li id='number'> Atleast one number</li>
                                <li id='length'> Make your password atleast 6-8 character</li>
                            </ul>
    <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Update</button>
    <button type="reset" class="btn btn-secondary mt-4">Reset</button>
    
</form>
</div>   <!-- End User Change Pasword  Form 2nd Column -->
<script>
     function validate(){
    var pass = document.getElementById('inputnewpassword');
    var upper = document.getElementById('upper');
    var lower = document.getElementById('lower');
    var num = document.getElementById('number');
    var len = document.getElementById('length');
    var sp_char = document.getElementById('special_char');
    // check if pass value contain a number
    if(pass.value.match(/[0-9]/)) {// match is function which matchs a regular expressions
    // password contain 0  to 9 number then 
        num.style.color = 'green'


    }
    else {
        //otherwise
        num.style.color = 'red'
    }
     // check if pass value contain a uppercase
     if(pass.value.match(/[A-Z]/)) {// match is function which matchs a regular expressions
        // password contain A  to Z number then 
            upper.style.color = 'green'
    
    
        }
        else {
            //otherwise
            upper.style.color = 'red'
        }
     // check if pass value contain a lowercase
     if(pass.value.match(/[a-z]/)) {// match is function which matchs a regular expressions
        // password contain A  to Z number then 
            lower.style.color = 'green'
    
    
        }
        else {
            //otherwise
            lower.style.color = 'red'
        }
    // checking for special symbols
    if(pass.value.match(/[!\@\#\$\%\^\&\*\(\)\_\-\+\=\?\>\<\.\,]/)) {// match is function which matchs a regular expressions
        // type all special characters which you want 
            sp_char.style.color = 'green'
        // it returns true if those characters are in password
    
        }
        else {
            //otherwise
            sp_char.style.color = 'red'
        }
    // check length of password
    if(pass.value.length <6){
        len.style.color='green'
    }
    else{
        len.style.color='green'
    }

}
    </script>
<?php
include('includes/footer.php');
?>
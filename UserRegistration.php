<?php 
include 'dbConnection.php';
$msg = "";

if (isset($_POST['submit'])) {
    $rName = mysqli_real_escape_string($conn, $_POST['rName']);
    $rEmail = mysqli_real_escape_string($conn, $_POST['rEmail']);
    $rPassword = mysqli_real_escape_string($conn, ($_POST['rPassword']));
    $confirm_password = mysqli_real_escape_string($conn, ($_POST['confirm-password']));
    
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM requesterlogin_tb WHERE r_email='{$rEmail}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$rEmail} - This email address has been already exists.</div>";
    } else {
        if ($rPassword == $confirm_password) {
            $sql = "INSERT INTO requesterlogin_tb (r_name, r_email, r_password) VALUES ('{$rName}', '{$rEmail}', '{$rPassword}')";
                $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "<div class= 'alert alert-success'>Registration has been Successfully</div>";
        }
        } else {
            $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
        }
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration Form</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/styled.css" type="text/css" media="all" />

    
    <!--//Style-CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image3.svg" alt="">
                    </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Create an Account</h2>
                        <p>It's quick and easy.</p>
                        <?php echo $msg; ?>
                        <form action="" method="post" >
                            <input type="text" class="name" name="rName" id = "name" placeholder="Enter Full Name" value="<?php if (isset($_POST['submit'])) { echo $rName; } ?>" required>
                            <input type="email" class="email" name="rEmail" placeholder="Enter Email" value="<?php if (isset($_POST['submit'])) { echo $rEmail; } ?>" required>
                            <div class="input-box">
                            <input type="password" class="password" name="rPassword" placeholder="Enter Password" id = "myInput"  onkeyup="return validate ()" required>
                            <span class="eye" onclick="myFunction()">
                                <i id = "hide1" class="fa-solid fa-eye"></i>
                                <i id = "hide2" class="fa-solid fa-eye-slash"></i>
                            </span>
                            </div>
                            <ul>
                                <li id='upper'> Atleast one uppercase </li>
                                <li id='lower'> Atleast one lowercase</li>
                                <li id='special_char'> Atleast one special symbol</li>
                                <li id='number'> Atleast one number</li>
                                <li id='length'> Make your password atleast 6-8 character</li>
                            </ul>
                            <div class= "input-box">
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Confirm Password" id ="confirmPw"  onkeyup="return confirmPassword()" required>
                            <span class="eye" onclick = "myFunctionpw()">
                                <i id = "show1" class="fa-solid fa-eye"></i>
                                <i id = "show2" class="fa-solid fa-eye-slash" ></i>
                            </span>
                            </div>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account ?<a href="Requester/RequesterLogin.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->
    <script src ="js/script.js"></script>
    <script src ="js/validation.js"></script>
    <script src ="js/namevalidate.js"></script>

    <script>
        function myFunction(){
            var x = document.getElementById("myInput");
            var y = document.getElementById("hide1");
            var z = document.getElementById("hide2");

            if(x.type === 'password'){
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            }
            else{
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }
    </script>
</body>

</html>
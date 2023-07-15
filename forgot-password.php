<?php 
session_start();
if (isset($_SESSION['rEmail'])) {
    header("Location: RequesterLogin.php");
    die();
}
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include 'dbConnection.php';
    $msg = "";

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    if (isset($_POST['submit'])) {
        $rEmail = mysqli_real_escape_string($conn, $_POST['rEmail']);
        $code = mysqli_real_escape_string($conn, md5(rand()));
        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM requesterlogin_tb WHERE r_email='{$rEmail}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE requesterlogin_tb SET code='{$code}' WHERE r_email='{$rEmail}'");
            if ($query) {        
                echo "<div style='display: none;'>";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                         
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'lorenz.landero@ctu.edu.ph';                     //SMTP username
        $mail->Password   = 'ozrvctodhtzpvffg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('from@example.com', 'no reply');
        $mail->addAddress($rEmail);     //Add a recipient

    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'Here is the verification link <b><a href="http://localhost/ProjectSystem/change-password.php?reset='.$code.'">http://localhost/ProjectSystem/change-password.php?reset='.$code.'</a></b>';

    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    echo "</div>";        
            $msg = "<div class='alert alert-info'>Successfully Sent a Reset Link.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>$rEmail - This email address does not found.</div>";
    }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password  Form</title>
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
                            <img src="images/image2.svg" alt="">
                    </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Forgot Password</h2>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="rEmail" placeholder="Enter Your Email" required>
                            <button name="submit" class="btn" type="submit">Send Reset Link</button>
                        </form>
                        <div class="social-icons">
                            <p>Back to! <a href="Requester/RequesterLogin.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>  

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">

    <title><?php echo TITLE ?></title>
</head>
<body>
  <!-- Top Navbar -->
  <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="RequesterProfile.php">AgriFresh</a></nav> 
  <br>
    <!--  Start Container -->
    <div class="container-fluid" style="margin-top:40px;">
    <div class="row">   <!--  Start Row -->
    <br>
  <br>
    <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
         <!-- Side Bar 1st Column -->
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'SubmitRequest'){echo 'active';} ?>" href="SubmitRequest.php"><i class="fas fa-qrcode"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'CheckStatus'){echo 'active';} ?>" href="Checkstatus.php"><i class="fas fa-database"></i>Datalog</a></li>
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'Requesterchangepass'){echo 'active';} ?>" href="Requesterchangepass.php"><i class="fas fa-chart-bar"></i>Analytics</a></li>
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'Cloud'){echo 'active';} ?>" href="Cloud.php"><i class="fas fa-cloud"></i>Connect Cloud</a></li>
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'DevInfo'){echo 'active';} ?>" href="DevInfo.php"><i class="fas fa-code"></i>Developers Information</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
        </ul>
        </div>
        
    </nav>  <!-- End Side Bar 1st Column -->
    

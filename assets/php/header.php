<?php
require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> U M S  | <?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')) ; ?> </title> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css"/>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <!-- Custom Css  -->
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap');

        *{
            font-family: "Maven Pro", sans-serif;
        }
    </style>
  </head>
<body>
 <nav class="navbar navbar-expand-md bg-dark navbar-dark">

    <a class="navbar-brand" href="index.php"><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp; U M S </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link <?= (basename($_SERVER['PHP_SELF'] )== "home.php")?"active":"";?>" href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=="profile.php")?"active":"";?>" href="profile.php"><i class="fas fa-user-circle"></i>&nbsp;Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=="feedback.php")?"active":"";?>" href="feedback.php"><i class="fas fa-comment-dots"></i>&nbsp;Feedback</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=="notification.php")?"active":"";?>" href="notification.php"><i class="fas fa-bell"></i>&nbsp;Notification&nbsp;
        <span id="checkNotification"></span></a>
        </li>
        <li class="nav-item">
                <a href="#" class = "nav-link"><i class="fas fa-cog"></i>&nbsp; Setting</a>
    </li>
        <li class="nav-item">
            <a class="nav-link" style="color:#0BEEF9;" href="#" id="navbardrop">
                <i class="fas fa-user-cog"></i>&nbsp; Hi, <?= $fname; ?>
            </a>
        </li>
    <li  class="nav-item">                
        <a href="assets/php/logout.php" class = "nav-link"><i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a>

        </li>
            </ul>

        </div>
    </nav>
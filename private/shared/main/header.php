<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <style media="screen">
    .carousel > img{
      width : 100%;
      height: 80%;
    }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo getStylePath("main.css"); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo getStylePath("main.css"); ?>">

  </head>
  <body>

    <!-- Navigation -->
     <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
       <div class="container">
         <a class="navbar-brand" href="index.html">Blood Pressure Diagnosis System</a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
           <ul class="navbar-nav ml-auto mr-5">
             <li class="nav-item">
               <a class="nav-link active" href="<?php echo urlFor('index.php'); ?>">Home</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="services.html">About Us</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="<?php echo urlFor('registration.php'); ?>">Registration</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="contact.html">Login</a>
             </li>
           </ul>
         </div>
       </div>
     </nav>

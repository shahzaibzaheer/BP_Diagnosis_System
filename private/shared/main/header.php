<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo getStylePath("main.css"); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo getStylePath("main.css"); ?>">

  </head>
  <body>

    <!-- Navigation -->
     <nav class="main_nav navbar navbar-expand-lg">
       <div class="container">
         <a class="navbar-brand" href="<?php echo urlFor('index.php'); ?>">Blood Pressure Diagnosis System</a>
         <button class=" navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
           <i class=" navbar-toggler-icon fas fa-bars" ></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
           <ul class="navbar-nav ml-auto nav-pills">
             <li class="nav-item ">
               <a class="nav-link <?php echo $page_title =="Home" ? 'active': ''; ?>" href="<?php echo urlFor('index.php'); ?>">Home</a>
             </li>
             <li class="nav-item">
               <a class="nav-link  <?php echo $page_title =="About Us" ? 'active': ''; ?>" href="<?php echo urlFor('aboutus.php'); ?>">About Us</a>
             </li>
         </div>
       </div>
     </nav>

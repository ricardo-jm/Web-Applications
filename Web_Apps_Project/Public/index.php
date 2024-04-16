<?php

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="images/title-img.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <title>SVDNS</title>
</head>

<body>
  <!-- Header -->
  <header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
      <!-- Brand -->
      <a class="navbar-brand" href="index.html">SVDNS</a>

      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html">Services</a>
          </li>
           <!-- Dropdown -->
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Prices</a>
            <div class="dropdown-menu bg-dark">
              <a class="dropdown-item bg-dark" href="rentals.html">Rentals</a>
              <a class="dropdown-item bg-dark" href="sales.html">Sales</a>
            </div><!-- End Dropdown -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="links.html">Links/Downloads</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gallery.html">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact Us</a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Banner -->
    <section>
      <div class="container-fluid banner">
        <div class="row justify-content-center align-items-top">
          <div class="col-sm-10 text-center">
            <h1 class="display-2 text-white font-weight-bold py-4">Swedish Vehicle Diagnostics</h1>
            <div class="row justify-content-end">
              <h1 class="display-4 text-secondary  pr-5 mr-5">(Not SAAB)</h1>
            </div>
            <div class="row justify-content-end">
              <a href="contact.html" class="btn btn-danger btn-lg px-4 m-5">Contact Us</a>
            </div>
            <h2 class="font-weight-light font-italic text-light">Providing Diagnostics support to Volvo enthusiasts</h2>
          </div>
        </div>
      </div>
    </section>
    <!-- End of Banner -->
  </header>
  <!-- End of Header -->

  <!-- Diagnostics -->
  <section>
    <div class="container-fluid">
      <div class="row bg-secondary justify-content-center text-left text-white">
        <div class="diag">
          <img src="images/volvo_swflag.jpg" alt="volvo with swidish flag" class="img-home">
        </div>
        <h3 class="p-4">Available Diagnostics: </h3>
        <ul class="py-3">
          <li>Clone DiCE for use with Vida 2014D/2015A and Vdash</li>
          <li>Genuine Vida compatible DiCE Clones for use with Vida 2014D/2015A , Genuine Vida and Vdash</li>
          <li>Ethernet cable for SPA platforms</li>
          <li>Vxdiag for use Vida 2014D/2015A , Genuine Vida and Vdash</li>
          <li>Mongoose Pro for use Vida 2014D/2015A , Genuine Vida and Vdash</li>
          <li>Vida 2014D pre installed and ready to rock laptops (as well as other complimentary software)</li>
          <li>Boot&Go! -Portable diagnostics installation</li>
          <li>For CEM pin Decoding why not check out ModUnlock – the handheld portable CEM pin Decoder</li>
        </ul>
      </div>
    </div>
  </section>
  <!-- End of Diagnostics -->

  <!-- Links -->
  <section>
    <div class="container-fluid">
      <div class="row bg-secondary text-left text-white">
        <div class="div_home">
          <h3 class="p-4 mt-4">Links: </h3>
          <ul class="pb-3">
            <li><a href="services.html" class="home-link text-uppercase">Services</a></li>
            <li><a href="rentals.html" class="home-link text-uppercase">Rentals</a></li>
            <li><a href="sales.html" class="home-link text-uppercase">Sales</a></li>
            <li><a href="links.html" class="home-link text-uppercase">Links</a></li>
            <li><a href="gallery.html" class="home-link text-uppercase">Galery</a></li>
            <li><a href="about.html" class="home-link text-uppercase">About Us</a></li>
            <li><a href="contact.html" class="home-link text-uppercase">Contact Us</a></li>
          </ul>
      </div>
      </div>
    </div>
  </section>
  <!-- End of Links -->




  <!-- Footer -->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 text-left">
          <h4 class="text-white font-italic py-3 mt-3">Thanks for visiting Swedish Vehicle Diagnostics (Not SAAB)</h4>
          <h4 class="text-light font-weight-light  mt-3">Reach out to us in  the Contact Us page or via our social media profiles.</h4>
          <p class="text-light small py-3 mt-3">&copy;Copyright 2023 - Created by Ricardo Martins</p>
        </div>
        <div class="col-lg-6">
          <div class="py-3">
            <a href="https://www.facebook.com/groups/1923486377674644"><i class="fab fa-facebook fa-3x text-primary mx-3"></i></a>
            <a href="mailto:svdnsinfo@gmail.com"><i class="fas fa-envelope fa-3x text-warning mx-3"></i></a>
            <a href="https://wa.me/447930062056"><i class="fab fa-whatsapp fa-3x text-success mx-3"></i></a>
            <a href="https://t.me/thatvidavdashguy"><i class="fab fa-telegram fa-3x text-primary mx-3"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
    <!-- End of Footer -->


    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  <script src="script.js"></script>

</body>
</html>

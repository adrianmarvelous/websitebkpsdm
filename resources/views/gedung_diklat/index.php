<?php 
    //require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Diklat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
</head>

<!--<style>
  @media only screen and (max-width: 850px) {
      .title{
          font-size:100px;
      }
      .backcover{
          flex-direction: reverse-column;
      }
  }
</style>-->
<style>
  body{
    background-image: url("resource/photo/home 3.jpeg");
    background-repeat: no-repeat;
    background-size:cover;
    background-attachment:fixed;
  }
  .cover{
    height:100%;
      left: 0px;
      top: 0px;
    display:flex;
    justify-content:center;
    background-color: rgba(255, 255, 255, .15);  
    backdrop-filter: blur(5px);
  }
  .kegiatan{
    display:flex;
  }
  @media only screen and (max-width: 1000px) {
    .kegiatan{
      flex-direction: column;
    }
    .gambar_logo{
      width: 60%;
    }
  }
</style>
<body>
<nav class="navbar navbar-expand-lg" style="
    background: rgba(255, 255, 255, 0.9); // Make sure this color has an opacity of less than 1
    backdrop-filter: blur(8px); // This be the blur;
    width:100%;
    display:flex;
  <div class="logo">
      <img class="gambar_logo" src="resource/logo/logo-bkpsdm.png" alt="" >
  </div>
  <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div class="d-flex" style="">
          <ul class="navbar-nav me-auto mb-2 mb-lg-3">
              <li class="nav-item" style="font-size:24px;margin:20px;font-family: 'Anton', sans-serif;">
                  <a class="nav-link" href="?pages=">Home <span class="sr-only"></span></a>
              </li>
              <li class="nav-item" style="font-size:24px;margin:20px;font-family: 'Anton', sans-serif;">
                  <a class="nav-link" href="calendar/calendar.php">Booking<span class="sr-only"></span></a>
              </li>
              <li class="nav-item" style="font-size:24px;margin:20px;font-family: 'Anton', sans-serif;">
                  <a class="nav-link" href="?pages=index_kegiatan">Kegiatan<span class="sr-only"></span></a>
              </li>
              <li class="nav-item" style="font-size:24px;margin:20px;font-family: 'Anton', sans-serif;">
                  <a class="nav-link" href="login/login_page.php">Login<span class="sr-only"></span></a>
              </li>
          </ul>
      </div>
      </div>
  </div>
</nav>
<div class="cover">
<!--<div class="cover"></div>-->
<!--<img class="cover" src="resource/photo/home 3.jpeg" alt="">-->
  
<!--<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FADC9B;box-shadow: 10px 5px lightblue;">
    <img src="resource/logo/logo-bkpsdm.png" alt="" width="400">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <a class="nav-link" href="?pages=">Home <span class="sr-only">(current)</span></a>
    <a class="nav-link" href="?pages=fasilitas_index">Fasilitas<span class="sr-only"></span></a>
    <a class="nav-link" href="calendar/calendar.php">Booking<span class="sr-only"></span></a>
    <a class="nav-link" href="?pages=index_kegiatan">Kegiatan<span class="sr-only"></span></a>
    <a class="nav-link" href="login/login_page.php">Login<span class="sr-only"></span></a>
    </form>
  </div>
</nav>-->
<?php /*
  if(htmlentities(@$_GET['pages']) == ""){
    include "home_new.php";
  }elseif(htmlentities($_GET['pages']) == "index_kegiatan"){
    include "kegiatan/index.php";
  }elseif(htmlentities($_GET['pages']) == "fasilitas_index"){
    include "fasilitas/index.php";
  }elseif(htmlentities($_GET['pages']) == "calendar"){
    include "calendar/calendar.php";
  }*/
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
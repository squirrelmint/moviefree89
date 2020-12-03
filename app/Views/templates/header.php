<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $setting['setting_description']; ?>">
  <meta name="keywords" content="<?php echo $setting['setting_keyword']; ?>">
  <!-- TAG og facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo base_url(); ?>" />
  <meta property="og:title" content="<?php echo $setting['setting_title']; ?>" />
  <meta property="og:description" content="<?php echo  $setting['setting_description']; ?>" />
  <meta property="og:image" content="<?php echo $setting['setting_img']; ?>" />
  <!-- TAG og Twitter -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="<?php echo $setting['setting_title']; ?>" />
  <meta name="twitter:description" content="<?php echo  $setting['setting_description']; ?>" />
  <meta name="twitter:image" content="<?php echo $setting['setting_img']; ?>" />
  <meta name="twitter:site" content="@ondemandacademy" />
  <title><?php echo $setting['setting_title']; ?></title>
  <link rel="icon" type="image/png" href="<?= $path_setting . $setting['setting_icon'] ?>" />
  <!-- Bootstrap core CSS -->
  <link href="<?= $document_root ?>assets/vendor/bootstrap/css/bootstrap.min.css?v=1" rel="stylesheet">
  <link href="<?= $document_root ?>assets/css/nav-css.css" rel="stylesheet">
  <link href="<?= $document_root ?>assets/css/title.css" rel="stylesheet">
  <link href="<?= $document_root ?>assets/css/icon.css" rel="stylesheet">
  <link href="<?= $document_root ?>assets/css/paginate.css" rel="stylesheet">
  <link href="<?= $document_root ?>assets/css/iframe-movie.css" rel="stylesheet">
  
  <!-- Custom fonts for this template -->
  <link href="<?= $document_root ?>assets/vendor/fontawesome-free/css/all.min.css?v=1" rel="stylesheet">
  <link href="<?= $document_root ?>assets/vendor/simple-line-icons/css/simple-line-icons.css?v=1" rel="stylesheet" type="text/css">
  <!-- Swiper -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,400;0,700;1,100;1,400;1,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?= $document_root ?>assets/css/landing-page.css?v=3" rel="stylesheet">
  <?php
  if (("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) != ('https://' . $_SERVER['HTTP_HOST'] . '/')) {
  ?>
    <link rel="canonical" href="<?= 'https://' . $_SERVER['HTTP_HOST'] ?>" />
  <?php } ?>
  <!-- Bootstrap core JavaScript -->
  <script src="<?= $document_root ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= $document_root ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <?php
  if (!empty($setting['setting_header'])) {
    echo base64_decode($setting['setting_header']);
  }
  ?>
</head>
<style>
  .list-group {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0px;
    margin-top: -12px;
    border-radius: 0;
}
.color-nave{
    color:white !important;
}

</style>
<body>
  <div id="overlay"></div>
  <header>
    <!-- Navigation -->
    <nav id="movie-menu" class="navbar navbar-expand-lg navbar-light static-top">
      <div class="container">
        <div class="col-sm-3">
          <a class="navbar-brand" href="<?php echo base_url() ?>">
            <!-- <img class="logo" src="<?= $path_setting . $setting['setting_logo'] ?> "> -->
            <img class="logo" src="<?= base_url() . '/public/logo.png' ?> ">
          </a>
        </div>
        <div class="col-sm-5">
          <h2 class="superheader-font">ดูหนังออนไลน์ หนังใหม่ชนโรงฟรี 2020 เต็มเรื่อง</h2>
        </div>
        <div class="col-sm-4" style="text-align:right;">
          <div class="collapse navbar-collapse position-search" id="navbarSupportedContent">
            <!-- <ul class="navbar-nav ">
              <li class="nav-item <?= $chk_act['home'] ?>">
                <a class="nav-link" href="<?php echo base_url() ?>"><button class="home-btn"><i class="fa fa-home"></i></button></a>
              </li>
            </ul> -->
            <form id="movie-formsearch">
              <div class="input-group" id="adv-search">
                <?php
                if (!empty($keyword)) {
                  $value = $keyword;
                } else {
                  $value = '';
                }
                ?>
                <input id="movie-search" class="movie-search ml-auto" placeholder="Search..." value="<?php echo $value ?>" autocomplete="off">
              </div>
            </form>
            <?php

            //  **** ปุ่ม Swit ให้ Category ลงมา  *****
            // if ($chk_act['category'] || $chk_act['contract'] || $chk_act['poppular']) {
            //   $change = 'change';
            //   $style = 'style="display: block;"';
            // } else {
            //   $change = '';
            //   $style = '';
            // }
            ?>
            <!-- <div class="hamburger <?//= $change ?>" onclick="myFunction(this)">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
            </div> 
            
             <div class="container">
                <div class="topnav">
                  <div id="myLinks" <?//= $style ?>>
                    <div class="row">
                      <ul class="movie-sup-manu">
                        <li><a class=" <?//= $chk_act['poppular'] ?>" href="<?//= base_url() . '/popular/' ?>"> POPULAR</a></li>
                        <li><a class=" <?//= $chk_act['category'] ?>" href="<?//= base_url() . '/category/' ?>"> Category</a></li>
                        <li><a class=" <?//= $chk_act['contract'] ?>" href="<?//= base_url() . '/contract/' ?>">ขอหนัง/ติดต่อ</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            -->
          </div>
        </div>
      </div>
    </nav>


    <nav class="navbar navbar-expand-lg navbar-light bg-light-header">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="container">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link color-nave" href="#">หนัง <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link color-nave" href="#">Jav <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link color-nave" href="#">ติดต่อเรา <span class="sr-only"></span></a>
            </li>
          </ul>
        </div>
      </div>



    </nav>










    <script type="text/javascript">
      $(document).ready(function() {
        $('#movie-formsearch').submit(function(e) {
          goSearch();
          return false; //<---- Add this line
        });
      });

      function goSearch() {
        var search = $.trim($("#movie-search").val())
        if (search) {
          window.location.href = "/search/" + $("#movie-search").val();
        } else {
          window.location.href = "<?= base_url() ?>";
        }
      }

      function myFunction(x) {
        x.classList.toggle("change");
        var a = document.getElementById("myLinks");
        if (a.style.display === "block") {
          a.style.display = "none";
        } else {
          a.style.display = "block";
        }
      }
    </script>
    <!-- Slider main container -->
  </header>
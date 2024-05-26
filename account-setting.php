<?php
   include("./Inc/database.php");
   include("./Inc/authentication.php");

   $session_email = $_SESSION["email"];
   $query = $conn->query("SELECT * FROM `users` WHERE `email`='$session_email'");
   $result = $query->fetch_assoc();
   $name = $result["name"];
   if($name == "" || $name == null){
      $name = "User001";
   }
   $job = $result["job"];
   if($job == "" || $job == null){
      $job = "User";
   }
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SenetAnaliz - Türkiyenin Finans Platformu</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- Integrating Remix Icons: -->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.min.css" rel="stylesheet">
   </head>
   <body class="sidebar-main-active right-column-fixed">
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-navbar-logo d-flex justify-content-between">
               <a href="index.php" class="header-logo">
                  <span>SenetAnaliz</span>
               </a>
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="ri-menu-line"></i></div>
                     <div class="hover-circle"><i class="ri-close-fill"></i></div>
                  </div>
               </div>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="">
                        <a href="index.php" class="iq-waves-effect"><i class="las la-calendar iq-arrow-left"></i><span>Ana Sayfa</span></a>
                     </li>
                     <li class="">
                        <a href="screener.php" class="iq-waves-effect"><i class="las la-calendar iq-arrow-left"></i><span>Tarama</span></a>
                     </li>
                     <?php
                        $query = $conn->query("SELECT * FROM `stocks` WHERE `id`='1'");
                        $result = $query->fetch_assoc();
                        $code = $result["code"];
                     ?>
                     <li class="">
                        <a href="screener2.php?stock=<?php echo $code ?>" class="iq-waves-effect"><i class="las la-calendar iq-arrow-left"></i><span>Analiz</span></a>
                     </li>
                     <li class="">
                        <a href="account-setting.php" class="iq-waves-effect"><i class="las la-calendar iq-arrow-left"></i><span>Ayarlar</span></a>
                     </li>
                     <li class="">
                        <a href="logout.php" class="iq-waves-effect"><i class="las la-calendar iq-arrow-left"></i><span>Çıkış</span></a>
                     </li>
                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
         </div>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-menu-bt d-flex align-items-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-menu-line"></i></div>
                        <div class="hover-circle"><i class="ri-close-fill"></i></div>
                     </div>
                     <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                        <a href="index.php" class="header-logo">
                        <span>SenetAnaliz</span>
                        </a>
                     </div>
                  </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item">
                        <a class="search-toggle iq-waves-effect language-title" href="#">
                              <span class="ripple rippleEffect" style="width: 98px; height: 98px; top: -15px; left: 56.2969px;">
                           </span>
                           <img src="https://cdn.britannica.com/82/4782-004-4119489D/Flag-Turkey.jpg" alt="img-flaf" class="img-fluid mr-1" style="height: 16px; width: 16px;">
                            TR <i class="ri-arrow-down-s-line"></i></a>
                           <div class="iq-sub-dropdown">
                              <a class="iq-sub-card" href="#"><img src="images/small/flag-02.png" alt="img-flaf" class="img-fluid mr-2">French</a>
                              <a class="iq-sub-card" href="#"><img src="images/small/flag-03.png" alt="img-flaf" class="img-fluid mr-2">Spanish</a>
                              <a class="iq-sub-card" href="#"><img src="images/small/flag-04.png" alt="img-flaf" class="img-fluid mr-2">Italian</a>
                              <a class="iq-sub-card" href="#"><img src="images/small/flag-05.png" alt="img-flaf" class="img-fluid mr-2">German</a>
                              <a class="iq-sub-card" href="#"><img src="images/small/flag-06.png" alt="img-flaf" class="img-fluid mr-2">Japanese</a>
                           </div>
                        </li>
                        
                     </ul>
                  </div>
                  <ul class="navbar-list">
                     <li class="line-height">
                        <a href="account-setting.php" class="search-toggle iq-waves-effect d-flex align-items-center">
                           <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTAX_GJNkAGyd9U_JjE86lsJCNZDJi3XANpHSnfeMaDrg&s" class="img-fluid rounded mr-3" alt="user">
                           <div class="caption">
                              <h6 class="mb-0 line-height"><?php echo $name ?></h6>
                              <p class="mb-0"><?php echo $job ?></p>
                           </div>
                        </a>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->
         
         <!-- Page Content  -->
         <?php
            $email = $_SESSION["email"];
            $query = $conn->query("SELECT * FROM `users` WHERE `email`='$email'");
            $result = $query->fetch_assoc();
            //Getting the parameters:
            $id = $result["id"];
            $name = $result["name"];
            $email = $result["email"];
            $password = $result["password"];
            $username = $result["username"];
            $alternateEmail = $result["alternateEmail"];
            $facebook = $result["facebook"];
            $twitter =  $result["twitter"];
            $instagram = $result["instagram"];
            $google = $result["google"];
            $youtube = $result["youtube"];
            $job = $result["job"];

            if(isset($_POST["username"])){
               $username = $_POST["username"];
               $email = $_POST["email"];
               $alternateEmail = $_POST["alternateEmail"];
               $emailOne = $_SESSION["email"];
               $job = $_POST["job"];

               $query = $conn->query("UPDATE `users` SET `username`='$username', `email`='$email', `alternateEmail`='$alternateEmail', `job`='$job' WHERE `email`='$emailOne'");

               if($query){
                  echo `
                     <script>
                        alert("Sizin verilerinizi göüncelledik.");
                        window.location.reload();
                     </script>
                  `;
               }
            }

            if(isset($_POST["facebook"])){
               $email = $_SESSION["email"];
               $facebook = $_POST["facebook"];
               $twitter = $_POST["twitter"];
               $google = $_POST["google"];
               $instagram = $_POST["instagram"];
               $youtube = $_POST["youtube"];

               $query = $conn->query("UPDATE `users` SET `facebook`='$facebook', `twitter`='$twitter', `google`='$google', `instagram`='$instagram', `youtube`='$youtube' WHERE `email`='$email'");

               if($query){
                  echo `
                     <script>
                        alert("Sizin verileriniz güncellendi.");
                        window.location.reload();
                     </script>
                  `;
               }
            }
         ?>
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Hesap Ayarlari</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="acc-edit">
                              <form method="POST" action="account-setting.php">
                                 <div class="form-group">
                                    <label for="uname">Kullanici  İsmi:</label>
                                    <input type="text" class="form-control" id="uname" name="username" value="<?php echo $username ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="altemail">Alternative Email:</label>
                                    <input type="email" class="form-control" id="altemail" name="alternateEmail" value="<?php echo $alternateEmail ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="altemail">İş:</label>
                                    <input type="text" class="form-control" id="job" name="job" value="<?php echo $job ?>">
                                 </div>
                                 <button type="submit" class="btn btn-primary">Gönder</button>
                                 <button type="button" onclick="window.location.reload();" class="btn iq-bg-danger">İptal</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Sosyal Medya</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="acc-edit">
                              <form method="POST" action="account-setting.php">
                                 <div class="form-group">
                                    <label for="facebook">Facebook:</label>
                                    <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $facebook ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="twitter">Twitter:</label>
                                    <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $twitter ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="google">Google +:</label>
                                    <input type="text" class="form-control" name="google" id="google" value="<?php echo $google ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="instagram">Instagram:</label>
                                    <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $instagram ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="youtube">You Tube:</label>
                                    <input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo $youtube ?>">
                                 </div>
                                 <button type="submit" class="btn btn-primary">Gönder</button>
                                 <button type="button" onclick="window.location.reload();" class="btn iq-bg-danger">İptal</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
       <!-- Footer -->
      <footer class="iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.php">Gizlilik Politikası</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.php">Kullanım Şartları</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright <span id="copyright"> 
<script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
</span> <a href="#">SenetAnaliz</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="js/worldLow.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>
<?php
    include("./Inc/database.php");
    include("./Inc/loginAuthentication.php");
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
   <body style="max-height: 100vh; overflow-y:hidden;">
        <!-- Sign in Start -->
        <section class="sign-in-page">
          <div id="container-inside">
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
          </div>
          <?php
            if(isset($_POST["email"])){
                $email = $_POST["email"];
                $password = $_POST["password"];

                $query = $conn->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'");
                $size = mysqli_num_rows($query);

                if($size == 0){
                    echo "
                        <script>
                            alert('Hata yaşandı. Lütfen, tekrar deneyin.);
                        </script>
                    ";
                }
                else{
                    $_SESSION["email"] = $email;
                    $_SESSION["password"] = $password;
                    echo '
                        <script>
                            alert("Başarılı bir şekilde sisteme giriş yapıldı.");
                            window.location.href="index.php";
                        </script>
                    ';
                }
            }
          ?>

            <div class="container p-0" style="max-height: 100vh;">
                <div style="display:flex; justify-content:center; text-align:center;" class="row no-gutters height-self-center">
                  <div class="col-sm-6 align-self-center bg-primary rounded" style="max-height: 100vh;">
                    <div class="row m-0">
                      <div class="col-md-12 bg-white sign-in-page-data">
                          <div class="sign-in-from">
                              <h1 class="mb-0 text-center">Giriş</h1>
                              <p class="text-center text-dark">Yönetici paneline erişmek için e-posta adresinizi ve şifrenizi girin.</p>
                              <form class="mt-4" method="POST" action="sign-in.php">
                                  <div class="form-group">
                                      <label style="float:left;" for="exampleInputEmail1">Email Adresi</label>
                                      <input type="email" name="email" class="form-control mb-0" name="email" id="exampleInputEmail1" placeholder="Email girin">
                                  </div>
                                  <div class="form-group">
                                      <label style="float:left;" for="exampleInputPassword1">Şifre</label>
                                      <input type="password" name="password" class="form-control mb-0" name="password" id="exampleInputPassword1" placeholder="Şifre">
                                  </div>
                                  <div class="d-inline-block w-100">
                                      <div style="float:left;" class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1">Beni Hatırla</label>
                                      </div>
                                  </div>
                                  <div class="sign-info text-center">
                                      <button type="submit" class="btn btn-primary d-block w-100 mb-2">Giriş</button>
                                      <span class="text-dark dark-color d-inline-block line-height-2">Hesabınızmı yok? <a href="sign-up.php">Kayıt ol</a></span>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
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
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
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
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>

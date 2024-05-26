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
   <body>
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
                if(isset($_POST["name"])){
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    //Getting the length:
                    $name_length = strlen($name);
                    $email_length = strlen($email);
                    $password_length = strlen($password);
                    $email_char_check = strpos($email, "@");

                    if($name == ""){
                        echo '
                            <script>
                                alert("İsminiz boş olmamalıdır.");
                            </script>
                        ';
                    }
                    else if($name_length < 5){
                        echo '
                            <script>
                                alert("İsim 5 karakterden daha büyük olmalıdır.");
                            </script>
                        ';
                    }
                    else if($email_char_check == false){
                        echo '
                            <script>
                                alert("Sizin Email Geçerli Değil.");
                            </script>
                        ';
                    }
                    else if($email == ""){
                        echo '
                            <script>
                                alert("Email geçerli değil.");
                            </script>
                        ';
                    }
                    else if($password == ""){
                        echo '
                            <script>
                                alert("Şifre geçerli değil");
                            </script>
                        ';
                    }
                    else if($password_length < 5){
                        echo "
                            <script>
                                alert('Şifrede karakter sayısı 5-den daha fazla olmalıdır.');
                            </script>
                        ";
                    }
                    else if($email_length < 5){
                        echo "
                            <script>
                                alert('Email karakter sayısı 5-den daha fazla olmalıdır.');
                            </script>
                        ";
                    }
                    else{
                        $query = $conn->query("SELECT * FROM `users` WHERE `email`='$email'");
                        $size_query = mysqli_num_rows($query);
                        if($size_query > 0){
                            echo '
                                <script>
                                    alert("Sistemimizde bu mail ile bir kullanıcı var.");
                                </script>
                            ';
                        }
                        else{
                            $query = $conn->query("INSERT INTO `users` (`name`,`email`,`password`) VALUES('$name', '$email', '$password')");

                            if($query){
                                $_SESSION["email"] = $email;
                                $_SESSION["password"] = $password;
                                echo '
                                    <script>
                                        alert("Başarılı bir şekilde kayıt oldunuz.");
                                        window.location.href= "index.php";
                                    </script>
                                ';
                            }
                            else{
                                echo '
                                    <script>
                                        alert("Sunucu hatası var.Lütfen, tekrar deneyin.");
                                    </script>
                                ';
                            }
                        }
                    }
                }
            ?>
            <div class="container p-0">
                <div class="row no-gutters height-self-center" style="display:flex; justify-content:center; align-items:center;">
                  <div class="col-sm-8 align-self-center bg-primary rounded">
                    <div class="row m-0">
                      <div class="col-md-12 bg-white sign-in-page-data">
                          <div class="sign-in-from">
                              <h1 class="mb-0 text-center">Kayıt Ol</h1>
                              <p class="text-center text-dark">Sisteme kayıt olma için bilgileri doldurun.</p>
                              <div class="mt-4" method="POST" id="form" action="sign-up.php">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Sizin Tam İsminiz</label>
                                      <input type="text" id="name" name="name" class="form-control mb-0" id="exampleInputEmail1" placeholder="Tam ismini girin">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail2">Email Adresi</label>
                                      <input type="email" id="email" name="email" class="form-control mb-0" id="exampleInputEmail2" placeholder="Email adresini girin">
                                  </div>
                                  <script>
                                    var emailCodeSent = false;
                                    var code = 0;

                                    // Generate code:
                                    function generateRandomNumber() {
                                        return Math.floor(Math.random() * 9000) + 1000;
                                    }
                                    //Send Email:
                                    function sendEmail(){
                                        let email = document.getElementById("email").value;
                                        let name = document.getElementById("name").value;
                                        code =generateRandomNumber();

                                        if(!email.includes("@")){
                                            alert("Emaıl doğru formatda değil.");
                                        }
                                        else if(email.length < 6){
                                            alert("Email doğru formatda değil.");
                                        }
                                        else{
                                            fetch("https://send-mail-serverless.p.rapidapi.com/send", {
                                                method: "POST",
                                                headers:{
                                                    "Content-Type":"application/json",
                                                    "Accept":"application/json",
                                                    "X-RapidAPI-Key":"80dc3ddabbmsh5cfb60bf3fbbc74p1916b8jsnd9a919b271e2",
                                                    "X-RapidAPI-Host":"send-mail-serverless.p.rapidapi.com"
                                                },
                                                body: JSON.stringify({
                                                    personalizations: [
                                                        {
                                                            to: [
                                                            {
                                                                email: email,
                                                                name: name
                                                            }
                                                            ]
                                                        }
                                                    ],
                                                    from: {
                                                        email: 'senetanaliz@firebese.com',
                                                        name: 'SenetAnaliz'
                                                    },
                                                    subject: 'SenetAna Doğrulama',
                                                    content: [
                                                        {
                                                            type: 'text/html',
                                                            value: 'Merhaba, <br> Sizin sisteme kayit olmak icin kodunuzu asagida belitilmistir. <br><b>'+code+'</b> <br> Tesekkurler sisteme kayit oldugunuz icin. Umariz sizin icin bir deger yaratabiliriz.'
                                                        }
                                                    ],
                                                    headers: {
                                                        'List-Unsubscribe': '<mailto: unsubscribe@firebese.com?subject=unsubscribe>, <https://firebese.com/unsubscribe/id>'
                                                    }
                                                })
                                            }).then((response) => response.json())
                                            .then((response) => {
                                                if(response["message"] == "Accepted"){
                                                    emailCodeSent = true;
                                                    alert("Email gonderilmistir. Lutfen, emailinizi kontrol edin.");
                                                }
                                                else{
                                                    alert("Sunucu hatasi aldik. Lutfen, bir daha emailinizi kontrol edin.");
                                                }
                                            });
                                        }
                                    }
                                    //Function submit:
                                    function submit(){
                                        let name = document.getElementById("name").value;
                                        let email = document.getElementById("email").value;
                                        let password = document.getElementById("password").value;
                                        if(name == ""){
                                            alert("Dogru degil. Lutfen, yeniden doldurun.");
                                        }
                                        else if(email == ""){
                                            alert("Dogru degil. Lutfen, yeniden doldurun.");
                                        }
                                        else if(password == ""){
                                            alert("Dogru degil. Lutfen, yeniden doldurun.");
                                        }
                                        else if(password.length < 6){
                                            alert("Dogru degil. Lutfen, yeniden doldurun.");
                                        }
                                        else if(!email.includes("@")){
                                            alert("Dogru degil. Lutfen, yeniden doldurun.");
                                        }
                                        else{
                                            localStorage.setItem("registerEmail", email);
                                            localStorage.setItem("registerPassword", password);
                                            localStorage.setItem("registerName", name);
                                            window.location.href="sign-up2.php";
                                        }
                                    }
                                  </script>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Şifre</label>
                                      <input type="password" name="password" class="form-control mb-0" id="password" placeholder="Şifre">
                                  </div>
                              </div>
                              <div class="sign-info text-center">
                                      <button type="button" onclick="submit();" class="btn btn-primary d-block w-100 mb-2">Devam</button>
                                      <span class="text-dark d-inline-block line-height-2">Hesabınız varmı ? <a href="sign-in.php">Giriş Yap</a></span>
                                  </div>
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
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
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
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>
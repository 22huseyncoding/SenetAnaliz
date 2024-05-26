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
            <div class="container p-0">
                <div class="row no-gutters height-self-center" style="display:flex; justify-content:center; align-items:center;">
                  <div class="col-sm-8 align-self-center bg-primary rounded">
                    <div class="row m-0">
                      <div class="col-md-12 bg-white sign-in-page-data">
                          <div class="sign-in-from">
                              <h1 class="mb-0 text-center">Kayıt Ol</h1>
                              <p class="text-center text-dark">Emaile doğrulama kodu gönderildi. Lütfen kontrol edin.</p>
                              <form class="mt-4" method="POST" id="form" action="sign-up.php">
                                <input type="hidden" name="email" id="email" />
                                <input type="hidden" name="name" id="name" />
                                <input type="hidden" name="password" id="password" />
                                  <div class="form-group">
                                      <label for="exampleInputEmail2">Emaile Gelen Kod</label>
                                      <input type="number" id="code" name="code" class="form-control mb-0" id="exampleInputEmail2" placeholder="Emaile Gelen Kodu girin">
                                  </div>
                                  <script>
                                    var emailCodeSent = false;
                                    var code = 0;
                                    var email = localStorage.getItem("registerEmail");
                                    var name =localStorage.getItem("registerName");
                                    var password =localStorage.getItem("registerPassword");
                                    document.getElementById("name").value = name;
                                    document.getElementById("email").value =email;
                                    document.getElementById("password").value = password;
                                    sendEmail();
                                    if(email == ""){
                                        alert("Sunucuda hata var. Yeniden deneyin.");
                                        window.location.href="sign-up.php";
                                    }
                                    // Generate code:
                                    function generateRandomNumber() {
                                        return Math.floor(Math.random() * 9000) + 1000;
                                    }
                                    //Send Email:
                                    function sendEmail(){
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
                                                    subject: 'SenetAnaliz Doğrulama',
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
                                        let codeValue =document.getElementById("code").value;
                                        if(emailCodeSent == false){
                                            alert("Email dogrulamasini yapmadan kayit olamazsiniz.");
                                        }
                                        else if(codeValue != code){
                                            alert("Dogrulama kodunuz uyusmuyor.");
                                        }
                                        else{
                                            document.getElementById("form").submit();
                                        }
                                    }
                                  </script>
                              </form>
                              <div class="sign-info text-center">
                                      <button type="button" onclick="submit();" class="btn btn-primary d-block w-100 mb-2">Bitir</button>
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
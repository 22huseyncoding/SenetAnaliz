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
<script>
   function formatNumber(number) {
      const formatter = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 });
      return formatter.format(number);
   }

</script>
<html lang="en">
<style>
   .iq-card{
      padding-left: 15px;
   }
</style>
   <head>
      <?php
           if(isset($_POST["type"])){
            $id = $_POST["id"];
            $email = $_POST["email"];
            $type = $_POST["type"];
            $code = $_POST["code"];


            if($type == "yes"){
               $query = $conn->query("SELECT * FROM `likes` WHERE `user`='$email' AND `stock`='$id'");
               $size = mysqli_num_rows($query);

               if($size > 0){
                  echo '
                     <script>
                        alert("Siz zaten artik bu stoğu favorilerinize eklemişsiniz.");
                        window.location.href="screener2.php?stock='.$code.'";
                     </script>
                  ';
               }
               else{
                  $query = $conn->query("INSERT INTO `likes` (`user`, `stock`) VALUES('$email', '$id');");

                  echo '
                     <script>
                        alert("Favoriler güncellendi.");
                        window.location.href="screener2.php?stock='.$code.'";
                     </script>
                  ';
               }
            }
            else{
               $query = $conn->query("DELETE FROM `likes` WHERE `user`='$email' AND `stock`='$id'");
               $query = $conn->query("SELECT * FROM `stocks` WHERE `id`='$id'");
               $result = $query->fetch_assoc();
               $code = $result["code"];
               echo '
                  <script>
                     alert("Favoriler güncellendi.");
                     window.location.href="screener2.php?stock='.$code.'";
                  </script>
               ';
            }
            
         }
      ?>
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
      <!-- Full calendar -->
      <link href='fullcalendar/core/main.css' rel='stylesheet' />
      <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
      <link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
      <link href='fullcalendar/list/main.css' rel='stylesheet' />

      <!-- Integrating Remix Icons: -->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.min.css" rel="stylesheet">


      <link rel="stylesheet" href="css/flatpickr.min.css">

   </head>
   <body>
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

         <?php
            
            //Checking the stock input:
            $stock = "";
            if(!isset($_GET["stock"])){
               echo "
                  <script>
                     window.location.href='index.php';
                  </script>
               ";
            }
            else{
               $stock = $_GET["stock"];
            }

            $query = $conn->query("SELECT * FROM `stocks` WHERE `code`='$stock'");
            $result = $query->fetch_assoc();
            $stock_id = $result["id"];
            $email = $_SESSION["email"];

            if(isset($_POST["type"])){
               $id = $_POST["id"];
               $email = $_POST["email"];
               $type = $_POST["type"];

               if($type == "yes"){
                  $query = $conn->query("SELECT * FROM `likes` WHERE `user`='$email' AND `stock`='$id'");
                  $size = mysqli_num_rows($query);

                  if($size > 0){
                     echo '
                        <script>
                           alert("You already liked this stock.");
                           window.location.href = "index.php";
                        </script>
                     ';
                  }
                  else{
                     $query = $conn->query("INSERT INTO `likes` (`user`, `stock`) VALUES('$email', '$id');");

                     echo '
                        <script>
                           alert("Successfully updated the form.");
                           window.location.href = "index.php";
                        </script>
                     ';
                  }
               }
               else{
                  $query = $conn->query("DELETE FROM `likes` WHERE `user`='$email' AND `stock`='$id'");
                  echo '
                     <script>
                        alert("Succesffully removed favourite.");
                        window.location.href="index.php";
                     </script>
                  ';
               }
               
            }
         ?>
         
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row"> 
                  <?php
                     $stock = $_GET["stock"];
                     $session_email = $_SESSION["email"];
                     $query2 = $conn->query("SELECT * FROM `stocks` WHERE `code`='$stock'");
                     $result2 = $query2->fetch_assoc();
                     $stock_id = $result2["id"];
                     $query2 = $conn->query("SELECT * FROM `likes` WHERE `user`='$session_email' AND `stock`='$stock_id'");
                     $size2 = mysqli_num_rows($query2);
                     
                     $likeText = "";
                     $likeCode = "yes";
                     if($size2 > 0){
                        $likeCode = "no";
                        $likeText = "Favorilerden Çıkar";
                     }
                     else{
                        $likeCode = "yes";
                        $likeText = "Favorilere Ekle";
                     }

                  ?>
                  <div class="col-lg-12 containerCard" style="margin-top: 10px;">
                     <div class="iq-card" style="padding-bottom: 10px;">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Hisse Seç</h4>
                           </div>
                        </div>
                        <script>
                           <?php
                              $all_codes_string = "";
                              $query = $conn->query("SELECT * FROM `stocks`");
                              while($result = $query -> fetch_assoc()){
                                 $name = $result["name"];
                                 $code = $result["code"];
                                 $all_codes_string .= ",["."'".$code."', '".$code."']";
                              }
                              $all_codes_string = substr($all_codes_string, 1, strlen($all_codes_string));
                              $all_codes_string = "[".$all_codes_string."]";
                           ?>
                           let allCodes = <?php echo $all_codes_string ?>;
                           
                        </script>
                        <div style="width: 90%; margin-left: 5%;">
                           <p style="text-align:left; color: black; margin-top: 10px;">
                              Analizini yapmak istediğiniz hisseyi arayabilirsiniz.
                           </p>
                           <input type="text" class="form-control" id="searchText1" oninput="searchChange();" placeholder="Arama">
                        </div>
                        <ul id="containerSearch" style="overflow-x: scroll; margin-bottom: 0px !important; padding-left: 10px; padding-right: 10px; height: 80px; width: 90%; margin-left: 5%;" class="nav nav-pills mb-3" role="tablist">
                           <?php
                              $query = $conn->query("SELECT * FROM `stocks` LIMIT 8");
                              while($result = $query->fetch_assoc()){
                                 $name = $result["name"];
                                 $code = $result["code"];
                                 echo '
                                    <li  class="nav-item" style="cursor: pointer; height: 40px; margin-left: 10px; border-radius: 10px; margin-top: 15px; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);">
                                       <a class="nav-link" href="screener2.php?stock='.$code.'">'.$code.'</a>
                                    </li>
                                 ';
                              }
                           ?>
                        </ul>
                        <form method="POST" action="screener2.php" class="row" style="display:flex; justify-content:center; align-items:center; margin-top: 0px; margin-bottom: 20px;">
                           <input type="hidden" name="type" value="<?php echo $likeCode ?>" />
                           <input type="hidden" name="id" value="<?php echo $stock_id ?>" />
                           <input type="hidden" name="email" value="<?php echo $email ?>" />
                           <input type="hidden" name="code" value= "<?php echo $code ?>" />
                           <div style="width: 100%; left: 0px; margin-top: 15px; display: flex; justify-content: center; align-items:center;">
                              <button type="submit" class="btn btn-outline-primary mb-3"><?php echo $likeText ?></button>
                           </div>
                        </form>
                        <script>
                           var oldText = document.getElementById("containerSearch").innerHTML;
                           function searchChange(){
                              let value =document.getElementById("searchText1").value;
                              if(value.length > 2){
                                 document.getElementById("containerSearch").innerHTML = "";
                                 let newCodes = allCodes.filter(element => element[0].toLowerCase().includes(value));
                                 console.log(newCodes);
                                 for(let i = 0; i < newCodes.length; i++){
                                    let element = newCodes[i];
                                    document.getElementById("containerSearch").innerHTML += `
                                       <li  class="nav-item" style="cursor: pointer; height: 40px; margin-left: 10px; border-radius: 10px; margin-top: 15px; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);">
                                          <a class="nav-link" href="screener2.php?stock=`+element[1]+`">`+element[0]+`</a>
                                       </li>
                                    `;
                                 }
                              }
                              else if(value.length == 2){
                                 document.getElementById("containerSearch").innerHTML = "";
                                 let newCodes = allCodes.filter(element => element[0].toLowerCase()[0] == value[0] && element[0].toLowerCase()[1] == value[1] );
                                 console.log(newCodes);
                                 for(let i = 0; i < newCodes.length; i++){
                                    let element = newCodes[i];
                                    document.getElementById("containerSearch").innerHTML += `
                                       <li  class="nav-item" style="cursor: pointer; height: 40px; margin-left: 10px; border-radius: 10px; margin-top: 15px; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);">
                                          <a class="nav-link" href="screener2.php?stock=`+element[1]+`">`+element[0]+`</a>
                                       </li>
                                    `;
                                 }
                              }
                              else if(value.length == 1){
                                 document.getElementById("containerSearch").innerHTML = "";
                                 let newCodes = allCodes.filter(element => element[0].toLowerCase()[0] == value[0]);
                                 console.log(newCodes);
                                 for(let i = 0; i < newCodes.length; i++){
                                    let element = newCodes[i];
                                    document.getElementById("containerSearch").innerHTML += `
                                       <li  class="nav-item" style="cursor: pointer; height: 40px; margin-left: 10px; border-radius: 10px; margin-top: 15px; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);">
                                          <a class="nav-link" href="screener2.php?stock=`+element[1]+`">`+element[0]+`</a>
                                       </li>
                                    `;
                                 }
                              }
                              else{
                                 document.getElementById("containerSearch").innerHTML = oldText;
                              }
                           }
                        </script>
                     </div>
                  </div>
                  
                  
                    <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Hisse Hakkında</h4>
                            <p class="card-description">
                              <?php
                                 //Getting the stock information and if not send user to the top:
                                 $query = $conn->query("SELECT * FROM `stocks` WHERE `code`='$stock'");
                                 $size = mysqli_num_rows($query);
                                 if($size == 0){
                                    echo "
                                       <script>
                                          window.location.href='index.php';
                                       </script>
                                    ";
                                 }
                                 else{
                                    $result = $query->fetch_assoc();
                                    $aboutStock = $result["aboutStock"];
                                    echo $aboutStock;
                                 }
                              ?>
                           </p>

                           <script>
                              function tab(number){
                                 let elements = document.getElementsByClassName("menuTabs");
                                 for(let i = 0; i < elements.length; i++){
                                    let element =elements[i];
                                    element.className = "nav-link menuTabs";
                                 }
                                 elements[number].className = "nav-link active menuTabs";
                                 currentTab =document.getElementsByClassName("active")[0].innerHTML.trim();
                                 document.getElementById("container").innerHTML = "";
                                 showList("", "");
                              }
                           </script>

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                 <?php
                                    $query = $conn->query("SELECT * FROM `tabs`");
                                    $number = 0;
                                    while($result = $query->fetch_assoc()){
                                       $name = $result["name"];
                                       if($number == 0){
                                          echo '
                                             <li class="nav-item">
                                                <a class="nav-link active menuTabs" onclick="tab('.$number.');" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                                   '.$name.'
                                                </a>
                                             </li>
                                          ';
                                          $number = $number + 1;
                                       }
                                       else{
                                          echo '
                                             <li class="nav-item">
                                                <a class="nav-link menuTabs" onclick="tab('.$number.');" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                                   '.$name.'
                                                </a>
                                             </li>
                                          ';
                                          $number = $number + 1;
                                       }
                                    }
                                 ?>
                             </ul>
                          </div>
                        </div>

                        

                        <div class="row" id="container">
                        </div>


                        <div class="row col-lg-12">
                     <div class="col-lg-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Favorileriniz</h4>
                              </div>
                              <div class="iq-card-header-toolbar d-flex align-items-center">
                                 <div class="dropdown">
                                    <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                    <i class="ri-more-fill"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                       <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                       <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                       <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                       <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                       <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="iq-card-body">
                              <div class="table-responsive">
                                 <table class="table mb-0" style="overflow-y: scroll;">
                                    <thead class="thead-light">
                                       <tr>
                                          <th>NO</th>
                                          <th>Hisse</th>
                                          <th>Kod</th>
                                          <th>Analiz</th>
                                          <th>Sil</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $email = $_SESSION["email"];
                                          $number_one = 0;
                                          $query = $conn->query("SELECT * FROM `likes` WHERE `user`='$email'");
                                          while($result = $query->fetch_assoc()){
                                             $stockCode = $result["stock"];
                                             $userCode = $result["user"];
                                             $query2 = $conn->query("SELECT * FROM `stocks` WHERE `id`='$stockCode'");
                                             $result = $query2->fetch_assoc();
                                             $id = $result["id"];
                                             $name = $result["name"];
                                             $code = $result["code"];
                                             $sector = $result["sector"];
                                             $number_two = $number_one + 1;
                                             echo "
                                                <tr>
                                                   <td>$number_two</td>
                                                   <td>$name</td>
                                                   <td>$code</td>
                                                   <td>
                                                      <a href='screener2.php?stock=$code' class='btn btn-primary mb-3' style='color: white;'>Analiz</a>
                                                   </td>
                                                   <td>
                                                      <form method='POST' action='screener.php'>
                                                         <input type='hidden' name='type' value='no' />
                                                         <input type='hidden' name='id' value='$stockCode' />
                                                         <input type='hidden' name='email' value='$userCode' />
                                                         <button type='submit' class='btn btn-primary mb-3' style='color: white; background: red;'>Sil</button>
                                                      </form>
                                                   </td>
                                                </tr>
                                             ";
                                             $number_one = $number_one + 1;
                                          }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     </div>

                        <!-- <div class="row" style="display:flex; justify-content:center; align-items:center; margin-top: 20px; margin-bottom: 20px;">
                           <button type="button" class="btn btn-outline-primary mb-3" onclick="moreButton();">Daha Çok</button>
                        </div> -->
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
                  Telif Hakları<span id="copyright"> 
<script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
</span> <a href="#">SOFIXAR LLC</a> Tüm Hakları Korunuyor
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
      <!-- Raphael-min JavaScript -->
      <script src="js/raphael-min.js"></script>
      <!-- Morris JavaScript -->
      <script src="js/morris.js"></script>
      <!-- Morris min JavaScript -->
      <script src="js/morris.min.js"></script>
      <!-- Flatpicker Js -->
      <script src="js/flatpickr.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>

      <script>
         function typeChange(number){
            number =number - 1;
            let number2 = number + 1;
            let element =document.getElementById("type"+number2).value;
            var options = {};
            if(element == "Line Chart"){
               let graph =graphs[number];
               options = {
                  chart: {
                     type: 'line'
                  },
                  series: graph["series"],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     categories: xAxis[number]
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  },
                  dataLabels: {
                     enabled: false,
                     offsetY: -10,
                     style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                     }
                  }
               };

            }
            else if(element == "Line Area Chart"){
               let graph =graphs[number];
               options = {
                  chart: {
                     type: "area"
                  },
                  dataLabels: {
                     enabled: !1
                  },
                  stroke: {
                     curve: "smooth"
                  },
                  
                  series: graph["series"],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     type: "text",
                     categories: xAxis[number]
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  }
               }
            }
            else if(element == "Column Chart"){
               let graph =graphs[number];
               options = {
                  chart: {
                     type: "bar"
                  },
                  plotOptions: {
                     bar: {
                        horizontal: !1,
                        columnWidth: "55%",
                        endingShape: "rounded"
                     }
                  },
                  dataLabels: {
                     enabled: !1
                  },
                  stroke: {
                     show: !0,
                     width: 2,
                     colors: ["transparent"]
                  },
                  series: graph["series"],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     categories: xAxis[number]
                  },
                  fill: {
                     opacity: 1
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  }
               }
            }
            else if(element == "Bar Chart"){
               let graph =graphs[number];
               options = {
                  chart: {
                     type: "bar"
                  },
                  plotOptions: {
                     bar: {
                        horizontal: !0,
                        columnWidth: "55%",
                        endingShape: "rounded"
                     }
                  },
                  dataLabels: {
                     enabled: !1
                  },
                  stroke: {
                     show: !0,
                     width: 2,
                     colors: ["transparent"]
                  },
                  series: graph["series"],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     categories: xAxis[number]
                  },
                  fill: {
                     opacity: 1
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  }
               }
            }
            else if(element == "Mixes Chart"){
               let graph =graphs[number];
               options = {
                  chart: {
                     type: "line",
                     stacked: !1
                  },
                  stroke: {
                     width: [2],
                     curve: "smooth"
                  },
                  plotOptions: {
                     bar: {
                        columnWidth: "50%"
                     }
                  },
                  series: graph["series"],
                  fill: {
                     opacity: [.85],
                     gradient: {
                        inverseColors: !1,
                        shade: "light",
                        type: "vertical",
                        opacityFrom: .85,
                        opacityTo: .55,
                        stops: [0, 100, 100, 100]
                     }
                  },
                  labels: xAxis[number],
                  markers: {
                     size: 0
                  },
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     type: "text"
                  },
                  yaxis: {
                     min: 0,
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  },
                  legend: {
                     labels: {
                        useSeriesColors: !0
                     },
                     markers: {
                        customHTML: [function() {
                           return ""
                        }, function() {
                           return ""
                        }, function() {
                           return ""
                        }]
                     }
                  }
               };
            } 
            setTimeout(function(task){
               charts[number].destroy();
               var chart = new ApexCharts(document.querySelector("#apex"+number2), options);
               charts[number] =chart;
               graphs[number] =options;
               chart.render();
            }, 300);
         }
         function periodChange(number, i ){
            number =number - 1;
            let number2 =number + 1;
            let startPeriod =document.getElementById("startPeriod"+number2).value.trim();
            let endPeriod =document.getElementById("endPeriod"+number2).value.trim();
            charts[number].destroy();
            let graph =graphs[number];
            let datas =JSON.parse(arrayOne[i]["data"]);
            let condition = false;
            let xAxisSample = [];
            let datasSample = [];
            xAxis[number] = [];
            let element =document.getElementById("type"+number2).value;
            for(let i = 0; i < datas.length; i++){
               let date = datas[i][0];
               let point =datas[i][1];

               if(date == startPeriod.trim()){
                  condition = true;
               }
               if(date == endPeriod.trim()){
                  condition = false;
               }

               if(condition == true){
                  xAxisSample.push(date);
                  datasSample.push(point);
               }
            }

            xAxis[number] =xAxisSample;

            var options = {};
            if(element == "Line Chart"){
               options = {
                  chart: {
                     type: 'line'
                  },
                  series: [{
                     name: graph["series"][0]["name"],
                     data:datasSample
                  }],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     categories: xAxisSample
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  },
                  dataLabels: {
                     enabled: false,
                     offsetY: -10,
                     style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                     }
                  }
               };

            }
            else if(element == "Line Area Chart"){
               options = {
                  chart: {
                     type: "area"
                  },
                  dataLabels: {
                     enabled: !1
                  },
                  stroke: {
                     curve: "smooth"
                  },
                  colors: ["#1e3d73"],
                  series: [{
                     name: graph["series"][0]["name"],
                     data: datasSample
                  }],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     type: "text",
                     categories: xAxisSample
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  }
               }
            }
            else if(element == "Column Chart"){
               options = {
                  chart: {
                     type: "bar"
                  },
                  plotOptions: {
                     bar: {
                        horizontal: !1,
                        columnWidth: "55%",
                        endingShape: "rounded"
                     }
                  },
                  dataLabels: {
                     enabled: !1
                  },
                  stroke: {
                     show: !0,
                     width: 2,
                     colors: ["transparent"]
                  },
                  colors: ["#1e3d73"],
                  series: [
                     {
                        name: graph["series"][0]["name"],
                        data: datasSample
                     }
                  ],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     categories:xAxisSample
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  },
                  fill: {
                     opacity: 1
                  }
               }
            }
            else if(element == "Bar Chart"){
               options = {
                  chart: {
                     type: "bar"
                  },
                  plotOptions: {
                     bar: {
                        horizontal: !0,
                        columnWidth: "55%",
                        endingShape: "rounded"
                     }
                  },
                  dataLabels: {
                     enabled: !1
                  },
                  stroke: {
                     show: !0,
                     width: 2,
                     colors: ["transparent"]
                  },
                  colors: ["#1e3d73"],
                  series: [
                     {
                        name: graph["series"][0]["name"],
                        data: datasSample
                     }
                  ],
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     categories: xAxisSample
                  },
                  fill: {
                     opacity: 1
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  }
               }
            }
            else if(element == "Mixes Chart"){
               options = {
                  chart: {
                     type: "line",
                     stacked: !1
                  },
                  stroke: {
                     width: [2],
                     curve: "smooth"
                  },
                  plotOptions: {
                     bar: {
                        columnWidth: "50%"
                     }
                  },
                  colors: ["#fe517e"],
                  series: [{
                     name: graph["series"][0]["name"],
                     type: "column",
                     data: datasSample
                  }],
                  fill: {
                     opacity: [.85],
                     gradient: {
                        inverseColors: !1,
                        shade: "light",
                        type: "vertical",
                        opacityFrom: .85,
                        opacityTo: .55,
                        stops: [0, 100, 100, 100]
                     }
                  },
                  labels: xAxisSample,
                  markers: {
                     size: 0
                  },
                  xaxis: {
                     labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                     type: "text"
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  },
                  legend: {
                     labels: {
                        useSeriesColors: !0
                     },
                     markers: {
                        customHTML: [function() {
                           return ""
                        }, function() {
                           return ""
                        }, function() {
                           return ""
                        }]
                     }
                  }
               };
            } 
            
            setTimeout(function(task){
               var chart = new ApexCharts(document.querySelector("#apex"+number2), options);
               charts[number] =chart;
               graphs[number] =options;
               chart.render();
            }, 500);
         }

         function moreButton(){
            let elements =document.getElementsByClassName("containerCard");
            let size =elements.length;
            let num = 0;
            for(let i = 0; num < size + 6; i++){
               if(arrayOne[i] == null || arrayOne[i] == undefined){
                  break;
               }
               let element =arrayOne[i];
               let title = element["title"];
               let tab =element["tab"];

               if(currentTab == tab){
                  num += 1;
                  if(num > size){
                     let data =JSON.parse(element["data"]);
                     document.getElementById("container").innerHTML += `
                        <div class="col-lg-6 containerCard" style="margin-top: 10px;">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">`+title+`</h4>
                                 </div>
                              </div>
                              <div style="height: 60px; padding-top: 10px; padding-bottom: 10px; width: 90%; margin-left: 5%;">
                                 <div style="float:right; display:flex; height: 60px; justify-content-between: 5px; align-items:center; justify-content:center;">
                                    <p style="margin-top: 0px; margin-bottom: 0px;">Zamanda</p>
                                    <select id="startPeriod`+num+`" class="form-control" style="border: 1px solid #808080; width: 90px; margin-left: 10px;">
                                       <option>Dönem</option>
                                       `+selectText+`
                                    </select>
                                    <p style="margin-top: 0px; margin-left: 10px; margin-bottom: 0px;">Zamana</p>
                                    <select id="endPeriod`+num+`" onchange="periodChange(`+num+`,`+i+`);" class="form-control" style="border: 1px solid #808080; width: 90px; margin-left: 10px;">
                                       <option>Dönem</option>
                                       `+selectText+`
                                    </select>
                                 </div>
                                 <div style="height: 60px; display:flex; justify-content:center; align-items:center; width: 140px;">
                                    <select id="type`+num+`" onchange="typeChange(`+num+`)" class="form-control" style="border: 1px solid #808080; width: 140px;">
                                       <option>Line Chart</option>
                                       <option>Line Area Chart</option>
                                       <option>Column Chart</option>
                                       <option>Bar Chart</option>
                                       <option>Mixes Chart</option>
                                    </select>
                                 </div>
                              </div>
                              <div style="width: 100%; margin-top: 10px;" id="apex`+num+`">

                              </div>
                           </div>
                        </div>
                     `;
                     let some = num;
                     setTimeout(function(Task){
                        let data_array = [parseFloat(data[0][1]), parseFloat(data[1][1]), parseFloat(data[2][1]), parseFloat(data[3][1]), parseFloat(data[4][1]), parseFloat(data[5][1]), parseFloat(data[6][1]), parseFloat(data[7][1]), parseFloat(data[8][1])];
                        xAxis.push([data[0][0], data[1][0], data[2][0], data[3][0], data[4][0], data[5][0], data[6][0], data[7][0], data[8][0]]);
                        var options = {
                           chart: {
                              type: 'line'
                           },
                           series: [{
                              name: title,
                              data:data_array
                           }],
                           xaxis: {
                              labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                              categories: [data[0][0], data[1][0], data[2][0], data[3][0], data[4][0], data[5][0], data[6][0], data[7][0], data[8][0]]
                           },
                           yaxis: {
                              opposite: true,
                              labels: {
                                 formatter: formatNumber,
                              },
                           },
                           dataLabels: {
                              enabled: false,
                              offsetY: -10,
                              style: {
                                 fontSize: '12px',
                                 colors: ["#304758"]
                              }
                           }
                        }
                        graphs.push(options);

                        var chart = new ApexCharts(document.querySelector("#apex"+some), options);
                        charts.push(chart);
                        chart.render();
                     }, 200);
                  }
               }
            }
         }
         function graphChange(number){
            let graphValue = document.getElementById("chartType"+number).value;
            let element =arrayOne[graphValue];
            let title = element["title"];
            let tab =element["tab"];
            let graph = element["graph"];
            let nameOnWeb = element["name"];
            if(graph == ""){
               graph = "line";
            }
            if(nameOnWeb == ""){
               nameOnWeb =title;
            }
            let data =JSON.parse(element["data"]);
            let num = number;
            console.log(document.getElementsByClassName("containerCard")[num]);
            document.getElementsByClassName("containerCard")[num].innerHTML = `
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">`+nameOnWeb+`</h4>
                        </div>
                     </div>
                     <div style="height: 60px; display:flex; justify-content:start; align-items:center; width: 100%;">
                        <select id="type`+num+`" onchange="typeChange(`+num+`)" class="form-control" style="border: 1px solid #808080; width: 140px;">
                           <option>Line Chart</option>
                           <option>Line Area Chart</option>
                           <option>Column Chart</option>
                           <option>Bar Chart</option>
                           <option>Mixes Chart</option>
                        </select>
                        <select id="chartType`+num+`" onchange="graphChange(`+num+`);" class="form-control" style="border:1px solid #808080; width: 90px; margin-left: 10px; ">
                           <option value="-1">Graph Type</option>
                           `+optionString+`
                        </select>
                     </div>
                     <div style="height: 60px; padding-top: 10px; padding-bottom: 10px; width: 90%; margin-left: 0%; margin-bottom: 20px;">
                        <div style="width: 100%; display:flex; height: 60px; justify-content-between: 5px; align-items:center; justify-content:center;">
                           <p style="margin-top: 0px; margin-bottom: 0px;">Zamandan</p>
                           <select id="startPeriod`+num+`" class="form-control startPeriod" style="border: 1px solid #808080; width: 90px; margin-left: 10px;">
                              <option>Dönem</option>
                              `+selectText+`
                           </select>
                           <p style="margin-top: 0px; margin-left: 10px; margin-bottom: 0px;">Zamana</p>
                           <select id="endPeriod`+num+`" onchange="periodChange(`+num+`,`+graphValue+`);" class="form-control endPeriod" style="border: 1px solid #808080; width: 90px; margin-left: 10px;">
                              <option>Dönem</option>
                              `+selectText+`
                           </select>
                        </div>
                     </div>
                     <div style="margin-top: 10px; display:flex; height: 60px; width: 90%; margin-left: 5%;">
                        <div style="height: 100%; display:flex; justify-content:center; align-items:center;">
                           <p>Grafiğin İsmi: </p>
                        </div>
                        <select id='graphName`+num+`' placeholder="Veri Tablosunun Adı" class="form-control grafiginIsmi" style="border: 1px solid #808080; width: 140px; margin-left: 10px;">
                           <option>Grafiğin İsmi</option>
                           `+someTextOne+`
                        </select>
                        <button class="btn btn-primary mb-3" style="color: white; margin-left: 10px;" onclick="addGraph(`+num+`);">Ekle</button>
                        <button class="btn btn-primary mb-3" style="color: white; background: red; margin-left: 10px;" onclick="removeGraph(`+num+`);">Çıkar</button>
                     </div>
                     <div style="width: 100%; margin-top: 10px;" id="apex`+number+`">

                     </div>
                  </div>
            `;
            let some = num;
            setTimeout(function(Task){
               let data_array = [parseFloat(data[0][1]), parseFloat(data[1][1]), parseFloat(data[2][1]), parseFloat(data[3][1]), parseFloat(data[4][1]), parseFloat(data[5][1]), parseFloat(data[6][1]), parseFloat(data[7][1]), parseFloat(data[8][1])];
               xAxis.push([data[0][0], data[1][0], data[2][0], data[3][0], data[4][0], data[5][0], data[6][0], data[7][0], data[8][0]]);
               var options = {
                  chart: {
                     type: graph
                  },
                  series: [{
                     name: title,
                     data:data_array
                  }],
                  xaxis: {
                     labels: {
                        rotate: -90,
                        rotateAlways: true,
                        minHeight: 100
                     },
                     categories: [data[0][0], data[1][0], data[2][0], data[3][0], data[4][0], data[5][0], data[6][0], data[7][0], data[8][0]]
                  },
                  yaxis: {
                     opposite: true,
                     labels: {
                        formatter: formatNumber,
                     },
                  },
                  dataLabels: {
                     enabled: false,
                     offsetY: -10,
                     style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                     }
                  }
               }
               graphs.push(options);
               var chart = new ApexCharts(document.querySelector("#apex"+number), options);
               charts.push(chart);
               chart.render();
            }, 200);
            
   
         
         }
         var someTextOne = "";

         function showClose(number){
            let element1 = document.getElementById("containerDivOne"+number);
            let element2 = document.getElementById("containerDivTwo"+number);
            let element3 = document.getElementById("containerDivThree"+number);

            if(element1.style.display == "none"){
               element1.style.display = "flex";
               element2.style.display = "flex";
               element3.style.display = "flex";
            }
            else{
               element1.style.display = "none";
               element2.style.display = "none";
               element3.style.display = "none";
            }
         }

         function showList(startPeriod, endPeriod){
            someTextOne = "";
            for(let i = 0; i <arrayOne.length; i++){
               let element = arrayOne[i];
               if(element["tab"] == currentTab){
                  someTextOne += `
                     <option>`+element["title"]+`</option>
                  `;
               }
            }

            if(startPeriod == "" || endPeriod == ""){
               let num = 0;
               xAxis = [];
               graphs = [];
               charts = [];
               for(let i = 0; num < 6; i++){
                  let element =arrayOne[i];
                  let title = element["title"];
                  let tab =element["tab"];
                  let graph = element["graph"];
                  let nameOnWeb = element["name"];
                  if(graph == ""){
                     graph = "line";
                  }
                  if(nameOnWeb == ""){
                     nameOnWeb =title;
                  }
                  let data =JSON.parse(element["data"]);

                  if(currentTab == tab){
                     num = num + 1;
                     document.getElementById("container").innerHTML += `
                        <div class="col-lg-6 containerCard" style="margin-top: 10px;">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">`+nameOnWeb+`</h4>
                                    <button onclick="showClose(`+num+`);" class="btn btn-primary mb-3" style="position: absolute; right: 20px; top: 10px;">Open / Close</button>
                                 </div>
                              </div>
                              <div id="containerDivOne`+num+`" style=" height: 60px; display:flex; justify-content:start; align-items:center; width: 100%;display: none;">
                                 <select id="type`+num+`" onchange="typeChange(`+num+`)" class="form-control" style="border: 1px solid #808080; width: 140px;">
                                    <option>Line Chart</option>
                                    <option>Line Area Chart</option>
                                    <option>Column Chart</option>
                                    <option>Bar Chart</option>
                                    <option>Mixes Chart</option>
                                 </select>
                                 <select id="chartType`+num+`" onchange="graphChange(`+num+`);" class="form-control" style="border:1px solid #808080; width: 90px; margin-left: 10px; ">
                                    <option value="-1">Graph Type</option>
                                    `+optionString+`
                                 </select>
                              </div>
                              <div id="containerDivTwo`+num+`" style="height: 60px; padding-top: 10px; padding-bottom: 10px; width: 90%; margin-left: 0%; margin-bottom: 20px; display: none;">
                                 <div style="width: 100%; display:flex; height: 60px; justify-content-between: 5px; align-items:center; justify-content:center;">
                                    <p style="margin-top: 0px; margin-bottom: 0px;">Zamandan</p>
                                    <select id="startPeriod`+num+`" class="form-control startPeriod" style="border: 1px solid #808080; width: 90px; margin-left: 10px;">
                                       <option>Dönem</option>
                                       `+selectText+`
                                    </select>
                                    <p style="margin-top: 0px; margin-left: 10px; margin-bottom: 0px;">Zamana</p>
                                    <select id="endPeriod`+num+`" onchange="periodChange(`+num+`,`+i+`);" class="form-control endPeriod" style="border: 1px solid #808080; width: 90px; margin-left: 10px;">
                                       <option>Dönem</option>
                                       `+selectText+`
                                    </select>
                                 </div>
                              </div>
                              <div id="containerDivThree`+num+`" style="margin-top: 10px; display:flex; height: 60px; width: 90%; margin-left: 5%;display: none;">
                                 <div style="height: 100%; display:flex; justify-content:center; align-items:center;">
                                    <p>Grafiğin İsmi: </p>
                                 </div>
                                 <select id='graphName`+num+`' placeholder="Veri Tablosunun Adı" class="form-control grafiginIsmi" style="border: 1px solid #808080; width: 140px; margin-left: 10px;">
                                    <option>Grafiğin İsmi</option>
                                    `+someTextOne+`
                                 </select>
                                 <button class="btn btn-primary mb-3" style="color: white; margin-left: 10px;" onclick="addGraph(`+num+`);">Ekle</button>
                                 <button class="btn btn-primary mb-3" style="color: white; background: red; margin-left: 10px;" onclick="removeGraph(`+num+`);">Çıkar</button>
                              </div>
                              <div style="width: 100%; margin-top: 10px;" id="apex`+num+`">

                              </div>
                           </div>
                        </div>
                     `;
                     let some = num;
                     setTimeout(function(Task){
                        let data_array = [parseFloat(data[0][1]), parseFloat(data[1][1]), parseFloat(data[2][1]), parseFloat(data[3][1]), parseFloat(data[4][1]), parseFloat(data[5][1]), parseFloat(data[6][1]), parseFloat(data[7][1]), parseFloat(data[8][1])];
                        xAxis.push([data[0][0], data[1][0], data[2][0], data[3][0], data[4][0], data[5][0], data[6][0], data[7][0], data[8][0]]);
                        var options = {
                           chart: {
                              type: graph
                           },
                           series: [{
                              name: title,
                              data:data_array
                           }],
                           xaxis: {
                              labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                              categories: [data[0][0], data[1][0], data[2][0], data[3][0], data[4][0], data[5][0], data[6][0], data[7][0], data[8][0]]
                           },
                           yaxis: {
                              opposite: true,
                              labels: {
                                 formatter: formatNumber,
                              },
                           },
                           dataLabels: {
                              enabled: false,
                              offsetY: -10,
                              style: {
                                 fontSize: '12px',
                                 colors: ["#304758"]
                              }
                           },
                           plotOptions: {
                              bar: {
                                 dataLabels: {
                                    enabled: false
                                 }
                              }
                           },
                        }
                        graphs.push(options);
                        var chart = new ApexCharts(document.querySelector("#apex"+some), options);
                        charts.push(chart);
                        chart.render();
                     }, 200);
                  }
               
               }
            }
         }

         function addGraph(index){
            let graph =graphs[index - 1];
            let chart =charts[index - 1];
            let graphName =document.getElementById("graphName"+index).value;
            let len = graph["series"][0]["data"].length;
            let someArray = arrayOne.filter(element => element["tab"] == currentTab && element["title"] == graphName);
            console.log(someArray);
            let someData =JSON.parse(someArray[0]["data"]);
            console.log(someData);
            let condition = false;
            let datasSample = [];
            let datas =someData;
            let startPeriod = document.getElementsByClassName("startPeriod")[index-1].value;
            let endPeriod =document.getElementsByClassName("endPeriod")[index-1].value;
            if(startPeriod == "Dönem"){
               endPeriod = datas[9][0];
               startPeriod = datas[0][0];
            }
            console.log("Start: " + startPeriod);
            console.log("End: " + endPeriod);
            for(let i = 0; i < datas.length; i++){
               let date = datas[i][0];
               let point =datas[i][1];

               if(date == startPeriod.trim()){
                  condition = true;
               }
               if(date == endPeriod.trim()){
                  condition = false;
               }

               if(condition == true){
                  datasSample.push(point);
               }
            }
            console.log(datasSample);
            graph["series"].push({
               name:graphName,
               data:datasSample
            });
            chart.destroy();
            setTimeout(function(task){
               let index2 = index+ 1;
               var chart = new ApexCharts(document.querySelector("#apex"+index), graph);
               chart.render();
            }, 400);
            /*console.log(graph);
            for(let i = 0; i < graphs.length; i++){
               let title =graphs[i]["series"][0]["name"];
               if(title == graphName){
                  console.log(graphs[0]);
                  let datas =graphs[i]["series"][0]["data"];
                  graph["series"].push({
                     name:title,
                     data:datas
                  });
                  chart.destroy();
                  setTimeout(function(task){
                     let index2 = index+ 1;
                     console.log(JSON.stringify(graph));
                     var chart = new ApexCharts(document.querySelector("#apex"+index), graph);
                     chart.render();
                  }, 400);
                  break;
               }
            }*/
         }
         function removeGraph(index){
            let graph =graphs[index - 1];
            let chart =charts[index - 1];
            let graphName =document.getElementById("graphName"+index).value;
            for(let i = 0; i < graphs.length; i++){
               let title =graphs[i]["series"][0]["name"];
               if(title == graphName){
                  console.log(graphs[0]);
                  let datas =graphs[i]["series"][0]["data"];
                  graph["series"] =graph["series"].slice(0, graph["series"].length - 1);
                  chart.destroy();
                  setTimeout(function(task){
                     let index2 = index+ 1;
                     console.log(JSON.stringify(graph));
                     var chart = new ApexCharts(document.querySelector("#apex"+index), graph);
                     chart.render();
                  }, 400);
                  break;
               }
            }
         }

         <?php
            $query = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$stock' ORDER BY `sira` ASC");
            echo "var arrayOne = [";
            $number=  0;
            while($result = $query->fetch_assoc()){
               $name = $result["name"];
               $datas = $result["datas"];
               $tab = $result["tab"];
               $nameOnWeb = $result["nameOnWeb"];
               $graph = $result["graph"];
               // Decode the JSON string into an array
               $array = json_decode($datas);

               // Reverse the array
               $reversed_array = array_reverse($array);

               // Encode the reversed array back into a JSON string
               $reversed_string = json_encode($reversed_array);
               $number = $number + 1;
               if($number == 1){
                  echo "{ 
                     'title': '".$name."',
                     'tab': '".$tab."', 
                     'data': '".$reversed_string."',
                     'name': '".$nameOnWeb."',
                     'graph': '".$graph."'
                  }";  
               }
               else{
                  echo ",{ 
                     'title': '".$name."', 
                     'tab': '".$tab."',
                     'data': '".$reversed_string."',
                     'name': '".$nameOnWeb."',
                     'graph': '".$graph."'
                  }";
               }
            }
            echo "];";
         ?>
         let selectText = "";
         let elementArray = JSON.parse(arrayOne[0]["data"]);
         for(let i = 0; i < elementArray.length; i++){
            let period =elementArray[i][0];
            selectText += "<option>"+period+"</option>";
         }

         let optionString = "";
         for(let i = 0; i < arrayOne.length; i++){
            let element =arrayOne[i]["name"];
            if(element == ""){
               element =arrayOne[i]["title"];
            }
            optionString =optionString + "<option value='"+i+"'>"+element+"</option>";
         }

         let currentTab = document.getElementsByClassName("menuTabs")[0].innerHTML;
         currentTab =currentTab.trim();
         var graphs = [];
         var charts = [];
         var xAxis = [];
         showList("", "");
      </script>
   </body>
</html>
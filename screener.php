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
   <?php
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
                        alert("Siz zaten artik bu stoğu favorilerinize eklemişsiniz.");
                        window.location.href = "screener.php";
                     </script>
                  ';
               }
               else{
                  $query = $conn->query("INSERT INTO `likes` (`user`, `stock`) VALUES('$email', '$id');");

                  echo '
                     <script>
                        alert("Favoriler güncellendi.");
                        window.location.href = "screener.php";
                     </script>
                  ';
               }
            }
            else{
               $query = $conn->query("DELETE FROM `likes` WHERE `user`='$email' AND `stock`='$id'");
               echo '
                  <script>
                     alert("Favoriler güncellendi.");
                     window.location.href="screener.php";
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

      <link rel="stylesheet" href="css/flatpickr.min.css">

      <!-- Integrating Remix Icons: -->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.min.css" rel="stylesheet">

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
            $query = $conn->query("SELECT * FROM `filters`");
            $filters = "";
            while($result = $query->fetch_assoc()){
               $filters .= ",".$result["texts"];
            }
            $filters = substr($filters, 1, strlen($filters));
         ?>
         <script>
           let filters = "<?php echo $filters ?>";
           filters =filters.split(",");
         </script>

         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="iq-card" style="width: 100%;">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Hisse Tarama</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p>
                           Buradan aradığınız özelliklerdeki hisseleri bulabilirsiniz.
                           </p>
                           <div class="row" id="filterContainer">
                              <input type="hidden" id="filterLength" />
                           </div>
                           <div style="width: 100%; display:flex; justify-content:center; align-items:center; margin-top: 20px;">
                              <div style="width: 18%; margin-left: 1%; margin-right: 1%; min-width: 200px; margin-top: 5px;">
                                 <button onclick="filter();" class="btn mb-3 btn-primary" style="width: 100%; padding-top: 10px; padding-bottom: 10px;">
                                       Filtrele
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <script>
                        document.getElementById("filterLength").value =filters.length;
                        for(let i = 0; i < filters.length; i++){
                           let element =filters[i];
                           document.getElementById("filterContainer").innerHTML += `
                              <div style="width: 18%; min-width: 200px; margin-left: 1%; margin-right: 1%; margin-top: 5px;">
                                 <div style="width: 100%; min-width: 200px;  margin-top: 0px;">
                                    <input type="text" class="form-control" placeholder="Min `+element+`" id="minType`+i+`" />
                                 </div>
                                 <div style="width: 100%; min-width: 200px;  margin-top: 10px;">
                                    <input type="text" class="form-control" placeholder="Max `+element+`" id="maxType`+i+`" />
                                 </div>
                              </div>
                           `;
                        }
                     </script>

                     <div class="col-sm-12">
                        <div class="iq-card">
                           <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Hisseler</h4>
                              </div>
                           </div>
                           <div class="iq-card-body">
                              <p>
                                 Hisse senedine ilişkin detaylı bilgilerin yer aldığı bu tablo üzerinden hisse senedi listesini görebilirsiniz. Hisse senedi hakkında daha detaylı bilgi almak istiyorsanız, lütfen hisse senedi adına tıklayın.
                              </p>
                              <div class="table-responsive">
                                 <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>NO</th>
                                          <th>Hisse</th>
                                          <th>Kod</th>
                                          <?php
                                             $filter_word = "";
                                             $query = $conn->query("SELECT * FROM `filters`");
                                             $result = $query->fetch_assoc();
                                             $word_one = $result["type"];
                                             $filter_word = explode(",", $word_one);
                                             for($i = 0; $i < sizeof($filter_word); $i++){
                                                $element = $filter_word[$i];
                                                echo "
                                                   <th id='thead$i' onclick='sortFunc($i, 0)'>
                                                      ".$element."
                                                   </th>
                                                ";
                                             }
                                          ?>
                                          <th>Analiz</th>
                                       </tr>
                                    </thead>
                                    <script>
                                       function sortByLargerToSmaller(products, index) {
                                          //Larger to smaller:
                                          return products.sort((a,b) => b[6] - a[6]);
                                       }
                                       function sortBySmallerToLarger(products, index){
                                          return products.sort((a, b) => a[6] - b[6]);
                                       }
                                       function sortFunc(number1, number2){
                                          let secondProducts =allProducts;
                                          let index =number1 + 1 + 4;
                                          if(number2 == 0){
                                             const sortedData = sortBySmallerToLarger(secondProducts, index);
                                             let container =document.getElementById("container");
                                             container.innerHTML = "";
                                             for(let i = 0; i < sortedData.length; i++){
                                                let element =sortedData[i];
                                                let textOne = "";
                                                for(let j = 5; j < element.length; j++){
                                                   textOne += "<td>"+element[j]+"</td>";
                                                }
                                                container.innerHTML += `
                                                   <tr>
                                                      <td>`+element[0]+`</td>
                                                      <td>`+element[1]+`</td>
                                                      <td>`+element[2]+`</td>
                                                      <td>`+element[3]+`</td>
                                                      `+textOne+`
                                                      <td><button type="button" onclick="window.location.href='screener2.php?stock=`+element[2]+`';" class="btn btn-primary mb-3">Analiz</button></td>
                                                   </tr>
                                                `;
                                             }
                                             document.getElementById("thead"+number1).onclick = function (){
                                                sortFunc(number1, 1)
                                             };
                                          }
                                          else{
                                             const sortedData = sortByLargerToSmaller(secondProducts, index);
                                             let container =document.getElementById("container");
                                             container.innerHTML = "";
                                             for(let i = 0; i < sortedData.length; i++){
                                                let element =sortedData[i];
                                                let textOne = "";
                                                for(let j = 5; j < element.length; j++){
                                                   textOne += "<td>"+element[j]+"</td>";
                                                }
                                                container.innerHTML += `
                                                   <tr>
                                                      <td>`+element[0]+`</td>
                                                      <td>`+element[1]+`</td>
                                                      <td>`+element[2]+`</td>
                                                      <td>`+element[3]+`</td>
                                                      `+textOne+`
                                                      <td><button type="button" onclick="window.location.href='screener2.php?stock=`+element[2]+`';" class="btn btn-primary mb-3">Analiz</button></td>
                                                   </tr>
                                                `;
                                             }
                                             document.getElementById("thead"+number1).onclick = function(){
                                                sortFunc(number1, 0)
                                             };
                                          }
                                       }
                                    </script>
                                    <tbody id="container">
                                       <?php
                                          $word = "[";
                                          $query = $conn->query("SELECT * FROM `stocks`");
                                          $number_three = 0;
                                          while($result = $query->fetch_assoc()){
                                             $id = $result["id"];
                                             $name = $result["name"];
                                             $code = $result["code"];
                                             $sector = $result["sector"];
                                             $types = $result["types"];
                                             $types = substr($types,1, strlen($types));

                                             $types_code = "";
                                             $types_array_string = "";
                                             $types_array = explode(",", $types);
                                             for($i = 0; $i < sizeof($types_array); $i++){
                                                $element1 = $types_array[$i];
                                                $element = number_format($element1, 2);
                                                $types_array_string = $types_array_string.",".$element;
                                                $types_code .= "<td>$element</td>";
                                             }
                                             $word = $word.",['".$id."', '".$name."', '$code', '$sector', '".$types."' ".$types_array_string."]";
                                             $number_three = $number_three + 1;
                                             echo "
                                                <tr>
                                                   <td>$number_three</td>
                                                   <td>$name</td>
                                                   <td>$code</td>
                                                   $types_code
                                                   <td>
                                                      <a type='button' class='btn btn-primary mb-3' href='screener2.php?stock=".$code."'>Analiz</a>
                                                   </td>
                                                </tr>
                                             ";
                                          }
                                          $word = $word."]";
                                          $word = substr($word, 2, strlen($word));
                                          $word =  "[".$word;
                                       ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th>NO</th>
                                          <th>Hisse</th>
                                          <th>Kod</th>
                                          <?php
                                             for($i = 0; $i < sizeof($filter_word); $i++){
                                                $element = $filter_word[$i];
                                                echo "
                                                   <th>
                                                      ".$element."
                                                   </th>
                                                ";
                                             }
                                          ?>
                                          <th>Analiz</th>
                                       </tr>
                                    </tfoot>
                                 </table>
                              </div>
                              <script>
                                 var allProducts = <?php echo $word ?>;
                                 
                                 function filter(){
                                    let stockName ="";
                                    let container =document.getElementById("container");

                                    let secondProducts =allProducts;

                                    if(stockName != ""){
                                       secondProducts = secondProducts.filter(subArray => subArray[1].includes(stockName));
                                    }
                                    for(let i = 0; i < document.getElementById("filterLength").value; i++){
                                       let minType =document.getElementById("minType"+i).value;
                                       let maxType =document.getElementById("maxType"+i).value;
                                       
                                       if(minType != ""){
                                          secondProducts =secondProducts.filter(subArray => parseFloat(subArray[4].split(",")[i+1]) > minType);
                                       }
                                       if(maxType != ""){
                                          secondProducts =secondProducts.filter(subArray => parseFloat(subArray[4].split(",")[i+1]) < maxType);
                                       }
                                    }

                                    if(secondProducts.length == 0){
                                       let textOne = "";
                                       let word_one = "<tr>";
                                       for(let i = 0; i < allProducts[0].length - 1; i++){
                                          word_one = word_one + `
                                             <td>
                                                Veri Yok
                                             </td>
                                          `;
                                       }
                                       word_one =word_one + "</tr>";
                                       container.innerHTML = word_one;
                                    }
                                    else{
                                       container.innerHTML = "";
                                       for(let i = 0; i < secondProducts.length; i++){
                                          let element =secondProducts[i];
                                          let textOne = "";
                                          for(let j = 5; j < element.length; j++){
                                             textOne += "<td>"+element[j]+"</td>";
                                          }
                                          let j = i + 1;
                                          container.innerHTML += `
                                             <tr>
                                                <td>`+j+`</td>
                                                <td>`+element[1]+`</td>
                                                <td>`+element[2]+`</td>
                                                `+textOne+`
                                                <td><button type="button" onclick="window.location.href='screener2.php?stock=`+element[2]+`';" class="btn btn-primary mb-3">Analiz</button></td>
                                             </tr>
                                          `;
                                       }
                                    }
                                 }
                              </script>
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
   </body>
</html>
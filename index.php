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
<style>
   .iq-card{
      padding-left: 15px;
   }
</style>
<script>
   function formatNumber(number) {
      const formatter = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 });
      return formatter.format(number);
   }

</script>
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
                        alert("Siz zaten artık bu stoku favorilerinize eklemişsiniz.");
                        window.location.href = "index.php";
                     </script>
                  ';
               }
               else{
                  $query = $conn->query("INSERT INTO `likes` (`user`, `stock`) VALUES('$email', '$id');");

                  echo '
                     <script>
                        alert("Favorilere eklendi.");
                        window.location.href = "index.php";
                     </script>
                  ';
               }
            }
            else{
               $query = $conn->query("DELETE FROM `likes` WHERE `user`='$email' AND `stock`='$id'");
               echo '
                  <script>
                     alert("Favorilerden çıkarıldı.");
                     window.location.href="index.php";
                  </script>
               ';
            }
            
         }
      ?>
      <script src="js/apexcharts.js"></script>
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

      <style>
         .vertical-labels {
            transform: rotate(-90deg);
         }
      </style>

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
         
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">

               <?php
                  $favourite1_name = "";
                  $favourite2_name = "";
                  $favourite3_name = "";
                  $favourite4_name = "";
                  $favourite5_name = "";
               ?>
               <div class="col-lg-12 containerCard" style="margin-top: 10px;">
                  <div class="iq-card" style="padding-bottom: 20px;">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Stok Arama</h4>
                        </div>
                     </div>
                     <script>
                        <?php
                           $all_codes_string = "";
                           $query = $conn->query("SELECT * FROM `stocks`");
                           while($result = $query -> fetch_assoc()){
                              $stock_id = $result["id"];
                              $name = $result["name"];
                              $code = $result["code"];
                              $all_codes_string .= ",["."'".$code."', '".$code."', '".$stock_id."']";
                           }
                           $all_codes_string = substr($all_codes_string, 1, strlen($all_codes_string));
                           $all_codes_string = "[".$all_codes_string."]";
                        ?>
                        let allCodes = <?php echo $all_codes_string ?>;
                        
                     </script>
                     <div style="width: 90%; margin-left: 5%;">
                        <p style="text-align:left; color: black; margin-top: 10px;">
                           Burada arama yapabilir ve istediginiz stoka gide bilirsiniz.
                        </p>
                        <input type="text" class="form-control" id="searchText1" oninput="searchChange();" placeholder="Arama">
                     </div>
                     <ul id="containerSearch" style="overflow-x: scroll; margin-bottom: 0px !important; padding-left: 10px; padding-right: 10px; height: 80px; width: 90%; margin-left: 5%;" class="nav nav-pills mb-3" role="tablist">
                        <?php
                           $query = $conn->query("SELECT * FROM `stocks` LIMIT 8");
                           while($result = $query->fetch_assoc()){
                              $name = $result["name"];
                              $code = $result["code"];
                              $stock_id = $result["id"];
                              echo '
                                 <li  class="nav-item" style="cursor: pointer; height: 40px; margin-left: 10px; border-radius: 10px; margin-top: 15px; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);">
                                    <a class="nav-link" href="index.php?stock='.$stock_id.'">'.$code.'</a>
                                 </li>
                              ';
                           }
                        ?>
                     </ul>
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
                                       <a class="nav-link" href="index.php?stock=`+element[2]+`">`+element[0]+`</a>
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
                                       <a class="nav-link" href="index.php?stock=`+element[2]+`">`+element[0]+`</a>
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
                                       <a class="nav-link" href="index.php?stock=`+element[2]+`">`+element[0]+`</a>
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

               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="card-title">Hisse Hakkında</h4>
                        <p class="card-description" id="stockAbout">
                        </p>
                     </div>
                  </div>
               </div>
               
                  <?php
                     $fav1_data = "";
                     $fav2_data = "";
                     $fav3_data = "";
                     $fav4_data = "";
                     $fav5_data = "";
                     $fav1_tab = "";
                     $fav2_tab = "";
                     $fav3_tab = "";
                     $fav4_tab = "";
                     $fav5_tab = "";
                     $fav1_name = "";
                     $fav2_name = "";
                     $fav3_name = "";
                     $fav4_name = "";
                     $fav5_name = "";
                     $fav_number = 0;
                     $fav1_style = "";
                     $fav2_style = "";
                     $fav3_style = "";
                     $fav4_style = "";
                     $fav5_style = "";
                     $stock_about = "";
                     $query = $conn->query("SELECT * FROM `favourites`");
                     while($result = $query->fetch_assoc()){
                        $fav_number = $fav_number + 1;
                        $tab = $result["tab"];
                        $data = $result["data"];
                        if($fav_number == 1){
                           $fav1_tab = $tab;
                           $fav1_name = $data;
                        }
                        else if($fav_number == 2){
                           $fav2_tab = $tab;
                           $fav2_name = $data;
                        }
                        else if($fav_number == 3){
                           $fav3_tab = $tab;
                           $fav3_name = $data;
                        }
                        else if($fav_number == 4){
                           $fav4_tab = $tab;
                           $fav4_name = $data;
                        }
                        else{
                           $fav5_tab = $tab;
                           $fav5_name = $data;
                        }
                     }
                     $email_stored = $_SESSION["email"];
                     $fav_titles = "";
                     $stock = "";
                     if(isset($_GET["stock"])){
                        $stock_id = $_GET["stock"];
                        $query2 = $conn->query("SELECT * FROM `stocks` WHERE `id`='$stock_id'");
                        $result2 = $query2->fetch_assoc();
                        $stock_name = $result2["code"];
                        $stock_about = $result2["aboutStock"];
                        $code = $result2["code"];
                        $fav_titles .= ",'".$code."'";
                        $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav1_tab' AND `name`='$fav1_name' ORDER BY `sira` ASC");
                        $result3 = $query3->fetch_assoc();
                        $datas = $result3["datas"];
                        $fav1_data .= ",".$datas; 
                        if($result3["nameOnWeb"] == ""){
                           $favourite1_name = $fav1_tab."-".$fav1_name."-".$stock_name;
                        }
                        else{
                           $favourite1_name = $result3["nameOnWeb"];
                        }
                        $fav1_style = $result3["graph"];
                        $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav2_tab' AND `name`='$fav2_name' ORDER BY `sira` ASC");
                        $result3 = $query3->fetch_assoc();
                        $datas = $result3["datas"];
                        $fav2_data .= ",".$datas;
                        if($result3["nameOnWeb"] == ""){
                           $favourite2_name = $fav2_tab."-".$fav2_name."-".$stock_name;
                        }
                        else{
                           $favourite2_name = $result3["nameOnWeb"];
                        }
                        $fav2_style = $result3["graph"];
                        $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav3_tab' AND `name`='$fav3_name' ORDER BY `sira` ASC");
                        $result3 = $query3->fetch_assoc();
                        $datas = $result3["datas"];
                        $fav3_data .= ",".$datas;
                        if($result3["nameOnWeb"] == ""){
                           $favourite3_name = $fav3_tab."-".$fav3_name."-".$stock_name;
                        }
                        else{
                           $favourite3_name = $result3["nameOnWeb"];
                        }
                        $fav3_style = $result3["graph"];
                        $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav4_tab' AND `name`='$fav4_name' ORDER BY `sira` ASC");
                        $result3 = $query3->fetch_assoc();
                        $datas = $result3["datas"];
                        $fav4_data .= ",".$datas;
                        if($result3["nameOnWeb"] == ""){
                           $favourite4_name = $fav4_tab."-".$fav4_name."-".$stock_name;
                        }
                        else{
                           $favourite4_name = $result3["nameOnWeb"];
                        }
                        $fav4_style = $result3["graph"];
                        $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav5_tab' AND `name`='$fav5_name' ORDER BY `sira` ASC");
                        $result3 = $query3->fetch_assoc();
                        $datas = $result3["datas"];
                        $fav5_data .= ",".$datas;
                        if($result3["nameOnWeb"] == ""){
                           $favourite5_name = $fav5_tab."-".$fav5_name."-".$stock_name;
                        }
                        else{
                           $favourite5_name = $result3["nameOnWeb"];
                        }
                        $fav5_style = $result3["graph"];
                     }
                     else{
                        $query = $conn->query("SELECT * FROM `likes` WHERE `user`='$email_stored'");
                        if(mysqli_num_rows($query) == 0){
                           $stock_id = 1;
                           $query2 = $conn->query("SELECT * FROM `stocks` WHERE `id`='$stock_id'");
                           $result2 = $query2->fetch_assoc();
                           $code = $result2["code"];
                           $fav_titles .= ",'".$code."'";
                           $stock_name = $result2["code"];
                           $stock_about = $result2["aboutStock"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav1_tab' AND `name`='$fav1_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav1_data .= ",".$datas; 
                           if($result3["nameOnWeb"] == ""){
                              $favourite1_name = $fav1_tab."-".$fav1_name."-".$stock_name;
                           }
                           else{
                              $favourite1_name = $result3["nameOnWeb"];
                           }
                           $fav1_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav2_tab' AND `name`='$fav2_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav2_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite2_name = $fav2_tab."-".$fav2_name."-".$stock_name;
                           }
                           else{
                              $favourite2_name = $result3["nameOnWeb"];
                           }
                           $fav2_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav3_tab' AND `name`='$fav3_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav3_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite3_name = $fav3_tab."-".$fav3_name."-".$stock_name;
                           }
                           else{
                              $favourite3_name = $result3["nameOnWeb"];
                           }
                           $fav3_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav4_tab' AND `name`='$fav4_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav4_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite4_name = $fav4_tab."-".$fav4_name."-".$stock_name;
                           }
                           else{
                              $favourite4_name = $result3["nameOnWeb"];
                           }
                           $fav4_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav5_tab' AND `name`='$fav5_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav5_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite5_name = $fav5_tab."-".$fav5_name."-".$stock_name;
                           }
                           else{
                              $favourite5_name = $result3["nameOnWeb"];
                           }
                           $fav5_style = $result3["graph"];
                        }
                        while($result = $query->fetch_assoc()){
                           $stock_id = $result["stock"];
                           $query2 = $conn->query("SELECT * FROM `stocks` WHERE `id`='$stock_id'");
                           $result2 = $query2->fetch_assoc();
                           $code = $result2["code"];
                           $fav_titles .= ",'".$code."'";
                           $stock_name = $result2["code"];
                           $stock_about = $result2["aboutStock"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav1_tab' AND `name`='$fav1_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav1_data .= ",".$datas; 
                           if($result3["nameOnWeb"] == ""){
                              $favourite1_name = $fav1_tab."-".$fav1_name."-".$stock_name;
                           }
                           else{
                              $favourite1_name = $result3["nameOnWeb"];
                           }
                           $fav1_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav2_tab' AND `name`='$fav2_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav2_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite2_name = $fav2_tab."-".$fav2_name."-".$stock_name;
                           }
                           else{
                              $favourite2_name = $result3["nameOnWeb"];
                           }
                           $fav2_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav3_tab' AND `name`='$fav3_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav3_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite3_name = $fav3_tab."-".$fav3_name."-".$stock_name;
                           }
                           else{
                              $favourite3_name = $result3["nameOnWeb"];
                           }
                           $fav3_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav4_tab' AND `name`='$fav4_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav4_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite4_name = $fav4_tab."-".$fav4_name."-".$stock_name;
                           }
                           else{
                              $favourite4_name = $result3["nameOnWeb"];
                           }
                           $fav4_style = $result3["graph"];
                           $query3 = $conn->query("SELECT `datas`.*,
            CASE WHEN `datafiltreler`.`sira` IS NULL THEN 1000 ELSE `datafiltreler`.`sira` END AS `sira`,
             CASE WHEN `datafiltreler`.`nameOnWeb` IS NULL THEN '' ELSE `datafiltreler`.`nameOnWeb` END AS `nameOnWeb`,
             CASE WHEN `datafiltreler`.`graph` IS NULL THEN '' ELSE `datafiltreler`.`graph` END AS `graph`
         FROM `datas` LEFT JOIN `datafiltreler` ON `datafiltreler`.`data` = `datas`.`name` AND `datafiltreler`.`tab` = `datas`.`tab` WHERE `stock`='$code' AND `datas`.`tab`='$fav5_tab' AND `name`='$fav5_name' ORDER BY `sira` ASC");
                           $result3 = $query3->fetch_assoc();
                           $datas = $result3["datas"];
                           $fav5_data .= ",".$datas;
                           if($result3["nameOnWeb"] == ""){
                              $favourite5_name = $fav5_tab."-".$fav5_name."-".$stock_name;
                           }
                           else{
                              $favourite5_name = $result3["nameOnWeb"];
                           }
                           $fav5_style = $result3["graph"];
                        } 
                     }
                     $fav_titles = substr($fav_titles, 1, strlen($fav_titles));
                     $fav_titles = "[".$fav_titles."]";
                     $fav1_data = substr($fav1_data, 1, strlen($fav1_data));
                     $fav1_data = "[".$fav1_data."]";
                     $fav2_data = substr($fav2_data, 1, strlen($fav2_data));
                     $fav2_data = "[".$fav2_data."]";
                     $fav3_data = substr($fav3_data, 1, strlen($fav3_data));
                     $fav3_data = "[".$fav3_data."]";
                     $fav4_data = substr($fav4_data, 1, strlen($fav4_data));
                     $fav4_data = "[".$fav4_data."]";
                     $fav5_data = substr($fav5_data, 1, strlen($fav5_data));
                     $fav5_data = "[".$fav5_data."]";
                  ?>
                  <!-- Favourite Table #1: -->
                  <div class="col-lg-8 containerCard" style="margin-top: 10px;">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><?php echo  $favourite1_name ?></h4>
                           </div>
                        </div>
                        <div style="width: 100%; margin-top: 10px;" id="fav1">

                        </div>
                     </div>
                  </div>

                  <div class="col-lg-4">
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
                                       <th>Kodu</th>
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
                                                <td>$code</td>
                                                <td>
                                                   <a type='button' class='btn btn-primary mb-3' style='color: white;' onclick='window.location.href=`index.php?stock=$id`;'>Analiz</a>
                                                </td>
                                                <td>
                                                   <form method='POST' action='index.php'>
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

                  <!-- Favourite Table #2: -->
                  <div class="col-lg-6 containerCard" style="margin-top: 10px;">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><?php echo  $favourite2_name ?></h4>
                           </div>
                        </div>
                        <div style="width: 100%; margin-left: 0%; margin-top: 10px;" id="fav2">

                        </div>
                     </div>
                  </div>
                  <!-- Favourite Table #3: -->
                  <div class="col-lg-6 containerCard" style="margin-top: 10px;">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><?php echo  $favourite3_name ?></h4>
                           </div>
                        </div>
                        <div style="width: 100%; margin-top: 10px;" id="fav3">

                        </div>
                     </div>
                  </div>
                  <!-- Favourite Table #4: -->
                  <div class="col-lg-6 containerCard" style="margin-top: 10px;">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><?php echo  $favourite4_name ?></h4>
                           </div>
                        </div>
                        <div style="width: 100%; margin-top: 10px;" id="fav4">

                        </div>
                     </div>
                  </div>
                  <!-- Favourite Table #5: -->
                  <div class="col-lg-6 containerCard" style="margin-top: 10px;">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><?php echo  $favourite5_name ?></h4>
                           </div>
                        </div>
                        <div style="width: 100%; margin-top: 10px;" id="fav5">

                        </div>
                     </div>
                  </div>
                  <script>
                     document.getElementById("stockAbout").innerHTML = "<?php echo $stock_about ?>";
                     let fav1_style = "<?php echo $fav1_style ?>";
                     let fav2_style = "<?php echo $fav2_style ?>";
                     let fav3_style = "<?php echo $fav3_style ?>";
                     let fav4_style = "<?php echo $fav4_style ?>";
                     let fav5_style = "<?php echo $fav5_style ?>";
                     if(fav1_style == ""){
                        fav1_style = "line";
                     }
                     if(fav2_style == ""){
                        fav2_style = "line";
                     }
                     if(fav3_style == ""){
                        fav3_style = "line";
                     }
                     if(fav4_style == ""){
                        fav4_style = "line";
                     }
                     if(fav5_style == ""){
                        fav5_style = "line";
                     }

                     let fav1Data = <?php echo $fav1_data ?>;
                     let fav2Data = <?php echo $fav2_data ?>;
                     let fav3Data = <?php echo $fav3_data ?>;
                     let fav4Data = <?php echo $fav4_data ?>;
                     let fav5Data = <?php echo $fav5_data ?>;
                     fav1Data[0] =fav1Data[0].reverse();
                     fav2Data[0] =fav2Data[0].reverse();
                     fav3Data[0] = fav3Data[0].reverse();
                     fav4Data[0] =fav4Data[0].reverse();
                     fav5Data[0] =fav5Data[0].reverse();
                     let favTitles = <?php echo $fav_titles ?>;
                     let favCharts = [];
                     let fav1Title =document.getElementById("fav1Title");
                     let fav2Title =document.getElementById("fav2Title");
                     let fav3Title =document.getElementById("fav3Title");
                     let fav4Title =document.getElementById("fav4Title");
                     let fav5Title =document.getElementById("fav5Title");

                     var options1 = {
                        chart: {
                           type: fav1_style
                        },
                        series: [{
                           name: "<?php echo  $fav1_tab." - ".$fav1_name ?>",
                           data:[fav1Data[0][fav1Data[0].length - 12][1],fav1Data[0][fav1Data[0].length - 11][1], fav1Data[0][fav1Data[0].length - 10][1], fav1Data[0][fav1Data[0].length - 9][1], fav1Data[0][fav1Data[0].length - 8][1], fav1Data[0][fav1Data[0].length - 7][1], fav1Data[0][fav1Data[0].length - 6][1], fav1Data[0][fav1Data[0].length - 5][1], fav1Data[0][fav1Data[0].length - 4][1], fav1Data[0][fav1Data[0].length - 3][1], fav1Data[0][fav1Data[0].length - 2][1], fav1Data[0][fav1Data[0].length - 1][1]],
                        }],
                        xaxis: {
                           labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                           categories: [fav1Data[0][fav1Data[0].length - 12][0],fav1Data[0][fav1Data[0].length - 11][0], fav1Data[0][fav1Data[0].length - 10][0], fav1Data[0][fav1Data[0].length - 9][0], fav1Data[0][fav1Data[0].length - 8][0], fav1Data[0][fav1Data[0].length - 7][0], fav1Data[0][fav1Data[0].length - 6][0], fav1Data[0][fav1Data[0].length - 5][0], fav1Data[0][fav1Data[0].length - 4][0], fav1Data[0][fav1Data[0].length - 3][0], fav1Data[0][fav1Data[0].length - 2][0], fav1Data[0][fav1Data[0].length - 1][0]]
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
                        colors: ['#01500B', 'red', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#ff8000', '#8000ff', '#0080ff', 'red', 'red', 'red']

                     }
                     var chart = new ApexCharts(document.getElementById("fav1"), options1);
                     favCharts.push(chart);
                     chart.render();
                     options1 = {
                        chart: {
                           type: fav2_style
                        },
                        series: [{
                           name: "<?php echo  $fav2_tab." - ".$fav2_name ?>",
                           data:[fav2Data[0][fav2Data[0].length - 12][1],fav2Data[0][fav2Data[0].length - 11][1], fav2Data[0][fav2Data[0].length - 10][1], fav2Data[0][fav2Data[0].length - 9][1], fav2Data[0][fav2Data[0].length - 8][1], fav2Data[0][fav2Data[0].length - 7][1], fav2Data[0][fav2Data[0].length - 6][1], fav2Data[0][fav2Data[0].length - 5][1], fav2Data[0][fav2Data[0].length - 4][1], fav2Data[0][fav2Data[0].length - 3][1], fav2Data[0][fav2Data[0].length - 2][1], fav2Data[0][fav2Data[0].length - 1][1]]
                        }],
                        xaxis: {
                           labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                           categories:[fav2Data[0][fav2Data[0].length - 12][0],fav2Data[0][fav2Data[0].length - 11][0], fav2Data[0][fav2Data[0].length - 10][0], fav2Data[0][fav2Data[0].length - 9][0], fav2Data[0][fav2Data[0].length - 8][0], fav2Data[0][fav2Data[0].length - 7][0], fav2Data[0][fav2Data[0].length - 6][0], fav2Data[0][fav2Data[0].length - 5][0], fav2Data[0][fav2Data[0].length - 4][0], fav2Data[0][fav2Data[0].length - 3][0], fav2Data[0][fav2Data[0].length - 2][0], fav2Data[0][fav2Data[0].length - 1][0]]
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
                     var chart = new ApexCharts(document.getElementById("fav2"), options1);
                     favCharts.push(chart);
                     chart.render();
                     options1 = {
                        chart: {
                           type: fav3_style
                        },
                        series: [{
                           name: "<?php echo  $fav3_tab." - ".$fav3_name ?>",
                           data:[fav3Data[0][fav3Data[0].length - 12][1],fav3Data[0][fav3Data[0].length - 11][1], fav3Data[0][fav3Data[0].length - 10][1], fav3Data[0][fav3Data[0].length - 9][1], fav3Data[0][fav3Data[0].length - 8][1], fav3Data[0][fav3Data[0].length - 7][1], fav3Data[0][fav3Data[0].length - 6][1], fav3Data[0][fav3Data[0].length - 5][1], fav3Data[0][fav3Data[0].length - 4][1], fav3Data[0][fav3Data[0].length - 3][1], fav3Data[0][fav3Data[0].length - 2][1], fav3Data[0][fav3Data[0].length - 1][1]]
                        }],
                        xaxis: {
                           labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                           categories: [fav3Data[0][fav3Data[0].length - 12][0],fav3Data[0][fav3Data[0].length - 11][0], fav3Data[0][fav3Data[0].length - 10][0], fav3Data[0][fav3Data[0].length - 9][0], fav3Data[0][fav3Data[0].length - 8][0], fav3Data[0][fav3Data[0].length - 7][0], fav3Data[0][fav3Data[0].length - 6][0], fav3Data[0][fav3Data[0].length - 5][0], fav3Data[0][fav3Data[0].length - 4][0], fav3Data[0][fav3Data[0].length - 3][0], fav3Data[0][fav3Data[0].length - 2][0], fav3Data[0][fav3Data[0].length - 1][0]]
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
                     var chart = new ApexCharts(document.getElementById("fav3"), options1);
                     favCharts.push(chart);
                     chart.render();
                     options1 = {
                        chart: {
                           type: fav4_style
                        },
                        series: [{
                           name: "<?php echo  $fav4_tab." - ".$fav4_name ?>",
                           data:[fav4Data[0][fav4Data[0].length - 12][1],fav4Data[0][fav4Data[0].length - 11][1], fav4Data[0][fav4Data[0].length - 10][1], fav4Data[0][fav4Data[0].length - 9][1], fav4Data[0][fav4Data[0].length - 8][1], fav4Data[0][fav4Data[0].length - 7][1], fav4Data[0][fav4Data[0].length - 6][1], fav4Data[0][fav4Data[0].length - 5][1], fav4Data[0][fav4Data[0].length - 4][1], fav4Data[0][fav4Data[0].length - 3][1], fav4Data[0][fav4Data[0].length - 2][1], fav4Data[0][fav4Data[0].length - 1][1]]
                        }],
                        xaxis: {
                           labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                           categories: [fav4Data[0][fav4Data[0].length - 12][0],fav4Data[0][fav4Data[0].length - 11][0], fav4Data[0][fav4Data[0].length - 10][0], fav4Data[0][fav4Data[0].length - 9][0], fav4Data[0][fav4Data[0].length - 8][0], fav4Data[0][fav4Data[0].length - 7][0], fav4Data[0][fav4Data[0].length - 6][0], fav4Data[0][fav4Data[0].length - 5][0], fav4Data[0][fav4Data[0].length - 4][0], fav4Data[0][fav4Data[0].length - 3][0], fav4Data[0][fav4Data[0].length - 2][0], fav4Data[0][fav4Data[0].length - 1][0]]
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
                     var chart = new ApexCharts(document.getElementById("fav4"), options1);
                     favCharts.push(chart);
                     chart.render();
                     options1 = {
                        chart: {
                           type: fav5_style
                        },
                        series: [{
                           name: "<?php echo  $fav5_tab." - ".$fav5_name ?>",
                           data:[fav5Data[0][fav5Data[0].length - 12][1],fav5Data[0][fav5Data[0].length - 11][1], fav5Data[0][fav5Data[0].length - 10][1], fav5Data[0][fav5Data[0].length - 9][1], fav5Data[0][fav5Data[0].length - 8][1], fav5Data[0][fav5Data[0].length - 7][1], fav5Data[0][fav5Data[0].length - 6][1], fav5Data[0][fav5Data[0].length - 5][1], fav5Data[0][fav5Data[0].length - 4][1], fav5Data[0][fav5Data[0].length - 3][1], fav5Data[0][fav5Data[0].length - 2][1], fav5Data[0][fav5Data[0].length - 1][1]]
                        }],
                        xaxis: {
                           labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                           categories:  [fav5Data[0][fav5Data[0].length - 11][0],fav5Data[0][fav5Data[0].length - 11][0], fav5Data[0][fav5Data[0].length - 10][0], fav5Data[0][fav5Data[0].length - 9][0], fav5Data[0][fav5Data[0].length - 8][0], fav5Data[0][fav5Data[0].length - 7][0], fav5Data[0][fav5Data[0].length - 6][0], fav5Data[0][fav5Data[0].length - 5][0], fav5Data[0][fav5Data[0].length - 4][0], fav5Data[0][fav5Data[0].length - 3][0], fav5Data[0][fav5Data[0].length - 2][0], fav5Data[0][fav5Data[0].length - 1][0]],
                     
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
                     var chart = new ApexCharts(document.getElementById("fav5"), options1);
                     favCharts.push(chart);
                     chart.render();

                     function favChange(index){
                        fav1Title.innerHTML =favTitles[index];
                        fav2Title.innerHTML =favTitles[index];
                        fav3Title.innerHTML =favTitles[index];
                        fav4Title.innerHTML =favTitles[index];
                        fav5Title.innerHTML =favTitles[index];
                        var options1 = {
                           chart: {
                              type: 'line'
                           },
                           series: [{
                              name: "<?php echo  $fav1_tab." - ".$fav1_name ?>",
                              data:[fav1Data[index][0][1], fav1Data[index][1][1], fav1Data[index][2][1], fav1Data[index][3][1], fav1Data[index][4][1], fav1Data[index][5][1], fav1Data[index][6][1], fav1Data[index][7][1], fav1Data[index][8][1]]
                           }],
                           xaxis: {
                              labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                              categories: [fav1Data[index][0][0], fav1Data[index][1][0], fav1Data[index][2][0], fav1Data[index][3][0], fav1Data[index][4][0], fav1Data[index][5][0], fav1Data[index][6][0], fav1Data[index][7][0], fav1Data[index][8][0]]
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
                        var chart1 = new ApexCharts(document.getElementById("fav1"), options1);
                        favCharts[0].destroy();
                        setTimeout(function(task){
                           chart1.render();
                        }, 500);
                        options1 = {
                           chart: {
                              type: 'line'
                           },
                           series: [{
                              name: "<?php echo  $fav2_tab." - ".$fav2_name ?>",
                              data:[fav2Data[index][0][1], fav2Data[index][1][1], fav2Data[index][2][1], fav2Data[index][3][1], fav2Data[index][4][1], fav2Data[index][5][1], fav2Data[index][6][1], fav2Data[index][7][1], fav2Data[index][8][1]]
                           }],
                           xaxis: {
                              labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                              categories: [fav2Data[index][0][0], fav2Data[index][1][0], fav2Data[index][2][0], fav2Data[index][3][0], fav2Data[index][4][0], fav2Data[index][5][0], fav2Data[index][6][0], fav2Data[index][7][0], fav2Data[index][8][0]]
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
                        var chart2 = new ApexCharts(document.getElementById("fav2"), options1);
                        favCharts[1].destroy();
                        setTimeout(function(task){
                           chart2.render();
                        }, 500);
                        options1 = {
                           chart: {
                              type: 'line'
                           },
                           series: [{
                              name: "<?php echo  $fav3_tab." - ".$fav3_name ?>",
                              data:[fav3Data[index][0][1], fav3Data[index][1][1], fav3Data[index][2][1], fav3Data[index][3][1], fav3Data[index][4][1], fav3Data[index][5][1], fav3Data[index][6][1], fav3Data[index][7][1], fav3Data[index][8][1]]
                           }],
                           xaxis: {
                              labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                              categories: [fav3Data[index][0][0], fav3Data[index][1][0], fav3Data[index][2][0], fav3Data[index][3][0], fav3Data[index][4][0], fav3Data[index][5][0], fav3Data[index][6][0], fav3Data[index][7][0], fav3Data[index][8][0]]
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
                        }
                        var chart3 = new ApexCharts(document.getElementById("fav3"), options1);
                        favCharts[2].destroy();
                        setTimeout(function(task){
                           chart3.render();
                        }, 500);
                        options1 = {
                           chart: {
                              type: 'line'
                           },
                           series: [{
                              name: "<?php echo  $fav4_tab." - ".$fav4_name ?>",
                              data:[fav4Data[index][0][1], fav4Data[index][1][1], fav4Data[index][2][1], fav4Data[index][3][1], fav4Data[index][4][1], fav4Data[index][5][1], fav4Data[index][6][1], fav4Data[index][7][1], fav4Data[index][8][1]]
                           }],
                           xaxis: {
                              labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                              categories: [fav4Data[index][0][0], fav4Data[index][1][0], fav4Data[index][2][0], fav4Data[index][3][0], fav4Data[index][4][0], fav4Data[index][5][0], fav4Data[index][6][0], fav4Data[index][7][0], fav4Data[index][8][0]]
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
                        var chart4 = new ApexCharts(document.getElementById("fav4"), options1);
                        favCharts[3].destroy();
                        setTimeout(function(task){
                           chart4.render();
                        }, 500);
                        options1 = {
                           chart: {
                              type: 'line'
                           },
                           series: [{
                              name: "<?php echo  $fav5_tab." - ".$fav5_name ?>",
                              data:[fav5Data[index][0][1], fav5Data[index][1][1], fav5Data[index][2][1], fav5Data[index][3][1], fav5Data[index][4][1], fav5Data[index][5][1], fav5Data[index][6][1], fav5Data[index][7][1], fav5Data[index][8][1]]
                           }],
                           xaxis: {
                              labels: {
                                 rotate: -90,
                                 rotateAlways: true,
                                 minHeight: 100
                              },
                              categories: [fav5Data[index][0][0], fav5Data[index][1][0], fav5Data[index][2][0], fav5Data[index][3][0], fav5Data[index][4][0], fav5Data[index][5][0], fav5Data[index][6][0], fav5Data[index][7][0], fav5Data[index][8][0]]
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
                        var chart5 = new ApexCharts(document.getElementById("fav5"), options1);
                        favCharts[4].destroy();
                        setTimeout(function(task){
                           chart5.render();
                        }, 500);
                     }
                  </script>
                  <div class="col-lg-4" style="height: 260px;">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Takip Et</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul class="perfomer-lists m-0 p-0">
                              <li onclick="window.location.href='https://instagram.com';" class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="images/page-img/31.png" alt="story-img" class="rounded avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Instagram</h6>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                 </div>
                              </li>
                              <li onclick="window.location.href='https://twitter.com';" class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="images/page-img/32.png" alt="story-img" class="rounded avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Twitter</h6>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8" >
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Yorumlar</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <?php
                           $link = $code;
                           $linkCode = "";
                           if(isset($_GET["stock"])){
                              $link = $_GET["stock"];
                              $query2 = $conn->query("SELECT * FROM `stocks` WHERE `id`='$link'");
                              $result = $query2->fetch_assoc();
                              $linkCode = $result["code"];
                              $link = "?stock=$link";
                           }
                           else{
                              $query2 = $conn->query("SELECT * FROM `stocks` WHERE `code`='$link'");
                              $result = $query2->fetch_assoc();
                              $linkCode = $result["code"];
                              $link = "";
                           }
                           if(isset($_POST["comment"])){
                              $comment = $_POST["comment"];
                              $date = date("m/d/Y");
                              $email = $_SESSION["email"];
                              $query = $conn->query("SELECT * FROM `users` WHERE `email`='$email'");
                              $user = $query->fetch_assoc();
                              $title = $user["name"];
                              $query = $conn->query("SELECT * FROM `comments` WHERE `email`='$email'");
                              $size = mysqli_num_rows($query);
                              $query = $conn->query("INSERT INTO `comments`(`title`, `date`, `comment`, `email`, `stock`) VALUES('$title', '$date', '$comment', '$email', '$linkCode')");
                              if($query){
                                 echo "
                                    <script>
                                       alert('Basarili.');
                                       //window.location.href = 'index.php$link';
                                    </script>
                                 ";
                              }
                              else{
                                 echo "
                                    <script>
                                       alert('Sunucu hatasi var.');
                                       //window.location.href = 'index.php$link';
                                    </script>
                                 ";
                              }
                           }
                        ?>
                        <form method="POST" action="index.php<?php echo $link ?>" style="width: 100%; margin-bottom: 15px; display:flex;">
                           <input class="form-control" name="comment" style="width: 70%; min-width: 250px;" placeholder="Yorum..." />
                           <button type="submit" class="btn btn-primary mb-3" style="width: 25%; margin-left: 5%; min-width: 250px; margin-top: 5px;">
                              Gönder
                           </button>
                        </form>
                        <hr>
                        <div id="commentContainer">
                           <?php
                              $query = $conn->query("SELECT * FROM `comments` WHERE `stock`='$linkCode' ORDER BY `id` DESC");
                              while($result = $query->fetch_assoc()){
                                 $title = $result["title"];
                                 $date = $result["date"];
                                 $comment = $result["comment"];
                                 $email = $result["email"];

                                 echo '
                                    <!-- Comment #1: -->
                                    <div style="display: flex; padding-left: 15px; padding-right: 15px; padding-top: 10px; padding-bottom: 10px;">
                                       <img style="width: 50px; height: 50px; border-radius: 10000px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" />
                                       <div style="margin-left: 10px; width: 100%;">
                                          <h6>'.$title.' <span style="font-size: 13px; float:right; color: #777d74;">'.$date.'</span></h6>
                                          <p>
                                             '.$comment.'
                                          </p>
                                       </div>
                                    </div>
                                    <div style="width: 100%; height:1px; background: black; border-radius: 10px;"></div>
                                 ';
                              }
                           ?>
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
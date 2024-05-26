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
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                           <div class="profile-header">
                              <div class="cover-container">
                                 <img src="images/page-img/profile-bg.jpg" alt="profile-bg" class="rounded img-fluid w-100">
                                 <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                                    <li><a href="javascript:void();"><i class="ri-pencil-line"></i></a></li>
                                    <li><a href="javascript:void();"><i class="ri-settings-4-line"></i></a></li>
                                 </ul>
                              </div>
                              <div class="user-detail text-center mb-3">
                                 <div class="profile-img">
                                    <img src="images/user/11.png" alt="profile-img" class="avatar-130 img-fluid" />
                                 </div>
                                 <div class="profile-detail">
                                    <h3 class="">Barry Tech</h3>
                                 </div>
                              </div>
                              <div class="profile-info p-4 d-flex align-items-center justify-content-between position-relative">
                                 <div class="social-links">
                                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                       <li class="text-center pr-3">
                                          <a href="#"><img src="images/icon/08.png" class="img-fluid rounded" alt="facebook"></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="#"><img src="images/icon/09.png" class="img-fluid rounded" alt="Twitter"></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="#"><img src="images/icon/10.png" class="img-fluid rounded" alt="Instagram"></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="#"><img src="images/icon/11.png" class="img-fluid rounded" alt="Google plus"></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="#"><img src="images/icon/12.png" class="img-fluid rounded" alt="You tube"></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="#"><img src="images/icon/13.png" class="img-fluid rounded" alt="linkedin"></a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="social-info">
                                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                       <li class="text-center pl-3">
                                          <h6>Posts</h6>
                                          <p class="mb-0">690</p>
                                       </li>
                                       <li class="text-center pl-3">
                                          <h6>Followers</h6>
                                          <p class="mb-0">206</p>
                                       </li>
                                       <li class="text-center pl-3">
                                          <h6>Following</h6>
                                          <p class="mb-0">100</p>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="row">
                        <div class="col-lg-4">
                                    <div class="iq-card">
                                       <div class="iq-card-body">
                                          <a href="#"><span class="badge badge-pill badge-primary font-weight-normal ml-auto mr-1"><i class="ri-star-line"></i></span> 27 Items for yoou</a>
                                       </div>
                                    </div>
                                    <div class="iq-card">
                                       <div class="iq-card-header d-flex justify-content-between">
                                          <div class="iq-header-title">
                                             <h4 class="card-title">Life Event</h4>
                                          </div>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">
                                             <p class="m-0"><a href="javacsript:void();"> Create </a></p>
                                          </div>
                                       </div>
                                       <div class="iq-card-body">
                                          <div class="row">
                                             <div class="col-sm-12">
                                                <div class="event-post position-relative">
                                                   <a href="javascript:void();"><img src="images/page-img/34.png" alt="gallary-image" class="img-fluid rounded"></a>
                                                   <div class="job-icon-position">
                                                      <div class="job-icon bg-primary p-2 d-inline-block rounded"><i class="ri-briefcase-line"></i></div>
                                                   </div>
                                                   <div class="iq-card-body text-center p-2">
                                                      <h5>Started New Job at Themeforest</h5>
                                                      <p>January 24, 2019</p>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-12">
                                                <div class="event-post position-relative">
                                                   <a href="javascript:void();"><img src="images/page-img/07.jpg" alt="gallary-image" class="img-fluid rounded w-100"></a>
                                                   <div class="job-icon-position">
                                                      <div class="job-icon bg-primary p-2 d-inline-block rounded"><i class="ri-briefcase-line"></i></div>
                                                   </div>
                                                   <div class="iq-card-body text-center p-2">
                                                      <h5>Started New Job at Themeforest</h5>
                                                      <p>January 24, 2019</p>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="iq-card">
                                       <div class="iq-card-header d-flex justify-content-between">
                                          <div class="iq-header-title">
                                             <h4 class="card-title">Photos</h4>
                                          </div>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">
                                             <p class="m-0"><a href="javacsript:void();">Add Photo </a></p>
                                          </div>
                                       </div>
                                       <div class="iq-card-body">
                                          <ul class="profile-img-gallary d-flex flex-wrap p-0 m-0">
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3"><a href="javascript:void();"><img src="images/page-img/g1.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3"><a href="javascript:void();"><img src="images/page-img/g2.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3"><a href="javascript:void();"><img src="images/page-img/g3.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3"><a href="javascript:void();"><img src="images/page-img/g4.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3"><a href="javascript:void();"><img src="images/page-img/g5.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3"><a href="javascript:void();"><img src="images/page-img/g6.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-0"><a href="javascript:void();"><img src="images/page-img/g7.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-0"><a href="javascript:void();"><img src="images/page-img/g8.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-0"><a href="javascript:void();"><img src="images/page-img/g9.jpg" alt="gallary-image" class="img-fluid w-100" /></a></li>
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="iq-card">
                                       <div class="iq-card-header d-flex justify-content-between">
                                          <div class="iq-header-title">
                                             <h4 class="card-title">Friends</h4>
                                          </div>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">
                                             <p class="m-0"><a href="javacsript:void();">Add New </a></p>
                                          </div>
                                       </div>
                                       <div class="iq-card-body">
                                          <ul class="profile-img-gallary d-flex flex-wrap p-0 m-0">
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3">
                                                <a href="javascript:void();">
                                                <img src="images/user/05.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Anna Rexia</h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3">
                                                <a href="javascript:void();"><img src="images/user/06.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Tara Zona</h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3">
                                                <a href="javascript:void();"><img src="images/user/07.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Polly Tech</h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3">
                                                <a href="javascript:void();"><img src="images/user/08.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Bill Emia</h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3">
                                                <a href="javascript:void();"><img src="images/user/09.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Moe Fugga</h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-3">
                                                <a href="javascript:void();"><img src="images/user/10.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Hal Appeno </h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-0">
                                                <a href="javascript:void();"><img src="images/user/05.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Zack Lee</h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-0">
                                                <a href="javascript:void();"><img src="images/user/06.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Terry Aki</h6>
                                             </li>
                                             <li class="col-md-4 col-6 pl-2 pr-0 pb-0">
                                                <a href="javascript:void();"><img src="images/user/07.jpg" alt="gallary-image" class="img-fluid w-100" /></a>
                                                <h6 class="mt-2">Greta Life</h6>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                        </div>
                        <div class="col-lg-8">
                           <div id="post-modal-data" class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Create Post</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
                                 <div class="d-flex align-items-center">
                                    <div class="user-img">
                                       <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded img-fluid">
                                    </div>
                                    <form class="post-text ml-3 w-100" action="javascript:void();">
                                       <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                                    </form>
                                 </div>
                                 <hr>
                                 <ul class="post-opt-block d-flex align-items-center list-inline m-0 p-0">
                                    <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/07.png" alt="icon" class="img-fluid"> Photo/Video</li>
                                    <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/08.png" alt="icon" class="img-fluid"> Tag Friend</li>
                                    <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</li>
                                    <li class="iq-bg-primary rounded p-2 pointer">
                                       <div class="iq-card-header-toolbar d-flex align-items-center">
                                          <div class="dropdown">
                                             <span class="dropdown-toggle" id="post-option" data-toggle="dropdown" >
                                             <i class="ri-more-fill"></i>
                                             </span>
                                             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="post-option" style="">
                                                <a class="dropdown-item" href="#">Check in</a>
                                                <a class="dropdown-item" href="#">Live Video</a>
                                                <a class="dropdown-item" href="#">Gif</a>
                                                <a class="dropdown-item" href="#">Watch Party</a>
                                                <a class="dropdown-item" href="#">Play with Friend</a>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                              <div class="modal fade" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="post-modalLabel" aria-hidden="true" style="display: none;">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-fill"></i></button>
                                       </div>
                                       <div class="modal-body">
                                          <div class="d-flex align-items-center">
                                             <div class="user-img">
                                                <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded img-fluid">
                                             </div>
                                             <form class="post-text ml-3 w-100" action="javascript:void();">
                                                <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                                             </form>
                                          </div>
                                          <hr>
                                          <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/07.png" alt="icon" class="img-fluid"> Photo/Video</div>
                                             </li>
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/08.png" alt="icon" class="img-fluid"> Tag Friend</div>
                                             </li>
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</div>
                                             </li>
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/10.png" alt="icon" class="img-fluid"> Check in</div>
                                             </li>
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/11.png" alt="icon" class="img-fluid"> Live Video</div>
                                             </li>
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/12.png" alt="icon" class="img-fluid"> Gif</div>
                                             </li>
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/13.png" alt="icon" class="img-fluid"> Watch Party</div>
                                             </li>
                                             <li class="col-md-6 mb-3">
                                                <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/14.png" alt="icon" class="img-fluid"> Play with Friends</div>
                                             </li>
                                          </ul>
                                          <hr>
                                          <div class="other-option">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <div class="user-img mr-3">
                                                      <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded img-fluid">
                                                   </div>
                                                   <h6>Your Story</h6>
                                                </div>
                                                <div class="iq-card-post-toolbar">
                                                   <div class="dropdown">
                                                      <span class="dropdown-toggle" id="postdata-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                      <span class="btn btn-primary">Friend</span>
                                                      </span>
                                                      <div class="dropdown-menu m-0 p-0" aria-labelledby="postdata-1" style="">
                                                         <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                               <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                                               <div class="data ml-2">
                                                                  <h6>Public</h6>
                                                                  <p class="mb-0">Anyone on or off Facebook</p>
                                                               </div>
                                                            </div>
                                                         </a>
                                                         <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                               <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                                               <div class="data ml-2">
                                                                  <h6>Friends</h6>
                                                                  <p class="mb-0">Your Friend on facebook</p>
                                                               </div>
                                                            </div>
                                                         </a>
                                                         <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                               <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                                               <div class="data ml-2">
                                                                  <h6>Friends except</h6>
                                                                  <p class="mb-0">Don't show to some friends</p>
                                                               </div>
                                                            </div>
                                                         </a>
                                                         <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                               <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                                               <div class="data ml-2">
                                                                  <h6>Only Me</h6>
                                                                  <p class="mb-0">Only me</p>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary d-block w-100 mt-3">Post</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="iq-card">
                              <div class="iq-card-body">
                                 <div class="post-item">
                                    <div class="user-post-data p-3">
                                       <div class="d-flex flex-wrap">
                                          <div class="media-support-user-img mr-3">
                                             <img class="rounded img-fluid" src="images/user/1.jpg" alt="">
                                          </div>
                                          <div class="media-support-info mt-2">
                                             <h5 class="mb-0 d-inline-block"><a href="#" class="">Barry Tech</a></h5>
                                             <p class="ml-1 mb-0 d-inline-block">Add New Post</p>
                                             <p class="mb-0">3 hour ago</p>
                                          </div>
                                          <div class="iq-card-post-toolbar">
                                             <div class="dropdown">
                                                <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                <i class="ri-more-fill"></i>
                                                </span>
                                                <div class="dropdown-menu m-0 p-0">
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                                         <div class="data ml-2">
                                                            <h6>Save Post</h6>
                                                            <p class="mb-0">Add this to your saved items</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <div class="icon font-size-20"><i class="ri-pencil-line"></i></div>
                                                         <div class="data ml-2">
                                                            <h6>Edit Post</h6>
                                                            <p class="mb-0">Update your post and saved items</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                                         <div class="data ml-2">
                                                            <h6>Hide From Timeline</h6>
                                                            <p class="mb-0">See fewer posts like this.</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <div class="icon font-size-20"><i class="ri-delete-bin-7-line"></i></div>
                                                         <div class="data ml-2">
                                                            <h6>Delete</h6>
                                                            <p class="mb-0">Remove thids Post on Timeline</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                                         <div class="data ml-2">
                                                            <h6>Notifications</h6>
                                                            <p class="mb-0">Turn on notifications for this post</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="user-post">
                                       <a href="javascript:void();"><img src="images/page-img/p1.jpg" alt="post-image" class="img-fluid w-100" /></a>
                                    </div>
                                       <div class="comment-area mt-3">
                                          <div class="d-flex justify-content-between align-items-center">
                                             <div class="like-block position-relative d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                   <div class="like-data">
                                                      <div class="dropdown">
                                                         <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                         <img src="images/icon/01.png" class="img-fluid" alt="">
                                                         </span>
                                                         <div class="dropdown-menu">
                                                            <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="total-like-block ml-2 mr-3">
                                                      <div class="dropdown">
                                                         <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                         140 Likes
                                                         </span>
                                                         <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Max Emum</a>
                                                            <a class="dropdown-item" href="#">Bill Yerds</a>
                                                            <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                            <a class="dropdown-item" href="#">Tara Misu</a>
                                                            <a class="dropdown-item" href="#">Midge Itz</a>
                                                            <a class="dropdown-item" href="#">Sal Vidge</a>
                                                            <a class="dropdown-item" href="#">Other</a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="total-comment-block">
                                                   <div class="dropdown">
                                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                      20 Comment
                                                      </span>
                                                      <div class="dropdown-menu">
                                                         <a class="dropdown-item" href="#">Max Emum</a>
                                                         <a class="dropdown-item" href="#">Bill Yerds</a>
                                                         <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                         <a class="dropdown-item" href="#">Tara Misu</a>
                                                         <a class="dropdown-item" href="#">Midge Itz</a>
                                                         <a class="dropdown-item" href="#">Sal Vidge</a>
                                                         <a class="dropdown-item" href="#">Other</a>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="share-block d-flex align-items-center feather-icon mr-3">
                                                <a href="javascript:void();"><i class="ri-share-line"></i>
                                                <span class="ml-1">99 Share</span></a>
                                             </div>
                                          </div>
                                          <hr>
                                          <ul class="post-comments p-0 m-0">
                                             <li class="mb-2">
                                                <div class="d-flex flex-wrap">
                                                   <div class="user-img">
                                                      <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded img-fluid">
                                                   </div>
                                                   <div class="comment-data-block ml-3">
                                                      <h6>Monty Carlo</h6>
                                                      <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                      <div class="d-flex flex-wrap align-items-center comment-activity">
                                                         <a href="javascript:void();">like</a>
                                                         <a href="javascript:void();">reply</a>
                                                         <a href="javascript:void();">translate</a>
                                                         <span> 5 minit </span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li>
                                                <div class="d-flex flex-wrap">
                                                   <div class="user-img">
                                                      <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded img-fluid">
                                                   </div>
                                                   <div class="comment-data-block ml-3">
                                                      <h6>Paul Molive</h6>
                                                      <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                      <div class="d-flex flex-wrap align-items-center comment-activity">
                                                         <a href="javascript:void();">like</a>
                                                         <a href="javascript:void();">reply</a>
                                                         <a href="javascript:void();">translate</a>
                                                         <span> 5 minit </span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                          </ul>
                                          <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                                             <input type="text" class="form-control rounded">
                                             <div class="comment-attagement d-flex">
                                                <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                                                <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                                                <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <div class="post-item">
                                       <div class="user-post-data p-3">
                                          <div class="d-flex flex-wrap">
                                             <div class="media-support-user-img mr-3">
                                                <img class="rounded img-fluid" src="images/user/1.jpg" alt="">
                                             </div>
                                             <div class="media-support-info mt-2">
                                                <h5 class="mb-0 d-inline-block"><a href="#" class="">Barry Tech</a></h5>
                                                <p class="ml-1 mb-0 d-inline-block">Share Anna Mull's Post</p>
                                                <p class="mb-0">5 hour ago</p>
                                             </div>
                                             <div class="iq-card-post-toolbar">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                   <i class="ri-more-fill"></i>
                                                   </span>
                                                   <div class="dropdown-menu m-0 p-0">
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Save Post</h6>
                                                               <p class="mb-0">Add this to your saved items</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-pencil-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Edit Post</h6>
                                                               <p class="mb-0">Update your post and saved items</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Hide From Timeline</h6>
                                                               <p class="mb-0">See fewer posts like this.</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-delete-bin-7-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Delete</h6>
                                                               <p class="mb-0">Remove thids Post on Timeline</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Notifications</h6>
                                                               <p class="mb-0">Turn on notifications for this post</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="user-post">
                                          <a href="javascript:void();"><img src="images/page-img/p2.jpg" alt="post-image" class="img-fluid w-100" /></a>
                                       </div>
                                       <div class="comment-area mt-3">
                                          <div class="d-flex justify-content-between align-items-center">
                                             <div class="like-block position-relative d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                   <div class="like-data">
                                                      <div class="dropdown">
                                                         <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                         <img src="images/icon/01.png" class="img-fluid" alt="">
                                                         </span>
                                                         <div class="dropdown-menu">
                                                            <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="total-like-block ml-2 mr-3">
                                                      <div class="dropdown">
                                                         <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                         140 Likes
                                                         </span>
                                                         <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Max Emum</a>
                                                            <a class="dropdown-item" href="#">Bill Yerds</a>
                                                            <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                            <a class="dropdown-item" href="#">Tara Misu</a>
                                                            <a class="dropdown-item" href="#">Midge Itz</a>
                                                            <a class="dropdown-item" href="#">Sal Vidge</a>
                                                            <a class="dropdown-item" href="#">Other</a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="total-comment-block">
                                                   <div class="dropdown">
                                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                      20 Comment
                                                      </span>
                                                      <div class="dropdown-menu">
                                                         <a class="dropdown-item" href="#">Max Emum</a>
                                                         <a class="dropdown-item" href="#">Bill Yerds</a>
                                                         <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                         <a class="dropdown-item" href="#">Tara Misu</a>
                                                         <a class="dropdown-item" href="#">Midge Itz</a>
                                                         <a class="dropdown-item" href="#">Sal Vidge</a>
                                                         <a class="dropdown-item" href="#">Other</a>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="share-block d-flex align-items-center feather-icon mr-3">
                                                <a href="javascript:void();"><i class="ri-share-line"></i>
                                                <span class="ml-1">99 Share</span></a>
                                             </div>
                                          </div>
                                          <hr>
                                          <ul class="post-comments p-0 m-0">
                                             <li class="mb-2">
                                                <div class="d-flex flex-wrap">
                                                   <div class="user-img">
                                                      <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded img-fluid">
                                                   </div>
                                                   <div class="comment-data-block ml-3">
                                                      <h6>Monty Carlo</h6>
                                                      <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                      <div class="d-flex flex-wrap align-items-center comment-activity">
                                                         <a href="javascript:void();">like</a>
                                                         <a href="javascript:void();">reply</a>
                                                         <a href="javascript:void();">translate</a>
                                                         <span> 5 minit </span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li>
                                                <div class="d-flex flex-wrap">
                                                   <div class="user-img">
                                                      <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded img-fluid">
                                                   </div>
                                                   <div class="comment-data-block ml-3">
                                                      <h6>Paul Molive</h6>
                                                      <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                      <div class="d-flex flex-wrap align-items-center comment-activity">
                                                         <a href="javascript:void();">like</a>
                                                         <a href="javascript:void();">reply</a>
                                                         <a href="javascript:void();">translate</a>
                                                         <span> 5 minit </span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                          </ul>
                                          <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                                             <input type="text" class="form-control rounded">
                                             <div class="comment-attagement d-flex">
                                                <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                                                <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                                                <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <div class="post-item">
                                       <div class="user-post-data p-3">
                                          <div class="d-flex flex-wrap">
                                             <div class="media-support-user-img mr-3">
                                                <img class="rounded img-fluid" src="images/user/1.jpg" alt="">
                                             </div>
                                             <div class="media-support-info mt-2">
                                                <h5 class="mb-0 d-inline-block"><a href="#" class="">Barry Tech</a></h5>
                                                <p class="ml-1 mb-0 d-inline-block">Update his Status</p>
                                                <p class="mb-0">7 hour ago</p>
                                             </div>
                                             <div class="iq-card-post-toolbar">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                   <i class="ri-more-fill"></i>
                                                   </span>
                                                   <div class="dropdown-menu m-0 p-0">
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Save Post</h6>
                                                               <p class="mb-0">Add this to your saved items</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-pencil-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Edit Post</h6>
                                                               <p class="mb-0">Update your post and saved items</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Hide From Timeline</h6>
                                                               <p class="mb-0">See fewer posts like this.</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-delete-bin-7-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Delete</h6>
                                                               <p class="mb-0">Remove thids Post on Timeline</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                      <a class="dropdown-item p-3" href="#">
                                                         <div class="d-flex align-items-top">
                                                            <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                                            <div class="data ml-2">
                                                               <h6>Notifications</h6>
                                                               <p class="mb-0">Turn on notifications for this post</p>
                                                            </div>
                                                         </div>
                                                      </a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="user-post">
                                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                                       </div>
                                       <div class="comment-area mt-3">
                                          <div class="d-flex justify-content-between align-items-center">
                                             <div class="like-block position-relative d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                   <div class="like-data">
                                                      <div class="dropdown">
                                                         <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                         <img src="images/icon/01.png" class="img-fluid" alt="">
                                                         </span>
                                                         <div class="dropdown-menu">
                                                            <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                                            <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="total-like-block ml-2 mr-3">
                                                      <div class="dropdown">
                                                         <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                         140 Likes
                                                         </span>
                                                         <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Max Emum</a>
                                                            <a class="dropdown-item" href="#">Bill Yerds</a>
                                                            <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                            <a class="dropdown-item" href="#">Tara Misu</a>
                                                            <a class="dropdown-item" href="#">Midge Itz</a>
                                                            <a class="dropdown-item" href="#">Sal Vidge</a>
                                                            <a class="dropdown-item" href="#">Other</a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="total-comment-block">
                                                   <div class="dropdown">
                                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                      20 Comment
                                                      </span>
                                                      <div class="dropdown-menu">
                                                         <a class="dropdown-item" href="#">Max Emum</a>
                                                         <a class="dropdown-item" href="#">Bill Yerds</a>
                                                         <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                         <a class="dropdown-item" href="#">Tara Misu</a>
                                                         <a class="dropdown-item" href="#">Midge Itz</a>
                                                         <a class="dropdown-item" href="#">Sal Vidge</a>
                                                         <a class="dropdown-item" href="#">Other</a>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="share-block d-flex align-items-center feather-icon mr-3">
                                                <a href="javascript:void();"><i class="ri-share-line"></i>
                                                <span class="ml-1">99 Share</span></a>
                                             </div>
                                          </div>
                                          <hr>
                                          <ul class="post-comments p-0 m-0">
                                             <li class="mb-2">
                                                <div class="d-flex flex-wrap">
                                                   <div class="user-img">
                                                      <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded img-fluid">
                                                   </div>
                                                   <div class="comment-data-block ml-3">
                                                      <h6>Monty Carlo</h6>
                                                      <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                      <div class="d-flex flex-wrap align-items-center comment-activity">
                                                         <a href="javascript:void();">like</a>
                                                         <a href="javascript:void();">reply</a>
                                                         <a href="javascript:void();">translate</a>
                                                         <span> 5 minit </span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                             <li>
                                                <div class="d-flex flex-wrap">
                                                   <div class="user-img">
                                                      <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded img-fluid">
                                                   </div>
                                                   <div class="comment-data-block ml-3">
                                                      <h6>Paul Molive</h6>
                                                      <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                      <div class="d-flex flex-wrap align-items-center comment-activity">
                                                         <a href="javascript:void();">like</a>
                                                         <a href="javascript:void();">reply</a>
                                                         <a href="javascript:void();">translate</a>
                                                         <span> 5 minit </span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                          </ul>
                                          <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                                             <input type="text" class="form-control rounded">
                                             <div class="comment-attagement d-flex">
                                                <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                                                <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                                                <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12 text-center">
                     <img src="images/page-img/page-load-loader.gif" alt="loader" style="height: 100px;">
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
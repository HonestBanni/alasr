<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <title><?php  echo isset($page_title) ? $page_title : $company_info->page_title; ?></title>
  <base href="<?php echo base_url()?>">
<!-- Stylesheets -->
<link href="SiteAssets/css/bootstrap.css" rel="stylesheet">
<link href="SiteAssets/plugins/revolution/css/settings.css" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="SiteAssets/plugins/revolution/css/layers.css" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="SiteAssets/plugins/revolution/css/navigation.css" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
<link href="SiteAssets/css/style.css" rel="stylesheet">
<link href="SiteAssets/css/responsive.css" rel="stylesheet">
<meta name="description" content="<?php  echo isset($SEO) ? $SEO : 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically'; ?>">

<link rel="<?php echo $company_info->page_title?>" href="SiteAssets/images/<?php echo $company_info->ico?>" type="image/x-icon">
<link rel="<?php echo $company_info->page_title?>" href="SiteAssets/images/<?php echo $company_info->ico?>" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>
    
    <!-- Main Header-->
    <header class="main-header">
        <!--Header Top-->
        <div class="header-top">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <div class="top-left">
                        <ul class="contact-list clearfix">
                            <li><a href="#">info@alasr.com</a></li>
                            <li>(091) 5251309</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top -->

        <!-- Header Upper -->
        <div class="header-upper">
            <div class="auto-container">
                <div class="clearfix">
                    
                    <div class="logo-outer">
                        <div class="logo"><a href="Home"><img src="SiteAssets/images/<?php echo $company_info->logo?>" alt="" title="<?php echo $company_info->page_title?>"></a></div>
                    </div>
                    
                    <div class="upper-right clearfix">
                        
                        <!--Info Box-->
                        <div class="upper-column info-box">
                            <div class="icon-box"><a href="Contact#googelMap"><span class="flaticon-map-marker"></span></a></div>
                            <ul>
                                <li><strong>FIND US</strong>: Usmania Colony,</li>
                                <li>Nothia Road, Peshawar.</li>
                            </ul>
                        </div>
                        
                        <!--Info Box-->
                        <div class="upper-column info-box">
                            <div class="icon-box"><span class="flaticon-clock-5"></span></div>
                            <ul>
                                <li><strong>Open Time</strong>: 08:00 - 14:00</li>
                                <li>Sunday - Closed</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--Header-lower-->
        <div class="header-lower">
            <div class="auto-container">

                <div class="nav-outer clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-dark">
                        <div class="navbar-header">
                            <!-- Toggle Button -->      
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="flaticon-menu"></span>
                            </button>
                        </div>
                        
                        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <?php
                                
                                if($site_nav):
                                   
                                    foreach($site_nav as $row):
                                        if($active_uri == $row->title):
                                            echo '<li class="current"><a href="'.$row->title.'">'.$row->title.'</a></li>';
                                            else:
                                            echo '<li><a href="'.$row->function_name.'">'.$row->title.'</a></li>';
                                        endif;
                                    
                                    endforeach;
                                endif;
                                
                                ?>
                           
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                    <!-- Outer Box -->
                    <div class="outer-box">
                        <ul class="social-icon-one">
                            <li><a href="https://www.facebook.com/AlAsrEducationSystemNothiaPeshawar/" target="_blank"><i class="fa fa-facebook-official"></i></a></li>
<!--                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-square"></i></a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="Home" title=""><img src="SiteAssets/images/<?php echo $company_info->logo2?>" alt="" title="<?php echo $company_info->page_title?>"></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-collapse show collapse clearfix">
                            <ul class="navigation clearfix">
                                <?php
                                if($site_nav):
                                     
                                    foreach($site_nav as $row):
                                        if($active_uri==$row->title):
                                            echo '<li class="current"><a href="'.$row->function_name.'">'.$row->title.'</a></li>';
                                            else:
                                            echo '<li><a href="'.$row->function_name.'">'.$row->title.'</a></li>';
                                        endif;
                                    
                                    endforeach;
                                endif;
                                
                                ?>
                           
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div>
    </header>
    <!--End Main Header -->

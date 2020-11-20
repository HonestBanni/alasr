<!DOCTYPE html>
<html lang="en"> 
<head>
  <title><?php  echo isset($page_title) ? $page_title : $page_title->title; ?></title>
    <!-- Meta -->
    <meta charset="utf-8">
       <base href="<?php echo base_url()?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $app_setting->title;?>">
    <meta name="author" content="Minotech Systems Limited">    
    <link rel="shortcut icon" href="assets/App/<?php echo $app_setting->ico;?>">  
 
    <link rel="stylesheet" href="assets/App/plugins/bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" href="assets/App/css/google-fonts.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="assets/App/plugins/font-awesome/css/font-awesome.css">
    
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/App/css/styles.css">
       <!--<script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>-->
</head>
 
<body class="home-page">
      <div class="wrapper">
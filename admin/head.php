<?php 
require_once('../includes/Database.php');
    session_start();  
    if(!$_SESSION['id']){
        header('location: ../login.html');
    }
$dbClass = new Database();
$conn = $dbClass->getDb(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Movie Links</title>
  <link rel="stylesheet" href="<?=$domain;?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$domain;?>assets/css/style.css">
  <link rel="stylesheet" href="<?=$domain;?>assets/css/all.min.css">
  <script src="<?=$domain;?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/fileinput.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/themes/explorer-fas/theme.min.js"></script>
<script src="<?=$domain;?>assets/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/css/fileinput.min.css" type="text/css" />
	
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"><i class="fa-solid fa-list-timeline" id="header-toggle"></i></div>
        <div class="header_img"> Hello <b><?php echo ucfirst($_SESSION['first_name']); ?></b></div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo">
			<i class="fa-solid fa-scalpel-line-dashed"></i>
			<span class="had-logo"><b>HauN</b></span> </a>
                <div class="nav_list"> 
				<?php
				switch($_SERVER['QUERY_STRING']) {
    case 'phimle': 
	  echo '<a href="'.$domain.'admin" class="nav_link"><i class="fa-solid fa-house-chimney-heart"></i> <span class="nav_name"><b>Home</b></span></a> 
		<a href="'.$domain.'movies.html" class="nav_link active"><i class="fa-solid fa-camera-movie"></i> <span class="nav_name"><b>Manage Movies</b></span></a>
		<a href="'.$domain.'tvseries.html" class="nav_link"><i class="fa-solid fa-tv"></i> <span class="nav_name"><b>Manage TV-Series</b></span></a> 
		<a href="'.$domain.'ads.html" class="nav_link"><i class="fa-solid fa-rectangle-ad"></i> <span class="nav_name"><b>Manage ADS</b></span></a> 
	    <a class="nav_link" data-bs-toggle="modal" data-bs-target="#modalForm3"> <i class="fa-solid fa-link"></i>  <span class="nav_name"><b>Support Link</b></span></a>
		<a href="'.$domain.'setting.html" class="nav_link"><i class="fa-solid fa-gear"></i> <span class="nav_name"><b>Setting</b></span></a>  
	   ';
       break;
    case 'phimbo':
       echo '<a href="'.$domain.'admin" class="nav_link"><i class="fa-solid fa-house-chimney-heart"></i> <span class="nav_name"><b>Home</b></span></a> 
		<a href="'.$domain.'movies.html" class="nav_link"><i class="fa-solid fa-camera-movie"></i> <span class="nav_name"><b>Manage Movies</b></span></a>
		<a href="'.$domain.'tvseries.html" class="nav_link active"><i class="fa-solid fa-tv"></i> <span class="nav_name"><b>Manage TV-Series</b></span></a> 
	    <a href="'.$domain.'ads.html" class="nav_link"><i class="fa-solid fa-rectangle-ad"></i> <span class="nav_name"><b>Manage ADS</b></span></a>
	    <a class="nav_link" data-bs-toggle="modal" data-bs-target="#modalForm3"> <i class="fa-solid fa-link"></i>  <span class="nav_name"><b>Support Link</b></span></a> 
	    <a href="'.$domain.'setting.html" class="nav_link"><i class="fa-solid fa-gear"></i> <span class="nav_name"><b>Setting</b></span></a>  
	   ';
        break;
	case 'ads':
       echo '<a href="'.$domain.'admin" class="nav_link"><i class="fa-solid fa-house-chimney-heart"></i> <span class="nav_name"><b>Home</b></span></a> 
		<a href="'.$domain.'movies.html" class="nav_link"><i class="fa-solid fa-camera-movie"></i> <span class="nav_name"><b>Manage Movies</b></span></a>
		<a href="'.$domain.'tvseries.html" class="nav_link"><i class="fa-solid fa-tv"></i> <span class="nav_name"><b>Manage TV-Series</b></span></a> 
	    <a href="'.$domain.'ads.html" class="nav_link active"><i class="fa-solid fa-rectangle-ad"></i> <span class="nav_name"><b>Manage ADS</b></span></a> 
	    <a class="nav_link" data-bs-toggle="modal" data-bs-target="#modalForm3"> <i class="fa-solid fa-link"></i>  <span class="nav_name"><b>Support Link</b></span></a>
		<a href="'.$domain.'setting.html" class="nav_link"><i class="fa-solid fa-gear"></i> <span class="nav_name"><b>Setting</b></span></a>  
	   ';
        break;
	case 'setting':
       echo '<a href="'.$domain.'admin" class="nav_link"><i class="fa-solid fa-house-chimney-heart"></i> <span class="nav_name"><b>Home</b></span></a> 
		<a href="'.$domain.'movies.html" class="nav_link"><i class="fa-solid fa-camera-movie"></i> <span class="nav_name"><b>Manage Movies</b></span></a>
		<a href="'.$domain.'tvseries.html" class="nav_link"><i class="fa-solid fa-tv"></i> <span class="nav_name"><b>Manage TV-Series</b></span></a> 
	    <a href="'.$domain.'ads.html" class="nav_link"><i class="fa-solid fa-rectangle-ad"></i> <span class="nav_name"><b>Manage ADS</b></span></a> 
	    <a class="nav_link" data-bs-toggle="modal" data-bs-target="#modalForm3"> <i class="fa-solid fa-link"></i>  <span class="nav_name"><b>Support Link</b></span></a>
	    <a href="'.$domain.'setting.html" class="nav_link active"><i class="fa-solid fa-gear"></i> <span class="nav_name"><b>Setting</b></span></a>  
	   ';
        break;
    default:
        echo '<a href="'.$domain.'admin" class="nav_link active"><i class="fa-solid fa-house-chimney-heart"></i> <span class="nav_name"><b>Home</b></span></a> 
		<a href="'.$domain.'movies.html" class="nav_link"><i class="fa-solid fa-camera-movie"></i> <span class="nav_name"><b>Manage Movies</b></span></a>
		<a href="'.$domain.'tvseries.html" class="nav_link"><i class="fa-solid fa-tv"></i> <span class="nav_name"><b>Manage TV-Series</b></span></a> 
		<a href="'.$domain.'ads.html" class="nav_link"><i class="fa-solid fa-rectangle-ad"></i> <span class="nav_name"><b>Manage ADS</b></span></a> 
		<a class="nav_link" data-bs-toggle="modal" data-bs-target="#modalForm3"> <i class="fa-solid fa-link"></i>  <span class="nav_name"><b>Support Link</b></span></a>
		<a href="'.$domain.'setting.html" class="nav_link"><i class="fa-solid fa-gear"></i> <span class="nav_name"><b>Setting</b></span></a>  
		';
        break;
}
?>
				</div>
            </div> <a href="<?=$domain;?>logout.html" class="nav_link"><i class="fa-solid fa-arrow-up-left-from-circle"></i> <span class="nav_name"><b>Log out</b></span></a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">

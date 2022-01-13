<?php 
require('head.php');
switch($_SERVER['QUERY_STRING']) {
    case 'phimle': 
	  include 'phimle.php';
	  echo '<script src="'.$domain.'assets/js/phimle.js"></script>';
       break;
    case 'phimbo':
        include 'phimbo.php';
	    echo '<script src="'.$domain.'assets/js/phimbo.js"></script>';
        break;
	case 'ads':
       include 'ads.php';
	   echo '<script src="'.$domain.'assets/js/ads.js"></script>';
        break;
	case 'setting':
       include 'setting.php';
	     echo '<script src="'.$domain.'assets/js/setting.js"></script>';
        break;
    default:
        $dbClass = new Database();
        $dbh = $dbClass->getDb(); 
        $ple = $dbh->query('select count(*) from movies')->fetchColumn(); 
        $tv = $dbh->query('select count(*) from tvseries')->fetchColumn();
        $mem = $dbh->query('select count(*) from members')->fetchColumn();  
        echo '<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Tutorial!</h4>
  <p>Thank You For Using Our Service</p>
  <hr>
  <p class="mb-0">Movies : '.$domain.'movie.php?id=<font color="red">tmdbid</font></p>
  <p class="mb-0">TV Series : '.$domain.'tvseries.php?id=<font color="red">tmdbid</font>&s<font color="red">season</font>&e<font color="red">episode</font></p>
</div>
  <div class="row">
  <div class="col"><div class="card text-white bg-primary" style="max-width: 18rem;">
  <div class="card-header">All Movies</div>
  <div class="card-body">
    <h5 class="card-title">'.$ple.' Movies</h5>
    <p class="card-text"><i class="fa-solid fa-camera-movie"></i></p>
  </div>
</div>
</div>
<div class="col">
<div class="card text-white bg-danger" style="max-width: 18rem;">
  <div class="card-header">All TV Series</div>
  <div class="card-body">
    <h5 class="card-title">'.$tv.' Movies</h5>
    <p class="card-text"><i class="fa-solid fa-tv"></i> </p>
  </div>
</div>
</div><div class="col">
<div class="card text-dark bg-warning" style="max-width: 18rem;">
  <div class="card-header">Active Server</div>
  <div class="card-body">
    <h5 class="card-title">20 Sever</h5>
    <p class="card-text"><i class="fa-solid fa-server"></i></p>
  </div>
</div>
</div><div class="col">
<div class="card text-white bg-success" style="max-width: 15rem;">
  <div class="card-header">Total Member</div>
  <div class="card-body">
    <h5 class="card-title">'.$mem.' Member</h5>
    <p class="card-text"><i class="fa-solid fa-users-gear"></i></p>
  </div>
</div>
</div>

';
        break;
}
require_once('footer.php');
?>

<?php
session_start();
require_once('../includes/Database.php');
$dbClass = new Database();
$dbh = $dbClass->getDb(); 
// Get Loading & Adblock
$setting = $dbh->prepare("SELECT * FROM `settings`");
$setting->execute();
$st = $setting->fetch();
$register = (!empty($st['register'])) ? $st['register'] : '';
if(isset($_POST['submit']))
{
	if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{   
			$sql = "select * from members where email = :email ";
			$handle = $dbh->prepare($sql);
			$params = ['email'=>$email];
			$handle->execute($params);
			if($handle->rowCount() > 0)
			{
				$getRow = $handle->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password, $getRow['password']))
				{
					unset($getRow['password']);
					$_SESSION = $getRow;
					header('location: index.php');
					exit();
				}
				else
				{
					$errors[] = "Wrong Email or Password";
				}
			}
			else
			{
				$errors[] = "Wrong Email or Password";
			}
			
		}
		else
		{
			$errors[] = "Email address is not valid";	
		}

	}
	else
	{
		$errors[] = "Email and Password are required";	
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Embed Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
 <body class="bg-primary bg-pattern">
<div class="account-pages my-5 pt-5"><div class="container"><div class="row justify-content-center"><div class="col-lg-5"><div class="card"><div class="card-body p-4"><div class="p-2">
<h5 class="text-center">Login</h5>	
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
				}
			?>
         <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		    <div class="mb-3">
                    <label class="form-label"><b>Email</b></label>
                     <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
			<div class="mb-3">
                    <label class="form-label"><b>Password<b></label>
                     <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
			 <button type="submit" name="submit" class="btn btn-info btn-block"><b style="color:#fff">Login</b></button> 
			 <?php if($register == 1){ ?>
			              <a href="/register.html" class="btn btn-info btn-block"><b style="color:#fff">Register</b></a>
             <?php } ?>			 
			 <br />
			 <div class="text-sm-center d-none d-sm-block">
                                    2022 <i class="mdi mdi-heart text-danger"></i> By <a href="https://www.facebook.com/haun.ytb/" target="_blank" title="Ancokplayer">Hậu Nguyễn</a>
                                </div>
		 </form>
<?php
session_start();
require_once('../includes/Database.php');
$dbClass = new Database();
$pdo = $dbClass->getDb(); 

// Get Loading & Adblock
$setting = $pdo->prepare("SELECT * FROM `settings`");
$setting->execute();
$st = $setting->fetch();
$register = (!empty($st['register'])) ? $st['register'] : '';
// allow register
if($register == 1){
	
if(isset($_POST['submit']))
{
    if(isset($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']))
    {
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        $options = array("cost"=>4);
        $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
        $date = date('Y-m-d H:i:s');

        if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
            $sql = 'select * from members where email = :email';
            $stmt = $pdo->prepare($sql);
            $p = ['email'=>$email];
            $stmt->execute($p);
            
            if($stmt->rowCount() == 0)
            {
                $sql = "insert into members (first_name, last_name, email, `password`, created_at,updated_at) values(:fname,:lname,:email,:pass,:created_at,:updated_at)";
            
                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':fname'=>$firstName,
                        ':lname'=>$lastName,
                        ':email'=>$email,
                        ':pass'=>$hashPassword,
                        ':created_at'=>$date,
                        ':updated_at'=>$date
                    ];
                    
                    $handle->execute($params);
                    
                    $success = 'User has been created successfully';
                    
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }
            }
            else
            {
                $valFirstName = $firstName;
                $valLastName = $lastName;
                $valEmail = '';
                $valPassword = $password;

                $errors[] = 'Email Already Used';
            }
        }
        else
        {
            $errors[] = "Invalid email";
        }
    }
    else
    {
        if(!isset($_POST['first_name']) || empty($_POST['first_name']))
        {
            $errors[] = 'Please Enter Last Name';
        }
        else
        {
            $valFirstName = $_POST['first_name'];
        }
        if(!isset($_POST['last_name']) || empty($_POST['last_name']))
        {
            $errors[] = 'Please Enter Name';
        }
        else
        {
            $valLastName = $_POST['last_name'];
        }

        if(!isset($_POST['email']) || empty($_POST['email']))
        {
            $errors[] = 'Email Cant Be Blank';
        }
        else
        {
            $valEmail = $_POST['email'];
        }

        if(!isset($_POST['password']) || empty($_POST['password']))
        {
            $errors[] = 'Password can not be blank';
        }
        else
        {
            $valPassword = $_POST['password'];
        }
        
    }

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="https://cdn.staticaly.com/gh/domkiddie/drive/master/assets/img/favicon.png"> 
    <!-- Meta -->
    <meta name="author" content="Hậu Nguyễn">
    <title>Register</title>    
   <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" /> 
 <link rel="stylesheet" href="../assets/css/style.css">		
</head>
 <body class="bg-primary bg-pattern">
<div class="account-pages my-5 pt-5"><div class="container"><div class="row justify-content-center"><div class="col-lg-5"><div class="card"><div class="card-body p-4"><div class="p-2">
<h5 class="text-center"><b>Register</b></h5>	
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
                }
                
                if(isset($success))
                {
                    
                    echo '<div class="alert alert-success">'.$success.'</div>';
                }
			?>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
					<label for="email"><b>First name</b></label>
					<input type="text" name="first_name" placeholder="Enter Your First Name" class="form-control" value="<?php echo ($valFirstName??'')?>">
				</div>
                <div class="form-group">
					<label for="email"><b>Last Name</b></label>
					<input type="text" name="last_name" placeholder="Enter Your Last Name" class="form-control" value="<?php echo ($valLastName??'')?>">
				</div>

                <div class="form-group">
					<label for="email"><b>Email </b></label>
					<input type="text" name="email" placeholder="Enter Email" class="form-control" value="<?php echo ($valEmail??'')?>">
				</div>
				<div class="form-group">
				<label for="email"><b>Password</b></label>
					<input type="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo ($valPassword??'')?>">
				</div><br />
				<button type="submit" name="submit" class="btn btn-primary"><b>Register</b></button><br />
				<p class="pt-2"> Back <a href="login.html">Login</a></p>
				 <div class="text-sm-center d-none d-sm-block">
                                    2022 <i class="mdi mdi-heart text-danger"></i> By <a href="https://www.facebook.com/haun.ytb/" target="_blank" title="Hậu Nguyễn">Hậu Nguyễn</a>
                                </div>
				
			</form>
		</div>
	</div>
</div>
</body>
</html>
<?php 
} else {
	echo '<center>Registration Function Closed</center>';
}
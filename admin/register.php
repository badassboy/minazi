<?php
include_once 'inc/functions.php';
session_start();

if(isset($_SESSION['minazi_auth']) && $_SESSION['minazi_auth'] === true){
	echo '<script>window.location="'.admin_base.'index.php";</script>';exit;
}

if(isset($_POST['uob'])){
	$email = strip_tags($_POST['email']);
    $name = strip_tags($_POST['name']);
    $pass = strip_tags($_POST['pass']);
    $rpass = strip_tags($_POST['rpass']);
    // $tk = strip_tags($_POST['tk']);
    
    $op->where('email', $email);
    $op->get(users);

    if ($op->count > 0 ) {
        $_SESSION['minazi_mgs'] = '$.notify("Email Already Taken!", "error");';
    }

 //    elseif($tk != mytoken){
	// 	$_SESSION['minazi_mgs'] = '$.notify("Wrong Token Entered!", "error");';
	// } 

	else {
		$passes = password_hash($pass, PASSWORD_DEFAULT);
        $hat = array(
			'first_name' => $name,
			'email' => $email,
			'password' => $passes,
			'status' => 1,
		);
		$op->insert(users,$hat);

		//record session
		$_SESSION['minazi_auth'] = true;
		$_SESSION['minazi-id'] = $email;
		$_SESSION['minazi-role'] = '';

		// login failed save error to a session
        $_SESSION['minazi_mgs'] = '$.notify("Registration Successful!", "success");'; 
		echo '<script>window.location="'.admin_base.'index.php";</script>';exit;
    }
}
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>LogIn | <?=appName?></title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-6 col-lg-4 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Admin Panel</h1>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="" method="POST" onSubmit="return checkform()">
										<div class="mb-3">
											<input class="form-control form-control-lg" type="text"
												id="name" name="name" autocomplete="off" placeholder="Name" value="<?=$name ?? ''?>" />
										</div>
										<div class="mb-3">
											<input class="form-control form-control-lg" type="email"
												id="email" name="email" autocomplete="off" placeholder="Email" value="<?=$email ?? ''?>" />
										</div>
										<div class="mb-3">
											<input class="form-control form-control-lg" type="password" 
												id="pass" name="pass" autocomplete="off" placeholder="Password" value="<?=$pass ?? ''?>" />
										</div>
										<div class="mb-3">
											<input class="form-control form-control-lg" type="password" 
												id="rpass" name="rpass" autocomplete="off" placeholder="Repeat Password" value="<?=$rpass ?? ''?>" />
										</div>

										<div class="mb-3">
											
												<a href="login.php">Login</a>
											</small>
										</div>
										
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="uob">Register</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/notify.js"></script>

	<script>
        <?php if (isset($_SESSION['minazi_mgs'])) { echo $_SESSION['minazi_mgs']; unset($_SESSION['minazi_mgs']); }?>
    </script>

	<script>
        function checkform() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var pass = document.getElementById('pass').value;
            var rpass = document.getElementById('rpass').value;
            var tk = document.getElementById('tk').value;
            if (name === '') {
                $.notify("Enter Your Name!", "error");
                return false;
            } else if (email === '') {
                $.notify("Enter Your Email Address!", "error");
                return false;
            } else if (pass === '') {
                $.notify("Enter Your Password!", "error");
                return false;
            } else if (rpass === '') {
                $.notify("Repeat Password!", "error");
                return false;
            } else if (tk === '') {
                $.notify("Enter Token!", "error");
                return false;
            } else {
                return true;
            }
        }
    </script>

</body>

</html>
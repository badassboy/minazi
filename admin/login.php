<?php
include_once 'inc/functions.php';
session_start();

if(isset($_SESSION['minazi_auth']) && $_SESSION['minazi_auth'] === true){
    header('Location: index.php');exit;
}else{
	//set session
	unset($_SESSION['minazi_auth']);
	unset($_SESSION['minazi-id']);
	unset($_SESSION['minazi-role']);
}

if(isset($_POST['lob'])){
	$email = strip_tags($_POST['email']);
    $pass = strip_tags($_POST['pass']);
    
    $op = new Mysqlidb(hostName, userName, userPass, hostDb);
    $op->where('status', 1);
    $op->where('email', $email);
    $pin = $op->getOne(users);

    if ($op->count == 1 ) {
        $passes = password_verify($pass, $pin['password']);

        if($passes){
            $id = $email; 
            $role = $pin['role'];

            //Set Session
            $_SESSION['minazi_auth'] = true;

            // reload the page
            $_SESSION['minazi-id'] = $id;
            $_SESSION['minazi-role'] = $role;
            $_SESSION['minazi_mgs'] = '$.notify("Welcome '.$pin[0]['full_name'].'!", "success");';
            header('Location: index.php');exit;
        } else {
            // login failed save error to a session
            $_SESSION['minazi_mgs'] = '$.notify("Wrong Credentials Entered!", "error");';
        }
    } else {
        // login failed save error to a session
        $_SESSION['minazi_mgs'] = '$.notify("Wrong Credentials Entered!", "error");';
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
											<input class="form-control form-control-lg" type="email"
												id="email" name="email" placeholder="Email" value="<?=$email ?? ''?>" autocomplete="off" />
										</div>
										<div class="mb-3">
											<input class="form-control form-control-lg" type="password" 
												id="pass" name="pass" placeholder="Password" value="<?=$pass ?? ''?>" />
											<small>
												<a href="forgot-pass.php">Forgot Password</a>
											</small> | 
											<small class="pull-right">
												<a href="register.php">Register Now</a>
											</small>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="lob">Log In</button>
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
            var email = document.getElementById('email').value;
            var pass = document.getElementById('pass').value;
            if (email === '') {
                $.notify("Enter Your Email Address!", "error");
                return false;
            } else if (pass === '') {
                $.notify("Enter Your Password!", "error");
                return false;
            } else {
                return true;
            }
        }
    </script>

</body>

</html>
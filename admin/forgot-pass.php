<?php
include_once 'inc/functions.php';
session_start();

if(isset($_POST['vob'])){
    $em = strip_tags($_POST['email']);
    $op->where('email',$em);
    $j = $op->get(users);
    if($op->count > 0){
        $token = bin2hex(random_bytes(16));
        $to = $em;
        $subject = 'Reset Password - Admin | Minazi.Store';
        $op->where('email',$em);
        $g = array(
            'token' => $token
        );
        $op->update(users,$g);
        $message = '
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
            <style>
                *{
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <img src="https://minazi.store/en/assets/img/minazi.png" alt="minazi.store"><br/>
            Click <a href="http://minazi.store/admin/reset-pass.php?token='.$token.'">here</a> to rest password
        </body>
        </html>';
        
        // Set content-type header for sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $message, $headers);
        $_SESSION['minazi_mgs'] = '$.notify("Go To Your Email to Reset Password!", "info");';
		echo '<script>window.location="'.admin_base.'login.php";</script>';exit;
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

	<title>Reset Password | <?=appName?></title>

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
									<form action="" method="POST">
										<div class="mb-3">
											<input class="form-control form-control-lg" type="email"
												id="email" name="email" placeholder="Email" value="<?=$email ?? ''?>" autocomplete="off" required />
											<small>
												<a href="login.php">Login</a>
											</small>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="vob">Verify</button>
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

</body>

</html>
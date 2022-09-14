<?php
include_once 'inc/functions.php';
session_start();
ob_start();

if(isset($_REQUEST['token']) && !empty($_REQUEST['token'])){
    $tk = $_REQUEST['token'];
}else{
	$_SESSION['minazi_mgs'] = '$.notify("Password Reset Failed!", "error");';
	echo '<script>window.location="'.admin_base.'login.php";</script>';exit;
}

$op->where('token', $tk);
$b = $op->getOne(users);

if($op->count == 0){
	$_SESSION['minazi_mgs'] = '$.notify("Password Reset Failed!", "error");';
	echo '<script>window.location="'.admin_base.'login.php";</script>';exit;
}

if(isset($_POST['hob'])){
    $npass = strip_tags($_POST['npass']);
    $rpass = strip_tags($_POST['rpass']);

    if($npass != $rpass){
        $_SESSION['minazi_mgs'] = '$.notify("Password Mismatch!", "error");';
    }else{
        $epass = password_hash($npass, PASSWORD_DEFAULT);
        $me = $b['email'];
        $g = array(
            'password' => $epass,
            'token' => ''
        );
        $op->where('email', $me);
        $op->update(users,$g);
        
        $_SESSION['minazi_mgs'] = '$.notify("Password Changed Successfully!", "success");';
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
											<input class="form-control form-control-lg" type="password"
												id="npass" name="npass" placeholder="New Password" value="<?=$email ?? ''?>" autocomplete="off" required />
										</div>
										<div class="mb-3">
											<input class="form-control form-control-lg" type="password"
												id="rpass" name="rpass" placeholder="Repeat Password" value="<?=$email ?? ''?>" autocomplete="off" required />
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="hob">Verify</button>
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
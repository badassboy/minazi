<?php include_once 'views/header.php'; 
ob_start();
$id = $_SESSION['minazi-id'];

$state = array(
	'0' => 'Inactive',
	'1' => 'Active'
);

if(isset($_POST['save-pass'])){
	$npass = strip_tags($_POST['npass']);
	$rpass = strip_tags($_POST['rpass']);
	if($npass != $rpass){
		$_SESSION['minazi_mgs'] = '$.notify("Password Mismatch!", "error");';
	}else{
		$mat = array(
			'password' => password_hash($npass, PASSWORD_DEFAULT),
		);
		$op->where('email',$id);
		$op->update(users,$mat);
		$_SESSION['minazi_mgs'] = '$.notify("Password Changed Successfully!", "success");';
		echo '<script>window.location="'.admin_base.'profile.php";</script>';exit;
	}
}

if(isset($_POST['save-us'])){
	$fname = strip_tags($_POST['fname']);
	$lname = strip_tags($_POST['lname']);
	$mat = array(
		'first_name' => $fname,
		'last_name' => $lname,
	);
	$op->where('email',$id);
	$op->update(users,$mat);
	$_SESSION['minazi_mgs'] = '$.notify("Profile Updated Successfully!", "success");';
	echo '<script>window.location="'.base.'profile.php";</script>';exit;

}

if(isset($_POST['save-dp'])){
	if(isset($_FILES['photo']) && !empty($_FILES['photo']["name"])){
		$allowedExts = array("jpeg", "jpg", "png");
		$bix = explode(".", $_FILES["photo"]["name"]);
		$extension = end($bix);
		if (($_FILES["photo"]["size"] < 1029049) && in_array($extension, $allowedExts)){
			$path = "img/users/";
			$new_name = $id;
			$ext_path = $path.$new_name.'.'.$extension;
			move_uploaded_file( $_FILES['photo']['tmp_name'], $ext_path );
			$mat = array(
				'photo' => $ext_path,
			);
			$op->where('email',$id);
			$op->update(users,$mat);
			$_SESSION['minazi_mgs'] = '$.notify("Profile Picture Saved!", "success");';
			echo '<script>window.location="'.admin_base.'profile.php";</script>';exit;
		}else{ $_SESSION['error-me'] = '<strong>Sorry!</strong> Image Upload Failed!';}
	}
	

}

$op->where('email', $id);
$us = $op->getOne(users);
?>

<body>
	<div class="wrapper">
		<?php include_once 'views/nav.php'; ?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<?php include_once 'views/user.php'; ?>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Profile</h1>

					<div class="row">
						<div class="col-sm-12 col-lg-4 col-xxl-4">
							<div class="card flex-fill">
								<div class="card-body">
									<div class="row">
										<form method="post" enctype="multipart/form-data">
										<div class="col-12 mb-3">
											<label for="" class="form-label">User's Image</label>
											<img id="dp-prev" src="<?=!empty($us['photo']) ? $us['photo'] : 'img/users/default.jpg'?>" class="rounded img-fluid" alt="...">	
										</div>
										<div class="col-12 text-center">
											<button type="button" class="btn btn-info" onclick="document.getElementById('photo').click()">Change</button>
											<button type="submit" id="save-dp" class="btn btn-success" name="save-dp" style="display:none">Save</button>
											<input type="file" id="photo" name="photo" style="display:none">
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-8 col-xxl-8 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
									<form method="POST">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
											<label for="" class="form-label">Users's Frist Name</label>
											<input type="text" class="form-control" placeholder="Frist Name" value="<?=$us['first_name']?>" name="fname" required>
										</div>
										<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
											<label for="" class="form-label">Users's Last Name</label>
											<input type="text" class="form-control" placeholder="Last Name" value="<?=$us['last_name']?>" name="lname" required>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
											<label for="" class="form-label">Users's Email</label>
											<input type="text" class="form-control" readonly placeholder="Email" value="<?=$us['email']?>" name="email">
										</div>
										<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
											<label for="" class="form-label">Users's Status</label>
											<select id="inputState" class="form-select" name="cat_id" disabled>
                                                    <?php foreach( $state as $n1 => $state ): ?>
                                                    <option value="<?php echo $n1 ?>"
                                                        <?php if( $n1 == $us['status']?: '' ): ?> selected="selected"
                                                        <?php endif; ?>><?php echo $state ?></option>
                                                    <?php endforeach; ?>
											</select>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col">
											<input type="submit" class="btn btn-primary form-control" name="save-us" value="Update Profile">
										</div>
									</div>
									</form>
									<form method="POST">
									<div class="row mt-3">
										<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
											<label for="" class="form-label">New Password</label>
											<input type="password" class="form-control" placeholder="New Password" value="<?=$npass ?? ''?>" name="npass" required>
										</div>
										<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
											<label for="" class="form-label">Repeat Password</label>
											<input type="password" class="form-control" placeholder="Repeat Password" value="<?=$rpass ?? ''?>" name="rpass" required>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col">
											<input type="submit" class="btn btn-primary form-control" name="save-pass" value="Change Password">
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<footer class="footer">
				<?php include_once 'views/footer.php'; ?>
			</footer>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/notify.js"></script>

	<script>
        <?php if (isset($_SESSION['minazi_mgs'])) { echo $_SESSION['minazi_mgs']; unset($_SESSION['minazi_mgs']); }?>
    </script>
	<script>
		function display(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (event) {
					$('#dp-prev').attr('src', event.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#photo").change(function () {
			display(this);
			$("#save-dp").show();
		});
	</script>

</body>

</html>
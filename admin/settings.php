<?php include_once 'views/header.php'; 

if(isset($_POST['save-mt'])){
	$title = $_POST['title'];
	$key = $_POST['key'];
	$desc = $_POST['desc'];

	$yat = array(
		'meta_key' => $_POST['key'],
		'meta_desc' => $_POST['desc'],
	);
	$op->where('meta_title',$title);
	$op->update(metadata,$yat);
	$_SESSION['minazi_mgs'] = '$.notify("Meta Data Updated!", "success");';
	echo '<script>window.location="'.admin_base.'settings.php";</script>';exit;
	
}

$bit = $op->get(metadata);

if(isset($_POST['meta-title'])){
	$tl = $_POST['meta-title'];
	$op->where('meta_title',$tl);
	$vit = $op->getOne(metadata);
}else{
	$op->where('meta_title','Home');
	$vit = $op->getOne(metadata);
}
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

					<h1 class="h3 mb-3">Settings</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile"
												role="tab" aria-controls="profile" aria-selected="false">Meta-Data</a>
										</li>
										<li class="nav-item" role="presentation">
											<a class="nav-link" id="logo-tab" data-bs-toggle="tab" href="#logo"
												role="tab" aria-controls="log" aria-selected="true">Logo</a>
										</li>
									</ul>
								</div>
								<div class="card-body">

									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade" id="logo" role="tabpanel"
											aria-labelledby="logo-tab">...</div>
										<div class="tab-pane fade show active" id="profile" role="tabpanel"
											aria-labelledby="profile-tab">
											<form id="title" method="POST">
											<div class="row g-3 align-items-center">
												<div class="col-auto">
													<label class="col-form-label">Page Title</label>
													<select class="form-select" name="meta-title" onchange="this.form.submit()">
														<?php foreach($bit as $tag):?>
														<option <?php if($vit['meta_title'] == $tag['meta_title']){echo 'selected';}?> ><?=$tag['meta_title']?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="col-auto">
													<span class="form-text">
														Select Page.
													</span>
												</div>
											</div>
											</form>
											<form method="POST">
											<div class="row g-3 mt-2 align-items-center">
												<div class="col-6">
													<label for="" class="col-form-label">Keywords</label>
													<textarea class="form-control" name="key" rows="2"><?=$vit['meta_key']?></textarea>
													<input type="hidden" name="title" value="<?=$vit['meta_title']?>">
												</div>
												<div class="col-auto">
													<span class="form-text">
														Keywords to be used for the this page.
													</span>
												</div>
											</div>
											<div class="row g-3 mt-2 align-items-center">
												<div class="col-6">
													<label for="" class="col-form-label">Description</label>
													<textarea class="form-control" name="desc" rows="4"><?=$vit['meta_desc']?></textarea>
												</div>
												<div class="col-auto">
													<span class="form-text">
														Description of items listed as keywords.
													</span>
												</div>
											</div>
											<div class="row g-3 mt-2 align-items-center">
												<div class="col-auto">
													<input type="submit" name="save-mt" class="btn btn-primary" value="Save Meta-Data">
												</div>
											</div>
											</form>
										</div>
										<div class="tab-pane fade" id="contact" role="tabpanel"
											aria-labelledby="contact-tab">...</div>
									</div>
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

	<script src="js/app.js"></script>

</body>

</html>
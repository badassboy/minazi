<?php include_once 'views/header.php'; 

if(isset($_GET['item']) && !empty($_GET['item'])){
	$item = $_GET['item'];

	$op->where('cat_id', $item);
	$cat = $op->getOne(categories);

	if(isset($_POST['up-cat'])){
		if(isset($_FILES['cat_img']) && !empty($_FILES['cat_img']["name"])){
			$allowedExts = array("jpeg", "jpg", "png");
			$bix = explode(".", $_FILES["cat_img"]["name"]);
			$extension = end($bix);
			if (($_FILES["cat_img"]["size"] < 1029049) && in_array($extension, $allowedExts)){
				$path = "assets/img/category/";
				$new_name = $gt;
				$ext_path = $path.$new_name.'.'.$extension;
				move_uploaded_file( $_FILES['cat_img']['tmp_name'], '../en/'.$ext_path );
			}else{ $_SESSION['error-me'] = '<strong>Sorry!</strong> Image Upload Failed!';}
		}
		$data = array(
			'cat_name' => $_POST['p_name'],
			'cat_img' => isset($ext_path)? $ext_path : $cat['cat_img']
		);
		$op->where('cat_id', $item);
		$op->update(categories, $data);
		echo '<script>window.location="'.admin_base.'categories.php";</script>';exit;
	}
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
				<form method="POST" action="" enctype="multipart/form-data">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Edit Product</h1>

					<div class="row">
					
					<?php if($item): ?>
					<div class="col-sm-12 col-lg-4 col-xxl-4">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="row">
									<div class="col-12 mb-3">
										<label for="" class="form-label">Category's Image</label>
										<img id="dp-prev" src="../en/<?=!empty($cat['cat_img']) ? $cat['cat_img'] : 'assets/img/products/new.png'?>" class="rounded img-fluid" alt="...">	
									</div>
									<div class="col-12 text-center">
										<button type="button" class="btn btn-success" onclick="document.getElementById('cat_img').click()">Change</button>
										<input type="file" id="cat_img" name="cat_img" style="display:none">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-lg-8 col-xxl-8 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="row">
									<div class="col mb-3">
										<label for="" class="form-label">Category's Name</label>
										<input type="text" class="form-control" placeholder="Product's Name" value="<?=$cat['cat_name']?>" name="cat_name">
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col">
										<input type="submit" class="btn btn-primary form-control" name="up-prod" value="Update Category">
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endif?>
					
					</div>

				</div>
				</form>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								...
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
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
	<script src="js/summernote.js"></script>

	<script>
		$(document).ready(function() {
			$('#summernote').summernote();
			$('#summernote1').summernote();
			$('#summernote2').summernote();
		});
		function display(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (event) {
					$('#dp-prev').attr('src', event.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#cat_img").change(function () {
			display(this);
		});
	</script>

</body>

</html>
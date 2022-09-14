<?php include_once 'views/header.php'; 

if(isset($_GET['item']) && !empty($_GET['item'])){
	$item = $_GET['item'];

	$op->where('p_id', $item);
	$pro = $op->getOne(products);

	if(isset($_POST['up-prod'])){
		if(isset($_FILES['ft_photo']) && !empty($_FILES['ft_photo']["name"])){
			$allowedExts = array("jpeg", "jpg", "png");
			$bix = explode(".", $_FILES["ft_photo"]["name"]);
			$extension = end($bix);
			if (($_FILES["ft_photo"]["size"] < 1029049) && in_array($extension, $allowedExts)){
				$path = "assets/img/products/";
				$new_name = $gt;
				$ext_path = $path.$new_name.'.'.$extension;
				move_uploaded_file( $_FILES['ft_photo']['tmp_name'], '../en/'.$ext_path );
			}else{ $_SESSION['error-me'] = '<strong>Sorry!</strong> Image Upload Failed!';}
		}
		$data = array(
			'p_name' => $_POST['p_name'],
			'p_old_price' => $_POST['p_old_price'],
			'p_current_price' => $_POST['p_current_price'],
			'p_qty' => $_POST['p_qty'],
			'p_remaining' => $_POST['p_remaining'],
			'p_ft_photo' => isset($ext_path)? $ext_path : $pro['p_ft_photo'],
			'p_code' => $_POST['p_code'],
			'p_description' => $_POST['p_description'],
			'p_short_description' => $_POST['p_short_description'],
			'p_keyword' => $_POST['p_keyword'],
			'p_return_policy' => $_POST['p_return_policy'],
			'p_total_view' => $_POST['p_total_view'],
			'p_is_featured' => $_POST['p_is_featured'],
			'p_is_active' => $_POST['p_is_active'],
			'cat_id' => $_POST['cat_id']
		);
		$op->where('p_id', $item);
		$op->update(products, $data);
		echo '<script>window.location="'.admin_base.'products.php";</script>';exit;
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
										<label for="" class="form-label">Product's Image</label>
										<img id="dp-prev" src="../en/<?=!empty($pro['p_ft_photo']) ? $pro['p_ft_photo'] : 'assets/img/products/new.png'?>" class="rounded img-fluid" alt="...">	
									</div>
									<div class="col-12 text-center">
										<button type="button" class="btn btn-success" onclick="document.getElementById('ft_photo').click()">Change</button>
										<input type="file" id="ft_photo" name="ft_photo" style="display:none">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-lg-8 col-xxl-8 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Category</label>
										<select id="inputState" class="form-select" name="cat_id">
											<?=setCatOpt($pro['cat_id'])?>
										</select>
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Product's Name</label>
										<input type="text" class="form-control" placeholder="Product's Name" value="<?=$pro['p_name']?>" name="p_name">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Product's Keyword</label>
										<input type="text" class="form-control" placeholder="Product's Keyword" value="<?=$pro['p_keyword']?>" name="p_keyword">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Old Pirce</label>
										<input type="text" class="form-control" placeholder="Old Price" value="<?=$pro['p_old_price']?>" name="p_old_price">
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Current Price</label>
										<input type="text" class="form-control" placeholder="Current Price" value="<?=$pro['p_current_price']?>" name="p_current_price">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Quantity</label>
										<input type="number" class="form-control" placeholder="Quantity" value="<?=$pro['p_qty']?>" name="p_qty">
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Remaining</label>
										<input type="number" class="form-control" placeholder="Remaining"  value="<?=$pro['p_remaining']?>" name="p_remaining">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-12 mb-3">
										<label for="" class="form-label">Product's Short Description</label>
										<textarea class="form-control" id="summernote1" rows="3" name="p_short_description"><?=$pro['p_short_description']?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-12 mb-3">
										<label for="" class="form-label">Product's Description</label>
										<textarea class="form-control" id="summernote" rows="3" name="p_description"><?=$pro['p_description']?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-12 mb-3">
										<label for="" class="form-label">Product's Return Policy</label>
										<textarea class="form-control" id="summernote2" name="p_return_policy" rows="3"><?=$pro['p_return_policy']?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Product's Code</label>
										<input type="text" class="form-control" placeholder="Product's Code" value="<?=$pro['p_code']?>" name="p_code">
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Product's Views</label>
										<input type="text" readonly class="form-control-plaintext" placeholder="Product's Views" value="<?=$pro['p_total_view']?>" name="p_total_view">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Featured Product?</label>
										<select id="inputState" class="form-select" name="p_is_featured">
											<?=setFtProd($pro['p_is_featured'])?>
										</select>
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
										<label for="" class="form-label">Product's Status</label>
										<select id="inputState" class="form-select" name="p_is_active">
											<?=setProdSt($pro['p_is_active'])?>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col">
										<input type="submit" class="btn btn-primary form-control" name="up-prod" value="Update Product">
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

		$("#ft_photo").change(function () {
			display(this);
		});
	</script>

</body>

</html>
<?php 

include_once 'views/header.php';

if(isset($_POST['in-prod'])){

	// database connection
	try{
    $pdo = new PDO("mysql:host=localhost;dbname=minazy", "root", "");

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

	
	 		$path = "intro_img/";
			 $errors = array();
		      $file_name = $_FILES["photo"]['name'];
		     
		      $file_size = $_FILES['photo']['size'];

		      $file_tmp = $_FILES['photo']['tmp_name'];
		      $file_type = $_FILES['photo']['type'];
		     

		      $test_file = $path.basename($_FILES["photo"]["name"]);
		      $file_ext = pathinfo($test_file, PATHINFO_EXTENSION);

		      $extensions= array("jpeg","jpg","png","gif");

		      if(in_array($file_ext,$extensions) === false){
		         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		      }

		      if($file_size > 4097152) {
		         $errors[]='File size must be exactly 2MB';
		      }

		      if (empty($errors) == TRUE) {
		      	move_uploaded_file($file_tmp, "intro_img/".$file_name);
		      }



	


	$title = htmlspecialchars(trim($_POST['title']));
	// echo $title;
	$description = htmlspecialchars(trim($_POST['desc']));

	// echo $description;



 
// Attempt insert query execution
try{
    $sql = "INSERT INTO intro (title, intro_img, description) VALUES ('$title', 'intro_img/".$file_name."', '$description')";    
    $pdo->exec($sql);
    echo "Records inserted successfully.";
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($pdo);



	




	// $_SESSION['success-me'] = '<strong>Congrats!</strong> Intro Added Successfully!';
	// echo '<script>window.location="'.admin_base.'intro.php";</script>';exit;
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

					<h1 class="h3 mb-3">Add Intro</h1>

					<div class="row">
					
					
					
					<div class="col-sm-12 col-lg-8 col-xxl-8 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								
		<!-- <div class="row"> -->

			<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
				<label for="" class="form-label">Title</label>
				<input type="text" class="form-control" placeholder="Main title" name="title">

				
			</div>

			<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
				<label for="" class="form-label">Intro Image</label>
				<input type="file" name="photo" class="form-control-file">

				

				
			</div>


			<div class="col-sm-12 col-md-12 col-lg-6 mb-3">
				<label for="" class="form-label">Description</label>
				<textarea class="form-control" name="desc" placeholder="Description"></textarea>
				<!-- <input type="text" class="form-control" placeholder="Product's Name" name="p_name"> -->
			</div>
		<!-- </div> -->

								

								

								
								

								<hr>
								<div class="row">
									<div class="col">
										<input type="submit" class="btn btn-success form-control" name="in-prod" value="Add Intro">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					</div>

				</div>
				</form>

				<!-- Modal -->
				<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				</div> -->

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


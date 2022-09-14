<?php include_once 'views/header.php'; ?>

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

					<button class="btn btn-sm btn-primary float-end" onclick="window.location.href='categ-add.php'">Add Category</button>
					<h1 class="h3 mb-3">Categories</h1>

				<div class="row">

				<div class="col-12 col-lg-12 col-xxl-12 d-flex">
					<div class="card flex-fill">
						<div class="card-body table-responsive">
						<table  id="example" class="table table-hover table-striped my-0" id="example" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">S/N</th>
										<th class="text-center">Photo</th>
										<th class="text-center">Category's Name</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									$op->orderBy('cat_id', 'desc');
									$it = $op->get(categories);
									foreach($it as $cat) { ?>
									<tr>
										<td class="text-center"><?=$i++?></td>
										<td class="text-center"><img src="../en/<?=$cat['cat_img']?>" alt="<?=$cat['cat_name']?>" width="40px"></td>
										<td class="text-center"><?=$cat['cat_name']?></td>
										<td>
										<div class="dropdown">
											<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
												Action
											</button>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
												<li><a class="dropdown-item" onclick="window.location.href='categ-edit.php?item=<?=$cat['cat_id']?>'">Edit</a></li>
												<li><a class="dropdown-item conf-del" data-id="<?=$cat['cat_id']?>" data-bs-toggle="modal" data-bs-target="#delModal">Delete</a></li>
											</ul>
											</div>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				</div>

				</div>

				
				<!-- Modal -->
				<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Deletion!</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-center">
								<b>Are you sure of deleting this Category?</b>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
								<button type="button" class="btn btn-danger confirm-del" name="confirm">Yes</button>
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
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/notify.js"></script>

	<script>
        <?php if (isset($_SESSION['minazi_mgs'])) { echo $_SESSION['minazi_mgs']; unset($_SESSION['minazi_mgs']); }?>
    </script>

	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		$('.conf-del').on('click', function (e) {
			var id = $(this).attr('data-id');
			$('.confirm-del').attr('data-id',id);
		});
		$(".confirm-del").on('click', function (e) {
			var id = $(this).attr('data-id');
			location.href="categ-del?id="+id;
		});
	</script>

</body>

</html>
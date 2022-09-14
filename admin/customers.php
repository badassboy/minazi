<?php include_once 'views/header.php'; 

function ckCountry($f){
	if($f == 1){
		return 'United Arab Emirates';
	}elseif($f == 2){
		return 'Ghana';
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
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Customers</h1>

					<div class="row">
					
					<div class="col-12 col-lg-12 col-xxl-12 d-flex">
						<div class="card flex-fill">
							<div class="card-body table-responsive">
							<table  id="example" class="table table-hover table-striped my-0" id="example" style="width:100%">
									<thead>
										<tr>
											<th>S/N</th>
											<th class="d-none d-xl-table-cell">Photo</th>
											<th class="d-none d-xl-table-cell">Customer's Name</th>
											<th>Contact</th>
											<th class="text-center">Email</th>
											<th class="text-center">Country</th>
											<th>City</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										$op->orderBy('c_id', 'desc');
										$it = $op->get(customers);
										foreach($it as $cust):?>
										<tr>
											<td class="text-center"><?=$i++?></td>
											<td class="d-none d-xl-table-cell"><img src="<?=(isset($cust['c_dp']) && !empty($cust['c_dp'])) ? '../en/'.$cust['c_dp'] : 'img/users/default.jpg'?>" alt="<?=$cust['c_id']?>" width="40px"></td>
											<td class="d-none d-xl-table-cell"><?=$cust['c_fname'].' '.$cust['c_lname']?></td>
											<td class="text-center"><?=$cust['c_phone']?></td>
											<td class="text-center"><?=$cust['c_email']?></td>
											<td class="text-center"><?=ckCountry($cust['c_country'])?></td>
											<td class="text-center"><?=$cust['c_city']?></td>
											<td class="text-center"><?=ckStatus($cust['c_status'])?></td>
											<td>
											<div class="dropdown">
												<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
													Action
												</button>
												<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
													<?php if($cust['c_status'] != 1):?><li><a class="dropdown-item conf-act" data-ids="<?=$cust['c_id']?>" data-bs-toggle="modal" data-bs-target="#actModal">Activate</a></li>
													<?php else:?><li><a class="dropdown-item conf-dec" data-id="<?=$cust['c_id']?>" data-bs-toggle="modal" data-bs-target="#decModal">Deactivate</a></li><?php endif?>
												</ul>
												</div>
											</td>
										</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					</div>

				</div>

				
				<!-- Modal -->
				<div class="modal fade" id="decModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Deactivation!</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-center">
								<b>Are you sure of Deactivating this customer?</b>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
								<button type="button" class="btn btn-danger confirm-dec" name="confirm">Yes</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="actModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Activation!</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-center">
								<b>Are you sure of Activating this customer?</b>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
								<button type="button" class="btn btn-danger confirm-act" name="aconfirm">Yes</button>
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

		$('.conf-act').on('click', function (e) {
			var ids = $(this).attr('data-ids');
			$('.confirm-act').attr('data-ids',ids);
		});
		$(".confirm-act").on('click', function (e) {
			var ids = $(this).attr('data-ids');
			location.href="custom.php?id="+ids+"&stat=0";
		});

		$('.conf-dec').on('click', function (e) {
			var id = $(this).attr('data-id');
			$('.confirm-dec').attr('data-id',id);
		});
		$(".confirm-dec").on('click', function (e) {
			var id = $(this).attr('data-id');
			location.href="custom.php?id="+id+"&stat=1";
		});
	</script>

</body>

</html>
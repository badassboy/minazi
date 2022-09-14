<?php 
include_once 'views/header.php'; 

function getCust($i){
	global $op;
	$op->where('c_id',$i);
	$rov = $op->getOne(customers);
	return '<div>
				ID: '.$rov['c_id'].'<br>
				Name: '.$rov['c_fname'].' '.$rov['c_lname'].'<br>
			</div>';
}

function getProd($p){
	global $op;
	$op->where('p_id',$p);
	$rov = $op->getOne(products);
	echo   'Product: '.$rov['p_name'];
	
}

function getMe($f){
	global $op;
	$op->where('order_id',$f);
	$rov = $op->get(orders);
	//print_r($rov);
	echo '<div>';
	foreach($rov as $nim){
		echo getProd($nim['p_id']).'<br> Quantity: '.$nim['quantity'].'<br>';
	}
	echo '</div>';
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

					<h1 class="h3 mb-3">Orders</h1>

				<div class="row">

				<div class="col-12 col-lg-12 col-xxl-12 d-flex">
					<div class="card flex-fill">
						<div class="card-body table-responsive">
						<table  id="example" class="table table-hover table-striped my-0" id="example" style="width:100%">
								<thead>
									<tr> 
										<th>S/N</th>
										<th>Customer Details</th>
										<th>Product Details</th>
										<th>Payment Information</th>
										<th>Paid Amount</th>
										<th>Payment Status</th>
										<th>Delivery Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									$op->orderBy('pay_id', 'desc');
									$it = $op->get(payments);
									foreach($it as $ord) { ?>
									<tr>
										<td class="text-center"><?=$i++?></td>
										<td class="d-none d-xl-table-cell"><div><?=$ord['order_add']?></div></td>
										<td class=""><?=getMe($ord['order_id'])?></td>
										<td class="text-center"><?=$ord['pay_type']?></td>
										<td class="text-center"><?=curcy().$ord['paid_amount']?></td>
										<td class="text-center"><span class="badge bg-success"><?=$ord['payment_status']?></span></td>
										<td class="text-center"><span class="badge bg-info"><?=$ord['shipping_status']?></span></td>
										<td>
										<div class="dropdown">
											<button  class="btn btn-sm btn-danger conf-del" data-id="<?=$ord['order_id']?>" data-bs-toggle="modal" data-bs-target="#delModal">Delete</button>
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
								<h5 class="modal-title" id="exampleModalLabel">Deleting Order</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-center">
								<b>Are you sure of deleting this Order?</b>
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

	<script src="js/jquery.min.js"></script>
	<script src="js/app.js"></script>
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
			location.href="order-del.php?trans="+id;
		});
	</script>

</body>

</html>
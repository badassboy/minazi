<?php include_once 'views/header.php'; 

function countItem($h){
	global $op;
	$op->get($h);
	return $op->count;
}

function countStat($db,$field, $value){
	global $op;
	$op->where($field,$value);
	$op->get($db);
	return $op->count;
}

function countStati($db,$field, $value){
	global $op;
	$op->where($field,$value);
	$op->where('shipping_status','pending');
	$op->get($db);
	return $op->count;
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

					<h1 class="h3 mb-3">Dashboard</h1>

					<div class="row">

						

						<div class="col-md-4 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Products</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="gift"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?=countItem(products)?></h1>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Customers</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="user-plus"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?=countItem(customers)?></h1>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Complete Orders</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="shopping-bag"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?=countStat(payments, 'payment_status', 'completed')?></h1>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Pending Orders</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="truck"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?=countStat(payments, 'payment_status', 'pending')?></h1>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Messages</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="mail"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?=countItem(messages)?></h1>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Categories</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="tag"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?=countItem(categories)?></h1>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Users</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="users"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?=countItem(users)?></h1>
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

</body>

</html>
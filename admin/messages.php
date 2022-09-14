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

					<h1 class="h3 mb-3">Messages</h1>

					<div class="row">
					
					<div class="col-12 col-lg-12 col-xxl-12 d-flex">
						<div class="card flex-fill">
							<div class="card-body table-responsive">
							<table  id="example" class="table table-hover table-striped my-0" id="example" style="width:100%">
									<thead>
										<tr>
											<th class="text-center">S/N</th>
											<th class="text-center">Subject</th>
											<th>Content</th>
											<th class="text-center">Email</th>
											<th class="text-center">Sender's Name</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										$it = $op->get(messages);
										foreach($it as $msgs) { ?>
										<tr>
											<td class="text-center"><?=$i++?></td>
											<td class="text-center"><b><?=$msgs['msg_subj']?></b></td>
											<td><?=$msgs['msg_content']?></td>
											<td class="text-center"><?=$msgs['msg_email']?></td>
											<td class="text-center"><?=$msgs['msg_fullname']?></td>
											<td>
												<div class="">
													<button class="btn btn-sm btn-danger conf-del" type="button" id="" data-id="<?=$msgs['msg_i']?>" data-bs-toggle="modal" data-bs-target="#delModal">
														Delete
													</button>
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
								<b>Are you sure of deleting this Message?</b>
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
			location.href="msg-del.php?id="+id;
		});
	</script>

</body>

</html>
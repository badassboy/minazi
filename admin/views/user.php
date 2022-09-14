<?php
function reveal($b){
	global $op;
	$op->where('email', $_SESSION['minazi-id']);
	$h = $op->getOne(users);
	if($op->count > 0){
		return $h[$b];
	}
}
?><ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="<?=!empty(reveal('photo'))? reveal('photo'): 'img/users/default.jpg'?>" class="avatar img-fluid rounded me-1" alt="<?=reveal('first_name')?>" /> <span
									class="text-dark"><?=reveal('first_name')?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
							    <a class="dropdown-item" href="./profile.php"><i class="align-middle me-1" data-feather="user"></i>
							        Profile</a>
							    <div class="dropdown-divider"></div>
							    <a class="dropdown-item" href="dismiss.php"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
							</div>
						</li>
					</ul>
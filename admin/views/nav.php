<?php
function dashAct($x){
    if(chkUrl() == $x)
    return 'active';
}

?><nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
			    <a class="sidebar-brand" href="index.php">
			        <span class="align-middle"><?=appName?></span>
			    </a>

			    <ul class="sidebar-nav">
			        <li class="sidebar-header">
			            Pages
			        </li>

			        <li class="sidebar-item <?=dashAct('index')?>">
			            <a class="sidebar-link" href="./index.php">
			                <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
			            </a>
			        </li>

			        <li class="sidebar-item <?=dashAct('intro')?>">
						<a class="sidebar-link" href="./intro.php">
							<i class="align-middle" data-feather="gift"></i> <span class="align-middle">Intro</span>
						</a>
					</li>


					<li class="sidebar-item <?=dashAct('produ')?>">
						<a class="sidebar-link" href="./products.php">
							<i class="align-middle" data-feather="gift"></i> <span class="align-middle">Products</span>
						</a>
					</li>

					<li class="sidebar-item <?=dashAct('custo')?>">
						<a class="sidebar-link" href="./customers.php">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Customers</span>
						</a>
					</li>

					<li class="sidebar-item <?=dashAct('categ')?>">
						<a class="sidebar-link" href="./categories.php">
							<i class="align-middle" data-feather="tag"></i> <span class="align-middle">Categories</span>
						</a>
					</li>

					<li class="sidebar-item <?=dashAct('order')?>">
						<a class="sidebar-link" href="./orders.php">
							<i class="align-middle" data-feather="truck"></i> <span class="align-middle">Orders</span>
						</a>
					</li>

					<li class="sidebar-item <?=dashAct('messa')?>">
						<a class="sidebar-link" href="./messages.php">
							<i class="align-middle" data-feather="mail"></i> <span class="align-middle">Messages</span>
						</a>
					</li>

                    <li class="sidebar-item <?=dashAct('setti')?>">
                        <a class="sidebar-link" href="./settings.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Settings</span>
                        </a>
                    </li>

			        <li class="sidebar-item <?=dashAct('profi')?>">
			            <a class="sidebar-link" href="./profile.php">
			                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
			            </a>
			        </li>
			    </ul>
			    
			</div>
		</nav>
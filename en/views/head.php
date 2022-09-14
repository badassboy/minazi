<div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php if(isset($_SESSION['mz_auth']) && $_SESSION['mz_auth'] == true): ?>
                            <button class="dropdown-item" type="button" onclick="window.location.href='profile.php'">Profile</button>
                            <button class="dropdown-item" type="button" onclick="window.location.href='my-orders.php'">My Orders</button>
                            <button class="dropdown-item" type="button" onclick="window.location.href='dismiss.php'">Logout</button>
                            <?php else: ?>
                            <button class="dropdown-item" type="button" onclick="window.location.href='signin.php'">Sign in</button>
		                    <?php endif; ?>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item disabled" type="button">FR</button>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="cart.php" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;"><?=$cart->getTotalItem()?></span>
                    </a>
                </div>
            </div>
        </div>
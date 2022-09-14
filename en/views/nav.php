<?php
function activeNav($x){
    if(chkMainUrl() == $x){
    return 'active';
    }
}

function listCat(){
    global $zp;
    $zp->orderBy('cat_name','asc');
    $c = $zp->get(categories);
    foreach($c as $cat){
        echo                   '<a href="products.php?cat='.$cat['cat_id'].'" class="nav-item nav-link">'.$cat['cat_name'].'</a>
                                ';
    }
}
?>

<div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <a href="products.php?cat=0" class="nav-item nav-link">All</a>
                        <?=listCat()?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="<?=base?>" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Minazi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Store</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?=base?>" class="nav-item nav-link <?=activeNav('inde')?><?=activeNav('')?>">Home</a>
                            <a href="<?=base?>products.php" class="nav-item nav-link <?=activeNav('prod')?>">Products</a>
                            <a href="<?=base?>about.php" class="nav-item nav-link <?=activeNav('abou')?>">About</a>
                            <?php if(isset($_SESSION['mz_auth']) && $_SESSION['mz_auth'] == true): ?>
                            <a href="<?=base?>profile.php" class="nav-item nav-link <?=activeNav('prof')?>">Profile</a>
                            <?php endif ?>
                            <a href="<?=base?>contact.php" class="nav-item nav-link <?=activeNav('cont')?>">Contact Us</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="#" class="btn px-0 ml-3" onclick="window.location.href='cart.php'">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?=$cart->getTotalItem()?></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
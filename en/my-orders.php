<?php include_once 'inc/functions.php';

if(isset($_SESSION['mz-cust-id'])){
    $email = $_SESSION['mz-cust-id'];
    $zp->where('c_email', $email);
    $me = $zp->getOne(customers);
    $id = $me['c_id'];
}else{
    header('Location: index.php');
}

function getProd($p){
	global $zp;
	$zp->where('p_id',$p);
	$rov = $zp->getOne(products);
	echo   'Product: '.$rov['p_name'];
	
}

function getMe($f){
	global $zp;
	$zp->where('order_id',$f);
	$rov = $zp->get(orders);
	echo '<div>';
	foreach($rov as $nim){
		echo getProd($nim['p_id']).'<br> Quantity: '.$nim['quantity'].'<br>';
	}
	echo '</div>';
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'views/metadata.php' ?>

    <?php include_once 'views/links.php' ?>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <?php include_once 'views/head.php' ?>
        <?php include_once 'views/title.php' ?>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include_once 'views/nav.php' ?>
    <!-- Navbar End -->

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>S/N</th>
                            <th>Address</th>
                            <th>Product Details</th>
                            <th>Payment Information</th>
                            <th>Paid Amount</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $i = 1;
                        $zp->where('c_id',$id);
                        $zp->orderBy('pay_id', 'desc');
                        $it = $zp->get(payments);
                        foreach($it as $ord) { ?>
                        <tr>
                            <td class="align-left"><?=$i++?></td>
                            <td class="align-left"><?=$ord['order_add']?></td>
                            <td class="align-left"><?=getMe($ord['order_id'])?></td>
                            <td class="align-middle"><?=$ord['pay_type']?></td>
                            <td class="align-middle"><?=curcy().$ord['paid_amount']?></td>
                            <td class="align-middle"><span class="badge badge-info"><?=$ord['payment_status']?></span></td>
                            <td class="align-middle"><span class="badge badge-info"><?=$ord['shipping_status']?></span></td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"
                                    data-id=""><i class="fa fa-times"></i></button></td>
                        </tr>
                        <?php } ?>
                        <?php if($zp->count == 0) { ?>
                        <tr class="align-middle">
                            <td colspan="8">
                                <img src="assets/img/cart.png" alt="cart" width="200px">
                                <div>No Orders Yet!</div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>
</body>

</html>
<?php include_once 'inc/functions.php';
include_once 'inc/carter.php';  

function get_deliv(){
    global $zp;
    $my_id = $_SESSION['mz-cust-id'];
    $zp->where('c_email',$my_id);
    $tag = $zp->getOne(customers);
    if($tag['c_state'] == '1-2'){
        return '25.00';
    }else{
        return deliv_fee();
    }
}

if(isset($_SESSION['mz_auth']) && $_SESSION['mz_auth'] == true){
    if(!isset($_SESSION['tx_ref'])){
        $_SESSION['tx_ref'] = '';
    }
    if(empty($_SESSION['tx_ref'])){
        $_SESSION['tx_ref'] = radmz(2).'-'.radmz(6);
        $_SESSION['order_id'] = radmz(3).'-'.radmz(6);
        $_SESSION['sub_t'] = number_format($cart->getAttributeTotal('price'), 2, '.', ',');
    }
}else{header('Location: signin.php');}

if(isset($_SESSION['sess-ready']) && $_SESSION['sess-ready'] == true){
}else{
    header('Location: cart.php');
}

$custid = $_SESSION['mz-cust-id'];

$zp->where('c_email', $custid);
$gt = $zp->getOne(customers);
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


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" onclick="window.location.href=''">Minazi.Store</a>
                    <a class="breadcrumb-item text-dark" href="products.php">Products</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <form id="deliv-add" action="process.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name *</label>
                            <input class="form-control" readonly type="text" placeholder="First Name" value="<?=$gt['c_fname']?>" name="c_fname">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name *</label>
                            <input class="form-control" readonly type="text" placeholder="Last Name" value="<?=$gt['c_lname']?>" name="c_lname">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail *</label>
                            <input class="form-control" readonly readonly type="text" placeholder="example@email.com" value="<?=$gt['c_email']?>" name="c_email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No *</label>
                            <input class="form-control" readonly type="text" placeholder="+123 456 789" value="<?=$gt['c_phone']?>" name="c_phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1 *</label>
                            <input class="form-control" readonly type="text" placeholder="123 Street" value="<?=$gt['c_address']?>" name="c_address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" readonly type="text" placeholder="123 Street" value="<?=$gt['c_address2']?>" name="c_address2">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country *</label>
                            <select class="custom-select" disabled name="c_country">
                                <?php foreach( $country as $n1 => $country ): ?>
                                <option value="<?php echo $n1 ?>"
                                    <?php if( $n1 == $gt['c_country']?: '' ): ?> selected="selected"
                                    <?php endif; ?>><?php echo $country ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State/Region *</label>
                            <select class="custom-select" disabled name="c_state">
                                <?php foreach( $state as $n1 => $state ): ?>
                                <option value="<?php echo $n1 ?>"
                                    <?php if( $n1 == $gt['c_state']?: '' ): ?> selected="selected"
                                    <?php endif; ?>><?php echo $state ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City *</label>
                            <input class="form-control" readonly type="text" placeholder="New York"  value="<?=$gt['c_city']?>" name="c_city">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" readonly type="text" placeholder="123"  value="<?=$gt['c_zip']?>" name="c_zip">
                        </div>
                        <div class="col-12 form-group vitz">
                            <input type="hidden" name="amount" value="<?=number_format($cart->getAttributeTotal('price') + get_deliv(), 2, '.', ',')?>">
                            <input type="hidden" name="process-pay" id="process-pay">
                        </div>
                        <div class="col-12 form-group vitz">
                            To change content here, goto you profile
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php 
                        if (!$cart->isEmpty()) {
                            $allItems = $cart->getItems();
                        ?>
                        <?php
                            foreach ($allItems as $id => $items) {
                                foreach ($items as $item) {
                                    foreach ($products as $product) {
                                        if ($id == $product->p_id) {
                                            break;
                                        }
                                    }
                        ?>
                        <div class="d-flex justify-content-between">
                            <p><?=$product->p_name?> (<?=$item['quantity']?>)</p>
                            <p><?=curcy().number_format($item['attributes']['price']*$item['quantity'], 2, '.', ',')?></p>
                        </div>
                        <?php } } ?>
                        <?php } ?>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?=curcy().number_format($cart->getAttributeTotal('price'), 2, '.', ',')?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium"><?=curcy().number_format(get_deliv(), 2, '.', ',')?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?=curcy().number_format($cart->getAttributeTotal('price') + get_deliv(), 2, '.', ',')?></h5>
                            <?php $_SESSION['newest_p'] = number_format($cart->getAttributeTotal('price') + get_deliv(), 2, '.', ',')?>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <?php if(isset($_SESSION['pay_msg'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Sorry!</strong> <?=$_SESSION['pay_msg']; unset($_SESSION['pay_msg']);?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif ?>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="flut" value="flut" disabled>
                                <label class="custom-control-label" for="flut">FlutterWave</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="on_dev" value="on_dev" checked>
                                <label class="custom-control-label" for="on_dev">Pay On Delivery</label>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold py-3" data-toggle="modal" data-target="#exampleModal" id="kit">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->

    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You have selected to Pay on Delivery. Proceed?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary yes">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>

<script>
    $(document).ready(function(){
        var form = document.getElementById("deliv-add");
        document.getElementById("kit").addEventListener("click", function () {
            if(document.getElementById('flut').checked) {
            //Flutter radio button is checked
            var wrapper = $(".vitz");
            $(wrapper).append('<input type="hidden" name="payments" value="flutter">');
            }else if(document.getElementById('on_dev').checked) {
            //Derlivery radio button is checked
            var wrapper = $(".vitz");
            $(wrapper).append('<input type="hidden" name="payments" value="delivery">');
            $(".yes").on('click', function (e) {
            form.submit();
		});
            }
            // form.submit();
        });
    });
</script>
</body>

</html>
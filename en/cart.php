<?php include_once 'inc/functions.php';
include_once 'inc/carter.php'; 
//print_r($cart);
$my_id = $_SESSION['mz-cust-id'];
function disCartBtn($r){
    if($r == 0){
        $_SESSION['sess-ready'] = false;
        return 'disabled';
    }else{
        $_SESSION['sess-ready'] = true;
    }
}

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
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
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
                        <tr>
                            <td class="align-left"><img src="<?=$product->p_ft_photo?>" alt="" style="width: 50px;"></td>
                            <td class="align-middle"><?=$product->p_name?></td>
                            <td class="align-middle"><?=curcy().$item['attributes']['price']?></td>
                            <td class="align-middle">
                                <div class="input-group mx-auto" style="width: 100px;">
                                    <input type="number" name="qty" id="quantity<?=$id?>" class="form-control form-control-sm bg-secondary border-0 text-center quantity" value="<?=$item['quantity']?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-update" data-id="<?=$id?>">
                                            <i class="fa fa-redo"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?=curcy().number_format($item['attributes']['price']*$item['quantity'], 2, '.', ',')?></td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove" data-id="<?=$id?>"><i class="fa fa-times"></i></button></td>
                        </tr>
                        <?php } } ?>
                        <?php } ?>
                        <?php if($cart->isEmpty()) { ?>
                        <tr class="align-middle">
                            <td colspan="6">
                                <img src="assets/img/cart.png" alt="cart" width="200px">
                                <div>No Item in Shopping Cart</div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <!-- <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?=curcy().number_format($cart->getAttributeTotal('price'), 2, '.', ',')?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium"><?=curcy().get_deliv()?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?=curcy().number_format($cart->getAttributeTotal('price') + get_deliv(), 2, '.', ',')?></h5>
                        </div>
                        <button class="btn btn-block btn-sm btn-danger font-weight-bold my-3 py-3 btn-empty-cart" <?=disCartBtn($cart->getAttributeTotal('price'))?>>Empty Cart</button>
                        <button class="btn btn-block btn-sm btn-primary font-weight-bold my-3 py-3" onclick="window.location.href='checkout.php'" <?=disCartBtn($cart->getAttributeTotal('price'))?>>Proceed To Checkout</button>
                        <button class="btn btn-block btn-sm btn-primary font-weight-bold my-3 py-3" onclick="window.location.href='products.php'">Continue Shopping</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>

    <script>
        $(document).ready(function(){
            $('.add-to-cart').on('click', function(e){
                e.preventDefault();

                var $btn = $(this);
                var id = $btn.parent().parent().find('.product-id').val();
                var color = $btn.parent().parent().find('.color').val() || '';
                var qty = $btn.parent().parent().find('.quantity').val();

                var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="color" value="' + color + '"><input type="hidden" name="qty" value="' + qty + '">');

                $('body').append($form);
                $form.submit();
            });

            $('.btn-update').on('click', function(){
                var $btn = $(this);
                var id = $btn.attr('data-id');
                var qty = $("#quantity"+id).val();

                var $form = $('<form action="cart.php" method="post" />').html('<input type="hidden" name="update" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="qty" value="' + qty + '">');

                $('body').append($form);
                $form.submit();
            });

            $('.btn-remove').on('click', function(){
                var $btn = $(this);
                var id = $btn.attr('data-id');

                var $form = $('<form action="cart.php" method="post" />').html('<input type="hidden" name="remove" value=""><input type="hidden" name="id" value="'+id+'">');

                $('body').append($form);
                $form.submit();
            });

            $('.btn-empty-cart').on('click', function(){
                var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="empty" value="">');

                $('body').append($form);
                $form.submit();
            });
        });
    </script>
</body>

</html>
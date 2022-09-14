<?php include_once 'inc/functions.php'; 
include_once 'inc/carter.php'; 

if(isset($_GET['item'])){
    $item = $_GET['item'];
}else{
    header('Location: products.php');
}

function lookR($item){
    global $zp;
    $zp->where('p_id',$item);
    $zp->where('cust_id',getCtU($_SESSION['mz-cust-id'], 'c_id'));
    $zp->getOne(ratings);
    return $zp->count;
}

if(isset($_POST['revs'])){
    if(disRev(getCtU($_SESSION['mz-cust-id'],'c_id'),$item) != 'disabled'){
        $data = array(
            'p_id' => $item,
            'cust_id' => getCtU($_SESSION['mz-cust-id'], 'c_id'),
            'comment' => $_POST['comment'],
            'rating' => $_POST['rating'],
        );
        $zp->insert(ratings, $data);
    }
}

function disRev($i,$p){
    global $zp;
    $zp->where('cust_id',$i);
    $zp->where('p_id',$p);
    $zp->getOne(ratings);
    if($zp->count > 0){
        return 'disabled';
    }else{
        return '';
    }
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'views/metadata.php' ?>

    <?php include_once 'views/links.php' ?>

    <style>
        @import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
        div,
        label {
            margin: 0;
            padding: 0
        }

        body {
            margin: 20px
        }

        h1 {
            font-size: 1.5em;
            margin: 10px
        }

        .rating {
            border: none;
            margin-right: 49px
        }

        .myratings {
            font-size: 85px;
            color: green
        }

        .rating>[id^="star"] {
            display: none
        }

        .rating>label:before {
            margin: 2px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005"
        }

        .rating>.half:before {
            content: "\f089";
            position: absolute
        }

        .rating>label {
            color: #ddd;
            float: right
        }

        .rating>[id^="star"]:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #FF4EE0
        }

        .rating>[id^="star"]:checked+label:hover,
        .rating>[id^="star"]:checked~label:hover,
        .rating>label:hover~[id^="star"]:checked~label,
        .rating>[id^="star"]:checked~label:hover~label {
            color: #FF4EE0
        }

        .reset-option {
            display: none
        }

        .reset-button {
            margin: 6px 12px;
            background-color: rgb(255, 255, 255);
            text-transform: uppercase
        }

        .mt-100 {
            margin-top: 100px
        }
    </style>
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
                    <a class="breadcrumb-item text-dark" onclick="window.location.href=''">Products</a>
                    <span class="breadcrumb-item active">Product's Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <?php 
    $zp->where('p_id',$item);
    $prod = $zp->getOne(products);
    ?>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-4 h-auto mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?=$prod['p_ft_photo']?>" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <form method="POST">
                    <h3><?=$prod['p_name']?></h3>
                    <input type="hidden" name="name" value="<?=$prod['p_name']?>">
                    <input type="hidden" name="id" value="<?=$prod['p_id']?>">
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <?=rateProd($item)?>
                        </div>
                        <?=countReviews($item)?>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4"><?=curcy().$prod['p_current_price']?></h3>
                    <?=$prod['p_short_description']?>
                    <div class="d-flex align-items-center mb-4 pt-2">
                    <form>
                        <div class="input-group mr-2" style="width: 130px;">
                            <input type="number" class="form-control bg-secondary border-0 text-center quantity" value="1">
                            <input type="hidden" class="prod-id" value="<?=$prod['p_id']?>">
                        </div>
                        <button class="btn btn-primary px-3 add-to-cart"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </form>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <div class="tab-content">
                        <div class="">
                            <h4 class="mb-3">Product Description</h4>
                            <?=$prod['p_description']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        $zp->where('p_id',$item);
        $rateme = $zp->get(ratings);
        ?>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-3">Reviews <?=$zp->count?></a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4"><?=$zp->count?> review(s) for "<?=$prod['p_name']?>"</h4>
                                    <?php foreach($rateme as $rv) {?>
                                    <div class="media mb-4">
                                        <img src="<?=getCtUser($rv['cust_id'],'c_dp')?>" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><?=getCtUser($rv['cust_id'],'c_fname')?> <?=getCtUser($rv['cust_id'],'c_lname')?><small> - <i><?=date('d m Y', strtotime($rv['date_created']))?></i></small></h6>
                                            <div class="text-primary mb-2">
                                                <?=rateMe($rv['rating'])?>
                                            </div>
                                            <?=$rv['comment']?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <?php if(isset($_SESSION['mz-cust-id'])): ?>
                                    <form method="POST">
                                        <h4 class="mb-4">Leave a review</h4>
                                        <small>Required fields are marked *</small>
                                        <div class="d-flex my-3">
                                            <p class="mb-0 mt-1 mr-2">Your Rating * :</p>
                                            <div class="rating text-primary">
                                                <input type="radio" id="star5" name="rating" value="5" />
                                                <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4half" name="rating" value="4.5" />
                                                <label class="half" for="star4half"
                                                    title="Pretty good - 4.5 stars"></label>
                                                <input type="radio" id="star4" name="rating" value="4" />
                                                <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3half" name="rating" value="3.5" />
                                                <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                <input type="radio" id="star3" name="rating" value="3" />
                                                <label class="full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2half" name="rating" value="2.5" />
                                                <label class="half" for="star2half"
                                                    title="Kinda bad - 2.5 stars"></label>
                                                <input type="radio" id="star2" name="rating" value="2" />
                                                <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1half" name="rating" value="1.5" />
                                                <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                <input type="radio" id="star1" name="rating" value="1" />
                                                <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                <input type="radio" id="starhalf" name="rating" value="0.5" />
                                                <label class="half" for="starhalf"
                                                    title="Sucks big time - 0.5 stars"></label>
                                                <input type="radio" class="reset-option" name="rating" value="reset" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" name="comment" <?=disRev(getCtU($_SESSION['mz-cust-id'],'c_id'),$item)?>
                                                class="form-control"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" name="revs" class="btn btn-primary px-3" <?=disRev(getCtU($_SESSION['mz-cust-id'],'c_id'),$item)?>>
                                        </div>
                                    </form>
                                    <?php else: ?>
                                        <div class="form-group mb-0">
                                            <a href="signin.php">Login</a> to Review
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php 
                    $zp->where('cat_id',$prod['cat_id']);
                    $zp->orderBy('RAND ()');
                    $likes = $zp->get(products, 12);
                    ?>
                    <?php foreach($likes as $likei) { ?>
                    <div class="product-item p-4 bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?=$likei['p_ft_photo']?>" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" onclick="window.location.href='product-details.php?item=<?=$likei['p_id']?>'"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href=""><?=$likei['p_name']?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5><?=curcy().$likei['p_current_price']?></h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <?=rateProdi($likei['p_id'])?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>

    <script>
        $(document).ready(function () {
            $('.add-to-cart').on('click', function (e) {
                e.preventDefault();

                var $btn = $(this);
                var id = $btn.parent().find('.prod-id').val();
                var qty = $btn.parent().find('.quantity').val();

                var $form = $('<form action="cart.php" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="qty" value="' + qty + '">');

                $('body').append($form);
                $form.submit();
            });
        });
    </script>
</body>

</html>
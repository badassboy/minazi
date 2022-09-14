<?php include_once 'inc/functions.php';
include_once 'inc/carter.php'; 
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


    <!-- Carousel Start -->
        <?php

        $db_host = "localhost";

        $db_user = "root";
        $db_password = "";
        $db_name= "minazy";

        $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
        if (!$conn) {
            die("connection failed".mysqli_connect_error());
        }

        // sql fetch query
        $sql = "SELECT title, images, description FROM intro";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)>0) {

        while($row = mysqli_fetch_assoc($result)){?>

       



    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">

                       
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">

                    

                       

                
              <div class="carousel-item position-relative active" style="height: 430px;">

            


             


            <img class="position-absolute w-100 h-100" src="../admin/<?php echo $row['images']; ?>" style="object-fit: cover;">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown"><?php echo $row['title']; ?></h1>
                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                        <?php echo $row['description']; ?>
                    </p>
                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="products.php">Shop Now</a>
                </div>
            </div>

            



        </div>

         <?php }?>



                         

                      

                       




                       

                        <?php 

                            }

                            mysqli_close($conn);



                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Ready Delivery</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            <?php 
            $cati = $zp->get(categories);
            ?>
            <?php foreach($cati as $cat) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="#" onclick="window.location.href='<?='products.php?cat='.$cat['cat_id']?>'">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="<?=$cat['cat_img']?>" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6><?=$cat['cat_name']?></h6>
                            <small class="text-body"><?=countProdCat($cat['cat_id'])?> Product(s)</small>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
        <div class="row px-xl-5">
            <?php 
            $zp->where('p_is_featured', 1);
            $zp->orderBy("RAND ()");
            $proi = $zp->get(products, 6);
            ?>
            <?php foreach($proi as $pro) { ?>
            <div class="col-lg-2 col-md-4 col-sm-6 h-auto pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?=$pro['p_ft_photo']?>" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" onclick="window.location.href='product-details.php?item=<?=$pro['p_id']?>'"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-wrap text-truncate" href=""><?=$pro['p_name']?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?=curcy().$pro['p_current_price']?></h5><h6 class="text-muted ml-2"><del><?php if($pro['p_old_price']>0){ echo curcy().$pro['p_old_price'];}?></del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <?=rateProd($pro['p_id'])?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="assets/img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="assets/img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Recent Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php 
                    $zp->orderBy('p_id', 'desc');
                    $zp->orderBy('RAND ()');
                    $likes = $zp->get(products, 6);
                    ?>
                    <?php foreach($likes as $likei) { ?>
                    <div class="product-item p-4 bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?=$likei['p_ft_photo']?>" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" onclick="window.location.href='product-details.php?item=<?=$likei['p_id']?>'"><i class="fa fa-eye"></i></a>
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
    <!-- Recent Products End -->


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>
</body>

</html>
<?php include_once 'inc/functions.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'views/metadata.php' ?>

    <?php include_once 'views/links.php' ?>
    <style>
        .wrap {
            display: flex;
            background: white;
            padding: 1rem 1rem 1rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 7px 7px 30px -5px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .wrap:hover {
            background: linear-gradient(135deg, #e23bc3 0%, #FF4EE0 100%);
            color: white;
        }

        .ico-wrap {
            margin: auto;
        }

        .mbr-iconfont {
            font-size: 4.5rem !important;
            color: #313131;
            margin: 1rem;
            padding-right: 1rem;
        }

        .vcenter {
            margin: auto;
        }

        .mbr-section-title3 {
            text-align: left;
        }

        h2 {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .display-5 {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.4rem;
        }

        .mbr-bold {
            font-weight: 700;
        }

        p {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            line-height: 25px;
        }

        .display-6 {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1re
        }
        .text-color {
            color: white;
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

    
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="assets/img/carousel-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Proudly African</h1>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="contact.php">Connect</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="assets/img/carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown"><?=appName?></h1>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="products.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <div class="container pt-5">
        <div class="row mbr-justify-content-center">
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span class="mbr-iconfont fa-phone fa"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">24/7 Support</h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">Ready to Support Our Customers on Delivery and Tracking Orders.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span class="mbr-iconfont fa-shopping-cart fa"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Shopping</h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">For all your affordable and freshest goods at reliable prices</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span class="mbr-iconfont fa-shopping-bag fa"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">African-Grocers</h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">We are availaible and just a phone call away
                            ,contact us today and let Minazystores handle all your Grocery Needs</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span class="mbr-iconfont fa-truck fa"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Delivery and Logistics</h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">Quick and Speedy Delivery assured will bring
                            Your Goods to your doorstep so You dont have to worry about the logistics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Team -->
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h4 class="title mb-4">Meet The Team</h4>
                <p class="text-muted para-desc mx-auto mb-0">Minazy stores is an online shopping site for customers to
                    connect with specific needs to be able to shop online anywhere, anytime. rest assured our company
                    will do all the heavy lifting and will definitely deliver to your doorstep or prefered place of
                    residence, we at Minazy will handle all the logistics so that you dont have to</p>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="team text-center rounded p-3 py-4">
                    <img src="assets/img/team/1.jpg"
                        class="img-fluid avatar avatar-medium shadow rounded-pill" alt="">
                    <div class="content mt-3">
                        <h4 class="title mb-0">Zuweira Yakubu</h4>
                        <small class="text-muted">C.E.O.</small>
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="team text-center rounded p-3 py-4">
                    <img src="assets/img/team/2.jpg"
                        class="img-fluid avatar avatar-medium shadow rounded-pill" alt="">
                    <div class="content mt-3">
                        <h4 class="title mb-0">Yakubu Abdul Hadi.</h4>
                        <small class="text-muted">Accountant</small>
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="team text-center rounded p-3 py-4">
                    <img src="assets/img/team/3.jpg"
                        class="img-fluid avatar avatar-medium shadow rounded-pill" alt="">
                    <div class="content mt-3">
                        <h4 class="title mb-0">Marc Sodoli</h4>
                        <small class="text-muted">Operations Manager</small>
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="team text-center rounded p-3 py-4">
                    <img src="assets/img/team/4.jpg"
                        class="img-fluid avatar avatar-medium shadow rounded-pill" alt="">
                    <div class="content mt-3">
                        <h4 class="title mb-0">Shakibu Yakubu.</h4>
                        <small class="text-muted">Distribution Manager</small>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div><!--end row-->
    </div>
    <!-- Team End -->


    <div class="container pt-5">
        <div class="row bg-primary animate-in-down">
            <div class="p-4 col-md-6 align-self-center text-color">
                <h2 text-color>If you Want it...</h2>
                <p>We at Minazi have a customer support staff dedicated to catering to all your shopping needs and procuring and providing all your neccessary items and needs.</p>
                <p>Contact us on our Whatsapp line for a speedy dispatch and reliable services our team is always ready to help and provide customer support.</p>
                <p>At Minazy stores the customer focus is peak and a key cornerstone to our organizations beliefs and standards, here at minazy customer support is our primary goal ,so we encourage you to feel free as you shop and use our services.</p> 
            </div>
            <div class="p-0 col-md-6">
                <div class="carousel slide" data-ride="carousel" id="carousel1">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"> <img class="d-block img-fluid"
                                src="assets/img/if.jpg" data-holder-rendered="true">
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>
</body>

</html>
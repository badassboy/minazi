<?php include_once 'inc/functions.php'; 

if(isset($_POST['sendme'])){
    $msg = array(
        'msg_fullname' => $_POST['msg_fullname'],
        'msg_subj' => $_POST['msg_subj'],
        'msg_email' => $_POST['msg_email'],
        'msg_content' => $_POST['msg_content'],
    );
    $zp->insert(messages,$msg);
    $_SESSION['mz_success'] = '<strong>Good!</strong> Message Sent!';
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'views/metadata.php' ?>

    <?php include_once 'views/links.php' ?>
    <style>
        .page-item:hover {
            cursor: pointer;
        }
        .vim:hover {
            cursor: pointer;
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
                    <span class="breadcrumb-item active">Products</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->




    <!-- Contact Start -->
    <div class="container-fluid">
        <div class="col">
        <?php if(isset($_SESSION['mz_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congrat!</strong> <?=$_SESSION['mz_success']; unset($_SESSION['mz_success']);?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif ?>
        </div>
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form method="POST">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Your Name" name="msg_fullname"
                                required="required" autocomplete="off" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Your Email" name="msg_email"
                                required="required" autocomplete="off" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="msg_subj"
                                required="required" autocomplete="off" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="summernote" placeholder="Message" name="msg_content"
                                required="required"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="sendme">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>minazifoodstuff@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+971521398226</p>
                <p class="mb-0 pull-right"><i class="fa fa-phone-alt text-primary mr-3"></i>+233554660985</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>
</body>

</html>
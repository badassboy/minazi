<?php include_once 'inc/functions.php';

if(isset($_POST['cob'])){
    $em = strip_tags($_POST['email']);
    $zp->where('c_email',$em);
    $j = $zp->get(customers);
    if($zp->count > 0){
        $token = bin2hex(random_bytes(16));
        $to = $em;
        $subject = 'Reset Password - Minazi.Store';
        $zp->where('c_email',$em);
        $g = array(
            'c_token' => $token
        );
        $zp->update(customers,$g);
        $message = '
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
            <style>
                *{
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <img src="https://minazi.store/en/assets/img/minazi.png" alt="minazi.store"><br/>
            Click <a href="http://minazi.store/en/reset-password.php?token='.$token.'">here</a> to rest password
        </body>
        </html>';
        
        // Set content-type header for sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $message, $headers);
        $_SESSION['mz_info'] = 'Go To Your Email to Reset Password!';
        header('Location: signin.php');exit;
    }
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'views/metadata.php' ?>

    <?php include_once 'views/links.php' ?>
    <style>
        .sign {
            margin-bottom: 40px;
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
                    <span class="breadcrumb-item active">Sign In</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <div class="container-fluid mb-3">
        <form method="POST">
        <div class="row px-xl-5">
            <div class="col">
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center sign">Forgot Password</h4>
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" autocomplete="off" placeholder="Your Email" name="email" value="<?=$email?? ''?>" required />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary form-control" value="Reset Password" name="cob" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
        </form>
    </div>


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>
</body>

</html>
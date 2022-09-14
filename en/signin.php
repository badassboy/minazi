<?php include_once 'inc/functions.php';

if(isset($_SESSION['mz_auth']) && $_SESSION['mz_auth'] == true){
    header('Location: products.php');
}

if(isset($_POST['sob'])){
	$email = strip_tags($_POST['email']);
    $pass = strip_tags($_POST['pass']);
    
    $zp->where('c_email', $email);
    $pin = $zp->get(customers);

    if ($zp->count === 1 ) {
        $passes = password_verify($pass, $pin[0]['c_password']);

        if($pin[0]['c_status'] == 0){
            $_SESSION['mz_error'] = 'Account Disabled! Contact the Admin!';
        }elseif($passes){
            
            //Set Session
            $_SESSION['mz_auth'] = true;

            // reload the page
            $_SESSION['mz-cust-id'] = $email;
            if($_SESSION['sess-ready'] == true){
                header('Location: cart.php');exit;
            }else{
                header('Location: index.php');exit;
            }
        } else {
            // login failed save error to a session
            $_SESSION['mz_error'] = 'Wrong Credentials Entered!';
        }
    } else {
        // login failed save error to a session
        $_SESSION['mz_error'] = 'Wrong Credentials Entered!';
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
        <div class="row px-xl-5">
            <div class="col">
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center sign">Sign In</h4>
                        <form method="POST">
                            <?php if(isset($_SESSION['mz_error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Sorry!</strong> <?=$_SESSION['mz_error']; unset($_SESSION['mz_error']);?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif ?>
                            <?php if(isset($_SESSION['mz_info'])): ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Note!</strong> <?=$_SESSION['mz_info']; unset($_SESSION['mz_info']);?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif ?>
                            <?php if(isset($_SESSION['mz_success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Congrats!</strong> <?=$_SESSION['mz_success']; unset($_SESSION['mz_success']);?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif ?>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email" name="email" value="<?=isset($email)? $email : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Your Password" name="pass" value="<?=isset($pass)? $pass : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary form-control" value="Sign In" name="sob" />
                            </div>
                            <div class="form-group text-center">
                                <a href="#" onclick="window.location.href='forgot-password.php'" class="ForgetPwd" value="Login">Forget Password?</a> or <a href="#" onclick="window.location.href='register.php'" class="ForgetPwd" value="Login">Register?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>
</body>

</html>
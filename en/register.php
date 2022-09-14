<?php include_once 'inc/functions.php';

if(isset($_SESSION['mz_auth']) && $_SESSION['mz_auth'] == true){
    header('Location: products.php');
}

if(isset($_POST['gob'])){
    $fname = strip_tags($_POST['fname']);
    $lname = strip_tags($_POST['lname']);
	$email = strip_tags($_POST['email']);
	$mobile = strip_tags($_POST['mobile']);
    $pass = strip_tags($_POST['pass']);
    $rpass = strip_tags($_POST['rpass']);
    
    $zp->where('c_email',$email);
    $zp->getOne(customers);

    if ($zp->count > 0) {
        $_SESSION['mz_error'] = 'Email is Already Registered!';
    }elseif ($pass != $rpass) {
        $_SESSION['mz_error'] = 'Password Missmatch!';
    }else{
        $passes = password_hash($rpass, PASSWORD_DEFAULT);

        $data = array(
            'c_fname' => $_POST['fname'],
            'c_lname' => $_POST['lname'],
            'c_email' => $_POST['email'],
            'c_phone' => $_POST['mobile'],
            'c_status' => 1,
            'c_password' => $passes,
        );

        $zp->insert(customers, $data);
        //Set Session
        $_SESSION['mz_auth'] = true;

        // reload the page
        $_SESSION['mz-cust-id'] = $email;
        if($_SESSION['sess-ready'] == true){
            header('Location: cart.php');exit;
        }else{
            header('Location: profile.php?act=edit');exit;
        }
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
                    <span class="breadcrumb-item active">Register</span>
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
                        <h4 class="text-center sign">Register an Account</h4>
                        <form method="POST">
                            <?php if(isset($_SESSION['mz_error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Sorry!</strong> <?=$_SESSION['mz_error']; unset($_SESSION['mz_error']);?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your First Name" name="fname" value="<?=isset($fname)? $fname : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Last Name" name="lname" value="<?=isset($lname)? $lname : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email" name="email" value="<?=isset($email)? $email : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Mobile" name="mobile" value="<?=isset($mobile)? $mobile : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Your Password" name="pass" value="<?=isset($pass)? $pass : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Repeat Password" name="rpass" value="<?=isset($pass)? $rpass : ''?>" required autocomplete="off"/>
                            </div>
                            <div class="form-group invalid">
                                <input type="submit" class="btn btn-primary form-control" value="Register" name="gob" />
                            </div>
                            <div class="form-group text-center">
                                <a href="#" onclick="window.location.href='signin.php'" class="ForgetPwd">Sign In</a>
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
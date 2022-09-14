<?php include_once 'inc/functions.php';

if(isset($_REQUEST['token']) && !empty($_REQUEST['token'])){
    $tk = $_REQUEST['token'];
}else{
    $_SESSION['mz_error'] = 'Password Reset Failed!';
    header('Location: signin.php');
}

$zp->where('c_token', $tk);
$b = $zp->getOne(customers);

if($zp->count == 0){
    header('Location: signin.php');
}

if(isset($_POST['dob'])){
    $npass = strip_tags($_POST['npass']);
    $rpass = strip_tags($_POST['rpass']);

    if($npass != $rpass){
        $_SESSION['mz_error'] = 'Password Mismatch!';
    }else{
        $epass = password_hash($npass, PASSWORD_DEFAULT);
        $me = $b['c_email'];
        $g = array(
            'c_password' => $epass,
            'c_token' => ''
        );
        $zp->where('c_email', $me);
        $zp->update(customers,$g);
        
        $_SESSION['mz_success'] = 'Password Changed!';
        header('Location: signin.php');
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
                        <h4 class="text-center sign">Reset Password</h4>
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
                                <input type="password" class="form-control" autocomplete="off" placeholder="Your New Password" name="npass" value="<?=$npass?? ''?>" required />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" autocomplete="off" placeholder="Repeat Password" name="rpass" value="<?=$rpass?? ''?>" required />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary form-control" value="Reset Password" name="dob" />
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
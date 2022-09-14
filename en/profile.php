<?php include_once 'inc/functions.php';

if(isset($_SESSION['mz_auth']) && $_SESSION['mz_auth'] == true){
    $rt = $_SESSION['mz-cust-id'];

    $a = isset($_REQUEST['act'])? $_REQUEST['act']: '';

    if(isset($_POST['kob'])){
		if(isset($_FILES['c_dp']) && !empty($_FILES['c_dp']["name"])){
			$allowedExts = array("jpeg", "jpg", "png");
			$bix = explode(".", $_FILES["c_dp"]["name"]);
			$extension = end($bix);
			if (($_FILES["c_dp"]["size"] < 1029049) && in_array($extension, $allowedExts)){
				$path = "assets/img/customers/";
				$new_name = $_POST['c_id'];
				$ext_path = $path.$new_name.'.'.$extension;
				move_uploaded_file( $_FILES['c_dp']['tmp_name'], $ext_path );
			}else{ $_SESSION['mz_error'] = 'Image Upload Failed!';}
		}
        $gaa = array(
            'c_fname' => $_POST['c_fname'],
            'c_lname' => $_POST['c_lname'],
            'c_email' => $_POST['c_email'],
            'c_phone' => $_POST['c_phone'],
            'c_dp' => isset($ext_path) ? $ext_path : $_POST['c_dp'],
            'c_country' => $_POST['c_country'],
            'c_address' => $_POST['c_address'],
            'c_address2' => $_POST['c_address2'],
            'c_city' => $_POST['c_city'],
            'c_state' => $_POST['c_state'],
            'c_zip' => $_POST['c_zip'],
        );
        $zp->where('c_email', $rt);
        $zp->update(customers,$gaa);
        $_SESSION['mz_success'] = 'Profile Updated!';
    }
    
    $zp->where('c_email', $rt);
    $gt = $zp->getOne(customers);
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


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col">
            <?php if(isset($_SESSION['mz_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> <?=$_SESSION['mz_error']; unset($_SESSION['mz_error']);?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif ?>
            <?php if(isset($_SESSION['mz_success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrat!</strong> <?=$_SESSION['mz_success']; unset($_SESSION['mz_success']);?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif ?>
            </div>
        </div>
        <?php if($a == 'edit'): ?>
        <form method="POST" action="profile.php" enctype="multipart/form-data">
        <div class="row px-xl-5">
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">My Picture</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <img id="dp-prev" class="img-fluid" src="<?=!empty($gt['c_dp'])? $gt['c_dp'] : 'assets/img/customers/default.png'?>" alt="">
                    </div>
                    <div class="text-center">
                        <input type="file" id="c_dp" name="c_dp" style="display:none">
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('c_dp').click()">Change Picture</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">My Details</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="First Name" value="<?=$gt['c_fname']?>" name="c_fname">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Last Name" value="<?=$gt['c_lname']?>" name="c_lname">
                            <input type="hidden" value="<?=$gt['c_id']?>" name="c_id">
                            <input type="hidden" value="<?=$gt['c_dp']?>" name="c_dp">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" readonly type="text" placeholder="example@email.com" value="<?=$gt['c_email']?>" name="c_email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789" value="<?=$gt['c_phone']?>" name="c_phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control"  type="text" placeholder="123 Street" value="<?=$gt['c_address']?>" name="c_address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street" value="<?=$gt['c_address2']?>" name="c_address2">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select data-child="niv1" class="custom-select" name="c_country">
                                <?php foreach( $country as $n1 => $country ): ?>
                                <option value="<?php echo $n1 ?>"
                                    <?php if( $n1 == $gt['c_country']?: '' ): ?> selected="selected"
                                    <?php endif; ?>><?php echo $country ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State/Region</label>
                            <select id="niv1" class="custom-select" name="c_state">
                                <?php foreach( $state as $n1 => $state ): ?>
                                <option value="<?php echo $n1 ?>"
                                    <?php if( $n1 == $gt['c_state']?: '' ): ?> selected="selected"
                                    <?php endif; ?>><?php echo $state ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York"  value="<?=$gt['c_city']?>" name="c_city">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123"  value="<?=$gt['c_zip']?>" name="c_zip">
                        </div>
                        <div class="col form-group">
                            <input type="submit" class="btn btn-primary form-control" type="text" name="kob" value="Update Profile">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <?php else: ?>
        <div class="row px-xl-5">
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">My Picture</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <img id="dp-prev" class="img-fluid" src="<?=!empty($gt['c_dp'])? $gt['c_dp'] : 'assets/img/customers/default.png'?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">My Details</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" readonly type="text" placeholder="First Name" value="<?=$gt['c_fname']?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" readonly type="text" placeholder="Last Name" value="<?=$gt['c_lname']?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" readonly type="text" placeholder="example@email.com" value="<?=$gt['c_email']?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" readonly type="text" placeholder="+123 456 789" value="<?=$gt['c_phone']?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" readonly type="text" placeholder="123 Street" value="<?=$gt['c_address']?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" readonly type="text" placeholder="123 Street" value="<?=$gt['c_address2']?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select" disabled>
                                <?php foreach( $country as $n1 => $country ): ?>
                                <option value="<?php echo $n1 ?>"
                                    <?php if( $n1 == $gt['c_country']?: '' ): ?> selected="selected"
                                    <?php endif; ?>><?php echo $country ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State/Region</label>
                            <select class="custom-select" name="c_state" disabled>
                                <?php foreach( $state as $n1 => $state ): ?>
                                <option value="<?php echo $n1 ?>"
                                    <?php if( $n1 == $gt['c_state']?: '' ): ?> selected="selected"
                                    <?php endif; ?>><?php echo $state ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" readonly type="text" placeholder="New York"  value="<?=$gt['c_city']?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" readonly type="text" placeholder="123"  value="<?=$gt['c_zip']?>">
                        </div>
                        <div class="col form-group">
                            <button class="btn btn-primary form-control" onclick="window.location.href='profile.php?act=edit'">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
    <!-- Checkout End -->


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>
    <script>
		function display(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function (event) {
		            $('#dp-prev').attr('src', event.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#c_dp").change(function () {
		    display(this);
		});

		$("[data-child]").change(function () {
		    const selectedGroup = $(this).val();
		    var $childSelect = $("#" + $(this).attr("data-child"));
		    value = $childSelect.find('option').hide()
		        .filter(function (i, e) {
		            return $(e).val().startsWith(selectedGroup)
		        }).show().eq(0).val();
		    $childSelect.val(value);
		    $childSelect.trigger('change');
		});

		$("[data-child]").eq(0).trigger('change');
    </script>
</body>

</html>
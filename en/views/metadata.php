<?php 
if(chkMainUrl() == ''){
    $o = 'Home';
}elseif(chkMainUrl() == 'inde'){
    $o = 'Home';
}elseif(chkMainUrl() == 'prod'){
    $o = 'Products';
}elseif(chkMainUrl() == 'cont'){
    $o = 'Contact Us';
}elseif(chkMainUrl() == 'cart'){
    $o = 'Shopping Cart';
}elseif(chkMainUrl() == 'sign'){
    $o = 'Sign In';
}elseif(chkMainUrl() == 'chec'){
    $o = 'CheckOut';
}elseif(chkMainUrl() == 'abou'){
    $o = 'About Us';
}elseif(chkMainUrl() == 'prof'){
    $o = 'Profile';
}else{
    $o = 'Shop Now';
}
$zp->where('meta_title',$o);
$md = $zp->getOne(metadata);
?><meta charset="utf-8">
    <title><?=$o?> - Minazi.Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?=$md['meta_key']?? 'MINAZI.STORE'?>" name="keywords">
    <meta content="<?=$md['meta_desc']?? 'African Online Market'?>" name="description">

    <meta property="og:title" content="MINAZI.STORE" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://minazi.store/en/assets/img/minazi.jpg" />
    <meta property="og:url" content="https://minazi.store/en/" />
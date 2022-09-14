<?php
require_once '../admin/inc/statics.php';
require_once '../admin/inc/MysqliDb.php';

session_start();

//Get Current Page in $cur_page
$cur_page = $_SESSION['cur_page'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];

require_once 'class.Cart.php';

// Initialize cart object
$cart = new Cart([
	// Maximum item can added to cart, 0 = Unlimited
	'cartMaxItem' => 0,

	// Maximum quantity of a item can be added to cart, 0 = Unlimited
	'itemMaxQuantity' => 0,

	// Do not use cookie, cart items will gone after browser closed
	'useCookie' => false,
]);


$zp = new MysqliDb(hostName, userName, userPass, hostDb);

function chkMainUrl(){
    return substr($_SERVER['REQUEST_URI'], 11, 4);
}

function curcy(){
    return 'AED';
}

function deliv(){
    return 0.00;
}

function getProduce($f,$n){
    global $zp;
    $zp->where('p_id',$f);
    $cv = $zp->getOne(products);
    return $cv[$n];
}

function countProdCat($m){
    global $zp;
    $zp->where('cat_id',$m);
    $zp->get(products);
    return $zp->count;
}

function rateProd($r){
    global $zp;
    $ft = 0;
    $zp->where('p_id',$r);
    $rv = $zp->get(ratings);
    $v = $zp->count;
    foreach($rv as $x){
        $ft = $ft + $x['rating'];
    }
    if($v>0){
        $ar = $ft / $v;
        switch (true) {
            case ($ar == 5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 4.5 && $ar < 5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>';
                break;
            case ($ar >= 4 && $ar < 4.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 3.5 && $ar < 4):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 3 && $ar < 3.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 2.5 && $ar < 3):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 2 && $ar < 2.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 1.5 && $ar < 1):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 1 && $ar < 1.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 0.5 && $ar < 1):
                echo '<small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 0 && $ar < 0.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
        }
    }else{
        return '<small class="pt-1">Not Reviewed</small>';
    }
   
}

function rateProdi($r){
    global $zp;
    $ft = 0;
    $zp->where('p_id',$r);
    $rv = $zp->get(ratings);
    $v = $zp->count;
    foreach($rv as $x){
        $ft = $ft + $x['rating'];
    }
    if($v>0){
        $ar = $ft / $v;
        switch (true) {
            case ($ar == 5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 4.5 && $ar < 5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>';
                break;
            case ($ar >= 4 && $ar < 4.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 3.5 && $ar < 4):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 3 && $ar < 3.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 2.5 && $ar < 3):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 2 && $ar < 2.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 1.5 && $ar < 1):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 1 && $ar < 1.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 0.5 && $ar < 1):
                echo '<small class="fas fa-star-half text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
            case ($ar >= 0 && $ar < 0.5):
                echo '<small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="fas fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>';
                break;
        }
    }
   
}

function rateMe($r){
    $ar = $r;
    switch (true) {
        case ($ar == 5):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>';
            break;
        case ($ar >= 4.5 && $ar < 5):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>';
            break;
        case ($ar >= 4 && $ar < 4.5):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 3.5 && $ar < 4):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 3 && $ar < 3.5):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 2.5 && $ar < 3):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 2 && $ar < 2.5):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 1.5 && $ar < 1):
            echo '<i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                            <i class="fae fa-star"></i>
                            <i class="fae fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 1 && $ar < 1.5):
            echo '<i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 0.5 && $ar < 1):
            echo '<i class="fas fa-star-half"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
        case ($ar >= 0 && $ar < 0.5):
            echo '<i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>';
            break;
    }
}

function countReviews($r){
    global $zp;
    $zp->where('p_id',$r);
    $zp->get(ratings);
    if($zp->count > 0){
        return '<small class="pt-1">('.$zp->count.' Reviews)</small>';
    }

}

function getCtUser($id,$content){
    global $zp;
    $zp->where('c_id',$id);
    $bv = $zp->getOne(customers);
    if($zp->count > 0){
        return $bv[$content];
    }
}

function getCtU($id,$content){
    global $zp;
    $zp->where('c_email',$id);
    $bv = $zp->getOne(customers);
    if($zp->count > 0){
        return $bv[$content];
    }
}

function radmz($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}

function deliv_fee(){
    global $zp;
    $zp->where('rec',1);
    $fig = $zp->getOne('tbl_settings');
    return $fig['deliv_fee'];
}
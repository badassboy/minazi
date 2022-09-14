<?php
require_once 'statics.php';
require_once 'MysqliDb.php';

$op = new MysqliDb(hostName, userName, userPass, hostDb);

function chkUrl(){
    return substr($_SERVER['REQUEST_URI'], 14, 5);
}

function curcy(){
    return '₵';
}

function deliv(){
    return 1.00;
}

function ckStatus($b){
    if($b === 0){
       return '<span class="badge bg-danger">Inactive</span>'; 
    }elseif($b === 1){
        return '<span class="badge bg-success">Active</span>'; 
    }
}

function blStatus($b){
    if($b == 0){
       return '<span class="badge bg-danger">No</span>'; 
    }elseif($b == 1){
        return '<span class="badge bg-success">Yes</span>'; 
    }
}

function catGroup($m){
    global $op;
    $op->where('cat_id',$m);
    $c = $op->getOne(categories);
    return '<span class="badge bg-info">'.$c['cat_name'].'</span>';
}

function setCatOpt($b){
    global $op;
    $vs = $op->get(categories);
    foreach($vs as $o){
        if($b == $o['cat_id']){
            $sel = ' selected ';
        }else{
            $sel = ' ';
        }
        echo '
                    <option'.$sel.'value = "'.$o['cat_id'].'">'.$o['cat_name'].'</option>';
    }
}

function setFtProd($g){
    for($i=0; $i<=1; $i++){
        if($g == $i){
            $sel = ' selected ';
        }else{
            $sel = ' ';
        }
        if($i == 1){
            $sl = 'Yes';
        }else{
            $sl = 'No';
        }
        echo '
                    <option'.$sel.'value = "'.$i.'">'.$sl.'</option>';
    }
}

function setProdSt($g){
        for($i=0; $i<=1; $i++){
            if($g == $i){
                $sel = ' selected ';
            }else{
                $sel = ' ';
            }
            if($i == 1){
                $sl = 'Active';
            }else{
                $sl = 'Inactive';
            }
        echo '
                    <option'.$sel.'value = "'.$i.'">'.$sl.'</option>';
    }
}
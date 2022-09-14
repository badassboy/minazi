<?php include_once 'inc/functions.php'; 
include_once 'inc/carter.php'; 

if(isset($_GET['item'])){
    $item = $_GET['item'].'%';
}
//Generate Products by Page, Limit and Sort
if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $page = $_GET['page'];}else{
    $page = 1;
}
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];}else{
    $sort = 'asc';
}
if(isset($_GET['limit']) && is_numeric($_GET['limit'])){
    $limit = $_GET['limit'];}else{
    $limit = 12;
}
if(isset($_GET['cat']) && is_numeric($_GET['cat'])){
    $cat = $_GET['cat'];}else{
    $cat = 0;
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


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12">
                <div class="row pb-3">
                    <?php  
                    // set page limit to results per page. 20 by default
                    if($cat > 0){$zp->where('cat_id',$cat);}
                    $zp->where ("p_name", $item, 'like');
                    $zp->orderBy('p_id',$sort);
                    $zp->pageLimit = $limit;
                    $products = $zp->arraybuilder()->paginate(products, $page);
                    ?>
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item vim" onclick="window.location.href='products-search.php?cat=<?=$cat?>&page=<?=$page?>&sort=desc&limit=<?=$limit?>'">Latest</a>
                                        <a class="dropdown-item vim" onclick="window.location.href='products-search.php?cat=<?=$cat?>&page=<?=$page?>&sort=asc&limit=<?=$limit?>'">Oldest</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item vim" onclick="window.location.href='products-search.php?cat=<?=$cat?>&page=<?=$page?>&sort=<?=$sort?>&limit=18'">18</a>
                                        <a class="dropdown-item vim" onclick="window.location.href='products-search.php?cat=<?=$cat?>&page=<?=$page?>&sort=<?=$sort?>&limit=32'">32</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach($products as $product) { ?>
                    <div class="col-lg-2 col-md-3 col-sm-6 h-auto pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="<?=$product['p_ft_photo']?>" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square fast-add" data-id="<?=$product['p_id']?>"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" onclick="window.location.href='product-details.php?item=<?=$product['p_id']?>'"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""><?=$product['p_name']?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><?=curcy().$product['p_current_price']?></h5><br><!--<h6 class="text-muted ml-2"><del><?php if($product['p_old_price']>0){ echo curcy().$product['p_old_price'];}?></del></h6>-->
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <?=rateProd($product['p_id'])?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="col-12">
                        <nav>
                          <?php 
                          //Configure Previous Page
                          function chkPpg($x){
                            if($x == 1){
                                return ' disabled';
                            }
                          }
                          //Configure Next Page
                          function chkNpg($x){
                            global $zp;
                            $v = $zp->totalPages;
                            if($x == $v){
                                return ' disabled';
                            }
                          }
                          ?>
                          <ul class="pagination justify-content-center">
                            <li class="page-item<?=chkPpg($page)?>"><a class="page-link" onclick="window.location.href='products-search.php?cat=<?=$cat?>&page=<?=$page-1?>&sort=<?=$sort?>&limit=<?=$limit?>'">Previous</span></a></li>
                            <?php for($i = 1; $i <= $zp->totalPages; $i++) {?>
                            <li class="page-item <?php if($page == $i){echo 'active';} ?>"><a class="page-link" onclick="window.location.href='products-search.php?cat=<?=$cat?>&page=<?=$i?>&sort=<?=$sort?>&limit=<?=$limit?>'"><?=$i?></a></li>
                            <?php }?>
                            <li class="page-item<?=chkNpg($page)?>"><a class="page-link" onclick="window.location.href='products-search.php?cat=<?=$cat?>&page=<?=$page+1?>&sort=<?=$sort?>&limit=<?=$limit?>'">Next</a></li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


    <!-- Footer Start -->
    <?php include_once 'views/footer.php'; ?>

    <script>
        $(document).ready(function(){
            $('.fast-add').on('click', function(){

                var $btn = $(this);
                var id = $btn.attr('data-id');
                var qty = 1;

                var $form = $('<form action="products.php" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="qty" value="' + qty + '">');

                $('body').append($form);
                $form.submit();
            });
        });
    </script>
</body>

</html>
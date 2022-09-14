<div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="<?=base?>" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Minazi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Store</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form id="search" method="get" action="products.php">
                    <div class="input-group">
                        <input type="text" name="item" class="form-control" placeholder="Search for products">
                        <div class="input-group-append vim" onclick="document.getElementById('search').submit();">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0"><a href="tel:+971-56-627-2649">+971-56-627-2649</a></h5>
            </div>
        </div>
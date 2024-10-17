<?php
if (!isset($_GET["page"])) {
  $_GET["page"] = 1;
}
require_once "includes/header.php";
?>
<div class="container">
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-primary text-light" id="search">
        <i class="fas fa-search fa-sm"></i>
      </span>
    </div>
    <input type="text" onkeyup="searchProducts(this)" class="form-control text-primary" placeholder="search" aria-label="search" aria-describedby="search">
  </div>
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">Shop</h1>
        </div>
        <div class="col-lg-6 text-lg-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <div class="container p-0">
      <div class="row">
        <!-- SHOP SIDEBAR-->
        <div class="col-lg-3 order-2 order-lg-1">
          <h5 class="text-uppercase mb-4">Categories</h5>
          <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Fashion &amp; Acc</strong></div>
          <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
            <li class="mb-2"><a class="reset-anchor <?= isset($_GET["cat"]) ? $_GET["cat"] == $category["id"] ? "text-dark fw-bold" : "" : "" ?>" href="?header=shop">All</a></li>
            <?php
            $categories = $conn->query("SELECT * FROM category");
            foreach ($categories as $category) :
            ?>
              <li class="mb-2"><a class="reset-anchor <?= isset($_GET["cat"]) ? $_GET["cat"] == $category["id"] ? "text-dark fw-bold" : "" : "" ?>" href="?header=shop&cat=<?= $category["id"] ?>"><?= $category["name"] ?></a></li>
            <?php endforeach; ?>
          </ul>
          <div class="py-2 px-4 bg-light mb-3"><strong class="small text-uppercase font-weight-bold">Health &amp; Beauty</strong></div>
          <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
            <li class="mb-2"><a class="reset-anchor" href="#">Shavers</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">bags</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Cosmetic</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Nail Art</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Skin Masks &amp; Peels</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Korean cosmetics</a></li>
          </ul>
          <div class="py-2 px-4 bg-light mb-3"><strong class="small text-uppercase font-weight-bold">Electronics</strong></div>
          <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal mb-5">
            <li class="mb-2"><a class="reset-anchor" href="#">Electronics</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">USB Flash drives</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Headphones</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Portable speakers</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Cell Phone bluetooth headsets</a></li>
            <li class="mb-2"><a class="reset-anchor" href="#">Keyboards</a></li>
          </ul>
          <h6 class="text-uppercase mb-4">Price range</h6>
          <div class="price-range pt-4 mb-5">
            <div id="range"></div>
            <div class="row pt-2">
              <div class="col-6"><strong class="small font-weight-bold text-uppercase">From</strong></div>
              <div class="col-6 text-right"><strong class="small font-weight-bold text-uppercase">To</strong></div>
            </div>
          </div>
          <h6 class="text-uppercase mb-3">Show only</h6>
          <div class="custom-control custom-checkbox mb-1">
            <input class="custom-control-input" id="customCheck1" type="checkbox">
            <label class="custom-control-label text-small" for="customCheck1">Returns Accepted</label>
          </div>
          <div class="custom-control custom-checkbox mb-1">
            <input class="custom-control-input" id="customCheck2" type="checkbox">
            <label class="custom-control-label text-small" for="customCheck2">Returns Accepted</label>
          </div>
          <div class="custom-control custom-checkbox mb-1">
            <input class="custom-control-input" id="customCheck3" type="checkbox">
            <label class="custom-control-label text-small" for="customCheck3">Completed Items</label>
          </div>
          <div class="custom-control custom-checkbox mb-1">
            <input class="custom-control-input" id="customCheck4" type="checkbox">
            <label class="custom-control-label text-small" for="customCheck4">Sold Items</label>
          </div>
          <div class="custom-control custom-checkbox mb-1">
            <input class="custom-control-input" id="customCheck5" type="checkbox">
            <label class="custom-control-label text-small" for="customCheck5">Deals &amp; Savings</label>
          </div>
          <div class="custom-control custom-checkbox mb-4">
            <input class="custom-control-input" id="customCheck6" type="checkbox">
            <label class="custom-control-label text-small" for="customCheck6">Authorized Seller</label>
          </div>
          <h6 class="text-uppercase mb-3">Buying format</h6>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" id="customRadio1" type="radio" name="customRadio">
            <label class="custom-control-label text-small" for="customRadio1">All Listings</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" id="customRadio2" type="radio" name="customRadio">
            <label class="custom-control-label text-small" for="customRadio2">Best Offer</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" id="customRadio3" type="radio" name="customRadio">
            <label class="custom-control-label text-small" for="customRadio3">Auction</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" id="customRadio4" type="radio" name="customRadio">
            <label class="custom-control-label text-small" for="customRadio4">Buy It Now</label>
          </div>
        </div>
        <!-- SHOP LISTING-->
        <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0 test">
          <div class="row mb-3 align-items-center">
            <div class="col-lg-6 mb-2 mb-lg-0">
              <p class="text-small text-muted mb-0">Showing 1–12 of 53 results</p>
            </div>
            <a id=popularity href="?header=shop<?= isset($_GET["cat"]) ? "&cat=$_GET[cat]" : "" ?>&sort=pop" style="width: 0;height: 0; overflow: hidden;"></a>
            <a id=low_sort href="?header=shop<?= isset($_GET["cat"]) ? "&cat=$_GET[cat]" : "" ?>&sort=low" style="width: 0;height: 0; overflow: hidden;"></a>
            <a id=high_sort href="?header=shop<?= isset($_GET["cat"]) ? "&cat=$_GET[cat]" : "" ?>&sort=high" style="width: 0;height: 0; overflow: hidden;"></a>
            <div class="col-lg-6">
              <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th-large"></i></a></li>
                <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th"></i></a></li>
                <li class="list-inline-item">
                  <select id=test_id onchange="sortProduct(this.value)" class="selectpicker ml-auto" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Default sorting">
                    <option value="default">Default sorting</option>
                    <option value="popularity">Popularity</option>
                    <option value="low-high">Price: Low to High</option>
                    <option value="high-low">Price: High to Low</option>
                  </select>
                </li>

                <script>
                  let pop = document.getElementById("popularity");
                  let low = document.getElementById("low_sort");
                  let high = document.getElementById("high_sort");

                  function sortProduct(v) {
                    if (v == "low-high") {
                      low.click();
                    } else if (v == "high-low") {
                      high.click();
                    } else if (v == "popularity") {
                      pop.click();
                    }
                  }
                </script>
              </ul>
            </div>
          </div>
          <div class="row" id="test">
            <?php
            $show = 3;
            $n = isset($_GET["page"]) ? ($_GET["page"] - 1) * $show : 0;
            $n = $n < 0 ? 0 : $n;
            require_once "functions/connect.php";
            if (isset($_GET["cat"])) {
              if (isset($_GET["sort"])) {
                if ($_GET["sort"] == "low") {
                  $products = $conn->query("SELECT * FROM products where cat_id = '$_GET[cat]' ORDER BY price ASC LIMIT $show offset $n");
                } else if ($_GET["sort"] == "high") {
                  $products = $conn->query("SELECT * FROM products where cat_id = '$_GET[cat]' ORDER BY price DESC LIMIT $show offset $n");
                } else if ($_GET["sort"] == "pop") {
                  $products = $conn->query("SELECT * FROM products where cat_id = '$_GET[cat]' ORDER BY sale DESC LIMIT $show offset $n");
                }
              } else {
                $products = $conn->query("SELECT * FROM products where cat_id = '$_GET[cat]' LIMIT $show offset $n");
              }
            } else {
              if (isset($_GET["sort"])) {
                if ($_GET["sort"] == "low") {
                  $products = $conn->query("SELECT * FROM products ORDER BY price ASC LIMIT $show offset $n");
                } else if ($_GET["sort"] == "high") {
                  $products = $conn->query("SELECT * FROM products ORDER BY price DESC LIMIT $show offset $n");
                } else if ($_GET["sort"] == "pop") {
                  $products = $conn->query("SELECT * FROM products ORDER BY sale DESC LIMIT $show offset $n");
                }
              } else {
                $products = $conn->query("SELECT * FROM products LIMIT $show offset $n");
              }
            }
            foreach ($products as $product) :
              $images = $conn->query("SELECT name FROM images WHERE pro_id = '$product[id]'")->fetch_assoc();

            ?>
              <!--  Modal -->
              <div class="modal fade" id="product<?= $product["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="row align-items-stretch">
                        <div class="col-lg-6 p-lg-0">
                          <a class="product-view d-block h-100 bg-cover bg-center" style="background: url(admin/img/<?= explode(",", $images["name"])[0]; ?>)" href="admin/img/<?= explode(",", $images["name"])[0]; ?>" data-lightbox="productview" title="<?= $product["name"]; ?>"></a>
                          <a class="d-none" href="admin/img/<?= explode(",", $images["name"])[0]; ?>" title="<?= $product["name"]; ?>" data-lightbox="productview"></a>
                          <a class="d-none" href="admin/img/<?= explode(",", $images["name"])[0]; ?>" title="<?= $product["name"]; ?>" data-lightbox="productview"></a>
                        </div>
                        <div class="col-lg-6">
                          <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          <div class="p-5 my-md-4">
                            <ul class="list-inline mb-2">
                              <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                              <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                              <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                              <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                              <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                            </ul>
                            <h2 class="h4"><?= $product["name"] ?></h2>
                            <p class="text-muted">$<?= $product["price"] ?></p>
                            <p class="text-small mb-4"><?= $product["description"] ?></p>
                            <form action="functions/carts/add_cart.php?cart=<?= $product["id"] ?>" method="post">
                              <div class="row align-items-stretch mb-4">
                                <div class="col-sm-7 pr-sm-0">
                                  <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                    <div class="quantity">
                                      <div class="dec-btn p-0" style="width: 14px;text-align: center;cursor: pointer;"><i class="fas fa-caret-left"></i></div>
                                      <input name=count class="form-control border-0 shadow-0 p-0" type="text" value="1">
                                      <div class="inc-btn p-0" style="width: 14px;text-align: center;cursor: pointer;"><i class="fas fa-caret-right"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-5 pl-sm-0">
                                  <button class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0">Add to cart</button>
                                </div>
                              </div><a class="btn btn-link text-dark p-0" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- PRODUCT-->
              <div class="col-lg-4 col-sm-6" id="product-cart<?= $product["id"] ?>">
                <div class="product text-center">
                  <div class="mb-3 position-relative">
                    <div class="badge text-white badge-"></div><a class="d-block" href="detail.php?id=<?= $product["id"] ?>"><img class="img-fluid w-100" src="admin/img/<?= explode(",", $images["name"])[0]; ?>" alt="..."></a>
                    <div class="product-overlay">
                      <ul class="mb-0 list-inline">
                        <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                        <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="functions/carts/add_cart.php?cart=<?= $product["id"] ?>">Add to cart</a></li>
                        <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#product<?= $product["id"] ?>" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <h6> <a class="reset-anchor" href="detail.php"><?= $product["name"] ?></a></h6>
                  <p class="small text-muted">$<?= $product["price"] ?></p>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <script>
            let cart = document.getElementById("test");

            function searchProducts(v) {
              let i = 1;
              <?php foreach ($products as $product) : ?>
                if (v.value == "" || "<?= $product["name"] ?>".includes(v.value)) {
                  cart.children[i].style.display = "block";
                } else if (!"<?= $product["name"] ?>".includes(v.value)) {
                  cart.children[i].style.display = "none";
                }
                i += 2;
              <?php endforeach; ?>
            }
          </script>
          <!-- PAGINATION-->
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center justify-content-lg-end">
              <li class="page-item">
                <a class="page-link" href="?header=shop&<?= isset($_GET["cat"]) ? "cat=" . $_GET["cat"] : "" ?>&page=<?= isset($_GET["page"]) ? $_GET["page"] - 1 : "" ?>&sort=<?= isset($_GET["sort"]) ? $_GET["sort"] : ""?>" aria-label="Previous">
                  <span aria-hidden="true">«</span>
                </a>
              </li>
              <?php
              if (isset($_GET["cat"])) {
                $count = $conn->query("SELECT COUNT(id) FROM products WHERE cat_id = '$_GET[cat]'")->fetch_assoc()["COUNT(id)"] / $show;
              } else {
                $count = $conn->query("SELECT COUNT(id) FROM products")->fetch_assoc()["COUNT(id)"] / $show;
              }
              for ($i = 0; $i < $count; $i++) {
              ?>
                <li class="page-item <?= isset($_GET["page"]) ? $i + 1 == $_GET["page"] ? "active" : "" : "" ?>"><a class="page-link" href="?header=shop&<?= isset($_GET["cat"]) ? "cat=" . $_GET["cat"] : "" ?>&page=<?= $i + 1 ?>&sort=<?= isset($_GET["sort"]) ? $_GET["sort"] : ""?>"><?= $i + 1 ?></a></li>
              <?php } ?>
              <li class="page-item"><a class="page-link" href="?header=shop&<?= isset($_GET["cat"]) ? "cat=" . $_GET["cat"] : "" ?>&page=<?= isset($_GET["page"]) ? $_GET["page"] + 1 : "" ?>&sort=<?= isset($_GET["sort"]) ? $_GET["sort"] : ""?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </section>
</div>
<footer class="bg-dark text-white">
  <div class="container py-4">
    <div class="row py-5">
      <div class="col-md-4 mb-3 mb-md-0">
        <h6 class="text-uppercase mb-3">Customer services</h6>
        <ul class="list-unstyled mb-0">
          <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
          <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
          <li><a class="footer-link" href="#">Online Stores</a></li>
          <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <h6 class="text-uppercase mb-3">Company</h6>
        <ul class="list-unstyled mb-0">
          <li><a class="footer-link" href="#">What We Do</a></li>
          <li><a class="footer-link" href="#">Available Services</a></li>
          <li><a class="footer-link" href="#">Latest Posts</a></li>
          <li><a class="footer-link" href="#">FAQs</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h6 class="text-uppercase mb-3">Social media</h6>
        <ul class="list-unstyled mb-0">
          <li><a class="footer-link" href="#">Twitter</a></li>
          <li><a class="footer-link" href="#">Instagram</a></li>
          <li><a class="footer-link" href="#">Tumblr</a></li>
          <li><a class="footer-link" href="#">Pinterest</a></li>
        </ul>
      </div>
    </div>
    <div class="border-top pt-4" style="border-color: #1d1d1d !important">
      <div class="row">
        <div class="col-lg-6">
          <p class="small text-muted mb-0">&copy; 2020 All rights reserved.</p>
        </div>
        <div class="col-lg-6 text-lg-right">
          <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstraptemple.com/p/bootstrap-ecommerce">Bootstrap Temple</a></p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- JavaScript files-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/lightbox2/js/lightbox.min.js"></script>
<script src="vendor/nouislider/nouislider.min.js"></script>
<script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="vendor/owl.carousel2/owl.carousel.min.js"></script>
<script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
<script src="js/front.js"></script>

<!-- Nouislider Config-->
<script>
  var range = document.getElementById('range');
  noUiSlider.create(range, {
    range: {
      'min': 0,
      'max': 2000
    },
    step: 5,
    start: [100, 1000],
    margin: 300,
    connect: true,
    direction: 'ltr',
    orientation: 'horizontal',
    behaviour: 'tap-drag',
    tooltips: true,
    format: {
      to: function(value) {
        return '$' + value;
      },
      from: function(value) {
        return value.replace('', '');
      }
    }
  });
</script>
<script>
  // ------------------------------------------------------- //
  //   Inject SVG Sprite - 
  //   see more here 
  //   https://css-tricks.com/ajaxing-svg-sprite/
  // ------------------------------------------------------ //
  function injectSvgSprite(path) {

    var ajax = new XMLHttpRequest();
    ajax.open("GET", path, true);
    ajax.send();
    ajax.onload = function(e) {
      var div = document.createElement("div");
      div.className = 'd-none';
      div.innerHTML = ajax.responseText;
      document.body.insertBefore(div, document.body.childNodes[0]);
    }
  }
  // this is set to BootstrapTemple website as you cannot 
  // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
  // while using file:// protocol
  // pls don't forget to change to your domain :)
  injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
</script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</div>
</body>

</html>
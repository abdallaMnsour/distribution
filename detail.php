<?php require_once "includes/header.php" ?>
<!--  Modal -->
<div class="modal fade" id="productView" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="row align-items-stretch">
          <div class="col-lg-6 p-lg-0"><a class="product-view d-block h-100 bg-cover bg-center" style="background: url(img/product-5.jpg)" href="img/product-5.jpg" data-lightbox="productview" title="Red digital smartwatch"></a><a class="d-none" href="img/product-5-alt-1.jpg" title="Red digital smartwatch" data-lightbox="productview"></a><a class="d-none" href="img/product-5-alt-2.jpg" title="Red digital smartwatch" data-lightbox="productview"></a></div>
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
              <h2 class="h4">Red digital smartwatch</h2>
              <p class="text-muted">$250</p>
              <p class="text-small mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam convallis.</p>
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-7 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                    <div class="quantity">
                      <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                      <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                      <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-5 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="cart.php">Add to cart</a></div>
              </div><a class="btn btn-link text-dark p-0" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="py-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-6">
        <!-- PRODUCT SLIDER-->
        <div class="row m-sm-0">
          <?php
          $product = $conn->query("SELECT * FROM products WHERE id = '$_GET[id]'")->fetch_assoc();
          $resultImgs = $conn->query("SELECT name FROM images WHERE pro_id = '$_GET[id]'");
          ?>
          <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
            <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
              <?php foreach ($resultImgs as $img) : ?>
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="admin/img/<?= explode(",", $img["name"])[0]; ?>" alt="..."></div>
                <!-- <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-2.jpg" alt="..."></div>
                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-3.jpg" alt="..."></div>
                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-3.jpg" alt="..."></div> -->
              <?php endforeach; ?>
            </div>
          </div>
          <div class="col-sm-10 order-1 order-sm-2">
            <div class="owl-carousel product-slider" data-slider-id="1">
              <?php $i = 0;
              foreach ($resultImgs as $img) : ?>
                <a class="d-block" href="admin/img/<?= explode(",", $img["name"])[0]; ?>" data-lightbox="product" title="Product item <?= ++$i ?>">
                  <img class="img-fluid" src="admin/img/<?= explode(",", $img["name"])[0]; ?>" alt="...">
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- PRODUCT DETAILS-->
      <div class="col-lg-6">
        <ul class="list-inline mb-2">
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-gray"></i></li>
        </ul>
        <h1><?= $product["name"] ?></h1>
        <p class="text-muted lead">$<?= $product["price"] ?></p>
        <p class="text-small mb-4"><?= $product["description"] ?></p>
        <form action="functions/carts/add_cart.php?cart=<?= $product["id"] ?>" method="post">
          <div class="row align-items-stretch mb-4">
            <div class="col-sm-5 pr-sm-0">
              <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                <div class="quantity">
                  <div class="dec-btn p-0" style="width: 14px;text-align: center;cursor: pointer;"><i class="fas fa-caret-left"></i></div>
                  <input name=count class="form-control border-0 shadow-0 p-0" type="text" value="1">
                  <div class="inc-btn p-0" style="width: 14px;text-align: center;cursor: pointer;"><i class="fas fa-caret-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-sm-3 pl-sm-0"><button class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0">Add to cart</button></div>
          </div><a class="btn btn-link text-dark p-0 mb-4" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a><br>
        </form>
        <ul class="list-unstyled small d-inline-block">
          <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">SKU:</strong><span class="ml-2 text-muted">039</span></li>
          <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ml-2" href="#">Demo Products</a></li>
          <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Tags:</strong><a class="reset-anchor ml-2" href="#">Innovation</a></li>
        </ul>
      </div>
    </div>
    <!-- DETAILS TABS-->
    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
      <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
      <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
      <?php if (isset($_SESSION["id_user"])) { ?>
        <li class="nav-item"><a class="nav-link" id="add-review-tab" data-toggle="tab" href="#add-review" role="tab" aria-controls="add-review" aria-selected="false">Add review</a></li>
      <?php } ?>
    </ul>
    <div class="tab-content mb-5" id="myTabContent">
      <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
        <div class="p-4 p-lg-5 bg-white">
          <h6 class="text-uppercase">Product description </h6>
          <p class="text-muted text-small mb-0"><?= $product["description"] ?></p>
        </div>
      </div>
      <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
        <div class="p-4 p-lg-5 bg-white">
          <div class="row">
            <div class="col-lg-8">
              <?php
              $comments = $conn->query("SELECT * FROM comment WHERE pro_id = '$_GET[id]'");
              foreach ($comments as $comment) :
                $user = $conn->query("SELECT * FROM user WHERE id = '$comment[user_id]'")->fetch_assoc();
              ?>
                <div class="media mb-3"><img class="rounded-circle" src="admin/img/<?= $user["image"] ?>" alt="" width="50">
                  <div class="media-body ml-3">
                    <h6 class="mb-0 text-uppercase"><?= $user["username"] ?></h6>
                    <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                    <ul class="list-inline mb-1 text-xs">
                      <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                    </ul>
                    <p class="text-small mb-0 text-muted"><?= $comment["comment"] ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <?php if (isset($_SESSION["id_user"])) { ?>
        <div class="tab-pane fade" id="add-review" role="tabpanel" aria-labelledby="add-review-tab">
          <div class="p-4 p-lg-5 bg-white">
            <h6 class="text-uppercase">Add review</h6>
            <p class="text-muted text-small mb-0">

            <form action="functions/add_comment.php?id=<?= $_SESSION["id_user"] ?>&pro_id=<?= $_GET["id"] ?>" method="post">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">type you'r review</label>
                <textarea name="review" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php if (isset($_GET["error"])) {
              if ($_GET["error"] == "comment") { ?>
                <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                  <i class="fas fa-exclamation-triangle mr-3"></i>
                  <div>
                    you'r comment is empty
                  </div>
                </div>
            <?php }
            } ?>
            </p>
          </div>
        </div>
      <?php } ?>

    </div>
    <!-- RELATED PRODUCTS-->
    <h2 class="h5 text-uppercase mb-4">Related products</h2>
    <div class="row">
      <!-- PRODUCT-->
      <div class="col-lg-3 col-sm-6">
        <div class="product text-center skel-loader">
          <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-1.jpg" alt="..."></a>
            <div class="product-overlay">
              <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
              </ul>
            </div>
          </div>
          <h6> <a class="reset-anchor" href="detail.php">Kui Ye Chen’s AirPods</a></h6>
          <p class="small text-muted">$250</p>
        </div>
      </div>
      <!-- PRODUCT-->
      <div class="col-lg-3 col-sm-6">
        <div class="product text-center skel-loader">
          <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-2.jpg" alt="..."></a>
            <div class="product-overlay">
              <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
              </ul>
            </div>
          </div>
          <h6> <a class="reset-anchor" href="detail.php">Air Jordan 12 gym red</a></h6>
          <p class="small text-muted">$300</p>
        </div>
      </div>
      <!-- PRODUCT-->
      <div class="col-lg-3 col-sm-6">
        <div class="product text-center skel-loader">
          <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-3.jpg" alt="..."></a>
            <div class="product-overlay">
              <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
              </ul>
            </div>
          </div>
          <h6> <a class="reset-anchor" href="detail.php">Cyan cotton t-shirt</a></h6>
          <p class="small text-muted">$25</p>
        </div>
      </div>
      <!-- PRODUCT-->
      <div class="col-lg-3 col-sm-6">
        <div class="product text-center skel-loader">
          <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-4.jpg" alt="..."></a>
            <div class="product-overlay">
              <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
              </ul>
            </div>
          </div>
          <h6> <a class="reset-anchor" href="detail.php">Timex Unisex Originals</a></h6>
          <p class="small text-muted">$351</p>
        </div>
      </div>
    </div>
  </div>
</section>
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
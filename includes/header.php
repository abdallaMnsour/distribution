<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once "functions/connect.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Boutique | Ecommerce bootstrap template</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/all.min.css">
  <!-- Lightbox-->
  <link rel="stylesheet" href="vendor/lightbox2/css/lightbox.min.css">
  <!-- Range slider-->
  <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
  <!-- Bootstrap select-->
  <link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.min.css">
  <!-- Owl Carousel-->
  <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.theme.default.css">
  <!-- Google fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.png">
  <style>
    #button-toggle::after {
      display: none;
    }

    #arrowMenu::before {
      left: 10.5rem;
    }

    @media (max-width: 991px) {
      #con_dropdown {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      #arrowMenu {
        margin-top: 10px;
      }

      #arrowMenu::before {
        left: 5.75rem;
      }
    }
  </style>
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
  <div class="page-holder">
    <!-- navbar-->
    <header class="header bg-white">
      <div class="container px-0 px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="font-weight-bold text-uppercase text-dark">Boutique</span></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <!-- Link--><a class="nav-link 
                <?= isset($_GET["header"]) ? $_GET["header"] == "home" ? "active" : "" : "" ?>" href="index.php?header=home">Home</a>
              </li>
              <li class="nav-item">
                <!-- Link--><a class="nav-link 
                <?= isset($_GET["header"]) ? $_GET["header"] == "shop" ? "active" : "" : "" ?>" href="shop.php?header=shop">Shop</a>
              </li>
              <li class="nav-item dropdown <?= isset($_GET["page"]) ? $_GET["page"] == "active" ? "active" : "" : "" ?>">
                <a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item border-0 transition-link" href="index.php?header=home">Homepage</a>
                  <a class="dropdown-item border-0 transition-link" href="shop.php?header=shop">Category</a>
                  <?php if (isset($_SESSION["id_user"])) { ?>
                    <a class="dropdown-item border-0 transition-link 
                  <?= isset($_GET["header"]) ? $_GET["header"] == "cart" ? "active" : "" : "" ?>" href="cart.php?header=cart&page=active">Shopping cart</a>
                    <a class="dropdown-item border-0 transition-link 
                  <?= isset($_GET["header"]) ? $_GET["header"] == "checkout" ? "active" : "" : "" ?>" href="checkout.php?header=checkout&page=active">Checkout</a>
                  <?php } ?>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto d-flex align-items-center">
              <?php
              if (isset($_SESSION["id_user"])) {
                $cart = $conn->query("SELECT COUNT(id) as count FROM cart WHERE user_id = '$_SESSION[id_user]'")->fetch_assoc(); ?>
                <li class="nav-item"><a class="nav-link" href="cart.php"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i> Cart <small class="text-gray"> (<?= $cart["count"] ?>)</small></a></li>
              <?php } else { ?>
                <li class="nav-item"><a class="nav-link" href="cart.php"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i> Cart <small class="text-gray"> (0)</small></a></li>
              <?php } ?>
              <li class="nav-item"><a class="nav-link" href="#"> <i class="far fa-heart mr-1"></i><small class="text-gray"> (0)</small></a></li>
              <?php
              if (!isset($_SESSION["id_user"])) { ?>
                <li class="nav-item"><a class="nav-link" href="login.php"> <i class="fas fa-user-alt mr-1 text-gray"></i>Login</a></li>
              <?php } else {
                $user = $conn->query("SELECT * FROM user WHERE id = '$_SESSION[id_user]'")->fetch_assoc();
              ?>

                <!-- Modal -->
                <div class="modal fade" id="modelLogOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        are you sure you log out ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="functions/user/log_out.php" type="button" class="btn btn-danger">Confirm</a>
                      </div>
                    </div>
                  </div>
                </div>

                <li class="dropdown" id="con_dropdown">
                  <button id="button-toggle" class="dropdown-toggle" style="
                  border: none;
                  width: 35px;
                  padding: 0;
                  margin: 0;
                  background: transparent;" id="ddm_button" type="button" data-toggle="dropdown" aria-expanded="false">
                    <img style="border-radius: 50%;box-shadow: 0px 0px 7px 0px #9c9c9c;" width="35" src="admin/img/<?= $user["image"] ?>" alt="user_image" title="log-out">
                  </button>
                  <div class="dropdown-menu " id="arrowMenu" style="left: -162px;top: 43px;">
                    <a class="dropdown-item" href="edit_user.php?id=<?= $_SESSION["id_user"] ?>">Edit</a>
                    <a type="button" class="dropdown-item" data-toggle="modal" data-target="#modelLogOut">
                      Log out
                    </a>
                  </div>
                </li>
              <?php } ?>
            </ul>
          </div>
        </nav>
      </div>
    </header>

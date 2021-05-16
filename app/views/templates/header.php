<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?= $data['judul']; ?></title>
    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/merk-wb.png" type="image/x-icon">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/bootstrap.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/jquery.fancybox.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/slicknav.min.css">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/reset.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>css/responsive.css">
</head>

<body>
    <!-- Header -->
    <header class="header shop">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <!-- Top Left -->
                        <div class="top-left">
                            <ul class="list-main">
                                <li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
                                <li><i class="ti-email"></i> support@shophub.com</li>
                            </ul>
                        </div>
                        <!--/ End Top Left -->
                    </div>
                    <div class="col-lg-8 col-md-12 col-12">
                        <!-- Top Right -->
                        <div class="right-content">
                            <ul class="list-main">
                                <li><i class="ti-location-pin"></i> Store location</li>
                                <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>

                                <?php if (isset($_SESSION['email'])) : ?>
                                    <li><i class="ti-user"></i> <a href="<?= BASEURL; ?>">My account</a></li>
                                    <li><i class="fas fa-sign-out-alt"></i> <a href="<?= BASEURL; ?>auth/logout">Logout</a></li>
                                <?php else : ?>
                                    <li><i class="ti-power-off"></i><a href="<?= BASEURL; ?>auth">Login</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <!-- End Top Right -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <div class="middle-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-12">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.html"><img src="<?= BASEURL; ?>img/merk-b.png" alt="logo"></a>
                        </div>
                        <!--/ End Logo -->
                        <!-- Search Form -->
                        <div class="search-top">
                            <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                            <!-- Search Form -->
                            <div class="search-top">
                                <form class="search-form">
                                    <input type="text" placeholder="Search here..." name="search">
                                    <button value="search" type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                            <!--/ End Search Form -->
                        </div>
                        <!--/ End Search Form -->
                        <div class="mobile-nav"></div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="search-bar-top">
                            <div class="search-bar">
                                <select>
                                    <option selected="selected">All Category</option>
                                    <option>watch</option>
                                    <option>mobile</option>
                                    <option>kid’s item</option>
                                </select>
                                <form>
                                    <input name="search" placeholder="Search Products Here....." type="search">
                                    <button class="btnn"><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar">
                                <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="sinlge-bar shopping">
                                <a href="#" class="single-icon"><i class="fas fa-shopping-cart"></i> <span class="total-count">2</span></a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>2 Items</span>
                                        <a href="#">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        <li>
                                            <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                            <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                                            <h4><a href="#">Woman Ring</a></h4>
                                            <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                        </li>
                                        <li>
                                            <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                            <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                                            <h4><a href="#">Woman Necklace</a></h4>
                                            <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">$134.00</span>
                                        </div>
                                        <a href="checkout.html" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="cat-nav-head">
                    <div class="row">
                        <div class="col-lg-9 col-12">
                            <div class="menu-area">
                                <!-- Main Menu -->
                                <nav class="navbar navbar-expand-lg">
                                    <div class="navbar-collapse">
                                        <div class="nav-inner">
                                            <ul class="nav main-menu menu navbar-nav">
                                                <li class="active"><a href="<?= BASEURL; ?>">Home</a></li>
                                                <li><a href="#">Product</a></li>
                                                <li><a href="#">Service</a></li>
                                                <li><a href="<?= BASEURL; ?>shop">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
                                                    <ul class="dropdown">
                                                        <li><a href="shop-grid.html">Shop Grid</a></li>
                                                        <li><a href="cart.html">Cart</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Pages</a></li>
                                                <li><a href="#">Blog<i class="ti-angle-down"></i></a>
                                                    <ul class="dropdown">
                                                        <li><a href="blog-single-sidebar.html">Blog Single Sidebar</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="contact.html">Contact Us</a></li>
                                                <li><a href="<?= BASEURL; ?>admin">Admin</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </nav>
                                <!--/ End Main Menu -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!--/ End Header -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASEURL; ?>">Codarel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= BASEURL; ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shop
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>shop">All</a></li>
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>">Kaos</a></li>
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>">Jaket</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>auth">Auth</a>
                    </li>
                    <?php if (isset($_SESSION['email'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary" href="<?= BASEURL; ?>auth/logout">Keluar</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary" href="<?= BASEURL; ?>auth">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-2 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="btn btn-outline-warning"><i class="fas fa-shopping-cart"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->
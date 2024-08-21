<?php
session_start(); // Start the session
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">


</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 fixed-top">
        <img class="logo" src="assets/imgs/logo.png" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link poppins-thin" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link poppins-thin" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link poppins-thin" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                <a href="cart.php">
                            <i class="fas fa-shopping-cart">
                            <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0 && $_SESSION['logged_in']){?>
                                <span class="cart-quantity"><?php echo $_SESSION['quantity'];?></span>
                                <?php }?>
                            </i>
                        </a>  
                        <a href="account.php"><i class="fas fa-user"></i></a> <!-- Added user-icon class -->
                    </a>
                </li>
            </ul>
        </div>
        
    </nav>

    <!--Home-->
    <section id="home" > 
            <h5>NEW ARRIVALS</h5>
            <h1><span> Best Prices</span> Right Now!</h1>
            <p>E-shop offers the best prices</p>
            <a href='shop.php'><button>Shop Now</button></a>
        </div>
    </section>

    <!--Brand-->
    <section id="brand" class="container mb-5">
        <div class="overflow-hidden">
            <div class="row brand-row">
                <div class="col-lg-3 col-md-6 col-sm-12 brand-container">
                    <img class="img-fluid" src="assets/imgs/KD.png" alt="KD"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 brand-container">
                    <img class="img-fluid" src="assets/imgs/PEM.png" alt="PEM"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 brand-container">
                    <img class="img-fluid" src="assets/imgs/birmingham_fastener.jpg" alt="Birmingham Fastener"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 brand-container">
                    <img class="img-fluid" src="assets/imgs/portland.jpeg" alt="Portland"/>
                </div>
            </div>
        </div>
    </section>
    
    
    

    <!--New-->
    <section id="new" class="w-100">
    <div class="row p-0 m-0 no-gutters">
        <!-- One -->
        <div onclick="window.location.href='shop.php'" class="one col-lg-4 col-md-12 col-sm-12 p-0 px-lg-1 d-flex justify-content-center">
            <img class="img-fluid" src="assets/imgs/With background/Bolts/hex bolt.webp"/>
            <div class="details">
                <h2>Bolts</h2>
                <button class="text-uppercase">Shop Now</button>
            </div>
        </div>

        <!-- Two -->
        <div onclick="window.location.href='shop.php'" class="one col-lg-4 col-md-12 col-sm-12 p-0 px-lg-1 d-flex justify-content-center">
            <img class="img-fluid" src="assets/imgs/With background/Nuts/hex nut.jpg">
            <div class="details">
                <h2>Nuts</h2>
                <button class="text-uppercase">Shop Now</button>
            </div>
        </div>

        <!-- Three -->
        <div onclick="window.location.href='shop.php'" class="one col-lg-4 col-md-12 col-sm-12 p-0 px-lg-1 d-flex justify-content-center">
            <img class="img-fluid" src="assets/imgs/With background/Screws/using scre.jpg">
            <div class="details">
                <h2>Screws</h2>
                <button class="text-uppercase">Shop Now</button>
            </div>
        </div>
    </div>
</section>

<!--Featured-->
<section id="featured" class="my-5 pb-5">
    <div class ="container text-center mt-5 py-5">
        <h3>Our Featured</h3>
        <hr class="mx-auto">
        <p>Check out our featured products</p>
    </div>
    <div class="row mx-auto container-fluid">

        <?php include('server/get_featured_products.php');?>
        <?php while($row = $featured_products->fetch_assoc()){ ?>

        <div onclick="window.location.href='shop.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name'];  ?></h5>
            <h4 class="p-price">₱<?php echo $row['product_price']; ?></h4>
            <button class="buy-btn">Shop Now</button>
        </div>
        <?php } ?>
    </div>
</section>


<!--Banner-->
<section id="banner" class="my-5 py-5">
    <div class="container"></div>
</section>

<!--Bolts-->
<section id="bolts" class="my-5">
    <div class ="container text-center mt-5 py-5">
        <h3>Bolts</h3>
        <hr>
        <p>Check out our bolts</p>
    </div>
    <div onclick="window.location.href='shop.php#bolts'" class="row mx-auto container-fluid">

        <?php include('server/get_bolts.php'); ?>
        <?php  while($row=$bolts_products->fetch_assoc()){ ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price">₱<?php echo $row['product_price'];?></h4>
            <button class="buy-btn">Shop Now</button>
        </div>
        <?php } ?>
    </div>
</section>

<!--Nuts-->
<section id="nuts" class="my-5">
    <div class ="container text-center mt-5 py-5">
        <h3>Nuts</h3>
        <hr>
        <p>Check out our nuts</p>
    </div>
    <div onclick="window.location.href='shop.php#nuts'" class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Nuts/hex.webp"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Hex Nuts</h5>
            <h4 class="p-price">₱20.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>

        <div onclick="window.location.href='shop.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Nuts/Cross Barrel Nut.png"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Cross Barrel Nuts</h5>
            <h4 class="p-price">₱25.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>

        <div onclick="window.location.href='shop.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Nuts/Barrel Nut.png"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Barrel Nut</h5>
            <h4 class="p-price">₱50.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>

        <div onclick="window.location.href='shop.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Nuts/Coupling Nut.png"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Coupling Nuts</h5>
            <h4 class="p-price">₱100.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>
    </div>
</section>

<!--Screws-->
<section id="screws" class="my-5">
    <div class ="container text-center mt-5 py-5">
        <h3>Screws</h3>
        <hr>
        <p>Check out our screws</p>
    </div>
    <div onclick="window.location.href='shop.php#screws'" class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Screws/Philips Head.png"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Philips Head Screws</h5>
            <h4 class="p-price">₱20.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>

        <div onclick="window.location.href='shop.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Screws/Binding Head.png"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Binding Head Screws</h5>
            <h4 class="p-price">₱25.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>

        <div onclick="window.location.href='shop.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Screws/Dome Head.png"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Dome Head Screws</h5>
            <h4 class="p-price">₱50.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>

        <div onclick="window.location.href='shop.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/With background/Screws/Flat Head.png"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">x10 Flat Head Screws</h5>
            <h4 class="p-price">₱100.00</h4>
            <button class="buy-btn">Shop Now</button>
        </div>
    </div>
</section>


<!--Footer-->
<footer class="mt-5 py-5">
    <div class="row mx-auto">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img src="assets/imgs/logo.png" style="max-height: calc(9rem - 1.5rem);"/>
            <p class="mt-3">Your one stop online bolt shop</p>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Featured</h5>
            <ul class="text-uppercase">
                <li><a href="#">Bolts</a></li>
                <li><a href="#">Nuts</a></li>
                <li><a href="#">Screws</a></li>
            </ul>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contact Us</h5>
            <div>
                <h6 class="text-uppercase">Address</h6>
                <p>Dumaguete City 6200, Negros Oriental</p>
            </div>
            <div>
                <h6 class="text-uppercase">Phone</h6>
                <p>09971867***</p>
            </div>
            <div>
                <h6 class="text-uppercase">Email</h6>
                <p>carlostbautista@su.edu.ph</p>
            </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 ckass="pb-2">Instagram</h5>
            <dev class="row">
                <img src="assets/imgs/With background/Bolts/hex bolt.webp" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/With background/Nuts/Cage Nut.png" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/With background/Bolts/Anchor Bolt.png" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/With background/Screws/Philips Head.png" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/With background/Nuts/Coupling Nut.png" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/With background/Screws/Flat Head.png" class="img-fluid w-25 h-100 m-2"/>
            </dev>
        </div>
    </div>

    <div class="copyright mt-5">
        <div class="row container mx-auto">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <img src="assets/imgs/gcash.png"/>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap">
                <p>eCommerce @ 2024 All Rights Reserved</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-x"></i></a>
            </div>
        </div>
    </div>



</footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

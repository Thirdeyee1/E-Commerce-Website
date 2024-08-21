<?php

session_start(); // Start the session


include('server/connection.php');

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];


    $stmt = $conn ->prepare("SELECT * FROM products WHERE product_id = ? ");
    $stmt -> bind_param("i", $product_id);
    $stmt -> execute();

    $product = $stmt -> get_result();



//no product id
}else{
    header('location: index.php');

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

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



<!--SIingle product-->
<section class="container single-product my-5 pt-5 pb-5">
    <div class="row mt-5">

        <?php while($row = $product->fetch_assoc()){ ?>
        
            
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php  echo$row['product_image']; ?>"/>
                </div>
            

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h6><?php  echo$row['product_category']; ?></h6>
                    <h3 class="py-4"><?php echo $row['product_name'];?></h3>
                    <h2>₱<?php echo $row['product_price'];?></h2>
                    
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php  echo$row['product_id']; ?>"/>
                        <input type="hidden" name="product_image" value="<?php  echo$row['product_image']; ?>"/>
                        <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>"/>
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>"/>

                        
                        <input type="number" name="product_quantity" value="1"/>
                        <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                    
                        <h4 class="mt-5 mb-5">Product Details:</h4>
                        <span><?php echo $row['product_description'];?>
                        </span>
                </div>
            
        <?php } ?>
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
<?php

session_start();

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}


if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){
        // Check if the product is already in the cart
        $products_array_ids = array_column($_SESSION['cart'],"product_id");
        if(!in_array($_POST['product_id'], $products_array_ids)){
            // If not, add the product to the cart
            $product_id = $_POST['product_id'];
            $product_array = array(
                    'product_id'=> $_POST['product_id'],
                    'product_name'=> $_POST['product_name'],
                    'product_price'=> $_POST['product_price'],
                    'product_image'=> $_POST['product_image'],
                    'product_quantity'=> $_POST['product_quantity']
            );
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            // If the product is already in the cart, display a message
            echo '<script>alert("Product is already in cart");</script>';
        }
    } else {
        // If cart is not set, add the product to the cart
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
                'product_id'=> $product_id,
                'product_name'=> $product_name,
                'product_price'=> $product_price,
                'product_image'=> $product_image,
                'product_quantity'=> $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
    }

    //calculate total
    calculateTotalCart() ;

    //remove product
} else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculate total
    calculateTotalCart() ;

}else if( isset($_POST['edit_quantity'])){
    //get id and quantity from form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //get product array from session
    $product_array = $_SESSION['cart'][ $product_id ];

    //update product quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back
    $_SESSION['cart'][ $product_id ] = $product_array;


    //calculate total
    calculateTotalCart() ;


}else if(isset($_POST['checkout'])) {
    // Check if cart is empty
    if(empty($_SESSION['cart'])) {
        // Display a notification
        echo '<script>alert("There are no items in the cart.");</script>';
    } else {
        // Redirect
        header('location: cart.php');
    }
}

function calculateTotalCart(){
    $total_price = 0; // Initialize total outside the loop
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][ $key ];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity =  $total_quantity+$quantity;
    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
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
                </li>
            </ul>
        </div>
        
    </nav>


    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>


            <?php if(isset($_SESSION['cart'])){?>

            <?php foreach($_SESSION['cart'] as $key => $value){?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $value['product_image'];?>"/>
                        <div>
                            <p><?php echo $value['product_name'];?></p>
                            <small><span>₱</span><?php echo $value['product_price'];?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="remove_product" class="remove-btn"  value="Remove"/>
                            </form>
                            
                        </div>
                    </div>
                </td>

                <td>
                    
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                        <input type="number" name ="product_quantity" value="<?php echo $value['product_quantity'];?>"/>
                        <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>

                    </form>
                    
                </td>

                <td>
                    <span>₱</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                </td>

            </tr>
            <?php }?>
            <?php }?>
        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <?php if(isset($_SESSION['cart'])){?>
                        <td>₱<?php echo $_SESSION['total'];?></td>
                        <?php }?>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <form method ="POST" action="checkout.php">
                <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
            </form>
            
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
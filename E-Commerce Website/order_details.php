<?php 

session_start(); // Start the session


include('server/connection.php');


if(isset($_GET['order_details_btn']) && isset( $_GET['order_id'] )) {

    $order_id = $_GET['order_id'];
    $order_status = $_GET['order_status'];
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id =?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);


}else{
    header('location: account.php');
    exit;
}


function calculateTotalOrderPrice($order_details){
    $total = 0; // Initialize total outside the loop

    foreach($row = $order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total+ ( $product_price * $product_quantity);

    }
    return $total;
}






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





    <!--Orders Details-->
    <section id="order_details" class="order_details container my-5 py-5">
            <div class="container mt-5">
                <h2 class="font-weight-bold text-center">Order Details</h2>
                <hr class="mr-auto">
            </div>

            <table class="table mt-5 pt-5 mx-auto">
                <tr>
                    <th>Product</th>
                    <th>Sub-Price</th>
                    <th>Quantity</th>
                    <th>Price</th>


                </tr>

                <?php foreach($order_details as $row) {?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image'];?>"/>
                            <div>
                                <p class="mt-3"><?php echo $row['product_name'];?></p>

                            </div>

                        </div>

                    </td>
                   
                    <td>
                        <span>₱<?php echo $row['product_price'];?>.00</span>   
                    </td>
                    <td>
                        <span><?php echo $row['product_quantity'];?></span>   
                    </td>
                    <td>
                        <span>₱<?php echo $row['product_quantity'] * $row['product_price']; ?>.00</span>   
                    </td>
                </tr>

                <?php }?>
            </table>

            <?php if($order_status =="on_hold"){?>
                <form style = "float:right;" method="POST" action="payment.php">
                    <input type="hidden" name="order_id" value="<?php echo $order_id?>"/>
                    <input type="hidden" name="order_total_price" value="<?php echo $order_total_price;?>"/>
                    <input type="hidden" name="order_status" value="<?php echo $order_status;?>"/>
                    <input type="submit" name = "order_pay_btn"class="btn btn-primary" value="Pay Now"/>

                </form>

            
            
            
            <?php }?>

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

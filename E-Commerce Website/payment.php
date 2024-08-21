<?php 

session_start();

if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];

    // Update $_SESSION['total'] with the new total price
   
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





   
   <!-- Payment -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">


            <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "on_hold"){?>
            <?PHP $amount= strval($_POST['order_total_price']);?>
            <?php $order_id = $_POST['order_id'];?>
            <p>Total payment: ₱<?php echo $_POST['order_total_price']; ?></p>
            <!--<input class="btn btn-primary" type="submit" value="Pay Now"/>-->
            <div id="paypal-button-container"></div>

        <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0): ?>
            <?PHP $amount = strval($_SESSION['total']);?>
            <?php $order_id = $_SESSION['order_id'];?>
            <p>Total Payment: ₱<?php echo $_SESSION['total']; ?>.00</p>
            <!--<input class="btn btn-primary" type="submit" value="Pay Now"/>-->
            <div id="paypal-button-container"></div>



        <?php else: ?>
            <p>You don't have an order.</p>
        <?php endif; ?>



       


    </div>
</section>

<style>
    #paypal-button-container {
        margin: auto;
        width: fit-content  ;
    }
</style>



<!-- PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=ASmEv4_Bv9ld0frVDj8N5FNbI5NBCQJsKh9jQH90Q9vLB7FoV-wrl28TpPWy6wVS5CZREX-5YtytSfDY&currency=PHP"></script>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $amount; ?>'
                    }
                }]
            });
        },

        onApprove: function(data, actions) { // Fixed the typo here
            return actions.order.capture().then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details.');
            
                window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id?>
            
            
            
            });
        }
    }).render('#paypal-button-container');
</script>   


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

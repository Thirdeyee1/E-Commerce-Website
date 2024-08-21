<?php 


/*
    on_hold
    shipped
    delivered
*/
session_start();
include('server/connection.php');


if (!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['cart']);
        unset($_SESSION['quantity']);
        
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    // Passwords don't match
    if($password !== $confirmPassword){
        header("location: account.php?error=Passwords don't match");
        exit;
    }

    // Password is less than 6 characters
    else if(strlen($password) < 6){
        header('location: account.php?error=Password must be at least 6 characters');
        exit;
    }

    // No errors
    else{
        $hashed_password = md5($password);
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email =?");
        $stmt->bind_param('ss', $hashed_password, $user_email);

        if($stmt->execute()){
            header('location: account.php?message=Password has been updated successfully.');
            exit;
        }else{
            header('location: account.php?error=Could not update password.');
            exit;
        }
    }
}


//get orders
if(isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_id'];

    $stmt = $conn ->prepare("SELECT * FROM orders WHERE user_id =? ORDER BY order_date DESC ");
    
    $stmt->bind_param('i', $user_id);

    $stmt -> execute();

    $orders = $stmt -> get_result();

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
                        <?php 
                        if(isset($_SESSION['logged_in']) && isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) {
                            echo '<span class="cart-quantity">' . $_SESSION['quantity'] . '</span>';
                        } else {
                            unset($_SESSION['cart']);
                        }
                        ?>
                </i>
                        </a>  
                        <a href="account.php"><i class="fas fa-user"></i></a> <!-- Added user-icon class -->
                    </a>
                </li>
            </ul>
        </div>
        
    </nav>




    <!--Account-->
    <section class="my-5 py-5">

        <?php if(isset($_GET['payment_message'])){?>

            <p class="mt-5 text-center" style="color:green"><?php echo $_GET['payment_message'];?> </p> 

        <?php }?> 

        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            
            <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];}?></p>
            <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];}?></p>
            <h3 class="font-weight-bold">Account Info</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name:<span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span></p>
                    <p>Email:<span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];}?></span></p>
                    <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>

            </div>

            
            <div class="mt-2 col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                    <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                    <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required/>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password"class="btn" id="change-pass-btn">
                    </div>

                </form>
            </div>

        </div>
    </section>


    <!--Orders-->
        <section id="orders" class="orders container mt-5 ">
        <div class="container">
            <h2 class="font-weight-bold text-center">Your Orders</h2>
        </div>

            <?php if ($orders->num_rows > 0) { ?>
                <table>
                    <tr class="headline">
                        <th>Order ID</th>
                        <th>Order Cost</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Order Details</th>
                    </tr>
            <?php  while($row = $orders->fetch_assoc()){?>

            <tr>
                <td>
                    <span><?php echo $row['order_id']?></span>
                </td>
                <td>
                    <span>₱ <?php echo $row['order_cost']; ?></span>   
                </td>

                <td>
                    <?php 
                        $order_status = $row['order_status'];
                        if ($order_status == 'on_hold') {
                            echo '<span style="color: red;">Pending</span>';
                        } else if($order_status == 'paid'){
                            echo '<span style="color: green;">Approved</span>';


                        }else {echo '<span>' . $order_status . '</span>';
                        }
                    ?>  
                </td>
                <td>
                    <span><?php echo $row['order_date']; ?></span>   
                </td>

                <td>
                    <form method="GET" action="order_details.php">
                        <input type="hidden" value="<?php echo $row['order_status'];?>" name="order_status"/>
                        <input type="hidden" value="<?php echo $row['order_id'];?>" name ="order_id"/>
                        <input href=""class="btn order-details-btn" name="order_details_btn" type="submit" value="details"/>
                    </form>


                </td>


            </tr>
            <?php }?>
        </table>
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

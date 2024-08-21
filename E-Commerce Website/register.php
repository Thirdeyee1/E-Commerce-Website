<?php 

session_start();

include('server/connection.php');


 if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}


if(isset($_POST["register"])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Passwords don't match
    if($password !== $confirmPassword){
        header("location: register.php?error=Password doesn't match");
        exit;
    }

    // Password is less than 6 characters
    else if(strlen($password) < 6){
        header('location: register.php?error=Password must be at least 6 characters');
        exit;
    }

    // If no error
    else{
        // Check if existing credentials
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        // User with this email exists
        if($num_rows != 0){
            header('location: register.php?error=User with email already exists.');
            exit;
        }

        // No user with this email
        else{
            // Create new user
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password)
                                    VALUES (?, ?, ?)");

            $password_hashed = md5($password); // Hash the password using MD5
            $stmt->bind_param("sss", $name, $email, $password_hashed);

            // If account was created successfully
            if($stmt->execute()){
                $user_id = $stmt->insert_id;
                $_SESSION['user_id']= $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=Registered Successfully');
                exit;
            } else {
                header('location: register.php?error=Could not create an account at the moment');
                exit;
            }
        }
    }
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
                    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>  
                    <a href="login.php"><i class="fas fa-user"></i></a> <!-- Added user-icon class -->
                </li>
            </ul>
        </div>
        
    </nav>


    <!--Register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>

                <div class="form-group">
                    <a href="login.php" id="login-url" class="btn">Do you have an account? Login</a>
                </div>


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

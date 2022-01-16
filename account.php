<?php
require "./database.php";

//Use SESSION to register the type of the user
session_start();

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
   
    $query = $pdo->prepare("SELECT username, password, userType FROM unixdatabase.users WHERE username =? AND password=?");
    $query->execute([$username, $password]);
    $result = $query->rowCount();
    if ($result >0){  
      
        $fetch = $query->fetch();
        // CHECKS IF THE USER IS AN ADMIN OR NOT
        if ($fetch['userType'] == 'admin')
        {
            $_SESSION['type'] = 'admin';
            header("location:adminPage.php");

        } elseif ($fetch['userType'] == 'customer'){
            $_SESSION['type'] = 'customer';
            header("location:home.php");
        }
    } else{
        echo 'Wrong Credentials';
    }
}

// REGISTRATION
if (isset($_POST['register'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = 'customer';

    
   //CHECKS IF THE USER ALREADY EXISTS
    $query = $pdo->prepare("SELECT username, password FROM unixdatabase.users WHERE username =?");
    $query->execute([$username]);
    $result = $query->rowCount();
    if ($result >0){
        echo 'Use different username. '.'<strong>'.$username.'</strong>'.' Already taken!';
        
    } else{ //IF IT DOESN'T IT WILL CREATE A NEW ONE
        try{
            $query = $pdo->prepare("INSERT INTO unixdatabase.users(userType, username, password, email, firstName, lastName) VALUES(:usert, :userN, :pass, :email, :fname, :lname)");
            $query->execute([
                'usert'=> $userType,
                'userN'=> $username,
                'pass'=> $password,
                'email'=> $email,
                'fname'=> $firstName,
                'lname'=> $lastName,
            ]);
       
            header("location:home.php");
        }
        catch (Exception $e){
           return 'SOMETHING WENT WRONG. TRY AGAIN.';
        }
    }
}

?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
	<title>Account</title>
	<link rel = "stylesheet" href ="style.css">
	<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<div class = "header">
	<div class = "container">
		<div class = "navbar">
		<div class = "logo">
			<img src="mainlogo.jpg" width="70px">
		</div>
			<nav>
                <b> <p style="text-align:left; font-family: helvetica; padding: 20px; padding-top: 30px;">UNIX</p> </b>
				<ul id = "MenuItems">
					<li> <a href ="./home.php">Home</a></li>
					<li> <a href ="./products.php">Products</a></li>
					<li> <a href ="./cart.php">Cart</a></li>
					<li> <a href ="./account.php">Login</a></li>
				</ul>	
		</div>
    </div>
    </div>
    <hr>

<!-- account-page -->
<div class = "account-page">
	<div class = "container">
		<div class = "row">
			<div class = "col-2">
				<div class = "form-container">
					<div class ="form-btn">
						<span onclick = "login()">Login</span>
						<span onclick = "register()">Register</span>
						<hr id= "Indicator">
					</div>
					<form id = "LoginForm" action="./account.php" method="POST">
						<input name="username" type="text" placeholder="Username" required>
						<input name="password" type="password" placeholder="Password" required>
						<input type="submit" value="Login" class= "btn" name="login">
						<a href="#">Forgot Password</a>
					</form>
					<form id="RegForm" action="./account.php" method="POST">
						<input type="text" placeholder="First Name" name="firstName" required>
						<input type="text" placeholder="Last Name" name="lastName" required>
						<input type="text" placeholder="Username" name="username" required>
						<input type="text" placeholder="Email" name="email" required>
						<input type="password" placeholder="Password" name="password" required>

						<input type="submit" value="Register" class = "btn" name="register">

					</form>
				</div>
			</div>			
		</div>
	</div>	
</div>


<!-- footer -->

<div class = "footer">
    <div class ="container">
        <div class = "row">
            <div class = "footer-col-1">
                <h3>Download Our App</h3>
                <img src="mainlogo.jpg">
                <p>Download Our App for Android and IOS</p>
            </div>
            <div class = "footer-col-2">
                <p>Embrace your inner child!</p>
            </div>
            <div class = "footer-col-3">
                <h3>Useful links</h3>
                <ul>
                    <li>Coupons</li>
                    <li>Blog Posts</li>
                    <li>Return Policy</li>
                    <li> Join Affiliate</li>
                </ul>
            </div>
            <div class = "footer-col-3">
                <h3>Follow Us</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                    <li> Youtube</li>
                </ul>
            </div>
        </div>	
        <hr>
        <p class = "copyright">Copyright 2021 - Disney</p>
    </div>	
</div>

<!-- js of toggle menu -->
	<script>
		var MenuItems = document.getElementById("MenuItems");
		MenuItems.style.maxHeight = "0px";
		function menutoggle(){
			if (MenuItems.style.maxHeight =="0px")
			{
				MenuItems.style.maxHeight ="200px"
			}
			else
			{
				MenuItems.style.maxHeight =="0px"
			}
		}
	 </script>
	 <!-- js of toggle menu -->
	 <script>
	 	var LoginForm = document.getElementById("LoginForm");
	 	var RegForm = document.getElementById("RegForm");
	 	var Indicator = document.getElementById("Indicator");
	 		
	 		function register(){
	 			RegForm.style.transform = "translateX(0px)";
	 			LoginForm.style.transform = "translateX(0px)"
	 			Indicator.style.transform ="translateX(100px)"
	 		}
	 		function login(){
	 			RegForm.style.transform = "translateX(300px)";
	 			LoginForm.style.transform = "translateX(300px)";
	 			Indicator.style.transform = "translateX(0px)";


	 		}

	 </script>	
</body>
</html>
<?php
require "./database.php";
session_start();

if (isset($_GET['product'])){
    
    //PRODUCT INFO
    $product = $pdo->prepare("SELECT productName, productImage, productInfo, price FROM unixdatabase.products
                            WHERE productName LIKE ?");
    $product->execute(['%'.$_GET['product'].'%']);
 
}


?>


<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
	<title>Enchanted Rose</title>
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
					<li> <a href ="cart.html">Cart</a></li>
                    <?php

if ($_SESSION['type'] == 'customer'){
?>
    				<li><a href="./logout.php?data=logout">LogOut</a></li>
<?php
} else{ ?>
    				<li><a href="./account.php">Login</a></li>
<?php
}
?>	
				</ul>	
		</div>
    </div>
    </div>
    <hr>


<div class = "small-container single-prouduct">
	<div class = "row">
		<div class = "col-2">
<?php foreach ($product as $infoProduct){ 
    $path = 'data:image/jpeg'.';base64,'.base64_encode( $infoProduct['productImage']);     
?>
		<img src="<?php echo $path;?>" width = "100%" id="prouductImg">
		</div>
		<div class = "col-2">
			<h1><?php echo $infoProduct['productName'];?></h1>
            <br>
			<h3>$<?php echo $infoProduct['price'];?></h3>
            <br>
            
            <form method="POST" action="./cart.php" >
                <input name="quantity" type="number" value="1" min="1">
                
                <input name="product" hidden type="text" value="<?php echo $infoProduct['productName']?>">
                <input type="submit" value="Add To Cart" style="width:150px;" class="btn" name="cart">
            </form>
			
        
            <br>
            <br>
			<h3>Product Details</h3>
			
			<p><?php echo $infoProduct['productInfo']?></p>
<?php } ?>
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
</body>
</html>
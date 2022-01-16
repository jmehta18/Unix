<?php
require './database.php';
//////////////////////////////////////
// GET DATA
$products = $pdo->prepare("SELECT productImage, productName, price FROM unixdatabase.products");
$products->execute();

?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
	<title>Products</title>
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
session_start();
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


    <div class = "small-container">
        <div class = "row row-2">
            <h2>All Products</h2>
            <select>
                <option>Default sorting</option>
                <option>Sort by price</option>
                <option> Sort by popularity</option>
                <option>Sort by Rating</option>
                <option>Sort by Sale</option>
            </select>
        </div>
        <div class = "row">

<?php
foreach($products as $value){       
    $path = 'data:image/jpeg'.';base64,'.base64_encode( $value['productImage']);
?>
            <div class = "col-4">
            <a href="./singleProduct.php?product=<?php echo $value['productName'];?>">
             <img src="<?php echo $path;?>">
                  </a>
                
                <h4><?php echo $value['productName']?></h4>
                <div class = "rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    
                </div>
                <p>$<?php echo $value['price'];?></p>
            </div>
<?php } ?>

        <div class = "page-btn">
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
                <span>&#8594;</span>
                
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
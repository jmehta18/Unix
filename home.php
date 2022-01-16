<?php
require "./database.php";



$lProduct = $pdo->prepare("SELECT * FROM unixdatabase.products ORDER BY id ASC LIMIT 3");
$lProduct->execute();

// foreach ($lProduct as $product)
// {
// 	echo '<img src="data:image/jpeg;base64,'.base64_encode( $product['productImage'] ).'"/>';
// }

?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
	<title>Unix</title>
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
    <hr>
	</div>
	<div class = "row">
		<div class = "col-2">
			<h2><center>Never grow up!</center></h2>
			<h4>Get your favorite magical products <br> right to your door.</h4>
			<a href = "./products.php" class = "btn">Explore</a>


		</div>
		<div class = "col-8">
			<img src="disneyhome.jpg">
			
		</div>  

	</div>
	 </div>	

	
<!-- featured categories -->

<!-- featured products -->

		<h2 class = "title">Latest Products</h2>
		<div class = "row">
		<!-- PHP -->
<?php foreach ($lProduct as $product) {
	$path = 'data:image/jpeg'.';base64,'.base64_encode( $product['productImage']); ?>

		<div class = "col-4">
			<a href="./singleProduct.php?product=<?php echo $product['productName'];?>" >
         <img src="<?php echo $path;?>">
      		</a>
			<h4><?php echo $product['productName'];?></h4>
			<div class = "rating">
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
			</div>
			<p>$<?php echo $product['price'];?></p>
		</div>
<?php } ?>

	</div>
</div>

<!-- end featured products -->

		<!-- About Us & FAQ -->
		<div class = "info">
			<div class = "small-container">
				<div class = "row">
					<div class = "column">
                        <h2>About Us</h2>
						<p>Unix is a magical space<br>designed to give fairy tale lovers
                            the best experience<br> at a magical world in our everyday lives. <br>Our website includes
                            <br>duplicate props from famous fictional novels<br> and movies. <br>Our items are handcrafted
                            and made with<br>the best products from all over the world!<br> We ensure that our customers will have
                            <br>the best experience to reenact their favorite magical movie.<br> <br>  <br></p>
					</div>
                    <div class = "column">
                        <h2> FAQ </h2>
                        <h5>How long does it take for my order to ship?</h5> <br> 
                            <p>In the US items usually take 5-7 business days to ship.</p> <br>
                        <h5>How can I sign up to become a member?</h5> <br>
                            <p>At the top of the header, click the login button. You will be directed to
								create an account from there. </p> <br>
                       <h5> Is there a limit on how many items I can buy? </h5> <br>
                            <p>There is no limit on the amount of items a customer can buy<br>
                            We make items for large parties, gatherings and events.</p>
                    </div>
				</div>
				
			</div>
		</div>





	</div>

	<!-- reviews -->
	<div class = "reviews">
		<div class = "small-container">
			<div class = "row">
				<div class = "col-3">
					<i class="fa fa-quote-left"></i>
					<p>I grew up on fairy tales and I love to cosplay! This site has great items 
						for a great price! You're absolutely getting your money's worth!
					</p>
					<div class = "rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
					<img src="belle.jpg">
					<h3>Princess Belle</h3>
				</div>
				<div class = "col-3">
					<i class="fa fa-quote-left"></i>
					<p>I bought this gift for my grandaughter for her 18th birthday. She is a huge 
						fan. I will be buying more for my other grandchildren.</p>
					<div class = "rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
					<img src = "aladdin.png">
					<h3>Aladdin</h3>
				</div>
				<div class = "col-3">
					<i class="fa fa-quote-left"></i>
					<p>It shipped to my home very fast! I was surprised with the quality of the item.</p>
					<div class = "rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						
					</div>
					<img src="evilqueen.jpg">
					<h3>Evil Queen</h3>
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



	
</body>
</html>
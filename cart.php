<?php 
require "./database.php";
session_start();
$_SESSION['productArray'] = array();

if (isset($_POST['cart'])){
	
	$product = $pdo->prepare("SELECT productName, price, productImage FROM unixdatabase.products
							WHERE productName LIKE ?");
	$product->execute(['%'.$_POST['product'].'%']);
	
	$info = $product->fetch();

	$cartProducts = array(array("productName"=>$info['productName'], "price"=>$info['price'], "quantity"=>$_POST['quantity'], "productImage"=>$info['productImage']));
	array_push($_SESSION['productArray'],$cartProducts); 

	$max=sizeof($_SESSION['productArray']);
						
	//DELETE ITEM
	if(isset($_GET["data"]) && isset($_GET["product"]))
    {   
        if ($_GET["data"] =='delete'){
            $product = '%'.$_GET['product'].'%';
            $query = $pdo->prepare("DELETE FROM unixdatabase.products WHERE productName LIKE ? ");
            $query->execute([$product]);
            header("location:cart.php"); 
        }
    }

} 

?>


<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
	<title>Cart</title>
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
<!-- cart item details -->

<div class = "small-container cart-page">
	<table>
		<tr>
			<th>Product</th>
			<th>Quantity</th>
			<th>Subtotal</th>
		</tr>

<?php if (isset($_POST['cart'])) { ?>
		<?php for($i=0; $i<$max; $i++){ 
			foreach ($_SESSION['productArray'] as $pr){
				$path = 'data:image/jpeg'.';base64,'.base64_encode( $pr[$i]['productImage']);
		?>
			
		<tr>
			<td>
				<div class = "cart-info">
					<img src = "<?php echo $path;?>">
					<div>
						<p><?php echo $pr[$i]['productName']?></p>
						<small>Price: $<?php echo $pr[$i]['price']?></small>
						<a href="./cart.php?data=delete&product=<?php echo $pr[$i]['productName'];?>">Remove</a>
					</div>	
				</div>
			</td>
			<td><input type = "text" value = "<?php echo $pr[$i]['quantity'];?>" min="1"></td>
			<td>$<?php echo  $pr[$i]['quantity'] * $pr[$i]['price'];?></td>
		</tr>
		<?php } ?>
	<?php } ?>


	</table>
	<div class = "total-price">
		<table>
			<tr>
				<td>Subtotal</td>
		
<?php for($i=0; $i<$max; $i++){ 
	foreach ($_SESSION['productArray'] as $pr){ ?>
			
				<td>$<?php $total=0; $total += $pr[$i]['quantity'] * $pr[$i]['price']; echo $total;?></td>
<?php 
} 
	}
?>

			</tr>
			<tr>
				<td>Tax</td>
				<td>$<?php $taxes=25.00; echo $taxes?></td>
			</tr>
			<tr>
				<td>Total</td>
				<td>$<?php echo $taxes + $total;?></td>
			</tr>
<?php } ?>
		</table>
	</div>
	<a href = "shippingaddress.html" class = "btn">Process Payment Info</a>
	
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
<?php
require "./database.php";
session_start();

if ($_SESSION['type'] == 'admin'){
    $query = $pdo->prepare("SELECT * FROM unixdatabase.products");
    $query->execute();

    //CRUD OPERATIONS
    if(isset($_GET["data"]) && isset($_GET["product"]))
    {   
        if ($_GET["data"] =='delete'){
            $product = '%'.$_GET['product'].'%';
            $query = $pdo->prepare("DELETE FROM unixdatabase.products WHERE productName LIKE ? ");
            $query->execute([$product]);
            header("location:adminPage.php"); 
        }
    }
} else{
    echo 'YOU AR NOT AN ADMIN!';
    exit;
}

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
                
					<li> <a href ="./adminPage.php">Home</a></li>
					
					<li> <a href="./logout.php?data=logout">LogOut</a></li>
                    <li> <a href = "./addproduct.php"> Add Product</a></li>
                    <li> <a href = "./updatecustomer.php"> Update Customer</a></li>
                    <li> <a href = "./updateadmin.php"> Update Admin</a></li>
		</div>
    </div> 
    <hr>
	</div>
	<div class = "row">
		<div class = "col-2">
            <h2><center>Add, delete and create products!</center></h2>
       

            <table>
                <thread>
                    <tr>
                      
                        <th >Product</th>
                        
                            <th > Change</th>
                            <th colspan="2">Delete Product </th>
                        </tr>
                    </section>
                    </thread>
                    <tbody>
                        <tr>
                            <section class="feature-table product,price">

                            <?php foreach ($query as $info){ ?> 
                                <td><?php echo $info['productName'].' '.'$'.$info['price']; ?></td>
                                <td>
                                    <a href="./editProducts.php?product=<?php echo $info['productName'];?>">Edit</a>
                                    
                                </td>
                                <td>
                                    <a href="./adminPage.php?data=delete&product=<?php echo $info['productName'];?>">Delete</a>

                                </td>
                                <tr></tr>

                            <?php }?>    
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>

          
    <br>
        <br>
        <br>
        <br>
        <br>   
    
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





















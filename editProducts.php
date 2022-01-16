<?php
require "./database.php";
session_start();

if ($_SESSION['type'] == 'admin'){
    //CRUD OPERATIONS
    if(isset($_GET["product"]))
    {
        
        $product = $pdo->prepare("SELECT id, productName, productImage, productInfo, price FROM unixdatabase.products
                            WHERE productName LIKE ?");
        $product->execute(['%'.$_GET['product'].'%']);

		
    }
    //WHEN UPDATED THE PAGE IS GOING TO STAY THERE AND CHANGED INFO WILL BE SHOWN
    if (isset($_POST['updateProduct'])){
		
        $id = $_GET['product'];
        $pName = $_POST['pName'];
        $description = htmlentities($_POST['description']);
        $price = $_POST['price'];
        
        //////////////GETTING IMAGE////
        ///IF IT HAS AN IMAGE IT WILL UPLOAD IT
        if (!empty($_FILES["image"]["name"])){
            $target_dir = "media/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
        
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $image = file_get_contents($target_file);
            $query = $pdo->prepare("UPDATE unixdatabase.products SET productName=?, productInfo=?, productImage=?, price=? WHERE id=?");
            $query->execute([$pName, $description, $image, $price, $id]);
        }
        else{ 
            $query = $pdo->prepare("UPDATE unixdatabase.products SET productName=?, productInfo=?, price=? WHERE id=?");
            $query->execute([$pName, $description, $price, $id]);
        }
    
        header("location:adminPage.php"); 
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
				</ul>	
		</div>
    </div> 
    <hr>
	</div>
	<div class = "row">
		<div class = "col-2">
            <h2><center>Edit Customer</center></h2>
       
<br>
            <table>
                <thread>
                    <tr>
                      </td>
<tr> </tr>

                         <th> </td>
                             <th> </th> 
                            <th>  </th>
                            
                        </tr>
                        </tbody>
                        </table>


    
<?php foreach ($product as $info){?>
					<form enctype="multipart/form-data" method="POST" action="./editProducts.php?product=<?php echo $info['id'];?>" >
					
						<br>
						<br>
                    
                        <div class="input-group">
                            <label>Product Name</label>
                            <input type="text" name="pName" value="<?php echo $info['productName'];?>">
                        </div>
                        <div class="input-group">
                            <label>Description</label><br>
                            <textarea name="description" cols="50" rows="10" ><?php echo $info['productInfo'];?></textarea>

                        </div>
                        <div class="input-group">
                            <label>Price</label>
                            <input type="text" name="price" value="<?php echo $info['price'];?>">
                        </div>
                        <div class="input-group">
                            <label>Image</label>
                            <input type="file" name="image">
                        </div>
						

                        <div class="crudbtn-group">
                            <input type="submit" name="updateProduct" class="btn" value="Update">
                        </div>
                    </form>
<?php } ?>
                    </div>
                </div>
            </div>
        </div> 
    



        <br>
        <br>
        <br>
        <br>
        <br>
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


















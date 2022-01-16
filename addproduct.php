<?php
require "./database.php";
session_start();

if ($_SESSION['type'] == 'admin'){

    if (isset($_POST['addProduct'])){
    //STORES THE IMAGES AND UPLOADS THEM IN THE DATABASE
        $target_dir = "media/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        //pics/mysterious-man-in-a-hood-on-a-dark-background-vector-30927608.jpg
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = file_get_contents($target_file);
///////////////////////////////////
        $pName = $_POST['pName'];
        $description = $_POST['description'];
        $price = $_POST['price'];
       
    

    //CHECKS IF THE USER ALREADY EXISTS
        $query = $pdo->prepare("SELECT productName FROM unixdatabase.products WHERE productName LIKE ?");
        $query->execute(['%'.$_POST['pName'].'%']);
        $result = $query->rowCount();
        if ($result >0){
            echo '<strong>'.'Product Already exists!'.'</strong>';
            
        } else{ //IF IT DOESN'T IT WILL CREATE A NEW ONE
            try{
                $query = $pdo->prepare("INSERT INTO unixdatabase.products(productName, productImage, productInfo, price) VALUES(:pName, :pImage, :pDescription, :price)");
                $query->execute([
                    'pName'=> $pName,
                    'pImage'=>$image,
                    'pDescription'=> $description,
                    'price'=> $price,
                ]);
        
                header("location:adminPage.php");
            }
            catch (Exception $e){
            return 'SOMETHING WENT WRONG. TRY AGAIN.';
            }
        }
    }
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
	
           
       


<div class = "container">
    <div class = "row">
        <div class = "col-2">
            <div class = "form-container">
                <div class ="form-btn">
                    <span>Add Product</span>

                    <br>
                </div>
                <form id = "AddProductForm" enctype="multipart/form-data" action="./addproduct.php" method="POST">
                    <input type="name" placeholder="Product Name" name="pName">
            
                    <textarea name="description" cols="32" rows="3" placeholder="Product Description"></textarea>
                    <input type="file" value="Product's Image" name="image">
                    <input type="text" placeholder="Price" name="price">
                    <input type="submit" name="addProduct" value="Add Product" class="btn">
                </form>
                

                
            </div>
        </div>			
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
</form>


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
<?php
require "./database.php";
session_start();

if ($_SESSION['type'] == 'admin'){
    //CRUD OPERATIONS
    if(isset($_GET["user"]))
    {
        $user =$_GET["user"];
        $query = $pdo->prepare("SELECT userType, username, password, email, firstName, lastName 
                                FROM unixdatabase.users WHERE username=?");
        $query->execute([$user]);
        $info = $query->fetchAll(PDO::FETCH_ASSOC);
		
    }
    //WHEN UPDATED THE PAGE IS GOING TO STAY THERE AND CHANGED INFO WILL BE SHOWN
    if (isset($_POST['updateUser'])){
		
	
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userType = $_POST['userType'];
		

        $query = $pdo->prepare("UPDATE unixdatabase.users SET userType=?, username=?, password=?, email=?, firstName=?, lastName=? 
                                WHERE username=?");
        $query->execute([
            $userType,
            $username,
            $password,
            $email,
            $firstName, 
            $lastName,
            $_GET['user'],
        ]);
		
		
        //CHANGING THE VALUE OF THE URL
        $query = $pdo->prepare("SELECT username FROM unixdatabase.users WHERE username=?");
        $query->execute([$username]);
        $user = $query->fetch();
		
        // header("location:editUser.php"."?user=".$user['username']); 
		if ($userType == 'admin')
		{
			header("location:updateadmin.php");
		} else{
			header("location:updatecustomer.php");

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


    

					<form method="POST" action="./editUser.php?user=<?php echo $info[0]['username'];?>" >
						<label>UserType:
							<select name="userType" required>
						<?php if ($info[0]['userType'] == 'admin') {?>

								<option value="admin" selected>Admin</option> 
								<option value="customer">Customer</option> 
							<?php }else{?>
								<option value="admin" >Admin</option> 
								<option selected value="customer">Customer</option> 
						<?php }?>

							</select>
						</label>
						<br>
						<br>
                    
                        <div class="input-group">
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $info[0]['username'];?>">
                        </div>
                        <div class="input-group">
                            <label>First Name</label>
                            <input type="text" name="firstName" value="<?php echo $info[0]['firstName'];?>">
                        </div>
                        <div class="input-group">
                            <label>Last Name</label>
                            <input type="text" name="lastName" value="<?php echo $info[0]['lastName'];?>">
                        </div>
                        <div class="input-group">
                            <label>Email Address</label>
                            <input type="text" name="email" value="<?php echo $info[0]['email'];?>">
                        </div>
						<div class="input-group">
                            <label>Password</label>
                            <input type="text" name="password" value="<?php echo $info[0]['password'];?>">
                        </div>

                        <div class="crudbtn-group">
                            <input type="submit" name="updateUser" class="btn" value="Update">
                        </div>
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





















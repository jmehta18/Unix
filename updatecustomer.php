<?php
require "./database.php";
session_start();

if ($_SESSION['type'] == 'admin'){
    $query = $pdo->prepare("SELECT * FROM unixdatabase.users where userType='customer'");
    $query->execute();

    //CRUD OPERATIONS
    if(isset($_GET["data"]) && isset($_GET["user"]))
    {   
        if ($_GET["data"] =='delete'){
            $user =$_GET["user"];
            $query = $pdo->prepare("DELETE FROM unixdatabase.users WHERE username=?");
            $query->execute([$user]);
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
            <h2><center>Update Customer Account</center></h2>
       

            <table>
                <thread>
                    <tr>
                      
                        <th >Customer</th>
                        <br> <br>
                        
                            <th >Email Address</th>
                            <th>Update Information</th>
                            <th colspan="2">Delete Customer </th>
                        </tr>
                    </section>
                    </thread>
                    <tbody>
                        <tr>
                            <section class="feature-table user">

                            <?php foreach ($query as $info){ ?> 

                                <td><?php echo $info['firstName'].' '.$info['lastName']; ?></td>
                                <td><?php echo $info['email'];?></td>
                                <td>
                                    <a href="./editUser.php?user=<?php echo $info['username'];?>">Edit</a>
                                </td>
                                <td>
                                    <a href="./updateadmin.php?data=delete&user=<?php echo $info['username'];?>">Delete</a>
                                    <tr></tr>
                                </td>
                                
                            <?php } ?>
                            </section>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
                        
                        
                        
</body>
</html>
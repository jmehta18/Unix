<?php
session_start();
if(isset($_GET["data"]))
// CHANGES SESSION VALUE FOR SECURITY
{   $_SESSION['type']='';
    
    header("location:account.php");
} else{
    header("location:account.php");
    

}
?>
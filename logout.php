<?php
session_start();
if(isset($_SESSION['name']) && $_GET['logout']==1){
    session_unset();
    session_destroy();

  //header("location:index.php");
setcookie("rememberme","",time()-3600);
echo "<script type='text/javascript'>window.location.href='http://localhost/EXAMSYS/home.php';</script>";
   // echo '<META HTTP-EQUIV="refresh" content="0;URL=' .'http://localhost/EXAMSYS/index.php' . '">';
        
}


?>
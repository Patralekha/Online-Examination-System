<?php

//start session and connect
session_start();
include ('connecttestdb.php');

//get user_id
$id = $_SESSION['userid'];

//Get username sent through Ajax
$username = $_POST['name'];

//Run query and update username
$sql = "UPDATE student SET name='$username' WHERE userid='$id'";
$result = mysqli_query($link, $sql);

//$sql1 ="UPDATE result SET name='$username' WHERE userid='$id'";
//$res=mysqli_query($link,$sql1);

if(!$result){
    echo '<div class="alert alert-danger">There was an error updating storing the new username in the database!</div>'.$result;
}else{
    $_SESSION['name']=$username;
}

//if(!res){
   // echo '<div class="alert alert-danger">There was an error updating storing the new username in the database!</div>'.$result;
//}

?>
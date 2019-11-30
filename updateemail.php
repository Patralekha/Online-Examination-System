<?php
//start session and connect
session_start();
include ('connecttestdb.php');

//get user_id and new email sent through Ajax
$id = $_SESSION['userid'];
$newemail = $_POST['email'];

//check if new email exists
$sql = "SELECT * FROM student WHERE email='$newemail'";
$result = mysqli_query($link, $sql);
$count = $count = mysqli_num_rows($result);
if($count>0){
    echo "<div class='alert alert-danger'>There is already as user registered with that email! Please choose another one!</div>"; exit;
}


//get the current email
$sql = "SELECT * FROM student WHERE userid='$id'";
$result = mysqli_query($link, $sql);


$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $email = $row['email']; 
}else{
    echo "<div class='alert alert-danger'>There was an error retrieving the email from the database</div>";exit;   
}

//create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));

//insert new activation code in the users table
//$sql = "UPDATE student SET activation2='$activationKey' WHERE userid = '$id'";
$sql = "UPDATE student SET email='$newemail' WHERE userid='$id'";
$result = mysqli_query($link, $sql);
//$result = mysqli_query($link, $sql);
if(!$result){
    echo "<div class='alert alert-danger'>There was an error inserting the user details in the database.</div>";exit;
}else{
    //send email with link to activatenewemail.php with current email, new email and activation code
    $_SESSION['email']=$newemail;
 /*   $message = "Please click on this link prove that you own this email:\n\n";
$message .= "http://mynotes.thecompletewebhosting.com/activatenewemail.php?email=" . urlencode($email) . "&newemail=" . urlencode($newemail) . "&key=$activationKey";
if(mail($newemail, 'Email Update for you Online Examination System', $message, 'From:'.'developmentisland@gmail.com')){
       echo "<div class='alert alert-success'>An email has been sent to $newemail. Please click on the link to prove you own that email address.</div>";
}*/
    
}


?>
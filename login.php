<?php
session_start();
//Connect to the database
 include("connecttestdb.php");
//Check user inputs
    //Define error messages
$missingEmail = '<p><stong>Please enter your email address!</strong></p>';
$missingName = '<p><stong>Please enter your name!</strong></p>'; 
$errors="";
    //Get email and name
    //Store errors in errors variable
if(empty($_POST["loginemail"])){
    $errors .= $missingEmail;   
}else{
    $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
}
if(empty($_POST["loginname"])){
    $errors .= $missingName;   
}
else{
    $name = $_POST["loginname"];
}
    //If there are any errors
if($errors){
    //print error message
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;   
}else{
    //else: No errors
    //Prepare variables for the query
    $email = mysqli_real_escape_string($link, $email);
$name = mysqli_real_escape_string($link, $name);
//$password = hash('sha256', $password);
        //Run query: Check combinaton of email & password exists
$sql = "SELECT * FROM student WHERE email='$email' AND name='$name' AND activation='activated'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
        //If email & password don't match print error
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Wrong Username or Email</div>';
}
else {
    //log the user in: Set session variables
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $_SESSION['userid']=$row['userid'];
   
    $_SESSION['name']=$row['name'];
    $_SESSION['email']=$row['email'];
    
    if(empty($_POST['rememberme'])){
        //If remember me is not checked
        echo "success";
    }else{
        //Create two variables $authentificator1 and $authentificator2
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        //2*2*...*2
        $authentificator2 = openssl_random_pseudo_bytes(20);
        //Store them in a cookie
        function f1($a, $b){
            $c = $a . "," . bin2hex($b);
            return $c;
        }
        $cookieValue = f1($authentificator1, $authentificator2);
        setcookie(
            "rememberme",
            $cookieValue,
            time() + 1296000
        );
        
        //Run query to store them in rememberme table
        function f2($a){
            $b = hash('sha256', $a); 
            return $b;
        }
        $f2authentificator2 = f2($authentificator2);
        
        $expiration = date('Y-m-d H:i:s', time() + 1296000);
        $email=$_SESSION['email'];
        
        $sql1 = "INSERT INTO rememberme (authentificator1, f2authentificator2, email, expires)
        VALUES
        ('$authentificator1', '$f2authentificator2', '$email', '$expiration')";
        
        
        
        
        $result = mysqli_query($link, $sql1);
        
        if(!$result){
            echo  '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';  
        }else{
            echo "success";   
        }
    }
}
    }

            //else
                //Create two variables $authentificator1 and $authentificator2
                //Store them in a cookie
                //Run query to store them in rememberme table
                //If query unsuccessful
                    //print error
                //else
                    //print "success"
                    ?>
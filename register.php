<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login/Register</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
   <?php
     include "connecttestdb.php";
     ?>
      
  </head>
  <body>
      <div class="container-fluid">
          <div class="row" >
              <div class="col-md-offset-1 col-md-9">
              <h1 style="text-align:center">Student Registration Form</h1>
              
      <?php
      if(isset($_POST['name'],$_POST['email'],$_POST['department'],$_POST['year'],$_POST['section'],$_POST['rollno'])){
      $name=$_POST['name'];
      $email=$_POST['email'];
      //$phoneno=$_POST['Phone_no'];
      $dept=$_POST['department'];
      $year=$_POST['year'];
      $sec=$_POST['section'];
      $roll=$_POST['rollno'];
      $errors="";
      
      //error messages
      $missingname="<p><strong>Please enter your name</strong></p>";
      $missingemail="<p><strong>Please enter your email</strong></p>";
      $invalidemail="<p><strong>Please enter valid email address</strong></p>";
      $missingdept="<p><strong>Please enter your department</strong></p>";
      $missingyear="<p><strong>Please enter your current academic year</strong></p>";
      $missingsec="<p><strong>Please enter your section</strong></p>";
      $missingroll="<p><strong>Please enter your roll no</strong></p>";
      
      
      if($_POST["submit"])
      {
          if(!$name){
              $errors.=$missingname;
          }else{
              $name=filter_var($name,FILTER_SANITIZE_STRING);
          }
          
           if(!$email){
              $errors.=$missingemail;
          }else{
              $email=filter_var($email,FILTER_SANITIZE_EMAIL);
              if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                  $errors.=$invalidemail;
              }
          }
          
           if(!$dept){
              $errors.=$missingdept;
           }
           if(!$year){
              $errors.=$missingyear;
           }
           if(!$sec){
              $errors.=$missingsec;
           }
           if(!$roll){
              $errors.=$missingroll;
           }
      
           
           if($errors){
               $resultmessage='<div class="alert alert-danger">'.$errors.'</div>';
               echo $resultmessage;
           }else{
                 $name=mysqli_real_escape_string($link,$name);
                 $email=mysqli_real_escape_string($link,$email);
                 $dept=mysqli_real_escape_string($link,$dept);
                 $sec=mysqli_real_escape_string($link,$sec);
                 
                 $sql = "SELECT * FROM student WHERE email = '$email'";
$result = mysqli_query($link, $sql);
//if(!$result){
    //echo '<div class="alert alert-danger">Error running the query!</div>'; exit;
//}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';  exit;
}else{
//Create a unique  activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
                 
                 
                 
                 $sql11="INSERT INTO student (name,email,department,year,section,rollno,activationkey) VALUES ('$name','$email','$dept','$year','$sec','$roll','$activationKey')";

                 if(mysqli_query($link,$sql11)){
                     $resultmessage = '<div class="alert alert-success">Data added successfully to the database</div>';
                     echo $resultmessage;
                 }else{
                     $resultmessage='<div class="alert alert-warning">ERROR:Unable to execute:'.$sql11.'.'.mysqli_error($link).'</div>';
                     echo $resultmessage;
                 }
                 
                 
                 $message = "Please click on this link to activate your account:\n\n";
                 $message .= "http://localhost/EXAMSYS/activate.php?email=" . urlencode($email) . "&key=$activationKey";
                /* if(mail($email, 'Confirm your Registration', $message, 'From:'.'bhattacharjee67aparna@gmail.com')){
                     echo "<div class='alert alert-success'>Thank for your registering! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>";
                   }*/
           }
           
      }
      }
      }
      
      ?>
      <div id="signupmessage"></div>
      <form action="register.php" method="post" id="signupform">
          <div class="form-group">
             <label for="name">Name:</label>
             <input type="text" id="name" placeholder="Name" class="form-control" name="name"  maxlength="50">
          </div>
          <div class="form-group">
             <label for="email">Email address:</label>
             <input type="email" id="email" placeholder="Email" class="form-control" name="email" maxlength="150">
          </div>
          
          <div class="form-group">
             <label for="department">Department:</label>
             <input type="text" id="department" placeholder="Department" class="form-control" name="department"  maxlength="20">
          </div>
          <div class="form-group">
             <label for="year">Year:</label>
             <input type="number" id="year" placeholder="Year" class="form-control" name="year"  maxlength="3">
          </div>
          
          <div class="form-group">
             <label for="section">Section:</label>
             <input type="text" id="section" placeholder="Section" class="form-control" name="section"  maxlength="2">
          </div>
           <div class="form-group">
             <label for="rollno">Roll number:</label>
             <input type="number" id="rollno" placeholder="Roll no" class="form-control" name="rollno" maxlength="10">
          </div>
          <input type="submit" name="submit" class="btn btn-success btn-lg" value="Register">

      </form>
    </div>
      </div>
      </div>
      
       
      
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      <script src="index.js"></script>
  </body>
</html>
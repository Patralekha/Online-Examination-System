<?php 
session_start();
/*if(!isset($_SESSION['name'])){
    session_unset();
    session_destroy();
   // header("location:/EXAMSYS/index.php");
    echo "<script type='text/javascript'>window.location.href='http://localhost/EXAMSYS/home.php';</script>";
}*/

include 'connecttestdb.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Notes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="styling.css" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <!--Navigation Bar-->  
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
      
          <div class="container-fluid">
            
              <div class="navbar-header">
              
                  <a class="navbar-brand">Online Examination System</a>
                  <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  
                  </button>
              </div>
              <div class="navbar-collapse collapse" id="navbarCollapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact us</a></li>
                  </ul>
                  
                
              
              </div>
          </div>
      
      </nav>
    
    <!--Jumbotron with Login Button-->
      <div class="jumbotron" id="myContainer">
          <h1>Conduct Online Examinations</h1>
          
          <button type="button" class="btn btn-lg " data-target="#tloginModal" data-toggle="modal" style="background-color:red;color:white;margin-top:100px;">Login</button>
      </div>

    <!--Login form-->    
      <form method="post" id="tloginform">
        <div class="modal" id="tloginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Login: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Login message from PHP file-->
                  <div id="loginmessage"></div>
                  

                  <div class="form-group">
                      <label for="loginemail" class="sr-only">Email:</label>
                      <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="150">
                  </div>
                  <div class="form-group">
                      <label for="loginpassword" class="sr-only">Password</label>
                      <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="150">
                  </div>
                  <div class="form-group">
                      <label for="loginpassword" class="sr-only">Unique id</label>
                      <input class="form-control" type="text" name="loginid" id="loginid" placeholder="Unique id" maxlength="30">
                  </div>
                  <div class="checkbox">
                    
                          <a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">
                      Forgot Password?
                      </a>
                  </div>
                  
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="login" type="submit" value="Login">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
                  
              </div>
          </div>
      </div>
      </div>
      </form>

   

    <!--Forgot password form-->
      <form method="post" id="forgotpasswordform">
        <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Forgot Password? Enter your email address: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--forgot password message from PHP file-->
                  <div id="forgotpasswordmessage"></div>
                  

                  <div class="form-group">
                      <label for="forgotemail" class="sr-only">Email:</label>
                      <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
                  </div>
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="forgotpassword" type="submit" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
               
              </div>
          </div>
      </div>
      </div>
      </form>
    <!-- Footer-->
      <div class="footer">
          <div class="container">
              <p>Online Examination System Developers &copy; 2018-<?php $today = date("Y"); echo $today?>.</p>
          </div>
      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="tindex.js"></script>
  </body>
</html>
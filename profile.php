<?php 
session_start();
if(!isset($_SESSION['name'])){
    session_unset();
    session_destroy();
   // header("location:/EXAMSYS/index.php");
    echo "<script type='text/javascript'>window.location.href='http://localhost/EXAMSYS/home.php';</script>";
}
include 'connecttestdb.php';
?>
<!--?php
/*session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];*/
include('connection.php');

$sql = "SELECT * FROM users WHERE userid='$userid'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQL_ASSOC); 
    $username = $row['username'];
    $email = $row['email']; 
}else{
    echo "There was an error retrieving the username and email from the database";   
}
?-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="styling.css" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
      <style>
        #container{
            margin-top:100px;   
        }

        #notePad, #allNotes, #done{
            display: none;   
        }

        .buttons{
            margin-bottom: 20px;   
        }

        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #CA3DD9;
            color: #CA3DD9;
            background-color: #FBEFFF;
            padding: 10px;
              
        }
          
          tr{
             cursor: pointer;    
          }
      </style>
  </head>
  <body>
    <!--Navigation Bar-->  
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
      
          <div class="container-fluid">
            
              <div class="navbar-header">
              
                  <a class="navbar-brand">Online Examination</a>
                  <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  
                  </button>
              </div>
              <div class="navbar-collapse collapse" id="navbarCollapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Profile</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact us</a></li>
                      
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Logged in as <b><?php echo $_SESSION['name']; ?></b></a></li>
                    <li><a href="logout.php?logout=1">Log out</a></li>
                  </ul>
              
              </div>
          </div>
      
      </nav>
    
<!--Container-->
      <div class="container" id="container">
          <div class="row">
              <div class="col-md-offset-3 col-md-6">

                  <h2>General Account Settings:</h2>
                  <div class="table-responsive">
                      <table class="table table-hover table-condensed table-bordered">
                          <tr data-target="#updateusername" data-toggle="modal">
                              <td>Username</td>
                              <td><?php echo $_SESSION['name']; ?></td>
                          </tr>
                          <tr data-target="#updateemail" data-toggle="modal">
                              <td>Email</td>
                              <td><?php echo $_SESSION['email'] ?></td>
                          </tr>
                          
                      </table>
                      
                      <form action="testpage.php" method="POST">
                  <div class="form-group">
                      <label for="subject">Subjects</label>
                      <br/>
                      <br/>
                       <select name="subject" id="subject">
                           <?php
                          
                           $res=mysqli_query($link,"SELECT DISTINCT subject  FROM test");
                           while($row=mysqli_fetch_array($res))
                           {
                               ?>
                           <option><?php echo $row["subject"];?></option>
                           <?php    
                           }
                           ?>
                           <option><?php echo "Miscellaneous"?></option>
                           </select >
                           <br/>
                          <br/>
                      <br/>     
                      <input type="submit"  id="subject"  class="btn btn-primary btn-lg" value="Take Test">
                     <!--button type="button" id="subject" class="btn btn-lg btn-success"><a href="testpage.php">Take Test</a></button-->
                    
                      </div>
                  </form>
                      
                      <div id="performance">
                          
                      </div>
                      
                  </div>
              
              </div>
          </div>
      </div>
      
    

    <!--Update username-->    
      <form method="post" id="updateusernameform">
        <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Edit Username: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--update username message from PHP file-->
                  <div id="updateusernamemessage"></div>
                  

                  <div class="form-group">
                      <label for="username" >Username:</label>
                      <input class="form-control" type="text" name="name" id="name" maxlength="30" value="<?php echo ""; ?>">
                  </div>
                  
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="updateusername" type="submit" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button> 
              </div>
          </div>
      </div>
      </div>
      </form>

    <!--Update email-->    
      <form method="post" id="updateemailform">
        <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Enter new email: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Update email message from PHP file-->
                  <div id="updateemailmessage"></div>
                  

                  <div class="form-group">
                      <label for="email" >Email:</label>
                      <input class="form-control" type="email" name="email" id="email" maxlength="50" value="<?php echo "" ?>">
                  </div>
                  
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="updateusername" type="submit" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button> 
              </div>
          </div>
      </div>
      </div>
      </form>
      
    <!--Update password-->    
    
    <!-- Footer-->
      <div class="footer">
          <div class="container">
              <p>Online Examination Developers &copy; 2018-<?php $today = date("Y"); echo $today?>.</p>
          </div>
      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      <script src="profile.js"></script>
  </body>
</html>
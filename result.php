<?php 
include 'connecttestdb.php';
session_start();
if(!isset($_SESSION['name'])){
    session_unset();
    session_destroy();
   
    echo "<script type='text/javascript'>window.location.href='http://localhost/EXAMSYS/index.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Online Quiz">
    <meta name="author" content="Val Okafor">   
    <title> Quiz</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body role="document">
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse " role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="www.technopoints.com">Online Examination System</a>
        </div>
        <div class="navbar-collapse collapse" class="toactive">
          <ul class="nav navbar-nav" class="list-inline">
            <li class="cli"><a href="index.php">Home</a></li>
            <li class="cli"><a href="add_quiz.php">Add Quiz</a></li>
            <li class="cli active"><a href="result.php">View Result</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php?logout=1" data-toggle="modal">Logout</a></li>
                  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>



<?php
include 'connecttestdb.php';
      
      $n1=$_SESSION['name'];

      $uid=$_SESSION['userid'];

     $sql1="SELECT * FROM student WHERE name='$n1'";
      
        
      
      $d1="";$y1=0;$s1='';$roll1=0;$score=0;$s=0;$count=0;
      
      $sub="";$lev='';
      $qid=0;
      if( $r=mysqli_query($link,$sql1)){
          
      if(mysqli_num_rows($r)==1){
          if( $row1=mysqli_fetch_array($r,MYSQLI_ASSOC)){
             
          $d1=$row1['department'];
       $y1=$row1['year'];
          $s1=$row1['section'];
          $roll1=$row1['rollno'];
          
      }
      }         
      }else{
                     $resultmessage='<div class="alert alert-warning">ERROR:Unable to execute:'.$sql1.'.'.mysqli_error($link).'</div>';
                     echo $resultmessage;
                 }
      
 $date=date("y-m-d,H:i:s");
   //   echo $date;
      
      $subj1=$_SESSION['subject'];
      
      //check for subject specific and miscellaneous,accordingly use mysqli fetch query
      
      
      
      
      
      
      
     // $fetchqry = "SELECT * FROM test WHERE subject='$subj1'";
//$result=mysqli_query($link,$fetchqry);
//$num=mysqli_num_rows($result); 
      // $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  $i=1;
      //$num
      
  for($i;$i<=5;$i++){
     
      @$userselected = $_POST[$i];
      $p='qid'.$i;
      
      $q='subj'.$i;
      
      $z='lev'.$i; 
      $qid=$_POST[$p];
      $sub=$_POST[$q];
      $lev=$_POST[$z];
   
      $s=0;
     
      $fetch="SELECT answer FROM test WHERE id='$qid'";
      $result1=mysqli_query($link,$fetch);
      $row_1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
      if(@$userselected==$row_1['answer']){
          $score+=2;
          $s=2;
          $count+=1;
      }else{
          $score-=1;
      }
      
      
      
      $qry2 = "INSERT INTO result (userid,name,department,year,section,rollno,qid,subject,level,studans,score,date) VALUES ('$uid','$n1','$d1','$y1','$s1','$roll1','$qid','$sub','$lev','$userselected','$s','$date')";

       if(mysqli_query($link,$qry2)){
           
                 }else{
                     $resultmessage='<div class="alert alert-warning">ERROR:Unable to execute:'.$qry2.'.'.mysqli_error($link).'</div>';
                     echo $resultmessage;
                 }
     } 
      
      $_SESSION['count']=$count;
      $_SESSION['score']=$score;
            
 
 ?> 
 <div class="col-md-offset-2 col-md-8">
<h2>Result:</h2><br><br>
 <span><b>No. of Correct Answers:</b>&nbsp;<?php  echo $no = $_SESSION['count']; 
											
 ?></span><br><br>
 <span><b>Your Score:</b>&nbsp;<?php if(isset($no)) echo $_SESSION['score']; ?></span>
</div>
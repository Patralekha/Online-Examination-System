<?php 
session_start();
if(!isset($_SESSION['name'])){
    session_unset();
    session_destroy();
   // header("location:/EXAMSYS/index.php");
    echo "<script type='text/javascript'>window.location.href='http://localhost/EXAMSYS/home.php';</script>";
}
include 'connecttestdb.php';
//include 'analysis.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Online Quiz">  
    <title>Online Examination</title>

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
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" >Online Examination System</a>
        </div>
        <div class="navbar-collapse collapse" class="toactive">
          <ul class="nav navbar-nav" class="list-inline">
            <li class="cli"><a href="tprofile.php">Back</a></li>
            <li class="cli active"><a href="createtest.php">Add Quiz</a></li>
           <!-- <li class="cli"><a href="result.php">View Result</a></li>-->
          </ul>
            <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php?logout=1">Log out</a></li>
           </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<style>
</style>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <br/>
        <br/>
        <h1>Add question</h1>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="question">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter your question here" Required>
            </div>
            
            <div class="form-group">
                <label for="question">Level</label>
                <input type="text" class="form-control" id="level" name="level" placeholder="Enter your question here" maxlength="1" Required>
            </div>
            
            <div class="form-group">
                <label for="question">Enter Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here" Required>
            </div>
            <div class="form-group">
                <label for="wrong_answer1">Option 1</label>
                <input type="text" class="form-control" id="wrong_answer1" name="wrong_answer1" placeholder="Answer 1" Required>
            </div>
            <div class="form-group">
                <label for="wrong_answer2" for="wrong_answer2">Option 2</label>
                <input type="text" class="form-control" id="wrong_answer2" name="wrong_answer2" placeholder="Answer 2" Required>
            </div>
            <div class="form-group">
                <label for="wrong_answer3" for="wrong_answer3">Option 3</label>
                <input type="text" class="form-control" id="wrong_answer3" name="wrong_answer3" placeholder="Answer 3" Required>
            </div>
            <div class="form-group">
                <label for="wrong_answer4" for="wrong_answer3">Option 4</label>
                <input type="text" class="form-control" id="wrong_answer3" name="wrong_answer4" placeholder="Answer 3" Required>
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct answer option</label>
                <input type="text" class="form-control" id="correct_answer" name="correct_answer" placeholder="Enter the correct answer option here" Required>
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Question</button>

        </form>
    </div>
     </div>
	 <?php
	 if(isset($_POST['submit'])){
$fetchqry = "SELECT * FROM test";
$result=mysqli_query($link,$fetchqry);
$num=mysqli_num_rows($result);
$id = $num + 1;
$sub=$_POST['subject'];
$level=$_POST['level'];
$que = $_POST['question'];
$op1 = $_POST['wrong_answer1'];
$op2 = $_POST['wrong_answer2'];
$op3 = $_POST['wrong_answer3']; 
$op4 = $_POST['wrong_answer4']; 
$ans = $_POST['correct_answer'];

         
         
$qry = "INSERT INTO test(subject,level,question, option_1,option_2, option_3,option_4,answer) VALUES ('$sub','$level','$que','$op1','$op2','$op3','$op4','$ans')";
$done = mysqli_query($link,$qry);
if($done==TRUE){
	echo "Question and Answers Submitted Succesfully";
}else{
    echo "Error:".mysqli_error($link);
}
	 }
?>

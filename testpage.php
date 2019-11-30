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
    <!--meta name="author" content="Val Okafor">   
    <title>Simple Quiz</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">	
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <title>Online Examination</title>
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
          <a class="navbar-brand">Online Examination System</a>
        </div>
        <div class="navbar-collapse collapse" class="toactive">
          <ul class="nav navbar-nav" class="list-inline">
            <li class="cli active"><a href="index.php">Home</a></li>
            <!--li class="cli"><a href="createtest.php">Add Quiz</a></li-->
            <!--li class="cli"><a href="result.php">View Result</a></li-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php?logout=1" data-toggle="modal">Logout</a></li>
                  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    
<!--/.head-->
<!--title>Online Examination</title-->
<!--/head-->

<center>
    <br/>
    <br/>
<br/>
<br/>
<button class="button button-lg" id="start"  style="background-color:blue">START QUIZ</button>
    
     <div id="examEnd" style="padding: 10px 30px;color:red;font-size:23px;">
               
            </div>
</center>
      <center>
      <div class="navbar" id="timeremaining" style="padding: 10px 30px;color:green;font-size:23px;">Time left :<span id="trv">60</span>sec</div>
          </center>
<div id="myDIV" style="padding: 10px 30px;">
   
    
    <script>document.getElementById("myDIV").style.display="none";</script>
<form action="result.php" method="post" id="form">  				
<table>
    <?php   
    $subj=$_POST['subject'];
     $_SESSION['subject']=$subj;
    $fetchqry="";
    if($subj=="Miscellaneous"){
        
        $fetchqry="SELECT * FROM test  ORDER BY RAND() LIMIT 5";
        
    }
    else{
    
       $curdate=date("Y-m-d,H:i:s");
    //echo $curdate;
    $pastdate1=date('Y-m-d,H:i:s', strtotime('-4 days'));
     //echo $pastdate1;
    $pastdate2=date('Y-m-d,H:i:s', strtotime('-10 days'));
   // echo $pastdate2;
    $f="SELECT * FROM result WHERE date BETWEEN '$pastdate2' AND '$pastdate1'"; 
    
    $r=mysqli_query($link,$f);
     	if(!$r){
                     echo '<div class="alert alert-danger">Error running the query!</div>';
                      exit;
              }
    
    $easy=0;
    $med=0;
    $hard=0;
    
    $easycount=0;
    $medcount=0;
    $hardcount=0;
    
    $ep=0;$mc=0;$hc=0;
    while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
    {
        if($row['level']=="E" && $row['subject']==$subj)
        {
            $easycount+=1;
            if($row['score']==2)
            { $easy+=1;  
            //echo "1|";
            }
        }
        else if($row['level']=="M" && $row['subject']==$subj)
        {
           
            $medcount+=1;
            if($row['score']==2)
            { $med+=1; 
            //echo "2|";
            }
        }
        else if($row['level']=="H" && $row['subject']==$subj)
        {
            $hardcount+=1;
            if($row['score']==2)
            { $hard+=1; 
            //echo "3|";
            }
        }
        
    }
               if($easycount!=0)
         $ep=$easy/$easycount;
          if($medcount!=0)
           $mc=$med/$medcount;
         if($hardcount!=0)
             $hc=$hard/$hardcount;
    //echo $ep." ".$mc." ".$hc;              
              $fetchqry=calc($subj,$easycount,$ep,$medcount,$mc,$hardcount,$hc);
        //echo $fetchqry;
    }
    //echo $fetch;
    
    
    function calc($sub,$easycount,$ep,$medcount,$mc,$hardcount,$hc){
    
    $fetch1="";
    if($ep<0.6)
    {  return "SELECT * FROM test WHERE (subject='$sub' AND level='E') ORDER BY RAND() LIMIT 5";
    //echo "<0.6";
    }
    else if($ep>=0.6 && $mc<=0.7)
        {
            return "(SELECT * FROM test WHERE  (subject='$sub' AND level='E') ORDER BY RAND() LIMIT 2)
         UNION (SELECT * FROM test WHERE (subject='$sub' AND level='M')ORDER BY RAND() LIMIT 3) ORDER BY RAND()";
        //echo ">0.6<0.7";
        }
   else if($mc>0.7 && $hc<=0.75)
   {
       return "(SELECT * FROM test WHERE  (subject='$sub' AND level='M')ORDER BY RAND() LIMIT 2)
         UNION (SELECT * FROM test WHERE (subject='$sub' AND level='H')ORDER BY RAND() LIMIT 3) ORDER BY RAND()"; 
      // echo ">0.7<0.75";
   }
    else if(hc>0.75)
     return "SELECT * FROM test WHERE (subject='$sub' AND level='H') ORDER BY RAND() LIMIT 5";  
    
     // return fetch1;
}
              
              
              
   // $fetchqry=analysis();
   
   // $r='E';$s='M';
   // $fetchqry="";
    /*
    if($subj=="Miscellaneous"){
        
        $fetchqry="SELECT * FROM test  ORDER BY RAND() LIMIT 5";
    }else{
       // $fetchqry = "SELECT * FROM test WHERE subject='$subj' ORDER BY RAND() LIMIT 5";
         //$fetchqry="(SELECT * FROM test WHERE  (subject='$subj' AND level='$r')ORDER BY RAND() LIMIT 2)
         //UNION (SELECT * FROM test WHERE (subject='$subj' AND level='$s')ORDER BY RAND() LIMIT 3) ORDER BY RAND()";
        $fetchqry=$fetch;
        echo $fetch;
    }*/
    //$fetchqry=analysis();
    
    
    
                $result=mysqli_query($link,$fetchqry);
    
				if(!$result){
                     echo '<div class="alert alert-danger">Error running the query!</div>';
                      exit;
              }
     
    
			   while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                   
    ?>

  <tr><td><h3><br><?php echo @$snr +=1;?>&nbsp;-&nbsp;<?php echo @$row['question'];?></h3></td></tr>
    
    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;a )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo @$snr;?>" value="<?php echo $row['option_1'];?>">&nbsp;<?php echo $row['option_1']; ?><br></td></tr>
    
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;b )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo @$snr;?>" value="<?php echo $row['option_2'];?>">&nbsp;<?php echo $row['option_2'];?></td></tr>
    
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;c )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo @$snr;?>" value="<?php echo $row['option_3'];?>">&nbsp;<?php echo $row['option_3']; ?></td></tr>
    
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;d )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo @$snr;?>" value="<?php echo $row['option_4'];?>">&nbsp;<?php echo $row['option_4']; echo "<br>"?><br></td></tr>
    
     <tr><td><input required type="hidden" name="<?php echo 'qid'.@$snr;?>" value="<?php echo $row['id'];?>">
     <input required type="hidden" name="<?php echo 'subj'.@$snr;?>" value="<?php echo $row['subject'];?>">
     <input required type="hidden" name="<?php echo 'lev'.@$snr;?>" value="<?php echo $row['level'];?>"><br></td></tr>
    
			<?php 	}?>
	
     
    <tr><td align="center"><button class="button3" name="click" id="endexam" style="margin-left:1050px;color:black;font-size:16px;background-color:yellow">Submit Quiz</button></td></tr>
	</table>
    </form>
</div>
    <script src="javascript1.js"></script>
</body>
</html>
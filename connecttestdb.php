<?php

   $link = mysqli_connect("localhost","root","root","exam") or die("ERROR:Unable to connect:".mysqli_connect_error());
                   // var_dump($link);
                    
                  
 
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }else
{
   // echo "SUCCESS";
}



?>
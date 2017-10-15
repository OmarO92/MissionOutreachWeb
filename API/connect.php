<?php

  define("HOST", "localhost");    
  define("USERNAME", "guest");   
  define("PASSWORD", "Scheema342");   
  define("DATABASE", "hackathon");  

   $link = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

   if (!$link) {
    echo('no connect');
      die('Could not connect: ' . mysql_error());
   }

?> 
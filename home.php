<!DOCTYPE html>
<html lang="en">

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>

<head>
  <title>clientloyees</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="ss.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="style.css" rel = "stylesheet" text="text/css"/>

</head>
<body>
<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

<nav class='navbar navbar-default navbar-custom' id='navbar'>
      	<div class='container-fluid'>
      		<div class='navbar-header'>
      			<button type='button' class='navbar-toggle' data-toggle="collapse" data-target="#myNavbar">
      				<span class='icon-bar'></span>
      				<span class='icon-bar'></span>
      				<span class='icon-bar'></span>
      			</button>
      			<a class='navbar-brand' href='#'>The Mission Outreach</a>
      		</div>

      		<div class='collapse navbar-collapse' id='myNavbar'>
      			<!---->
      			<ul class='nav navbar-nav'>
      				<li><a href='home.php'>Home</a></li>
      				<li><a href='add.php'>Add form</a></li>
      			</ul>
      			<!---->

      			<!---->
      			<ul class='nav navbar-nav navbar-right'>
              <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>
      			</ul>
      			<!---->
      		</div>


      	</div>
      </nav>


<?php
session_start();
if(!isset($_SESSION['active'])) {
	header('Location: ./index.php');
	exit();
}
if(isset($_SESSION['active'])) {
  $link = mysqli_connect('localhost', 'guest', 'Scheema342', 'hackathon');
  
  
  $client_sql = 'SELECT * FROM client';
  $client_parse = mysqli_query($link, $client_sql);
  //$client = oci_fetch_array($client_parse,OCI_BOTH);
  
  //echo "\n\n";
  //echo $conn;
  
  //Tclientorary Arrays
  $clientT = array();
  $clientT[0] = '';
  $tclientC = 0;
  echo'
  <center>
  <div class="well col-lg-10 col-lg-offset-1">
        <div class="panel panel-primary">
          <div class="panel-heading">clients</div>
          <div class="panel-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-striped" >
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                  </tr>
                </thead>
                <tbody>';
                  while ($client = mysqli_fetch_assoc($client_parse)) {
                      $tclientC++;
                      echo '<tr>
                          <td class = "clickable-row" data-href="https://google.com/">'. $client['fname'] .'</td>
                          <td>'. $client['lname'] .'</td>
                          </tr>
                          ';
                  }
                  echo'
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      </center>
  
  </body>
  </html>';
} else {
	header('./index.php');
	exit();
}
?>
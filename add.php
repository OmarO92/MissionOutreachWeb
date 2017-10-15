<!DOCTYPE html>
<html lang="en">

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>

<head>
  <title>MissionOutreach Add</title>
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
			<a class='navbar-brand' href='#'>Mission Outreach</a>
		</div>

		<div class='collapse navbar-collapse' id='myNavbar'>
			<!---->
			<ul class='nav navbar-nav'>
				<li><a href='home.php'>Clients</a></li>
				<li><a href='agents.php'>Agents</a></li>
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

	if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['dob']) && isset($_POST['qr']))
	{

		$fname = mysqli_real_escape_string($link,htmlentities($_POST['fname']));
		$lname = mysqli_real_escape_string($link,htmlentities($_POST['lname']));
		$dob   = mysqli_real_escape_string($link,htmlentities($_POST['dob']));
		$qr    = mysqli_real_escape_string($link,htmlentities($_POST['qr']));

		$add = "INSERT INTO client (fname, lname, dob, qr, lat, lng)
			VALUES ('$fname', '$lname', '$dob', '$qr', '0.0', '0.0')";
		if(mysqli_query($link, $add)) 
		{
			if(isset($_POST['food']) && isset($_POST['shelter']) && isset($_POST['med'])) 
			{
				$getid = "SELECT id from client where qr = '". $qr ."'";
				$newid = mysqli_query($link, $getid);
				if(mysqli_num_rows($newid) > 0) {
					$row = mysqli_fetch_assoc($newid);
					$clientid = $row["id"];
					$agentid = $_SESSION['id'];
					$food = mysqli_real_escape_string($link,htmlentities($_POST['food']));
					$shelter = mysqli_real_escape_string($link,htmlentities($_POST['shelter']));
					$med = mysqli_real_escape_string($link,htmlentities($_POST['med']));
					$need = "INSERT INTO need (forclient, createdby, food, shelter, medical)
						VALUES('$clientid', '$agentid', '$food', '$shelter', '$med')";
					if(mysqli_query($link, $need)) 
					{
						echo '<div class="alert alert-success" role="alert"> <strong> Client Added! </strong> </div>';
					}
					else 
					{
						echo '<div class="alert alert-danger" role="alert"> <strong> Failed to Add Client Needs! </strong> </div>';
						$removeclient = "delete from client where id = '$clientid'";
						mysqli_query($link, $removeclient);
					}

				}
				 
				else
				{
					echo '<div class="alert alert-danger" role="alert"> <strong> Failed to Get Client ID! </strong> </div>';
				}
			}
		}
		else
		{

			echo '<div class="alert alert-danger" role="alert"> <strong> Failed to Add Client!  </strong> </div>';
		}
	}
	echo'
<!DOCTYPE html>
 <html>
			 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			 <link rel="stylesheet" href="style.css">
			 <div>
				 <section id="login">
					 <div class="container">
						 <div class="row">
							 <div class="col-xs-12">
								 <div class="form-wrap">
									 <h1>Register Client</h1>
									 <form role="form"  action="add.php" method="POST" id="login-form" autocomplete="off">
										 <div class="form-group">
											 <label for="fname" class="control-label">First Name</label>
											 <input type="text" name="fname" id="fname" class="form-control" placeholder="john">
										 </div>
										 <div class="form-group">
											 <label for="lname" class="control-label">Last Name</label>
											 <input type="text" name="lname" id="lname" class="form-control" placeholder="doe">
										 </div>

										 <div class="form-group">
											 <label for="dob" class="control">Date of Birth (Format: YYYY-MM-DD)</label>
											 <input type="text" name="dob" id="dob" class="form-control" placeholder="1999-01-01">
										 </div>

										 <div class="form-group">
											 <label for="qr" class="control-label">QR Identifier</label>
											 <input type="text" name="qr" id="qr" class="form-control" placeholder="1234">
										 </div>
										 <div class="form-group">
											 <label for="food" class="control-label">Needs Food?</label>
											 <input type="hidden" name="food" id="food" value="0">
											 <input type="checkbox" name="food" id="food" value="1" class="form-control">
										 </div>
										 <div class="form-group">
											 <label for="shelter" class="control-label">Needs Shelter?</label>
											 <input type="hidden" name="shelter" id="shelter" value="0">
											 <input type="checkbox" name="shelter" id="shelter" value="1" class="form-control">
										 </div>
										 <div class="form-group">
											 <label for="med" class="control-label">Needs Medical</label>
											 <input type="hidden" name="med" id="med" value="0">
											 <input type="checkbox" name="med" id="med" value="1" class="form-control">
										 </div>

										 <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
									 </form>
									 <hr>
								 </div>
							 </div> <!-- /.col-xs-12 -->
						 </div> <!-- /.row -->
					 </div> <!-- /.container -->
				 </section>
			 </div>
			 <!---
	    <footer id="footer">
	    <div class="container">
	    <div class="row">
	    <div class="col-xs-12">
	    <p>Page  - 2014</p>
	    <p>Powered by <strong><a href="http://www.facebook.com/tavo.qiqe.lucero" target="_blank">TavoQiqe</a></strong></p>
	    </div>
	    </div>
	    </div>
	    </footer>
			 -->
		 </html>';
} else {
	header('./index.php');
	exit();
}
?>

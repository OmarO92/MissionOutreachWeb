<?php
session_start();
$link = mysqli_connect('localhost', 'guest', 'Scheema342', 'hackathon');
if(isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){

	// sanitize and query database 
	$postedUsername = $_POST['username'];
	$postedPassword = $_POST['password'];
	$sql = "SELECT * from agent where fname = '". $postedUsername ."'";
	$res = mysqli_query($link, $sql);
	if (mysqli_num_rows($res) > 0) {
		$row = mysqli_fetch_assoc($res);
		if( $postedPassword == $row["pass"]) {
			session_regenerate_id();
			$_SESSION['active'] = true; // isset
			$_SESSION['fname']= $row["fname"];
			$_SESSION['lname']= $row["lname"];
			$_SESSION['id']= $row["id"];;
			header('Location: ./home.php');
			exit();
		} 
		else {
			echo ' <div class="alert alert-danger">
				<strong>Error! </strong> Wrong Password!.
				</div>';
		}
	} 
	else {

		echo ' <div class="alert alert-danger">
			<strong>Error! </strong> Enter in all fields!.
			</div>';
	}
} 

?>


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
									 <h1>Log in with your account</h1>
									 <form role="form"  action="index.php" method="POST" id="login-form" autocomplete="off">
										 <div class="form-group">
											 <label for="username" class="sr-only">Username</label>
											 <input type="username" name="username" id="username" class="form-control" placeholder="somebody">
										 </div>
										 <div class="form-group">
											 <label for="password" class="sr-only">Password</label>
											 <input type="password" name="password" id="password" class="form-control" placeholder="Password">
										 </div>
										 <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
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
	    <p>Page © - 2014</p>
	    <p>Powered by <strong><a href="http://www.facebook.com/tavo.qiqe.lucero" target="_blank">TavoQiqe</a></strong></p>
	    </div>
	    </div>
	    </div>
	    </footer>
			 -->
		 </html>

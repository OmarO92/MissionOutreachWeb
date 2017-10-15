<!DOCTYPE html>
<html lang="en">

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>

<head>
  <title>MissionOutreach Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="ss.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <link href="style.css" rel = "stylesheet" text="text/css"/>
  <style>
      #map {
        height: 300px;
        width: 100%;
      }
  </style>
</head>
<body>
<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
$(document).ready(function() {
    $('#agentTable').DataTable();
    $('select').addClass('mdb-select');
    $('.mdb-select').material_select();
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
      				<li><a href='home.php'>agents</a></li>
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
  
  
  $agent_sql = 'SELECT fname, lname, lat, lng FROM `agent`';
  $agent_parse = mysqli_query($link, $agent_sql);
  //$agent = oci_fetch_array($agent_parse,OCI_BOTH);
  
  //echo "\n\n";
  //echo $conn;
  
  //Tagentorary Arrays
  $agentT = array();
  $agentT[0] = '';
  $tagentC = 0;
  echo'
  <center>
  <div class="well col-lg-10 col-lg-offset-1">
    <table id="agentTable" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" >
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Location</th>
        </tr>
      </thead>
      <tbody>';
        while ($agent = mysqli_fetch_assoc($agent_parse)) {
            $tagentC++;
            echo "<tr>
                <td>". $agent['fname'] ."</td>
                <td>". $agent['lname'] ."</td>
                <td><button onClick='initMap(".$agent['lat'].", ".$agent['lng'].")' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLong'>View Location</button>
                </tr>
                ";
        }
        echo'
      </tbody>
    </table>
  </div>
  </center>
  
  </body>
  </html>';
} else {
	header('./index.php');
	exit();
}
?>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Client location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="map"></div>
        <div style="display:none;" id="Lat" value=""></div>
        <div style="display:none;" id="Lng" value=""></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

    function initMap(plat, plng) {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: plat, lng: plng}
        console.log("lat: " + plat + " lng: " + plng);
      });

      var marker = new google.maps.Marker({
        position: {lat: plat, lng: plng},
        map: map,
        title: 'Client Location'
      });
        console.log("lat: " + plat + " lng: " + plng + "second ");
    }
  </script>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDDVKkM51f4P-tbkqHVw3bbUkAnfITvfB0&callback=initMap"
  async defer></script>
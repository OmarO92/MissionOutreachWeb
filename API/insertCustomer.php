<?php 
    require_once('connect.php');

    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['dob']) && isset($_POST['qr']) && isset($_POST['lat']) && isset($_POST['lng'])){

        $fname = mysqli_real_escape_string($link,htmlentities($_POST['fname']));
        $lname = mysqli_real_escape_string($link,htmlentities($_POST['lname']));
        $dob   = mysqli_real_escape_string($link,htmlentities($_POST['dob']));
        $qr    = mysqli_real_escape_string($link,htmlentities($_POST['qr']));
        $lat   = mysqli_real_escape_string($link,htmlentities($_POST['lat']));
        $lng   = mysqli_real_escape_string($link,htmlentities($_POST['lng']));

        $sql = "INSERT INTO client (fname, lname, dob, qr, lat, lng)
            VALUES('$fname', '$lname', $dob, '$qr', $lat, $lng )";

        echo (mysqli_query($link, $sql)? "Added New Client Sucessfully" : "Failed To Add New Client");

    }
?>

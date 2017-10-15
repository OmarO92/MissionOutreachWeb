<?php 

    require_once('connect.php');

    if(isset($_POST['id'])){

        $fname = mysqli_real_escape_string($link,htmlentities($_POST['fname']));
        $lname = mysqli_real_escape_string($link,htmlentities($_POST['lname']));
        $dob   = mysqli_real_escape_string($link,htmlentities($_POST['dob']));
        $qr    = mysqli_real_escape_string($link,htmlentities($_POST['qr']));
        $lat   = mysqli_real_escape_string($link,htmlentities($_POST['lat']));
        $lng   = mysqli_real_escape_string($link,htmlentities($_POST['lng']));
        $id    = mysqli_real_escape_string($link,htmlentities($_POST['id']));

        $sql = "UPDATE client";
        if($fname != null) $sql += "SET fname = '$fname'";
        if($lname != null) $sql += "SET lname = '$lname'";
        if($dob   != null) $sql += "SET dob = " + $fname + " "; 
        if($qr    != null) $sql += "SET qr = '$qr'"; 
        if($lat   != null) $sql += "SET lat = " + $lat + " "; 
        if($lng   != null) $sql += "SET lng = " + $lng + " "; 
        $sql += "WHERE id = " + $id;        

        echo (mysqli_query($link, $sql)? "Updated Client Sucessfully" : "Failed To Update Client");

    }
?>

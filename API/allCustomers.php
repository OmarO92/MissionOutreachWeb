<?php 
require_once('connect.php');

      $fetch = mysqli_query($link, "SELECT * FROM client");
      $return_arr = array();
      while ($row = mysqli_fetch_array($fetch)) {
          $row_array['fname'] = $row['fname'];
          $row_array['lname'] = $row['lname'];
          $row_array['dob']   = $row['dob'];
          $row_array['qr']    = $row['qr'];
          array_push($return_arr,$row_array);
      }
      echo json_encode($return_arr);
?>

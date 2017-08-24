<?php
  include 'dbconn.php';

  $event_name = $_POST['evt_name'];
  $event_name = str_replace("'", "''", $event_name);

  $email = $_POST['email_id'];

  $sql_query = "SELECT * from event WHERE Title = '$event_name'";
  $result = mysqli_query($conn, $sql_query);
  if (mysqli_num_rows($result) > 0)
  {
    $row = mysqli_fetch_assoc($result);
    $id = $row['ID'];

    $register_query = "SELECT * from registration WHERE id = '$id' AND email = '$email'";
    $register_result = mysqli_query($conn, $register_query);

    if (mysqli_num_rows($register_result) > 0)
    {
    	echo "<div id='reg_status' data-is-registered='True'></div>";
    }
    else
    {
    	echo "<div id='reg_status' data-is-registered='False'></div>";
    }
  }
?>
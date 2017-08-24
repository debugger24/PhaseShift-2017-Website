<?php
  include 'dbconn.php';

  $event_name = $_POST['evt_name'];
  $event_name = str_replace("'", "''", $event_name);

  $sql_query = "SELECT * from event WHERE Title = '$event_name'";
  $result = mysqli_query($conn, $sql_query);
  if (mysqli_num_rows($result) > 0)
  {
    $row = mysqli_fetch_assoc($result);

    // Filling the modal.
    echo  "<div class='modal-content'>";

    // Event Title
    echo    "<h4>";
    echo      $row['Title'];
    echo    "</h4>";

    // Event Description
    echo    "<p>";
    echo      $row['Description'];
    echo    "</p>";

    // Department
    echo    "<p><b>Department: </b>";
    echo      $row['Department'];
    echo    "</p>";

    // Participation
    echo    "<p><b>Participation: </b>";
    echo      $row['Participation'];
    echo    "</p>";

    // Registration Fees
    echo    "<p><b>Fee: </b>";
    echo      $row['RegFees'];
    echo    "</p>";

    // Start Date
    echo    "<p><b>Start Date: </b>";
    echo      $row['Date'];
    echo    "</p>";

    echo    "<br/>";

    // Rewards
    if (!(empty($row['Prize1']) && empty($row['Prize2']) && empty($row['Prize3'])))
    {
      echo    "<p>";
      echo      "<p><b style='font-size: 20px'>Rewards</b></p>";
      echo      "<p>";

      // First Place
      if (!empty($row['Prize1']))
      {
        echo      "<b>First Place: </b>";
        echo      $row['Prize1'];
        echo      "<br/>";
      }

      // Second Place
      if (!empty($row['Prize2']))
      {
        echo      "<b>Second Place: </b>";
        echo      $row['Prize2'];
        echo      "<br/>";
      }

      // Third Place
      if (!empty($row['Prize3']))
      {
        echo      "<b>Third Place: </b>";
        echo      $row['Prize3'];
        echo      "<br/>";
      }

      echo      "</p>";
      echo    "</p>";
      echo    "<br/>";
    }

    // Rules
    if (!empty($row['Rules']))
    {
      echo    "<p><b style='font-size: 20px'>Rules: </b></p>";
      echo    "<p>";
      echo      $row['Rules'];
      echo    "</p>";

      echo    "<br/>";
    }

    // Co-ordinators
    if (!empty($row['Name']))
    {
      echo    "<p><b style='font-size: 20px'>Co-ordinators:</b></p>";
      echo    "<p>";
      echo      $row['Name'];
      echo      " - ";
      echo      $row['Number'];
      echo    "</p>";

      // Second co-ordinator
      if (!empty($row['Name2']))
      {
        echo    "<p>";
        echo      $row['Name2'];
        echo      " - ";
        echo      $row['Number2'];
        echo    "</p>";
      }

    }

    echo  "</div>";


    $num_registered = $row['Num_Reg'];
    $max_registrations = $row['Max_Reg'];
    $event_name_sanitized = $event_name = str_replace("''", "&#39;", $event_name);

    if ($num_registered >= $max_registrations)
    {
      // Modal Footer
      echo  "<div class='modal-footer'>
              <div class='center-align'>
                <a class='modal-action waves-effect waves-green btn-large disabled' data-event-name='";
      echo        $event_name_sanitized;
      echo      "'>Register</a>";
      echo      "<p>Sorry, this event is full.</p>";
      echo    "</div>
            </div>";
    }

    else
    {
      // Modal Footer
      echo  "<div class='modal-footer'>
              <div class='center-align'>
                <a class='modal-action waves-effect waves-green btn-large register-btn' data-event-name='";
      echo        $event_name_sanitized;
      echo      "'>Register</a>
              </div>
            </div>";
    }
  }

?>

<!--
<div class="modal-content">
  <h4>Bio-Race</h4>
  <p>A treasure hunt with 10 stages. Solve a problem at each stage in order to proceed to the next. Think fast! Run faster!</p>
  <p><b>Department: </b>Bio-Technology</p>
  <p><b>Participation: </b>Team of 2</p>
  <p><b>Fee: </b>100</p>
  <p><b>Start Date: </b>15-09-2017</p>
  <br/>
  <p>
    <p><b style="font-size: 20px">Rewards</b></p>
    <p>
      <b>First Place: </b>1000
      <br/>
      <b>Second Place: </b>500
      <br/>
    </p>
  </p>
  <br/>
  <p><b style="font-size: 20px">Rules: </b></p>
  <p>
    Teams will have to solve the problem that they’re given at each stage in order to proceed to the next. 
The first team to finish, wins. Use of phones, laptops etc are prohibited.
  </p>
  <br/>
  <p><b style="font-size: 20px">Co-ordinators:</b></p>
  <p>Anish Raju R. Amara - 9620856942</p>
</div>

<div class="modal-footer">
  <div class="center-align">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-large">Register</a>
  </div>
</div>
-->
<?php
  include 'dbconn.php';

  $workshop_name = $_POST['wrk_name'];
  $workshop_name = str_replace("'", "''", $workshop_name);

  $sql_query = "SELECT * from event WHERE Title = '$workshop_name'";
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
    if (!empty($row['Date']))
    {
      echo    "<p><b>Start Date: </b>";
      echo      $row['Date'];
      echo    "</p>";
    }

    // Time
    if (!empty($row['Time']))
    {
      echo    "<p><b>Timings: </b>";
      echo      $row['Time'];
      echo    "</p>";
    }

    // Venue
    if (!empty($row['Venue']))
    {
      echo    "<p><b>Venue: </b>";
      echo      $row['Venue'];
      echo    "</p>";
    }

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

    $workshop_name_sanitized = $event_name = str_replace("''", "&#39;", $workshop_name);

    if ($row['Full'] == 1)
    {
      // Modal Footer
      echo  "<div class='modal-footer'>
              <div class='center-align'>
                <a class='modal-action waves-effect waves-green btn-large disabled' data-event-name='";
      echo        $workshop_name_sanitized;
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
      echo        $workshop_name_sanitized;
      echo      "'>Register</a>
              </div>
            </div>";
    }
  }

?>
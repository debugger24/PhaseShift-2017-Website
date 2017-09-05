<?php
  include 'dbconn.php';

  $sql_query = "SELECT Title, Description from event WHERE Type = 'Workshop'";
  $result = mysqli_query($conn, $sql_query);
  if (mysqli_num_rows($result) > 0)
  {

    $num_entries = mysqli_num_rows($result);
    $cards_filled = 0;

    while ($cards_filled < $num_entries)
    {
      $row = mysqli_fetch_assoc($result);
      $workshop_title = str_replace("'", "&#39;", $row['Title']);

      // Creating a new row.
      if ($cards_filled % 4 == 0) {
        echo "<div class='row'>";
      }

      // Creating a card.
      echo    "<div class='col s12 l3'>
                <div class='card blue-grey darken-1'>
                  <div class='card-content white-text' style='overflow-y: hidden; text-overflow: ellipsis; height: 200px'>";

      // Workshop Title
      echo          "<span class='card-title'>";
      echo            $row['Title'];
      echo          "</span>";

      // Workshop Description
      echo          "<p style='display: -webkit-box; overflow: hidden; -webkit-line-clamp: 4; -webkit-box-orient: vertical'>";
      echo            $row['Description'];
      echo          "</p>";
      echo        "</div>";

      // Workshop Modal Button
      echo        "<div class='card-action'>
                    <div class='center-align'>";
      echo            "<a class='workshop-modal-btn waves-effect waves-light btn modal-trigger' href='#workshops-modal' data-workshop-name='";
      echo            $workshop_title;
      echo            "'>Learn More</a>";
      echo          "</div>
                  </div>";

      echo      "</div>
              </div>";

      $cards_filled = $cards_filled + 1;

      if ($cards_filled % 4 == 0) {
        echo "</div>";
      }
    }

  }

  
?>
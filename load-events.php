<?php
  include 'dbconn.php';

  $category_name = $_POST['cat_name'];
  echo  "<h4 class='center-align blue-grey-text text-lighten-1'>";
  echo    $category_name;
  echo  "</h4>";

  $sql_query = "SELECT Title, Description from event WHERE Category = '$category_name' AND Type = 'Event'";
  $result = mysqli_query($conn, $sql_query);
  if (mysqli_num_rows($result) > 0)
  {

    $num_entries = mysqli_num_rows($result);
    $cards_filled = 0;

    while ($cards_filled < $num_entries)
    {
      $row = mysqli_fetch_assoc($result);
      $event_title = str_replace("'", "&#39;", $row['Title']);

      // Creating a new row.
      if ($cards_filled % 4 == 0) {
        echo "<div class='row'>";
      }

      // Creating a card.
      echo    "<div class='col s12 l3'>
                <div class='card blue-grey darken-1'>
                  <div class='card-content white-text'>";

      // Event Title
      echo          "<span class='card-title'>";
      echo            $row['Title'];
      echo          "</span>";

      // Event Description
      echo          "<p style='display: -webkit-box; overflow: hidden; -webkit-line-clamp: 2; -webkit-box-orient: vertical'>";
      echo            $row['Description'];
      echo          "</p>";
      echo        "</div>";

      // Event Modal Button
      echo        "<div class='card-action'>
                    <div class='center-align'>";
      echo            "<a class='event-modal-btn waves-effect waves-light btn modal-trigger' href='#events-modal' data-event-name='";
      echo            $event_title;
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

<!--
<h4 class="center-align blue-grey-text text-lighten-1">Mission Possible</h4>

        <div class="container" style="width: 90%">
          <div class="row">

            <div class="col s12 m6 l3">
              <div class="card blue-grey darken-1">
                <div class="card-content white-text">

                    PHP CODE

                    $sql_query = "SELECT * from event WHERE Title = 'Bio-Race'";
                    $result = mysqli_query($conn, $sql_query);
                    if (mysqli_num_rows($result) > 0)
                    {
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        echo "<span class='card-title'>";
                        echo $row['Title'];
                        echo "</span>";

                        echo "<p>";
                        echo $row['Description'];
                        echo "</p>";
                      }
                    }

                  PHP CODE END

                </div>

                <div class="card-action">
                  <div class="center-align">
                    <a class="waves-effect waves-light btn modal-trigger" href="#events-modal">Learn More</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
-->
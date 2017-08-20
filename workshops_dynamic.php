 <?php
    include 'dbconn.php';
 ?>

 <!DOCTYPE html>
  <html>
    <head>
      <title>BMSCE Phase Shift 2017 - Workshops</title>

      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/materialize_custom.css"/>
      <link rel="icon" href="ps_favicon.ico" type="image/gif" sizes="16x16">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="blue-grey darken-4">
      <div class="container" style="margin-bottom: 30px">
        <h1 class="center-align blue-grey-text text-lighten-4">Workshops</h1>
        <div class="center-align">
          <a class="waves-effect waves-light btn" href="index.html">Back To Home Page</a>
        </div>
      </div>
      
      <div id="workshops-list" class="col s12"></div>

      <div id="workshops-modal" class="modal"></div>


      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <script>
      function load_workshops_list() {
        $("#workshops-list").empty();
        $("#workshops-list").load("load-workshops.php");
      }

      function load_workshop_modal(workshop_name) {
        $("#workshops-modal").empty();
        $("#workshops-modal").load("load-workshop-details.php", { wrk_name: workshop_name });
      }

        $(document).ready(function() {
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();

          $("#workshops-list").on("click", ".workshop-modal-btn", function() {
            var wrk_name = $(this).attr("data-workshop-name");
            load_workshop_modal(wrk_name);
          });

          load_workshops_list();
        });
      </script>
    </body>
  </html>
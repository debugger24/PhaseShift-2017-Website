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

      <div id="reg-check"></div>


      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

      <script>
      function load_workshops_list() {
        $("#workshops-list").empty();
        $("#workshops-list").load("load-workshops.php");
      }

      function load_workshop_modal(workshop_name) {
        $("#workshops-modal").empty();
        $("#workshops-modal").load("load-workshop-details.php", { wrk_name: workshop_name });
      }

      function load_registration_form(workshop_name) {
        $("#workshops-modal").empty();
        $("#workshops-modal").load("load-registration-form.php", { evt_name: workshop_name });
      }

      function handle_payment(response, event_name) {
        $("#workshops-modal").empty();
        $("#workshops-modal").load("handle-payment.php", { payment_id: response.razorpay_payment_id, evt_name: event_name });
      }

      function check_registered_and_open_payment(event_name, fees, name, college, email, phone) {
        $("#reg-check").empty();
        $("#reg-check").load("check-registered.php", { evt_name: event_name, email_id: email }, function() {
          var is_registered = $('#reg-check').children().first().attr('data-is-registered');

          if (is_registered == 'True')
          {
            alert("A person has already registered with this email!");
          }

          else
          {
            var options = {
              "key": "rzp_test_R8DYN4gfYSznyT",
              "amount": fees * 100, // Multiplied by 100 since razor-pay specifies in paisa.
              "name": "BMSCE",
              "description": "Registration for event: " + event_name,
              "handler": function (response) {
                  handle_payment(response, event_name);
              },
              "notes": {
                  "name": name,
                  "college": college,
                  "email": email,
                  "phone": phone
              },
              "theme": {
                  "color": "#F37254"
              }
            };

            var rzp1 = new Razorpay(options);

            rzp1.open();
          }
        });
      }

        $(document).ready(function() {
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();

          $("#workshops-list").on("click", ".workshop-modal-btn", function() {
            var wrk_name = $(this).attr("data-workshop-name");
            load_workshop_modal(wrk_name);
          });

          $("#workshops-modal").on("click", ".register-btn", function() {
            var evt_name = $(this).attr("data-event-name");
            load_registration_form(evt_name);
          });

          $("#workshops-modal").on("click", ".back-details-btn", function() {
            var evt_name = $(this).attr("data-event-name");
            load_workshop_modal(evt_name);
          });

          $("#workshops-modal").on("click", ".registration-submit-btn", function() {
            var evt_name = $(this).attr("data-event-name");
            var reg_fees = $(this).attr("data-reg-fees");

            var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if ($('#first_name').val() == "")
            {
              alert("Please enter your first name.");
            }

            else if ($('#last_name').val() == "")
            {
              alert("Please enter your last name.");
            }

            else if ($('#college_name').val() == "")
            {
              alert("Please enter your college name.");
            }

            else if (!email_regex.test($('#email').val()))
            {
              alert("Please enter a valid email.");
            }

            else if ($('#phno').val().length != 10)
            {
              alert("Please enter a valid phone number.");
            }

            else
            {
              check_registered_and_open_payment(evt_name, parseInt(reg_fees), $('#first_name').val() + ' ' + $('#last_name').val(), $('#college_name').val(), $('#email').val(), $('#phno').val());
            }
          });

          load_workshops_list();
        });
      </script>
    </body>
  </html>
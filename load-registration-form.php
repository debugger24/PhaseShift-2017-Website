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

    echo 	"<p class='font-size: 20px'>Registration</p>";

    // Registration Form
    echo 	"<div class='row'>
			    <form class='col s12'>
			      <div class='row'>

			        <div class='input-field col s6'>
			          <input id='first_name' type='text'>
			          <label for='first_name'>First Name</label>
			        </div>

			        <div class='input-field col s6'>
			          <input id='last_name' type='text'>
			          <label for='last_name'>Last Name</label>
			        </div>
			      </div>

			      <div class='row'>
				    <div class='input-field col s12'>
				    	<input id='college_name' type='text'>
				    	<label for='college_name'>College Name</label>
				    </div>
			      </div>

			      <div class='row'>
			        <div class='input-field col s12'>
			          <input id='email' type='email'>
			          <label for='email'>Email</label>
			        </div>
			      </div>

			      <div class='row'>
			        <div class='input-field col s12'>
			          <input id='phno' type='tel' maxlength='10'>
			          <label for='phno'>Phone Number</label>
			        </div>
			      </div>

			      <div class='row'>
			      	<div class='col s12'>
			      	  <div class='center-align'>
			      	    <button class='btn waves-effect waves-light disabled registration-submit-btn' type='submit' name='action'>Submit</button>
					  </div>
			      	</div>
			      </div>
			    </form>
			</div>";

    echo  "</div>";

    // Modal Footer
    echo  "<div class='modal-footer'>
            <div class='center-align'>
              <a class='modal-action waves-effect waves-green btn-large back-details-btn' data-event-name='";
    echo        $row['Title'];
    echo      "'>Back To Details</a>
            </div>
          </div>";
  }

?>




<!--
<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input disabled value="I am not editable" id="disabled" type="text" class="validate">
          <label for="disabled">Disabled</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          This is an inline input field:
          <div class="input-field inline">
            <input id="email" type="email" class="validate">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
      </div>
    </form>
  </div>
-->
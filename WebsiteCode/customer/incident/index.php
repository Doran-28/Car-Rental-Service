<?php
session_start();
require_once('../../model/database.php');
require_once('../../model/fields.php');
require_once('../../model/validate.php');
require_once('../../model/customer_db.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('reservation_id');
$fields->addField('date');
$fields->addField('description');

// Ensures the user is logged in
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
}

// Get phone number of logged in user for query
$phone_number = $_SESSION['customer_password'];

// Pull reservations attached to user
$reservations = get_reservations_for_customer_incident($phone_number);

$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case NULL :
        // Select vehicle to give feedback for
    	if (empty($reservations)) {
			include('no_vehicles.php');
			break;
    	} else {
    		include('vehicle_list.php');
    		break;
    	}

    case "vehicle_selected" :
    	// Set default variables
    	$reservation_id = filter_input(INPUT_POST, 'reservation_id');
    	$start_date = filter_input(INPUT_POST, 'start_date');
    	$end_date = filter_input(INPUT_POST, 'end_date');
    	$description = "";
    	$date = "";

    	include ('vehicle_selected.php');
    	break;

    case "submit_feedback" :
        require_once('../../model/database.php');

        // Copy values to local variables
        $reservation_id = filter_input(INPUT_POST, 'reservation_id');
        $start_date = filter_input(INPUT_POST, 'start_date');
    	$end_date = filter_input(INPUT_POST, 'end_date');
        $description = filter_input(INPUT_POST, 'description');
        $date = filter_input(INPUT_POST, 'date');

        // Validate form data
        $validate->text('description', $description, true);
        $validate->date('date', $date, true);     

        // Ensure inputed date falls within date range
        $inputDate = new DateTime($date);
        $startDate = new DateTime($start_date);
        $endDate = new DateTime($end_date);

        if ($inputDate < $startDate || $inputDate > $endDate) {
        	$field = $fields->getField('date');
        	$field->setErrorMessage("Date not within range of rental period.");
        }

        // Load appropriately according to errors
        if ($fields->hasErrors()) {
            include('vehicle_selected.php');
        } else {
            //Add the form info to database if there are no errors
            $query = 'INSERT INTO incident (reservation_id, date, description) VALUES (:reservation_id, :date, :description)';
            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':reservation_id', $reservation_id);
                $statement->bindValue(':description', $description);
                $statement->bindValue(':date', $date);
                $statement->execute();
                $statement->closeCursor();
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
            }
            
            include('success.php');
            break;
        }
        break;
}

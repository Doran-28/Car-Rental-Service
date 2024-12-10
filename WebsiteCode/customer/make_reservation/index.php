<?php
session_start();
require_once('../../model/database.php');
require_once('../../model/fields.php');
require_once('../../model/validate.php');
require_once('../../model/customer_db.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('start_date');
$fields->addField('end_date');
$fields->addField('name');
$fields->addField('card_number');
$fields->addField('CVV');

// Get phone number of logged in user for query
$phone_number = $_SESSION['customer_password'];

// Ensures the user is logged in
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
}

// Get phone number of logged in user for query
$phone_number = $_SESSION['customer_password'];

// Declare other initial variables
$vehicles = "";
$locations = get_used_locations();

$action = filter_input(INPUT_POST, 'action');

switch($action) {
	// Select date range for reservation
	case NULL :
		$start_date = "";
		$end_date = "";

		include('filter_form.php');
		break;

	case 'show_vehicles' :
		$start_date = filter_input(INPUT_POST, 'start_date');
		$end_date = filter_input(INPUT_POST, 'end_date');
		$location_id = filter_input(INPUT_POST, 'location_id');

		$validate->date('start_date', $start_date, TRUE);
		$validate->date('end_date', $end_date, TRUE);
		if ($fields->hasErrors()) {
			include('filter_form.php');
		} else {
			//Retrieve all vehicles available
			$vehicles = get_available_vehicles($start_date, $end_date, $location_id);

			//If empty, show empty page, otherwise list vehicles
			if (empty($vehicles)) {
				include('no_vehicles.php');
				break;
			} else {
				include('vehicle_list.php');
				break;
			}
		}

	case 'vehicle_selected':
		$start_date = filter_input(INPUT_POST, 'start_date');
		$end_date = filter_input(INPUT_POST, 'end_date');
		$vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
		$valued_at = filter_input(INPUT_POST, 'valued_at');

		// Determine the cost of rental period to display to user.
		$start = new DateTime($start_date);
		$end = new DateTime($end_date);

		$interval = $start->diff($end);
		$number_of_days = $interval->days;

		$result = ($valued_at / 200) * $number_of_days;
		$result = number_format($result, 2); // Final cost of rental.

		$name = "";
		$card_number = "";
		$CVV = "";

		include('confirm_payment.php');
		break;

	case "confirm_reservation" :
		require_once('../../model/database.php');

		// Move values to local variables
		$start_date = filter_input(INPUT_POST, 'start_date');
		$end_date = filter_input(INPUT_POST, 'end_date');
		$vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
		$name = filter_input(INPUT_POST, 'name');
		$card_number = filter_input(INPUT_POST, 'card_number');
		$CVV = filter_input(INPUT_POST, 'CVV');
		$result = filter_input(INPUT_POST, 'result');
		$result = str_replace(',', '', $result);
		$employee_id = random_int(1,20);
		$customer_id = get_customer_id($phone_number);
		$payment_date = date('Y-m-d');

		// Validate payment info
		$validate->text('name', $name, TRUE);
		$validate->pattern('card_number', $card_number, '/^\d{4} \d{4} \d{4} \d{4}$/', "Card number has to follow the formating of 1111 2222 3333 4444.", TRUE);
		$validate->number('CVV', $CVV, TRUE, 100, 999);

		// If no errors, finalize resevation.
		if ($fields->hasErrors()) {
			include('confirm_payment.php');
		} else {
			$query = "CALL insert_reservation(:vehicle_id, :customer_id, :employee_id, :start_date, :end_date, @result);";
			try {
				$statement = $db->prepare($query);
				$statement->bindValue(':vehicle_id', $vehicle_id);
				var_dump($customer_id);
				$statement->bindValue(':customer_id', $customer_id);
				$statement->bindValue(':employee_id', $employee_id);
				$statement->bindValue(':start_date', $start_date);
				$statement->bindValue(':end_date', $end_date);
				$statement->execute();
				$statement->closeCursor();
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				display_db_error($error_message);
			}

			$reservation_id = get_last_reservation();

			// After reservation is made update payment
			$query2 = "INSERT INTO payment (reservation_id, amount, payment_date, payment_method, status) VALUES (:reservation_id, :result, :payment_date, 'Credit Card', 'Completed');";
			try {
				$statement = $db->prepare($query2);
				$statement->bindValue(':reservation_id', $reservation_id);
				$statement->bindValue(':result', $result);
				$statement->bindValue(':payment_date', $payment_date);
				$statement->execute();
				$statement->closeCursor();
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				display_db_error($error_message);
			}

			include('success.php');
			break;
		}
}
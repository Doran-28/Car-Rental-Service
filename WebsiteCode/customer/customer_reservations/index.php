<?php
session_start();
require_once('../../model/database.php');
require_once('../../model/fields.php');
require_once('../../model/validate.php');
require_once('../../model/customer_db.php');

// Ensures the user is logged in
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
}

// Get phone number of logged in user for query
$phone_number = $_SESSION['customer_password'];

// Pull reservations attached to user
$reservations = get_reservations_for_customer($phone_number);

$action = filter_input(INPUT_POST, 'action');

// Shows appropriate page
switch($action) {
	case NULL : 
		include('view_reservations.php');
		break;

	case "delete_reservation" :
		$reservation_id = filter_input(INPUT_POST, 'reservation_id');
		
		delete_reservation($reservation_id);

		include('success.php');
		break;
}
?>
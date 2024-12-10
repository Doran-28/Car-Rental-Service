<?php
session_start();
require_once('../model/database.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require_once('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('first_name');
$fields->addField('last_name');
$fields->addField('email');
$fields->addField('phone_number');

// Determines if the user clicked logout.
if (isset($_POST['logout'])) {
	$_SESSION = array();
	session_destroy();
	$action = NULL;
}

// Determines if the user is currently logged in via session
if(isset($_SESSION['customer_password'])) {
	$action = "logged_in";
}

// Shows appropriate page based on login
switch($action) {
	case NULL : 
		include('customer_login.php');
		break;

	case "create_user" :
		$first_name = "";
		$last_name = "";
		$email = "";
		$phone_number = "";

		include('create_user.php');
		break;

	case "submit_new_account" :
		require_once('../model/database.php');

        // Copy values to local variables
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
    	$email = filter_input(INPUT_POST, 'email');
        $phone_number = filter_input(INPUT_POST, 'phone_number');

        // Validate form data
        $validate->text('first_name', $first_name, true);
        $validate->text('last_name', $first_name, true);
        $validate->email('email', $email, true);
        $validate->phone('phone_number', $phone_number, true);  

        // Load appropriately according to errors
        if ($fields->hasErrors()) {
            include('create_user.php');
        } else {
            //Add the form info to database if there are no errors
            $query = 'INSERT INTO customer (first_name, last_name, email, phone_number) VALUES (:first_name, :last_name, :email, :phone_number)';
            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':first_name', $first_name);
                $statement->bindValue(':last_name', $last_name);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':phone_number', $phone_number);
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

	case "request_login" :
		require_once('../model/database.php');

		// Gather login info
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');

		if (is_valid_customer_login($username, $password)) {
	        $_SESSION['customer_password'] = $password;
	        include('customer_home.php');
	    	break;
	    } else {
	         $error = "Invalid login, please try again.";
	         include('customer_login.php');
	    	 break;
	    }
	    break;

	case "logged_in" :
		include('customer_home.php');
		break;
}
?>
<?php
function is_valid_customer_login($username, $password) {
    global $db;
    $query = 'SELECT * FROM customer
              WHERE email = :username AND phone_number = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function get_reservations_for_customer($phone_number) {
    global $db;
    $query = 'SELECT r.reservation_id, r.vehicle_id, r.customer_id, r.start_date, r.end_date, c.first_name, c.last_name, c.email, c.phone_number, v.make, v.model, v.year FROM reservation r INNER JOIN customer c INNER JOIN vehicle v ON r.customer_id = c.customer_id AND r.vehicle_id = v.vehicle_id WHERE c.phone_number = :phone_number';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':phone_number', $phone_number);
        $statement->execute();
        $reservations = $statement->fetchAll();
        $statement->closeCursor();
        return $reservations;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_reservations_for_customer_feedback($phone_number) {
    global $db;
    $query = 'SELECT r.reservation_id, r.vehicle_id, r.customer_id, r.start_date, r.end_date, c.first_name, c.last_name, c.email, c.phone_number, v.make, v.model, v.year FROM reservation r INNER JOIN customer c INNER JOIN vehicle v ON r.customer_id = c.customer_id AND r.vehicle_id = v.vehicle_id WHERE c.phone_number = :phone_number AND r.end_date < CURDATE() AND r.reservation_id NOT IN (SELECT reservation_id FROM feedback);';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':phone_number', $phone_number);
        $statement->execute();
        $reservations = $statement->fetchAll();
        $statement->closeCursor();
        return $reservations;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_reservations_for_customer_incident($phone_number) {
    global $db;
    $query = 'SELECT r.reservation_id, r.vehicle_id, r.customer_id, r.start_date, r.end_date, c.first_name, c.last_name, c.email, c.phone_number, v.make, v.model, v.year FROM reservation r INNER JOIN customer c INNER JOIN vehicle v ON r.customer_id = c.customer_id AND r.vehicle_id = v.vehicle_id WHERE c.phone_number = :phone_number AND r.end_date > CURDATE() AND r.start_date < CURDATE() AND r.reservation_id NOT IN (SELECT reservation_id FROM incident);';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':phone_number', $phone_number);
        $statement->execute();
        $reservations = $statement->fetchAll();
        $statement->closeCursor();
        return $reservations;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_reservation($reservation_id) {
    global $db;
    $reservation_id = filter_input(INPUT_POST, 'reservation_id');
    $query2 = 'DELETE FROM payment WHERE reservation_id = :reservation_id;';
    try {
        $statement = $db->prepare($query2);
        $statement->bindValue(':reservation_id', $reservation_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }

    $query = 'DELETE FROM reservation WHERE reservation_id = :reservation_id;';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':reservation_id', $reservation_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_available_vehicles($start_date, $end_date, $location_id){
    global $db;
    $start_date = filter_input(INPUT_POST, 'start_date');
    $end_date = filter_input(INPUT_POST, 'end_date');
    $location_id = filter_input(INPUT_POST, 'location_id');
    $query = 'SELECT * FROM vehicle v WHERE v.location_id = :location_id AND NOT EXISTS (SELECT 1 FROM reservation r WHERE r.vehicle_id = v.vehicle_id AND (r.start_date BETWEEN :start_date AND :end_date OR r.end_date BETWEEN :start_date AND :end_date OR (r.start_date <= :end_date AND r.end_date >= :start_date)));';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':start_date', $start_date);
        $statement->bindValue(':end_date', $end_date);
        $statement->bindValue('location_id', $location_id);
        $statement->execute();
        $vehicles = $statement->fetchAll();
        $statement->closeCursor();
        return $vehicles;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_used_locations() {
    global $db;
    $query = 'SELECT DISTINCT l.* FROM location l INNER JOIN vehicle v ON l.location_id = v.location_id;';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $locations = $statement->fetchAll();
        $statement->closeCursor();
        return $locations;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_customer_id($phone_number) {
    global $db;
    $query = "SELECT customer_id FROM customer WHERE phone_number = :phone_number;";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':phone_number', $phone_number);
        $statement->execute();
        $customer = $statement->fetch();
        $id = $customer['customer_id'];
        $statement->closeCursor();
        return $id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_last_reservation() {
    global $db;
    $query = "SELECT reservation_id FROM reservation ORDER BY reservation_id DESC LIMIT 1;";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $reservation = $statement->fetch();
        $id = $reservation['reservation_id'];
        $statement->closeCursor();
        return $id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>
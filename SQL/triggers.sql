

DELIMITER //

-- Triger calculates cost for reservation total_cost. Based on formula (vehilce.valued_at / 200) * (number of days)
CREATE TRIGGER calculate_total_cost
BEFORE INSERT ON reservation
FOR EACH ROW
BEGIN
    DECLARE daily_rate DECIMAL(10, 2);
    
    -- Get the daily rate from the vehicle table
    SELECT valued_at / 200 INTO daily_rate
    FROM vehicle
    WHERE vehicle_id = NEW.vehicle_id;

    -- Calculate the total cost
    SET NEW.total_cost = DATEDIFF(NEW.end_date, NEW.start_date) * daily_rate;
END //

DELIMITER ;


DELIMITER //

-- Triger ensures that the payment meets the total_cost of the reservation. If not, the insert is cancelled
CREATE TRIGGER check_payment_amount
BEFORE INSERT ON payment
FOR EACH ROW
BEGIN
    DECLARE reservation_total DECIMAL(10, 2);

    -- Retrieve total_cost from the reservation table
    SELECT total_cost INTO reservation_total
    FROM reservation
    WHERE reservation_id = NEW.reservation_id;

    -- Check if the amount in payment matches the total cost in reservation
    IF NEW.amount != reservation_total THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Payment amount must match the reservation total cost.';
    END IF;
END //

DELIMITER ;


DELIMITER //
-- Triger is to set vehicle.service_required to TRUE whenever an incident on that vehicle occurs
CREATE TRIGGER set_service_required
AFTER INSERT ON incident
FOR EACH ROW
BEGIN
    -- Update the vehicle's service_required flag to TRUE when an incident occurs
    UPDATE vehicle
    SET service_required = TRUE
    WHERE vehicle_id = (SELECT vehicle_id FROM reservation WHERE reservation_id = NEW.reservation_id);
END //

DELIMITER ;

-- Procedure exists for inerting reservations. When inserting, we must be sure that the car selected for the date range is available.
DELIMITER //
CREATE PROCEDURE insert_reservation(
    IN p_vehicle_id INT,
    IN p_customer_id INT,
    IN p_employee_id INT,
    IN p_start_date DATE,
    IN p_end_date DATE,
    OUT p_result VARCHAR(255)
)
BEGIN
    DECLARE overlap_count INT DEFAULT 0;

    -- Check for overlapping reservations
    SELECT COUNT(*) INTO overlap_count
    FROM reservation
    WHERE vehicle_id = p_vehicle_id
      AND p_start_date < end_date
      AND p_end_date > start_date;

    -- If there’s an overlap, set an error message
    IF overlap_count > 0 THEN
        SET p_result = 'This vehicle is already booked for the selected dates.';
    ELSE
        -- Insert reservation if no conflict
        INSERT INTO reservation (vehicle_id, customer_id, employee_id, start_date, end_date, total_cost)
        VALUES (p_vehicle_id, p_customer_id, p_employee_id, p_start_date, p_end_date, NULL);
        SET p_result = 'Reservation added successfully.';
    END IF;
END //
DELIMITER ;


-- Here we want to insert into feedback, however the insert must happen only after the reservation is done.
-- So the current date (CURDATE()) mus be greater than the reservation end_date  
DELIMITER //
CREATE PROCEDURE insert_feedback(
    IN p_reservation_id INT,
    IN p_description VARCHAR(255),
    IN p_rating INT,
    OUT p_result VARCHAR(255)
)
BEGIN
    DECLARE reservation_end_date DATE;

    -- Get the end date of the specified reservation
    SELECT end_date INTO reservation_end_date
    FROM reservation
    WHERE reservation_id = p_reservation_id;

    -- Check if the reservation exists and if feedback is being given after the end date
    IF reservation_end_date IS NULL THEN
        SET p_result = 'Reservation not found.';
    ELSEIF CURDATE() < reservation_end_date THEN
        SET p_result = 'Feedback can only be provided after the reservation has ended.';
    ELSE
        -- Insert the feedback record
        INSERT INTO feedback (reservation_id, description, rating)
        VALUES (p_reservation_id, p_description, p_rating);
        SET p_result = 'Feedback added successfully.';
    END IF;
END //
DELIMITER ;

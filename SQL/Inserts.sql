-- To insert into the tables, we must follow an order so that the parent tables are inserted into first.
-- locations – No foreign keys reference this table.
-- customers – Independent table, so it can be populated next.
-- employee – Depends on locations (via location_id).
-- vehicle – Depends on locations (via location_id).
-- insurance – No direct dependencies, but each vehicle has one associated insurance policy.
-- reservation – Depends on customers, employee, and vehicle.
-- incident – Depends on reservation.
-- vehicle_service – Depends on vehicle.
-- feedback – Depends on reservation.
-- payment – Depends on reservation.

INSERT INTO location (street_number, street_name, city, state_province, postal_code, country) VALUES 
('123', 'Queen St', 'Toronto', 'ON', 'M5H 2N2', 'Canada'),
('4510', 'Paris St', 'Sudbury', 'ON', 'D5T 5M1', 'Canada'),
('456', 'Main St', 'Vancouver', 'BC', 'V5K 0A1', 'Canada'),
('789', 'King St W', 'Calgary', 'AB', 'T2P 2E1', 'Canada'),
('101', 'Bloor St', 'Montreal', 'QC', 'H2X 1Z8', 'Canada'),
('202', 'Robson St', 'Victoria', 'BC', 'V8W 1P5', 'Canada'),
('303', 'Lombard St', 'Halifax', 'NS', 'B3J 3A1', 'Canada'),
('404', 'St. Laurent Blvd', 'Montreal', 'QC', 'H2W 1Y6', 'Canada'),
('606', 'Broadway Ave', 'Winnipeg', 'MB', 'R3C 0N1', 'Canada'),
('707', 'Whyte Ave', 'Edmonton', 'AB', 'T6E 1Z9', 'Canada');

INSERT INTO insurance (policy_number, provider, coverage, yearly_cost) VALUES
('POL24680', 'Desjardins', 'Full Coverage', 2500.00), 
('POL12345', 'Intact Insurance', 'Full Coverage', 2000.00),
('POL67890', 'Aviva Canada', 'Liability Coverage', 1200.00),
('POL54321', 'The Co-operators', 'Collision Coverage', 1800.00),
('POL09876', 'State Farm', 'Comprehensive Coverage', 1000.00),
('POL13579', 'Allstate Canada', 'Basic Coverage', 990.00),
('POL11223', 'Travelers Canada', 'Collision Coverage', 1250.00),
('POL77889', 'Economical Insurance', 'Basic Coverage', 850.00);


INSERT INTO vehicle(make, model, year, mileage, location_id, valued_at, policy_number, service_required) VALUES 
('Toyota', 'Camry', 2020, 15000, 1, 25000.00, 'POL12345', FALSE),
('Honda', 'Civic', 2019, 22000, 2, 23000.00, 'POL24680', FALSE),
('Ford', 'F-150', 2021, 10000, 9, 35000.00, 'POL13579', FALSE),
('Chevrolet', 'Malibu', 2022, 5000, 1, 27000.00, 'POL54321', FALSE),
('Nissan', 'Rogue', 2021, 12000, 5, 28000.00, 'POL67890', FALSE),
('Hyundai', 'Elantra', 2018, 30000, 6, 18000.00, 'POL67890', FALSE),
('Volkswagen', 'Jetta', 2020, 18000, 7, 24000.00, 'POL77889', FALSE),
('Subaru', 'Outback', 2019, 15000, 6, 29000.00, 'POL09876', FALSE),
('Kia', 'Soul', 2021, 9000, 3, 22000.00, 'POL09876', FALSE),
('Mazda', 'CX-5', 2020, 20000, 10, 30000.00, 'POL12345', FALSE);

INSERT INTO employee (name, salary, location_id) VALUES
('Alice Johnson', 70000, 1),
('Bob Smith', 65000, 2),
('Carol Williams', 82000, 3),
('David Brown', 68000, 4),
('Eva Davis', 71000, 5),
('Frank Wilson', 76000, 6),
('Grace Taylor', 79000, 7),
('Henry Clark', 80000, 8),
('Ivy Lewis', 110000, 9),
('Jack White', 91000, 10);


INSERT INTO customer (name, email, phone_number) VALUES 
('John Doe', 'johndoe@example.com', '705-555-1234'),
('Jane Smith', 'janesmith@example.com', '705-555-5678'),
('Robert Brown', 'robertbrown@example.com', '249-555-8765'),
('Emily Davis', 'emilydavis@example.com', '249-555-4321'),
('Michael Wilson', 'michaelwilson@example.com', '789-555-6789'),
('Jessica Lee', 'jessicalee@example.com', '123-555-9876'),
('David Thompson', 'davidthompson@example.com', '678-555-2468'),
('Sarah Johnson', 'sarahjohnson@example.com', '235-555-1357'),
('Christopher White', 'christopherwhite@example.com', '763-555-3579'),
('Angela Garcia', 'angelagarcia@example.com', '351-555-4826');

-- Must use a procdure to insert into reservation. This ensures that there's no reservation with overlapping dates.
-- total_cost is set to NULL. There is a trigger that automatically sets the total_cost after the insert based on the vehicle cost

-- Declare the variable for the output message
SET @result = '';
CALL insert_reservation(1, 1, 1, '2024-11-01', '2024-11-05', @result); 
SELECT @result;  -- Check the result message
SET @result = '';
CALL insert_reservation(5, 2, 1, '2024-11-03', '2024-11-10', @result);
SELECT @result;  -- Check the result message
SET @result = '';
CALL insert_reservation(4, 3, 2, '2024-11-12', '2024-11-15', @result);
SELECT @result;  -- Check the result message
SET @result = '';
CALL insert_reservation(9, 4, 4, '2024-11-07', '2024-11-09', @result);
SELECT @result;  -- Check the result message
SET @result = '';
CALL insert_reservation(6, 5, 3, '2024-11-20', '2024-11-25', @result);
SELECT @result;  -- Check the result message


-- To insert into payments
-- Insert payment records ensuring the payment date is before the start date
INSERT INTO payment (reservation_id, amount, payment_date, payment_method, status) VALUES 
(2, 500.00, '2024-10-01', 'Credit Card', 'Completed'),  -- Reservation 2
(3, 980.00, '2024-10-02', 'Debit Card', 'Completed'),   -- Reservation 3
(4, 405.00, '2024-10-03', 'PayPal', 'Completed'),       -- Reservation 4
(5, 220.00, '2024-10-04', 'Cash', 'Completed');         -- Reservation 5



INSERT INTO incident (reservation_id, date, description) VALUES
(6, '2024-11-22', 'Crashed into a pole.');

-- We can see that the vehicle_id (6) has service required now set to True.
select * from vehicle;





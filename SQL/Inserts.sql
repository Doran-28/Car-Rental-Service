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



INSERT INTO location (street_number, street_name, city, province, postal_code, country) VALUES 
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
INSERT INTO location (street_number, street_name, city, province, postal_code, country) VALUES 
('878', 'Wellington St', 'Ottawa', 'ON', 'K1A 0B1', 'Canada'),
('999', 'Yonge St', 'Toronto', 'ON', 'M5S 2A3', 'Canada'),
('1001', 'Robie St', 'Halifax', 'NS', 'B3H 3J1', 'Canada'),
('1102', 'Mount Royal Ave', 'Montreal', 'QC', 'H2V 3S8', 'Canada'),
('1203', 'Glenmore Rd', 'Kelowna', 'BC', 'V1V 2Z7', 'Canada'),
('1304', 'Kingston Rd', 'Scarborough', 'ON', 'M1N 1W5', 'Canada'),
('1405', 'Dundas St', 'Hamilton', 'ON', 'L8P 1A2', 'Canada'),
('1506', 'Steeles Ave', 'Markham', 'ON', 'L3R 1E7', 'Canada'),
('1607', 'Main St E', 'Hamilton', 'ON', 'L8M 1H2', 'Canada'),
('1708', 'St. George St', 'Vancouver', 'BC', 'V6A 1Z1', 'Canada');


SHOW TABLE STATUS LIKE 'location';
ALTER TABLE location AUTO_INCREMENT = 21;
select * from location;



INSERT INTO insurance (policy_number, provider, coverage, yearly_cost) VALUES
('POL24680', 'Desjardins', 'Full Coverage', 2500.00), 
('POL12345', 'Intact Insurance', 'Full Coverage', 2000.00),
('POL67890', 'Aviva Canada', 'Liability Coverage', 1200.00),
('POL54321', 'The Co-operators', 'Collision Coverage', 1800.00),
('POL09876', 'State Farm', 'Comprehensive Coverage', 1000.00),
('POL13579', 'Allstate Canada', 'Basic Coverage', 990.00),
('POL11223', 'Travelers Canada', 'Collision Coverage', 1250.00),
('POL77889', 'Economical Insurance', 'Basic Coverage', 850.00);
INSERT INTO insurance (policy_number, provider, coverage, yearly_cost) VALUES
('POL24681', 'Desjardins', 'Liability Coverage', 2200.00),
('POL12346', 'Intact Insurance', 'Comprehensive Coverage', 1100.00),
('POL67891', 'Aviva Canada', 'Collision Coverage', 1500.00),
('POL54322', 'The Co-operators', 'All-Risk Coverage', 2600.00),
('POL09877', 'State Farm', 'Personal Injury Coverage', 1700.00),
('POL13580', 'Allstate Canada', 'Third-Party Liability', 800.00),
('POL11224', 'Travelers Canada', 'Uninsured Motorist Coverage', 950.00),
('POL77890', 'Economical Insurance', 'Accident Forgiveness', 1350.00),
('POL98766', 'Desjardins', 'Collision Coverage', 1600.00),
('POL45679', 'Intact Insurance', 'Comprehensive Coverage', 2400.00),
('POL24682', 'Aviva Canada', 'Loss of Use Coverage', 750.00),
('POL11235', 'The Co-operators', 'Fire & Theft Coverage', 950.00);

select * from insurance;


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
INSERT INTO vehicle(make, model, year, mileage, location_id, valued_at, policy_number, service_required) VALUES
('BMW', 'X5', 2022, 8000, 2, 55000.00, 'POL24681', FALSE),
('Audi', 'A4', 2021, 12000, 3, 40000.00, 'POL11224', FALSE),
('Mercedes-Benz', 'C-Class', 2020, 15000, 4, 45000.00, 'POL54322', FALSE),
('Tesla', 'Model 3', 2023, 2000, 8, 50000.00, 'POL98766', FALSE),
('Chevrolet', 'Equinox', 2021, 10000, 5, 35000.00, 'POL13579', FALSE),
('Jeep', 'Wrangler', 2019, 25000, 7, 32000.00, 'POL11235', FALSE),
('Ford', 'Explorer', 2021, 9000, 10, 37000.00, 'POL24682', FALSE),
('Toyota', 'Highlander', 2020, 18000, 6, 42000.00, 'POL54321', FALSE),
('Honda', 'CR-V', 2022, 6000, 2, 33000.00, 'POL77889', FALSE),
('Hyundai', 'Santa Fe', 2021, 13000, 9, 34000.00, 'POL45679', FALSE);

select * from vehicle;


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
-- Modified table where we transformed name into first_name and last_name
INSERT INTO employee (first_name, last_name, salary, location_id) VALUES
('Kimberly', 'Moore', 74000, 2),
('Liam', 'Harris', 72000, 13),
('Mia', 'Walker', 85000, 18),
('Noah', 'Martinez', 88000, 11),
('Olivia', 'Robinson', 93000, 6),
('Parker', 'Lee', 95000, 12),
('Quinn', 'King', 77000, 15),
('Rachel', 'Scott', 89000, 19),
('Samuel', 'Adams', 96000, 10),
('Tessa', 'Baker', 85000, 1);

SHOW TABLE STATUS LIKE 'employee';
select * from employee;


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
-- Modified table where we transformed name into first_name and last_name
INSERT INTO customer (first_name, last_name, email, phone_number) VALUES
('Sophia', 'Martinez', 'sophiamartinez@example.com', '705-555-1456'),
('Ethan', 'Miller', 'ethanmiller@example.com', '705-555-2356'),
('Ava', 'Davis', 'avadavis@example.com', '249-555-3645'),
('Lucas', 'Garcia', 'lucasgarcia@example.com', '249-555-4567'),
('Isabella', 'Lopez', 'isabellalopez@example.com', '789-555-5689'),
('James', 'Hernandez', 'jameshernandez@example.com', '123-555-6790'),
('Charlotte', 'Gonzalez', 'charlottegonzalez@example.com', '678-555-7812'),
('Benjamin', 'Martinez', 'benjaminmartinez@example.com', '235-555-8923'),
('Amelia', 'Perez', 'ameliaperez@example.com', '763-555-9034'),
('Henry', 'Roberts', 'henryroberts@example.com', '351-555-0145');

SHOW TABLE STATUS LIKE 'customer';
select * from customer;

-- Must use a procdure to insert into reservation. This ensures that there's no reservation with overlapping dates.
-- total_cost is set to NULL. There is a trigger that automatically sets the total_cost after the insert based on the vehicle cost

-- Declare the variable for the output message 
-- (vehicle_id, customer_id, employee_id, start_date, end_date)
CALL insert_reservation(2, 19, 5, '2024-8-21', '2024-8-25', @result);
CALL insert_reservation(1, 1, 1, '2024-11-01', '2024-11-05', @result); 
CALL insert_reservation(5, 2, 1, '2024-11-03', '2024-11-10', @result);
CALL insert_reservation(4, 3, 2, '2024-11-12', '2024-11-15', @result);
CALL insert_reservation(9, 4, 4, '2024-11-07', '2024-11-09', @result);
CALL insert_reservation(6, 5, 3, '2024-11-20', '2024-11-25', @result);
CALL insert_reservation(6, 6, 8, '2024-12-20', '2024-12-25', @result);
CALL insert_reservation(6, 6, 8, '2024-12-20', '2024-12-25', @result);
CALL insert_reservation(11, 12, 3, '2024-10-20', '2024-10-25', @result);
CALL insert_reservation(14, 9, 5, '2023-9-20', '2023-9-25', @result);
CALL insert_reservation(2, 7, 10, '2024-11-02', '2024-11-06', @result);
CALL insert_reservation(3, 8, 11, '2024-11-04', '2024-11-08', @result);
CALL insert_reservation(1, 9, 12, '2024-11-05', '2024-11-09', @result);
CALL insert_reservation(8, 10, 13, '2024-11-10', '2024-11-14', @result);
CALL insert_reservation(5, 11, 14, '2024-11-15', '2024-11-19', @result);
CALL insert_reservation(12, 13, 15, '2024-11-16', '2024-11-20', @result);
CALL insert_reservation(7, 14, 16, '2024-11-17', '2024-11-21', @result);
CALL insert_reservation(13, 15, 17, '2024-11-18', '2024-11-22', @result);
CALL insert_reservation(10, 16, 18, '2024-11-19', '2024-11-23', @result);
CALL insert_reservation(11, 17, 19, '2024-11-20', '2024-11-24', @result);
CALL insert_reservation(14, 18, 20, '2024-11-21', '2024-11-25', @result);

SHOW TABLE STATUS LIKE 'reservation';
ALTER TABLE reservation AUTO_INCREMENT = 1;
select * from reservation;

-- Insert into feedback. Must be done using insert_feedback() PROC
CALL insert_feedback(7, "Overall good expierance.", 8, @result);
CALL insert_feedback(2, "Very satisfied with the service!", 9, @result);
CALL insert_feedback(3, "Good experience overall, minor issues.", 7, @result);
CALL insert_feedback(1, "Perfect experience, exceeded expectations!", 10, @result);
CALL insert_feedback(4, "Service was average, could improve.", 5, @result);
CALL insert_feedback(5, "Highly satisfied, will use again!", 8, @result);
CALL insert_feedback(6, "It was okay, room for improvement.", 6, @result);
CALL insert_feedback(8, "Not great, but manageable.", 4, @result);
CALL insert_feedback(9, "Good experience, but a few issues.", 7, @result);
CALL insert_feedback(10, "Disappointed, would not recommend.", 3, @result);
CALL insert_feedback(11, "Quite good, but not perfect.", 7, @result);
CALL insert_feedback(12, "Service was acceptable, nothing special.", 6, @result);
CALL insert_feedback(13, "Very happy with everything!", 9, @result);
CALL insert_feedback(14, "Great service, will recommend.", 8, @result);
CALL insert_feedback(15, "Mediocre experience, needs improvement.", 5, @result);
CALL insert_feedback(16, "Excellent, almost perfect!", 9, @result);
CALL insert_feedback(17, "Could be better, a bit disappointing.", 4, @result);
CALL insert_feedback(18, "Fantastic service, highly satisfied!", 10, @result);
CALL insert_feedback(19, "Pretty good overall!", 8, @result);
CALL insert_feedback(20, "Met expectations, nothing extraordinary.", 7, @result);

select * from feedback;

-- To insert into payments
-- Insert payment records ensuring the payment date is before the start date
INSERT INTO payment (reservation_id, amount, payment_date, payment_method, status) VALUES 
(2, 500.00, '2024-10-01', 'Credit Card', 'Completed'),  -- Reservation 2
(3, 980.00, '2024-10-02', 'Debit Card', 'Completed'),   -- Reservation 3
(4, 405.00, '2024-10-03', 'PayPal', 'Completed'),       -- Reservation 4
(5, 220.00, '2024-10-04', 'Cash', 'Completed');         -- Reservation 5
INSERT INTO payment (reservation_id, amount, payment_date, payment_method, status) VALUES 
(1, 460.00, '2024-10-01', 'Credit Card', 'Completed'), 
(6, 450.00, '2024-10-05', 'Credit Card', 'Completed'),
(7, 450.00, '2024-10-06', 'Debit Card', 'Completed'),
(8, 1375.00, '2024-10-07', 'PayPal', 'Completed'),
(9, 1250.00, '2024-10-08', 'Credit Card', 'Completed'),
(10, 460.00, '2024-10-09', 'Cash', 'Completed'),
(11, 700.00, '2024-10-10', 'Credit Card', 'Completed'),
(12, 500.00, '2024-10-11', 'Debit Card', 'Completed'),
(13, 580.00, '2024-10-12', 'PayPal', 'Completed'),
(14, 560.00, '2024-10-13', 'Credit Card', 'Completed'),
(15, 800.00, '2024-10-14', 'Cash', 'Completed'),
(16, 480.00, '2024-10-15', 'Credit Card', 'Completed'),
(17, 900.00, '2024-10-16', 'Debit Card', 'Completed'),
(18, 600.00, '2024-10-17', 'PayPal', 'Completed'),
(19, 1100.00, '2024-10-18', 'Credit Card', 'Completed'),
(20, 1000.00, '2024-10-19', 'Cash', 'Completed');

select * from payment;

-- Inserts will flip vehicle.service_required to 1.
INSERT INTO incident (reservation_id, date, description) VALUES
(6, '2024-11-22', 'Crashed into a pole.'),
(14, '2024-11-22', 'Head on collision on highway.'),
(12, '2024-11-17', 'Lost control of car, and car got ditched.'),
(9, '2024-11-08', 'Hit a deer.'),
(5, '2024-11-05', 'Got side swiped.');

select * from incident;

INSERT INTO vehicle_service(vehicle_id, service_company, mechanic_name, repair_cost, repair_date, category, repair_desc) VALUES
(1, 'NAPA', "Paul", 300.00, '2024-11-24', 'Body', 'Undented car siding, and inspected damaged area.'),
(5, 'AutoZone', 'Mike', 450.00, '2024-11-05', 'Body', 'Replaced side panel after being sideswiped.'),
(6, 'Midas', 'Jane', 700.00, '2024-11-22', 'Mechanical', 'Repaired damage from crashing into a pole.'),
(9, 'Canadian Tire', 'Tom', 1200.00, '2024-11-08', 'Body', 'Fixed front end after hitting a deer.'),
(14, 'Goodyear', 'Anna', 2000.00, '2024-11-22', 'Body', 'Repaired head-on collision damage on the highway.');

select * from vehicle_service;





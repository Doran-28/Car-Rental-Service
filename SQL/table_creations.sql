-- Customers Table
CREATE TABLE DatabaseProject.customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    phone_number VARCHAR(15)
);

-- Locations Table
CREATE TABLE DatabaseProject.location (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    street_number VARCHAR(10),
    street_name VARCHAR(100),
    city VARCHAR(50),
    state_province VARCHAR(50),
    postal_code VARCHAR(10),
    country VARCHAR(50)
);

-- Insurance Table
CREATE TABLE DatabaseProject.insurance (
    policy_number VARCHAR(50) PRIMARY KEY,
    provider VARCHAR(100),
    coverage DECIMAL(10, 2),
    cost DECIMAL(10, 2)
);

-- Vehicle Table
CREATE TABLE DatabaseProject.vehicle (
    vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(50),
    model VARCHAR(50),
    year INT,
    mileage INT,
    location_id INT,
    valued_at DECIMAL(10, 2),
    policy_number VARCHAR(50),
    service_required BOOLEAN,
    FOREIGN KEY (location_id) REFERENCES location(location_id),
    FOREIGN KEY (policy_number) REFERENCES insurance(policy_number)
);

-- Employee Table
CREATE TABLE DatabaseProject.employee (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    salary DECIMAL(10, 2),
    location_id INT,
    FOREIGN KEY (location_id) REFERENCES location(location_id)
);

-- Reservation Table
-- total_cost value will have to be modified using a trigger
CREATE TABLE DatabaseProject.reservation (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT,
    customer_id INT,
    employee_id INT,
    start_date DATE,
    end_date DATE,
    total_cost DECIMAL(10,2),
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(vehicle_id),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
);

-- Incident Table
CREATE TABLE DatabaseProject.incident (
    incident_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    date DATE,
    description TEXT,
    FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id)
);

-- Vehicle Service Table
CREATE TABLE DatabaseProject.vehicle_service (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT,
    service_company VARCHAR(100),
    mechanic_name VARCHAR(100),
    repair_cost DECIMAL(10, 2),
    repair_date DATE,
    category VARCHAR(50),
    repair_desc TEXT,
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(vehicle_id)
);

-- Feedback Table
CREATE TABLE DatabaseProject.feedback (
    reservation_id INT PRIMARY KEY,
    description TEXT,
    rating INT CHECK (rating BETWEEN 1 AND 10),
    FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id)
);

-- Payment Table
CREATE TABLE DatabaseProject.payment (
    reservation_id INT PRIMARY KEY,
    amount DECIMAL(10, 2),
    payment_date DATE,
    payment_method VARCHAR(50),
    status VARCHAR(50),
    FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id)
);








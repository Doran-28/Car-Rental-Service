
-- Change the name of state_province to just province in location
ALTER TABLE location 
CHANGE state_province province VARCHAR(50);


-- Change the name column into first_name and last_name
ALTER TABLE customer
ADD COLUMN first_name VARCHAR(50),
ADD COLUMN last_name VARCHAR(50);

-- Set frist_name and last_name from the name column 
SET SQL_SAFE_UPDATES = 0;
UPDATE customer
SET 
    first_name = SUBSTRING_INDEX(name, ' ', 1),
    last_name = SUBSTRING_INDEX(name, ' ', -1);
SET SQL_SAFE_UPDATES = 1;

-- Reorder the columns so the names are in the column after customer_id
ALTER TABLE customer
MODIFY COLUMN first_name VARCHAR(50) AFTER customer_id,
MODIFY COLUMN last_name VARCHAR(50) AFTER first_name;

-- Delete the name column
ALTER TABLE customer
DROP COLUMN name;

-- -------------------DO SAME THING WITH EMPLOYEE TABLE----------------------

-- Change the name column into first_name and last_name
ALTER TABLE employee
ADD COLUMN first_name VARCHAR(50),
ADD COLUMN last_name VARCHAR(50);

-- Set frist_name and last_name from the name column 
SET SQL_SAFE_UPDATES = 0;
UPDATE employee
SET 
    first_name = SUBSTRING_INDEX(name, ' ', 1),
    last_name = SUBSTRING_INDEX(name, ' ', -1);
SET SQL_SAFE_UPDATES = 1;

-- Reorder the columns so the names are in the column after customer_id
ALTER TABLE employee
MODIFY COLUMN first_name VARCHAR(50) AFTER employee_id,
MODIFY COLUMN last_name VARCHAR(50) AFTER first_name;

-- Delete the name column
ALTER TABLE employee
DROP COLUMN name;

select * from employee;

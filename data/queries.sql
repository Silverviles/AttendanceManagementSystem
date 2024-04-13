CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    contact_no CHAR(10) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    account_type ENUM('admin', 'lecturer', 'student') DEFAULT 'student' NOT NULL
);

INSERT INTO users (username, password, first_name, last_name, email, contact_no, account_type)
VALUES
('student1', 'password1', 'John', 'Doe', 'john.doe@example.com', '1234567890', 'student'),
('student2', 'password2', 'Jane', 'Smith', 'jane.smith@example.com', '2345678901', 'student'),
('student3', 'password3', 'Bob', 'Johnson', 'bob.johnson@example.com', '3456789012', 'student'),
('student4', 'password4', 'Alice', 'Williams', 'alice.williams@example.com', '4567890123', 'student'),
('student5', 'password5', 'Charlie', 'Brown', 'charlie.brown@example.com', '5678901234', 'student'),
('student6', 'password6', 'Emma', 'Davis', 'emma.davis@example.com', '6789012345', 'student'),
('student7', 'password7', 'Frank', 'Miller', 'frank.miller@example.com', '7890123456', 'student'),
('student8', 'password8', 'Grace', 'Wilson', 'grace.wilson@example.com', '8901234567', 'student'),
('student9', 'password9', 'Henry', 'Moore', 'henry.moore@example.com', '9012345678', 'student'),
('student10', 'password10', 'Ivy', 'Taylor', 'ivy.taylor@example.com', '0123456789', 'student'),
('lecturer1', 'password6', 'Emma', 'Watson', 'emma.watson@example.com', '6789012341', 'lecturer'),
('lecturer2', 'password7', 'Frank', 'Miller', 'frank.miller_lecturer@example.com', '7890123451', 'lecturer'),
('lecturer3', 'password8', 'Grace', 'Wilson', 'grace.wilson_lecturer@example.com', '8901234561', 'lecturer'),
('lecturer4', 'password9', 'Henry', 'Moore', 'henry.moore_lecturer@example.com', '9012345671', 'lecturer'),
('lecturer5', 'password10', 'Ivy', 'Taylor', 'ivy.taylor_lecturer@example.com', '0123456781', 'lecturer'),
('lecturer6', 'password11', 'Jack', 'Smith', 'jack.smith_lecturer@example.com', '1234567891', 'lecturer'),
('lecturer7', 'password12', 'Linda', 'Jones', 'linda.jones_lecturer@example.com', '2345678902', 'lecturer'),
('lecturer8', 'password13', 'Michael', 'Davis', 'michael.davis_lecturer@example.com', '3456789013', 'lecturer'),
('lecturer9', 'password14', 'Nancy', 'Brown', 'nancy.brown_lecturer@example.com', '4567890124', 'lecturer'),
('lecturer10', 'password15', 'Oliver', 'Johnson', 'oliver.johnson_lecturer@example.com', '5678901235', 'lecturer'),
('admin', 'admin', 'Oliver', 'Johnson', 'oliver.johnson_admin@example.com', '1111111111', 'admin');


#Add foreign key later
CREATE TABLE IF NOT EXISTS faculty (
	faculty_id CHAR(2) PRIMARY KEY,
	faculty_name VARCHAR(100) NOT NULL UNIQUE,
    faculty_head int NOT NULL 
);

INSERT INTO faculty (faculty_id, faculty_name, faculty_head)
VALUES
('CS', 'Computer Science', 11),
('IT', 'Information Technology', 12),
('EE', 'Electrical Engineering', 13),
('ME', 'Mechanical Engineering', 14),
('CE', 'Civil Engineering', 15);

-- Create the lecturer table
CREATE TABLE IF NOT EXISTS lecturer (
    user_id INT PRIMARY KEY,
    lecturer_id CHAR(10) NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL,
    CONSTRAINT fk_lecturer_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE, 
    CONSTRAINT fk_lecturer_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id) ON DELETE CASCADE
);

INSERT INTO lecturer (user_id, lecturer_id, faculty)
VALUES
(11, 'LEC123456', 'CS'),
(12, 'LEC234567', 'IT'),
(13, 'LEC345678', 'EE'),
(14, 'LEC456789', 'ME'),
(15, 'LEC567890', 'CE'),
(16, 'LEC678901', 'CS'),
(17, 'LEC789012', 'IT'),
(18, 'LEC890123', 'EE'),
(19, 'LEC901234', 'ME'),
(20, 'LEC012345', 'CE');

-- Add foreign key constraint to the faculty_head in the faculty table
ALTER TABLE faculty
ADD CONSTRAINT fk_faculty_head
FOREIGN KEY (faculty_head) REFERENCES lecturer(user_id) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS degree (
	degree_id CHAR(5) PRIMARY KEY,
    degree_name VARCHAR(100) NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL,
    CONSTRAINT fk_degree_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id) ON DELETE CASCADE
);

INSERT INTO degree (degree_id, degree_name, faculty) VALUES
('D001', 'Bachelor of Computer Science', 'CS'),
('D002', 'Bachelor of Information Technology', 'IT'),
('D003', 'Bachelor of Engineering', 'EE'),
('D004', 'Bachelor of Multimedia Engineering', 'ME'),
('D005', 'Bachelor of Computer Engineering', 'CE');

CREATE TABLE IF NOT EXISTS student (
	user_id int PRIMARY KEY,
    student_id CHAR(10) NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL,
    degree CHAR(5) NOT NULL,
    batch CHAR(5) NOT NULL,
    CONSTRAINT fk_student_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_student_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id) ON DELETE CASCADE,
    CONSTRAINT fk_student_degree FOREIGN KEY (degree) REFERENCES degree(degree_id) ON DELETE CASCADE
);

-- Add dummy records to student with corresponding user_id
INSERT INTO student (user_id, student_id, faculty, degree, batch)
VALUES
(1, 'ST123456', 'CS', 'D001', '2022'),
(2, 'ST234567', 'IT', 'D005', '2023'),
(3, 'ST345678', 'EE', 'D003', '2021'),
(4, 'ST456789', 'ME', 'D003', '2022'),
(5, 'ST567890', 'CE', 'D002', '2023'),
(6, 'ST678901', 'CS', 'D005', '2022'),
(7, 'ST789012', 'CS', 'D004', '2021'),
(8, 'ST890123', 'CE', 'D001', '2022'),
(9, 'ST901234', 'IT', 'D003', '2023'),
(10, 'ST012345', 'EE', 'D002', '2021');

CREATE TABLE IF NOT EXISTS module (
	module_code CHAR(8) PRIMARY KEY,
    module_name VARCHAR(100) NOT NULL UNIQUE,
    module_owner INT NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL,
    degree CHAR(5) NOT NULL,
    CONSTRAINT fk_module_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id) ON DELETE CASCADE,
    CONSTRAINT fk_module_degree FOREIGN KEY (degree) REFERENCES degree(degree_id) ON DELETE CASCADE,
    CONSTRAINT fk_module_module_owner FOREIGN KEY (module_owner) REFERENCES lecturer(user_id) ON DELETE CASCADE
);

-- Insert dummy records into the module table
INSERT INTO module(module_code, module_name, module_owner, faculty, degree) VALUES
('M001', 'Introduction to Programming', 11, 'CS', 'D001'),
('M002', 'Database Management', 12, 'IT', 'D002'),
('M003', 'Digital Circuits', 13, 'EE', 'D003'),
('M004', 'Multimedia Design', 14, 'ME', 'D004'),
('M005', 'Computer Networks', 16, 'CE', 'D005'),
('M006', 'Software Engineering', 17, 'CS', 'D001'),
('M007', 'Web Development', 18, 'IT', 'D002'),
('M008', 'Control Systems', 19, 'EE', 'D003'),
('M009', 'Robotics', 20, 'ME', 'D004'),
('M010', 'Embedded Systems', 15, 'CE', 'D005');

CREATE TABLE IF NOT EXISTS student_to_module (
    student_id CHAR(10) NOT NULL,
    module_code CHAR(8) NOT NULL,
    faculty CHAR(2) NOT NULL,
    degree CHAR(5) NOT NULL,
    CONSTRAINT pk_student_to_module PRIMARY KEY (student_id, module_code),
    CONSTRAINT fk_student_to_module_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id) ON DELETE CASCADE,
    CONSTRAINT fk_student_to_module_degree FOREIGN KEY (degree) REFERENCES degree(degree_id) ON DELETE CASCADE
);

-- Insert dummy data into the student_to_module table based on student-module relationships
INSERT INTO student_to_module (student_id, module_code, faculty, degree) VALUES
('ST123456', 'M001', 'CS', 'D001'),
('ST234567', 'M002', 'IT', 'D005'),
('ST345678', 'M003', 'EE', 'D003'),
('ST456789', 'M004', 'ME', 'D003'),
('ST567890', 'M005', 'CE', 'D002'),
('ST678901', 'M006', 'CS', 'D005'),
('ST789012', 'M007', 'CS', 'D004'),
('ST890123', 'M008', 'CE', 'D001'),
('ST901234', 'M009', 'IT', 'D003'),
('ST012345', 'M010', 'EE', 'D002'),
('ST123456', 'M002', 'CS', 'D001'),
('ST234567', 'M003', 'IT', 'D002'),
('ST345678', 'M004', 'EE', 'D003'),
('ST456789', 'M005', 'ME', 'D004'),
('ST567890', 'M006', 'CE', 'D005'),
('ST678901', 'M007', 'CS', 'D001'),
('ST789012', 'M008', 'IT', 'D002'),
('ST890123', 'M009', 'EE', 'D003'),
('ST901234', 'M010', 'ME', 'D004'),
('ST012345', 'M001', 'CE', 'D005');


DELIMITER //

CREATE PROCEDURE InsertUserAndLecturer(
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_first_name VARCHAR(100),
    IN p_last_name VARCHAR(100),
    IN p_email VARCHAR(255),
    IN p_contact_no CHAR(10),
    IN p_account_type ENUM('admin', 'lecturer', 'student'),
    IN p_lecturer_id CHAR(10),
    IN p_faculty CHAR(2)
)
BEGIN
    -- Declare a variable to store the auto-incremented user_id
    DECLARE user_id INT;

    -- Start a transaction to ensure data consistency
    START TRANSACTION;

    -- Insert a new user
    INSERT INTO users (username, password, first_name, last_name, email, contact_no, account_type)
    VALUES (p_username, p_password, p_first_name, p_last_name, p_email, p_contact_no, p_account_type);

    -- Retrieve the auto-incremented user_id for the new user
    SELECT LAST_INSERT_ID() INTO user_id;

    -- Check if the account type is lecturer and insert into the lecturer table accordingly
    IF p_account_type = 'lecturer' THEN
        -- Insert into the lecturer table
        INSERT INTO lecturer (user_id, lecturer_id, faculty)
        VALUES (user_id, p_lecturer_id, p_faculty);
    END IF;

    -- Commit the transaction
    COMMIT;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE InsertOrUpdateUserAndStudent(
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_first_name VARCHAR(100),
    IN p_last_name VARCHAR(100),
    IN p_email VARCHAR(255),
    IN p_contact_no CHAR(10),
    IN p_account_type ENUM('admin', 'lecturer', 'student'),
    IN p_student_id CHAR(10),
    IN p_faculty CHAR(2),
    IN p_degree CHAR(5),
    IN p_batch CHAR(5)
)
BEGIN
    -- Declare a variable to store the auto-incremented user_id
    DECLARE user_id INT;

    -- Start a transaction to ensure data consistency
    START TRANSACTION;

    -- Insert or update the user based on the account type
    IF p_account_type = 'student' THEN
        -- Check if the student record already exists
        IF EXISTS (SELECT 1 FROM student WHERE student_id = p_student_id) THEN
            -- Update existing student record
            UPDATE student
            SET
                faculty = p_faculty,
                degree = p_degree,
                batch = p_batch
            WHERE student_id = p_student_id;
        ELSE
            -- Insert new student record
            INSERT INTO users (username, password, first_name, last_name, email, contact_no, account_type)
            VALUES (p_username, p_password, p_first_name, p_last_name, p_email, p_contact_no, p_account_type);

            -- Retrieve the auto-incremented user_id for the new user
            SELECT LAST_INSERT_ID() INTO user_id;

            -- Insert into the student table
            INSERT INTO student (user_id, student_id, faculty, degree, batch)
            VALUES (user_id, p_student_id, p_faculty, p_degree, p_batch);
        END IF;
    END IF;

    -- Commit the transaction
    COMMIT;
END //

DELIMITER ;

CREATE TABLE IF NOT EXISTS classes (
    duration TIME NOT NULL,
    locations VARCHAR(20) NOT NULL,
    module CHAR(8) NOT NULL,
    lecturer CHAR(10) NOT NULL,
    batch CHAR(8) NOT NULL,
    date DATETIME NOT NULL,
    FOREIGN KEY (module) REFERENCES module(module_code) ON DELETE CASCADE,
    FOREIGN KEY (lecturer) REFERENCES lecturer(lecturer_id) ON DELETE CASCADE
);

INSERT INTO classes (duration, locations, module, lecturer, batch, date) 
VALUES 
(TIME('01:00:00'), 'Room A', 'M001', 'LEC123456', 'B2022A01', '2024-02-04 08:00:00'),
(TIME('02:00:00'), 'Room B', 'M002', 'LEC234567', 'B2023B02', '2024-02-05 10:00:00');

CREATE TABLE IF NOT EXISTS otp_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    duration VARCHAR(20) NOT NULL,
    locations VARCHAR(20) NOT NULL,
    module CHAR(8) NOT NULL,
    lecturer CHAR(10) NOT NULL,
    batch CHAR(8) NOT NULL,
    date DATETIME NOT NULL,
    otp INT NOT NULL,
    expiration DATETIME NOT NULL,
    FOREIGN KEY (module) REFERENCES module(module_code) ON DELETE CASCADE
);

SET GLOBAL event_scheduler = ON;

DELIMITER //
CREATE PROCEDURE delete_expired_records()
BEGIN
    DELETE FROM otp_table WHERE expiration <= NOW();
END //
DELIMITER ;

DELIMITER //
CREATE EVENT delete_expired_records_event
ON SCHEDULE EVERY 1 HOUR
DO
BEGIN
    CALL delete_expired_records();
END;
DELIMITER ;

CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    student_id CHAR(10) NOT NULL,
    otp VARCHAR(4) NOT NULL,
    module_code CHAR(8),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE CASCADE,
    FOREIGN KEY (module_code) REFERENCES module(module_code) ON DELETE CASCADE
); 
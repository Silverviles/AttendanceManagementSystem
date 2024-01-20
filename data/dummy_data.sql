-- Add 20 dummy records to users
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
('student10', 'password10', 'Ivy', 'Taylor', 'ivy.taylor@example.com', '0123456789', 'student');
('lecturer1', 'password6', 'Emma', 'Davis', 'emma.davis@example.com', '6789012345', 'lecturer'),
('lecturer2', 'password7', 'Frank', 'Miller', 'frank.miller@example.com', '7890123456', 'lecturer'),
('lecturer3', 'password8', 'Grace', 'Wilson', 'grace.wilson@example.com', '8901234567', 'lecturer'),
('lecturer4', 'password9', 'Henry', 'Moore', 'henry.moore@example.com', '9012345678', 'lecturer'),
('lecturer5', 'password10', 'Ivy', 'Taylor', 'ivy.taylor@example.com', '0123456789', 'lecturer');

INSERT INTO faculty (faculty_id, faculty_name, faculty_head)
VALUES
('CS', 'Computer Science', 1),
('IT', 'Information Technology', 2),
('EE', 'Electrical Engineering', 3),
('ME', 'Mechanical Engineering', 4),
('CE', 'Civil Engineering', 5);

-- Add dummy records to student with corresponding user_id
INSERT INTO student (user_id, student_id, faculty, degree, batch)
VALUES
(1, 'ST123456', 'CS', 'BSCS', '2022'),
(2, 'ST234567', 'IT', 'BSIT', '2023'),
(3, 'ST345678', 'EE', 'BSEE', '2021'),
(4, 'ST456789', 'ME', 'BSME', '2022'),
(5, 'ST567890', 'CE', 'BSCE', '2023'),
(6, 'ST678901', 'CS', 'BSBA', '2022'),
(7, 'ST789012', 'CS', 'BSPH', '2021'),
(8, 'ST890123', 'CE', 'BSCH', '2022'),
(9, 'ST901234', 'IT', 'BSPSY', '2023'),
(10, 'ST012345', 'EE', 'BSECO', '2021');

INSERT INTO lecturer (user_id, lecturer_id, faculty)
VALUES
(LAST_INSERT_ID(), 'LEC123456', 'CS'),
(LAST_INSERT_ID(), 'LEC234567', 'IT'),
(LAST_INSERT_ID(), 'LEC345678', 'EE'),
(LAST_INSERT_ID(), 'LEC456789', 'ME'),
(LAST_INSERT_ID(), 'LEC567890', 'CE');
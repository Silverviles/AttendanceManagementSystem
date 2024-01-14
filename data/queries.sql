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

#Add foreign key later
CREATE TABLE IF NOT EXISTS faculty (
	faculty_id CHAR(2) PRIMARY KEY,
	faculty_name VARCHAR(100) NOT NULL UNIQUE,
    faculty_head int NOT NULL 
);

-- Create the lecturer table
CREATE TABLE IF NOT EXISTS lecturer (
    user_id INT PRIMARY KEY,
    lecturer_id CHAR(10) NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL UNIQUE,
    CONSTRAINT fk_lecturer_user_id FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_lecturer_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id)
);

-- Add foreign key constraint to the faculty_head in the faculty table
ALTER TABLE faculty
ADD CONSTRAINT fk_faculty_head
FOREIGN KEY (faculty_head) REFERENCES lecturer(user_id);

CREATE TABLE IF NOT EXISTS degree (
	degree_id CHAR(5) PRIMARY KEY,
    degree_name VARCHAR(100) NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL,
    CONSTRAINT fk_degree_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id)
);

CREATE TABLE IF NOT EXISTS student (
	user_id int PRIMARY KEY,
    student_id CHAR(10) NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL,
    degree CHAR(5) NOT NULL,
    batch CHAR(5) NOT NULL,
    CONSTRAINT fk_student_user_id FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_student_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id),
    CONSTRAINT fk_student_degree FOREIGN KEY (degree) REFERENCES degree(degree_id)
);

CREATE TABLE IF NOT EXISTS module (
	module_code CHAR(8) PRIMARY KEY,
    module_name VARCHAR(100) NOT NULL UNIQUE,
    module_owner INT NOT NULL UNIQUE,
    faculty CHAR(2) NOT NULL,
    degree CHAR(5) NOT NULL,
    CONSTRAINT fk_module_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id),
    CONSTRAINT fk_module_degree FOREIGN KEY (degree) REFERENCES degree(degree_id)
);

CREATE TABLE IF NOT EXISTS student_to_module (
    student_id CHAR(10) NOT NULL,
    module_code CHAR(8) NOT NULL,
    faculty CHAR(2) NOT NULL,
    degree CHAR(5) NOT NULL,
    CONSTRAINT pk_student_to_module PRIMARY KEY (student_id, module_code),
    CONSTRAINT fk_student_to_module_faculty FOREIGN KEY (faculty) REFERENCES faculty(faculty_id),
    CONSTRAINT fk_student_to_module_degree FOREIGN KEY (degree) REFERENCES degree(degree_id)
);
-- =============================================
-- COMPLETE SQL SCRIPT - INSTRUCTOR EVALUATION SYSTEM
-- =============================================

-- 1. DROP EXISTING TABLES (IF NEEDED)
-- ===================================
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS answers;
DROP TABLE IF EXISTS evaluations;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS questionnaires;
DROP TABLE IF EXISTS instructor_courses;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS instructors;
DROP TABLE IF EXISTS resumes;
DROP TABLE IF EXISTS role_permissions;
DROP TABLE IF EXISTS module_permissions;
DROP TABLE IF EXISTS permissions;
DROP TABLE IF EXISTS modules;
DROP TABLE IF EXISTS profiles;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS courses;
DROP TABLE IF EXISTS specialties;
DROP TABLE IF EXISTS document_types;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS user_statuses;
DROP VIEW IF EXISTS evaluation_reports_view;
DROP VIEW IF EXISTS complete_users_view;
DROP VIEW IF EXISTS complete_instructors_view;
DROP VIEW IF EXISTS role_permissions_view;
DROP VIEW IF EXISTS user_modules_view;
SET FOREIGN_KEY_CHECKS = 1;

-- 2. CREATE BASE TABLES
-- ====================

-- User status table
CREATE TABLE user_statuses (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    allows_access BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Roles table
CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Document types table
CREATE TABLE document_types (
    document_type_id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(10) NOT NULL UNIQUE,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. USER AND PROFILE TABLES
-- ==========================

-- Users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    status_id INT NOT NULL DEFAULT 1,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    failed_attempts INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(role_id),
    FOREIGN KEY (status_id) REFERENCES user_statuses(status_id)
);

-- Profiles table
CREATE TABLE profiles (
    profile_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    document_type_id INT NOT NULL,
    document_number VARCHAR(20) NOT NULL UNIQUE,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    birth_date DATE,
    gender ENUM('male', 'female', 'other', 'prefer_not_to_say'),
    profile_picture VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (document_type_id) REFERENCES document_types(document_type_id)
);

-- 4. SPECIALTY AND COURSE TABLES
-- =============================

-- Specialties table
CREATE TABLE specialties (
    specialty_id INT AUTO_INCREMENT PRIMARY KEY,
    specialty_code VARCHAR(20) NOT NULL UNIQUE,
    specialty_name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(50) NOT NULL UNIQUE,
    program_name VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'inactive', 'completed') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. RESUME AND INSTRUCTOR TABLES
-- ==============================

-- Resumes table
CREATE TABLE resumes (
    resume_id INT AUTO_INCREMENT PRIMARY KEY,
    professional_title VARCHAR(100) NOT NULL,
    is_professional BOOLEAN DEFAULT TRUE,
    years_experience INT DEFAULT 0,
    education_level ENUM('technical', 'technologist', 'professional', 'specialization', 'masters', 'phd') NOT NULL,
    certifications TEXT,
    skills TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Instructors table
CREATE TABLE instructors (
    instructor_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    specialty_id INT NOT NULL,
    resume_id INT NOT NULL,
    hire_date DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (specialty_id) REFERENCES specialties(specialty_id),
    FOREIGN KEY (resume_id) REFERENCES resumes(resume_id)
);

-- 6. STUDENT AND ASSIGNMENT TABLES
-- ===============================

-- Students table
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    course_id INT NOT NULL,
    enrollment_date DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

-- Instructor-course assignments
CREATE TABLE instructor_courses (
    assignment_id INT AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT NOT NULL,
    course_id INT NOT NULL,
    assignment_date DATE NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY (instructor_id, course_id),
    FOREIGN KEY (instructor_id) REFERENCES instructors(instructor_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

-- 7. MODULE AND PERMISSION TABLES
-- ==============================

-- Modules table
CREATE TABLE modules (
    module_id INT AUTO_INCREMENT PRIMARY KEY,
    module_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    icon VARCHAR(50),
    route VARCHAR(100),
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Permissions table
CREATE TABLE permissions (
    permission_id INT AUTO_INCREMENT PRIMARY KEY,
    permission_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    permission_key VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Module-permissions table
CREATE TABLE module_permissions (
    module_permission_id INT AUTO_INCREMENT PRIMARY KEY,
    module_id INT NOT NULL,
    permission_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (module_id) REFERENCES modules(module_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id),
    UNIQUE KEY (module_id, permission_id)
);

-- Role-permissions table
CREATE TABLE role_permissions (
    role_permission_id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    module_permission_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(role_id),
    FOREIGN KEY (module_permission_id) REFERENCES module_permissions(module_permission_id),
    UNIQUE KEY (role_id, module_permission_id)
);

-- 8. EVALUATION TABLES
-- ====================

-- Questionnaires table
CREATE TABLE questionnaires (
    questionnaire_id INT AUTO_INCREMENT PRIMARY KEY,
    questionnaire_name VARCHAR(100) NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Questions table
CREATE TABLE questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    questionnaire_id INT NOT NULL,
    question_text TEXT NOT NULL,
    answer_type ENUM('scale_1to5', 'yes_no', 'open') NOT NULL,
    weight DECIMAL(3,2) DEFAULT 1.00,
    display_order INT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (questionnaire_id) REFERENCES questionnaires(questionnaire_id)
);

-- Evaluations table
CREATE TABLE evaluations (
    evaluation_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    instructor_id INT NOT NULL,
    course_id INT NOT NULL,
    questionnaire_id INT NOT NULL,
    evaluation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_completed BOOLEAN DEFAULT FALSE,
    observations TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (instructor_id) REFERENCES instructors(instructor_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (questionnaire_id) REFERENCES questionnaires(questionnaire_id)
);

-- Answers table
CREATE TABLE answers (
    answer_id INT AUTO_INCREMENT PRIMARY KEY,
    evaluation_id INT NOT NULL,
    question_id INT NOT NULL,
    answer_text TEXT NOT NULL,
    numeric_value DECIMAL(5,2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (evaluation_id) REFERENCES evaluations(evaluation_id),
    FOREIGN KEY (question_id) REFERENCES questions(question_id),
    UNIQUE KEY (evaluation_id, question_id)
);

-- 9. INITIAL DATA INSERTION
-- =========================

-- User statuses
INSERT INTO user_statuses (status_name, description, allows_access) VALUES 
('pending_activation', 'User created but not activated', FALSE),
('active', 'Active user with system access', TRUE),
('inactive', 'Temporarily inactive user', FALSE),
('locked', 'User locked for security reasons', FALSE),
('deleted', 'User marked as deleted', FALSE);

-- Roles
INSERT INTO roles (role_name, description) VALUES 
('admin', 'Full system access'),
('coordinator', 'Manages evaluations and reports'),
('instructor', 'Receives student evaluations'),
('student', 'Evaluates instructors');

-- Document types
INSERT INTO document_types (code, name, description) VALUES 
('CC', 'Citizenship ID', 'National identification document'),
('TI', 'Identity Card', 'For minors'),
('CE', 'Foreigner ID', 'For foreigners'),
('PA', 'Passport', 'International travel document');

-- System modules
INSERT INTO modules (module_name, description, icon, route, display_order) VALUES
('Dashboard', 'System main dashboard', 'dashboard', '/dashboard', 1),
('Users', 'User management', 'people', '/users', 2),
('Roles', 'Role and permission management', 'lock', '/roles', 3),
('Courses', 'Student group management', 'groups', '/courses', 4),
('Instructors', 'Instructor management', 'school', '/instructors', 5),
('Evaluations', 'Evaluation management', 'assignment', '/evaluations', 6),
('Reports', 'Reports and statistics', 'analytics', '/reports', 7);

-- Permissions
INSERT INTO permissions (permission_name, description, permission_key) VALUES
('View', 'Permission to view content', 'read'),
('Create', 'Permission to create records', 'create'),
('Edit', 'Permission to modify records', 'update'),
('Delete', 'Permission to delete records', 'delete'),
('Manage', 'Full module permissions', 'manage');

-- 10. CREATE VIEWS
-- ================

-- Evaluation reports view
CREATE VIEW evaluation_reports_view AS
SELECT 
    c.course_code,
    dt_a.code AS student_doc_type,
    p_a.document_number AS student_doc,
    CONCAT(p_a.first_name, ' ', p_a.last_name) AS student_name,
    dt_i.code AS instructor_doc_type,
    p_i.document_number AS instructor_doc,
    CONCAT(p_i.first_name, ' ', p_i.last_name) AS instructor_name,
    s.specialty_name,
    q.questionnaire_name,
    e.evaluation_date,
    AVG(a.numeric_value) AS average_score,
    COUNT(a.answer_id) AS questions_answered
FROM evaluations e
JOIN students st ON e.student_id = st.student_id
JOIN users u_a ON st.user_id = u_a.user_id
JOIN profiles p_a ON u_a.user_id = p_a.user_id
JOIN document_types dt_a ON p_a.document_type_id = dt_a.document_type_id
JOIN instructors i ON e.instructor_id = i.instructor_id
JOIN users u_i ON i.user_id = u_i.user_id
JOIN profiles p_i ON u_i.user_id = p_i.user_id
JOIN document_types dt_i ON p_i.document_type_id = dt_i.document_type_id
JOIN specialties s ON i.specialty_id = s.specialty_id
JOIN courses c ON e.course_id = c.course_id
JOIN questionnaires q ON e.questionnaire_id = q.questionnaire_id
LEFT JOIN answers a ON e.evaluation_id = a.evaluation_id
GROUP BY e.evaluation_id;

-- Complete users view
CREATE VIEW complete_users_view AS
SELECT 
    u.user_id,
    u.email,
    r.role_name,
    us.status_name,
    us.allows_access,
    p.first_name,
    p.last_name,
    dt.code AS document_type,
    p.document_number,
    CASE 
        WHEN st.user_id IS NOT NULL THEN 'student'
        WHEN i.user_id IS NOT NULL THEN 'instructor'
        ELSE 'administrative'
    END AS user_type,
    c.course_code AS student_course,
    s.specialty_name AS instructor_specialty
FROM users u
JOIN roles r ON u.role_id = r.role_id
JOIN user_statuses us ON u.status_id = us.status_id
JOIN profiles p ON u.user_id = p.user_id
JOIN document_types dt ON p.document_type_id = dt.document_type_id
LEFT JOIN students st ON u.user_id = st.user_id
LEFT JOIN courses c ON st.course_id = c.course_id
LEFT JOIN instructors i ON u.user_id = i.user_id
LEFT JOIN specialties s ON i.specialty_id = s.specialty_id;

-- Complete instructors view
CREATE VIEW complete_instructors_view AS
SELECT 
    i.instructor_id,
    u.email,
    CONCAT(p.first_name, ' ', p.last_name) AS full_name,
    s.specialty_name,
    r.professional_title,
    r.is_professional,
    r.years_experience,
    r.education_level,
    i.hire_date,
    COUNT(ic.course_id) AS assigned_courses
FROM instructors i
JOIN users u ON i.user_id = u.user_id
JOIN profiles p ON u.user_id = p.user_id
JOIN specialties s ON i.specialty_id = s.specialty_id
JOIN resumes r ON i.resume_id = r.resume_id
LEFT JOIN instructor_courses ic ON i.instructor_id = ic.instructor_id
GROUP BY i.instructor_id;

-- Role permissions view
CREATE VIEW role_permissions_view AS
SELECT 
    r.role_id,
    r.role_name,
    m.module_name,
    p.permission_name,
    p.permission_key,
    m.route
FROM roles r
JOIN role_permissions rp ON r.role_id = rp.role_id
JOIN module_permissions mp ON rp.module_permission_id = mp.module_permission_id
JOIN modules m ON mp.module_id = m.module_id
JOIN permissions p ON mp.permission_id = p.permission_id
ORDER BY r.role_id, m.display_order, p.permission_id;

-- User modules view
CREATE VIEW user_modules_view AS
SELECT DISTINCT
    u.user_id,
    m.module_id,
    m.module_name,
    m.icon,
    m.route,
    m.display_order
FROM users u
JOIN role_permissions rp ON u.role_id = rp.role_id
JOIN module_permissions mp ON rp.module_permission_id = mp.module_permission_id
JOIN modules m ON mp.module_id = m.module_id
WHERE m.is_active = TRUE
ORDER BY u.user_id, m.display_order;

-- =============================================
-- END OF SQL SCRIPT
-- =============================================
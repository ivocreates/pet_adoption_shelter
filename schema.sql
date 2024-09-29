-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS pet_adoption_shelter;

-- Use the database
USE pet_adoption_shelter;

-- Create users table (for adopters and admin)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('adopter', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create pets table
CREATE TABLE IF NOT EXISTS pets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    breed VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    health_status VARCHAR(100),
    description TEXT,
    image VARCHAR(255),  -- Path to the image
    adoption_status ENUM('available', 'reserved', 'adopted') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create adoption applications table
CREATE TABLE IF NOT EXISTS adoption_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pet_id INT NOT NULL,
    application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
);

-- Create a table to store volunteer information (optional)
CREATE TABLE IF NOT EXISTS volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    availability TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert example admin user (change password to a hashed value in practice)
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$yO5n7hrxqW1rYQ6G/vHiBeZjYIh3.0eG0pVQ7p8P0TqVJ5gxF/mZ6', 'admin'); -- Password: 'admin123'

-- Insert example pets (optional)
INSERT INTO pets (name, breed, age, health_status, description, image) VALUES
('Buddy', 'Golden Retriever', 3, 'Healthy', 'Friendly and playful', 'path/to/buddy.jpg'),
('Mittens', 'Tabby Cat', 2, 'Healthy', 'Loves to cuddle', 'path/to/mittens.jpg'),
('Bella', 'Bulldog', 5, 'Needs medication', 'Calm and gentle', 'path/to/bella.jpg');

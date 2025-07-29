-- Create the database
CREATE DATABASE IF NOT EXISTS rudra_rides;
USE rudra_rides;

-- Users table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Destinations table
CREATE TABLE destinations (
    destination_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    location VARCHAR(100),
    best_time_to_visit VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Hotels table
CREATE TABLE hotels (
    hotel_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(100),
    price_per_night DECIMAL(10,2),
    image_url VARCHAR(255),
    amenities TEXT,
    rating DECIMAL(2,1),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Activities table
CREATE TABLE activities (
    activity_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(100),
    price DECIMAL(10,2),
    image_url VARCHAR(255),
    duration VARCHAR(50),
    difficulty_level VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bookings table
CREATE TABLE bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    booking_type ENUM('hotel', 'activity', 'package') NOT NULL,
    reference_id INT NOT NULL, -- hotel_id or activity_id
    booking_date DATE NOT NULL,
    check_in_date DATE,
    check_out_date DATE,
    number_of_people INT,
    total_price DECIMAL(10,2),
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Contact messages table
CREATE TABLE contact_messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data for destinations
INSERT INTO destinations (name, description, location, best_time_to_visit) VALUES
('Manali', 'Manali is a high-altitude Himalayan resort town in India\'s northern Himachal Pradesh state. It has a reputation as a backpacking center and honeymoon destination.', 'Himachal Pradesh', 'March to June'),
('Shimla', 'Shimla, the capital of Himachal Pradesh, is a picturesque hill station known for its colonial architecture, vibrant bazaars, and stunning mountain views.', 'Himachal Pradesh', 'March to June'),
('Spiti Valley', 'Spiti Valley is a cold desert mountain valley known for its breathtaking landscapes, ancient monasteries, and unique Tibetan culture.', 'Himachal Pradesh', 'May to October');

-- Insert sample data for hotels
INSERT INTO hotels (name, description, location, price_per_night, amenities, rating) VALUES
('Radisson Jass Shimla', 'Luxurious accommodations with stunning views of the Himalayan mountains', 'Shimla', 8000.00, 'WiFi, Pool, Spa, Restaurant', 4.5),
('Whoopers Boutique Kasol', 'Cozy retreat nestled in the Parvati Valley', 'Kasol', 5000.00, 'WiFi, Restaurant, Garden', 4.2),
('Heavot Caves Resort', 'Unique stay experience with cave-inspired architecture', 'Spiti Valley', 6000.00, 'WiFi, Restaurant, Mountain View', 4.0);

-- Insert sample data for activities
INSERT INTO activities (name, description, location, price, duration, difficulty_level) VALUES
('Paragliding', 'Soar high above the majestic Himalayan landscapes', 'Bir Billing', 3500.00, '1 hour', 'Moderate'),
('Trekking', 'Thrilling adventure through breathtaking trails', 'Hampta Pass', 2000.00, '5 days', 'Challenging'),
('Rafting', 'Adrenaline-pumping adventure through gushing rivers', 'Beas River', 1500.00, '2 hours', 'Moderate'); 
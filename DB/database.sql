CREATE DATABASE ASSAD;

USE ASSAD;

CREATE TABLE IF NOT EXISTS users(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	role ENUM('admin','visiter','guide') NOT NULL,
	firstlogin BOOL DEFAULT TRUE,
	is_active BOOL DEFAULT FALSE,
	is_approved BOOL DEFAULT FALSE,
	remeber_token VARCHAR(255),
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role, firstlogin, is_active, is_approved)
VALUES
('Admin ASSAD', 'admin@assad.ma', 'admin123', 'admin', FALSE, TRUE, TRUE),

('Ahmed Guide', 'ahmed.guide@assad.ma', 'guide123', 'guide', FALSE, TRUE, TRUE),
('Sara Guide', 'sara.guide@assad.ma', 'guide123', 'guide', FALSE, TRUE, TRUE),

('Youssef Visitor', 'youssef@assad.ma', 'visitor123', 'visiter', FALSE, TRUE, TRUE),
('Amina Visitor', 'amina@assad.ma', 'visitor123', 'visiter', FALSE, TRUE, TRUE);

CREATE TABLE IF NOT EXISTS habitats(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  zoo_zone ENUM(
	  'AFRICAN_ZONE',
	  'SAVANNA_AREA',
	  'BIG_CATS_ZONE',
	  'REPTILE_HOUSE',
	  'BIRDS_ZONE',
	  'AQUATIC_ZONE'
	)
);

INSERT INTO habitats (name, description, zoo_zone)
VALUES
('Savanna Habitat', 'Open grassy plains suitable for large mammals', 'SAVANNA_AREA'),
('Big Cats Area', 'Special zone for lions, tigers and leopards', 'BIG_CATS_ZONE'),
('Reptile House', 'Indoor area for reptiles and amphibians', 'REPTILE_HOUSE'),
('Birds Sanctuary', 'Large aviary for exotic birds', 'BIRDS_ZONE'),
('Aquatic World', 'Water-based habitat for aquatic animals', 'AQUATIC_ZONE');


CREATE TABLE IF NOT EXISTS animals(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	species VARCHAR(100) NOT NULL,
	diet_type ENUM('CARNIVORE','HERBIVORE','OMNIVORE'),
	image TEXT NOT NULL,
	short_description VARCHAR(255),
	id_habitat INT,
	FOREIGN KEY (id_habitat) REFERENCES habitats(id) ON DELETE CASCADE
);

INSERT INTO animals (name, species, diet_type, image, short_description, id_habitat)
VALUES
('Asaad', 'Panthera leo leo', 'CARNIVORE', 'asaad_lion.jpg',
 'The famous Atlas Lion, symbol of strength and heritage', 2),

('African Elephant', 'Loxodonta africana', 'HERBIVORE', 'elephant.jpg',
 'The largest land animal in Africa', 1),

('Nile Crocodile', 'Crocodylus niloticus', 'CARNIVORE', 'crocodile.jpg',
 'Large and powerful aquatic reptile', 3),

('Flamingo', 'Phoenicopterus roseus', 'OMNIVORE', 'flamingo.jpg',
 'Pink bird living near water areas', 5);


CREATE TABLE IF NOT EXISTS guide_visits(
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(100) NOT NULL,
    description TEXT,
    start_datetime DATETIME NOT NULL,
    duration INT NOT NULL,
    price FLOAT NOT NULL,
    language VARCHAR(20) NOT NULL,
    capacity_max INT NOT NULL,
    status ENUM("available", "not available") DEFAULT "available",
    id_guide INT,
	FOREIGN KEY (id_guide) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO guide_visits (title, description, start_datetime, duration, price, language, capacity_max, status, id_guide)
VALUES
('Atlas Lion Experience',
 'Discover the story of Asaad, the Atlas Lion',
 '2025-01-10 10:00:00', 90, 100.00, 'French', 20, 'available', 2),

('African Wildlife Tour',
 'Explore African animals and their habitats',
 '2025-01-12 14:00:00', 120, 150.00, 'Arabic', 25, 'available', 3);


CREATE TABLE IF NOT EXISTS visit_steps(
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(100) NOT NULL,
    description TEXT,
    step_order INT NOT NULL,
    id_visit INT,
	FOREIGN KEY (id_visit) REFERENCES guide_visits(id) ON DELETE CASCADE
);

INSERT INTO visit_steps (title, description, step_order, id_visit)
VALUES
('Savanna Zone', 'Introduction to African mammals', 1, 1),
('Big Cats Area', 'Meet Asaad the Atlas Lion', 2, 1),

('Birds Zone', 'Discover exotic African birds', 1, 2),
('Reptile House', 'Learn about reptiles', 2, 2);


CREATE TABLE IF NOT EXISTS reservation(
	id INT AUTO_INCREMENT PRIMARY KEY,
    number_of_people INT NOT NULL,
    id_visiter INT,
    id_visit INT,
	FOREIGN KEY (id_visit) REFERENCES guide_visits(id) ON DELETE CASCADE,
	FOREIGN KEY (id_visiter) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO reservation (number_of_people, id_visiter, id_visit)
VALUES
(2, 4, 1),
(3, 5, 2);

CREATE TABLE IF NOT EXISTS comments(
	id INT AUTO_INCREMENT PRIMARY KEY,
    comment_text TEXT,
    comment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    rating INT NOT NULL CHECK(rating BETWEEN 1 and 5),
    id_visiter INT,
    id_visit INT,
	FOREIGN KEY (id_visit) REFERENCES guide_visits(id) ON DELETE CASCADE,
	FOREIGN KEY (id_visiter) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO comments (comment_text, rating, id_visiter, id_visit)
VALUES
('Amazing experience, very informative guide!', 5, 4, 1),
('Great visit, my kids loved it!', 4, 5, 2);
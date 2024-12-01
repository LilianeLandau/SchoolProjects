-- table utilisateurs
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- table chambres
CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_number INT,
    price_room DECIMAL(10,2),
    price_breakfast DECIMAL (10,2)
) ENGINE=InnoDB;

-- Table de liaison - réservations 
CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,           -- Correspond à la colonne user_id dans users
    room_id INT NOT NULL,           -- Correspond à la colonne room_id dans rooms
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    breakfast BOOLEAN,
    total_price DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
) ENGINE=InnoDB;



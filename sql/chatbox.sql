-- Supprime la base de données si elle existe déjà
DROP DATABASE IF EXISTS chatbox;

-- Crée la base de données
CREATE DATABASE chatbox;

-- Utilise la base de données chatbox
USE chatbox;

-- Crée la table des messages
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion de données bidon
INSERT INTO messages (name, message) VALUES ('Fred', 'azerty');
INSERT INTO messages (name, message) VALUES ('toto@gmail.com', 'test');
INSERT INTO messages (name, message) VALUES ('eleve', 'test');
INSERT INTO messages (name, message) VALUES ('prof', 'moi meme');
INSERT INTO messages (name, message) VALUES ('eleve', 'Bonjour');
INSERT INTO messages (name, message) VALUES ('prof', 'nkjcnqjkcnzkj');

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

-- Insertion de données bidon dans la table des messages
INSERT INTO messages (name, message) VALUES ('Fred', 'azerty');
INSERT INTO messages (name, message) VALUES ('toto@gmail.com', 'test');
INSERT INTO messages (name, message) VALUES ('eleve', 'test');
INSERT INTO messages (name, message) VALUES ('prof', 'moi meme');
INSERT INTO messages (name, message) VALUES ('eleve', 'Bonjour');
INSERT INTO messages (name, message) VALUES ('prof', 'nkjcnqjkcnzkj');

-- Crée la table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    niveau ENUM('utilisateur', 'admin') DEFAULT 'utilisateur'
);

-- Insertion de données bidon dans la table des utilisateurs
INSERT INTO users (nom, prenom, mail, mdp, niveau) VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', SHA1('password123'), 'utilisateur');
INSERT INTO users (nom, prenom, mail, mdp, niveau) VALUES ('Durand', 'Marie', 'marie.durand@example.com', SHA1('password456'), 'admin');
-- setup.sql

-- Créer la base de données foliomakerdb
CREATE DATABASE foliomakerdb;

-- Utiliser la base de données
\c foliomakerdb;

-- Créer la table user avec les colonnes id, name, lastname, mail, et password
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    firstname varchar(25) NOT NULL,
    mail varchar(320) NOT NULL,
    password varchar(255) NOT NULL,
    status tinyint(4) NOT NULL DEFAULT 0,
    isDeleted tinyint(1) NOT NULL DEFAULT 0,
    insertedAt timestamp NOT NULL DEFAULT current_timestamp(),
    updateedAt timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
);

-- Insérer 5 enregistrements avec des noms, prénoms, mails et mots de passe fictifs
INSERT INTO users (name, lastname, mail, password) VALUES
    ('John', 'Doe', 'john.doe@example.com', 'motdepasse1'),
    ('Jane', 'Smith', 'jane.smith@example.com', 'motdepasse2'),
    ('Alice', 'Johnson', 'alice.johnson@example.com', 'motdepasse3'),
    ('Bob', 'Williams', 'bob.williams@example.com', 'motdepasse4'),
    ('Eve', 'Brown', 'eve.brown@example.com', 'motdepasse5');


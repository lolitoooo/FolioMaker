-- setup.sql

-- Créer la base de données foliomakerdb
CREATE DATABASE foliomakerdb;

-- Utiliser la base de données
\c foliomakerdb;

-- Créer la table user avec les colonnes id, name, lastname, email, et password
CREATE TABLE IF NOT EXISTS esgi_users (
    id SERIAL PRIMARY KEY,
    firstname varchar(25) NOT NULL,
    lastname varchar(25) NOT NULL,
    email varchar(320) NOT NULL,
    password varchar(255) NOT NULL,
    status smallint NOT NULL DEFAULT 0,
    isDeleted smallint NOT NULL DEFAULT 0,
    insertedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insérer 5 enregistrements avec des noms, prénoms, emails et mots de passe fictifs
INSERT INTO users (firstname, lastname, email, password) VALUES
    ('John', 'Doe', 'john.doe@example.com', 'motdepasse1'),
    ('Jane', 'Smith', 'jane.smith@example.com', 'motdepasse2'),
    ('Alice', 'Johnson', 'alice.johnson@example.com', 'motdepasse3'),
    ('Bob', 'Williams', 'bob.williams@example.com', 'motdepasse4'),
    ('Eve', 'Brown', 'eve.brown@example.com', 'motdepasse5');


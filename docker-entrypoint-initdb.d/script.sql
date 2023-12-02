-- setup.sql

-- Créer la table user avec les colonnes id, name, lastname, mail, et password
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insérer 5 enregistrements avec des noms, prénoms, mails et mots de passe fictifs
INSERT INTO users (name, lastname, mail, password) VALUES
    ('John', 'Doe', 'john.doe@example.com', 'motdepasse1'),
    ('Jane', 'Smith', 'jane.smith@example.com', 'motdepasse2'),
    ('Alice', 'Johnson', 'alice.johnson@example.com', 'motdepasse3'),
    ('Bob', 'Williams', 'bob.williams@example.com', 'motdepasse4'),
    ('Eve', 'Brown', 'eve.brown@example.com', 'motdepasse5');

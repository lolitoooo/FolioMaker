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
    isverif bool NOT NULL DEFAULT false,
    isDeleted smallint NOT NULL DEFAULT 0,
    insertedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insérer 5 enregistrements avec des noms, prénoms, emails et mots de passe fictifs
-- INSERT INTO esgi_users (firstname, lastname, email, password) VALUES
--     ('John', 'Doe', 'john.doe@example.com', 'motdepasse1'),
--     ('Jane', 'Smith', 'jane.smith@example.com', 'motdepasse2'),
--     ('Alice', 'Johnson', 'alice.johnson@example.com', 'motdepasse3'),
--     ('Bob', 'Williams', 'bob.williams@example.com', 'motdepasse4'),
--     ('Eve', 'Brown', 'eve.brown@example.com', 'motdepasse5');

-- Créer la table esgi_menus
CREATE TABLE IF NOT EXISTS esgi_menus (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    content JSON NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    user_updated_at INT,
    FOREIGN KEY (user_updated_at) REFERENCES esgi_users(id)
);

-- Trigger pour la mise à jour de la colonne updated_at
CREATE OR REPLACE FUNCTION update_modified_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = now();
    RETURN NEW;
END;
$$ language 'plpgsql';

CREATE TRIGGER update_esgi_menus_modtime
    BEFORE UPDATE ON esgi_menus
    FOR EACH ROW
    EXECUTE FUNCTION update_modified_column();

-- Exemple d'insertion ajusté
INSERT INTO esgi_menus (name, description, content, user_updated_at) VALUES
    ('Menu Principal', 'Menu principal du site', '[{"name": "Accueil", "url": "/"}, {"name": "À propos", "url": "/about"}, {"name": "Services", "url": "/services"}, {"name": "Contact", "url": "/contact"}]', 1);

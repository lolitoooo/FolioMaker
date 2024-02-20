<?php

$connect = "pgsql:host=localhost;port=5432;dbname=foliomakeruser, foliomakerdb, Azerty11";
$createDatabase = "CREATE DATABASE IF NOT EXISTS foliomakeruser;";
$createTable = "
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
                ";

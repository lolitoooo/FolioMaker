<?php

define('CONNECT', "pgsql:host=db;port=5432;dbname=Loan Pena");
define('DB_USER', "aze");
define('DB_PASSWORD', "azeaz");
define('PREFIX', "MR_");
$createDatabase = "";
$createTableUser = "CREATE TABLE IF NOT EXISTS MR_users (id SERIAL PRIMARY KEY,firstname varchar(25) NOT NULL,lastname varchar(25) NOT NULL,email varchar(320) NOT NULL,password varchar(255) NOT NULL,status smallint NOT NULL DEFAULT 0,isverif bool NOT NULL DEFAULT false,isDeleted smallint NOT NULL DEFAULT 0,insertedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,updatedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP);";
$createTableMenu = "CREATE TABLE IF NOT EXISTS MR_menus (id SERIAL PRIMARY KEY,name VARCHAR(255) NOT NULL,description VARCHAR(255),content JSON NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,deleted_at TIMESTAMP NULL,user_updated_at INT,FOREIGN KEY (user_updated_at) REFERENCES esgi_users(id));";

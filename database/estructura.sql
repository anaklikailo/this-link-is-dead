DROP DATABASE IF EXISTS thislinkisdead;

CREATE DATABASE thislinkisdead;

USE thislinkisdead;

DROP TABLE IF EXISTS album;
CREATE TABLE album (
    idAlbum INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tituloAlbum VARCHAR(64),
    fecha DATE,
    portada VARCHAR(255),
    stream BIGINT
);
DROP TABLE IF EXISTS cancion;
CREATE TABLE cancion (
    idCancion INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tituloCancion VARCHAR(255),
    glosa TEXT,
    idAlbum INT(11) NOT NULL,
    FOREIGN KEY (idAlbum) REFERENCES album(idAlbum)
);

DROP TABLE IF EXISTS contacto;
CREATE TABLE contacto (
    idContacto		INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email			VARCHAR(255) NOT NULL,
    nombre			VARCHAR(32),
    apellido		VARCHAR(32),
    telefono		VARCHAR(16),
    direccion		VARCHAR(32),
    ciudad			VARCHAR(32),
    pais			VARCHAR(32),
    falbum          VARCHAR(64),
    mensaje			TEXT NOT NULL,
    fechaAlta		TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario (
    idUsuario	INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre		VARCHAR(64) NOT NULL UNIQUE,
    clave		TEXT NOT NULL
);

-- CREAR LA BASE DE DATOS
CREATE DATABASE IF NOT EXISTS tarjeta;

-- USAR LA BASE DE DATOS
USE tarjeta;

-- CREAR LA TABLA USUARIO
CREATE TABLE IF NOT EXISTS Usuario (
    ID_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50),
    Apellido VARCHAR(50),
    Saldo DECIMAL(10, 2)
);

-- CREAR LA TABLA CODIGO
CREATE TABLE IF NOT EXISTS Codigo_Barras (
    ID_Usuario INT,
    Codigo_Barras VARCHAR(100) UNIQUE,
    PRIMARY KEY (ID_Usuario),
    FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

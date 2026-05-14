CREATE DATABASE IF NOT EXISTS biblioteca_db
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish_ci;

USE biblioteca_db;

-- Tabla: categoria
CREATE TABLE categoria (
    idCategoria INT(11) NOT NULL AUTO_INCREMENT,
    nombreCategoria VARCHAR(50) NOT NULL,
    PRIMARY KEY (idCategoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Datos iniciales: categoria
INSERT INTO categoria (nombreCategoria) VALUES 
('Novela'), ('Ensayo'), ('Ciencia Ficción'), ('Historia'), ('Infantil');

-- Tabla: libro
CREATE TABLE libro (
    idLibro INT(11) NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    isbn VARCHAR(20) NOT NULL,
    idCategoria INT(11) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT(11) NOT NULL,
    fechaPublicacion DATE NOT NULL,
    PRIMARY KEY (idLibro),
    UNIQUE KEY uk_isbn (isbn),
    CONSTRAINT fk_libro_categoria 
        FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Datos iniciales: libro
INSERT INTO libro (titulo, autor, isbn, idCategoria, precio, stock, fechaPublicacion) VALUES
('Cien años de soledad', 'Gabriel García Márquez', '978-0307474728', 1, 25.50, 10, '1967-05-30'),
('Breve historia del tiempo', 'Stephen Hawking', '978-0553380163', 2, 18.90, 5, '1988-04-01');
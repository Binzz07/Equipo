CREATE DATABASE proyectobinz;
USE proyectobinz;

CREATE TABLE usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT(8) NOT NULL,
    nombre VARCHAR(40) NOT NULL,
    contrasena VARCHAR(40) NOT NULL
);

CREATE TABLE espacio(
    id INT(5) PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    capacidad INT(30) NOT NULL
);

CREATE TABLE reserva (
    idr INT(5) AUTO_INCREMENT PRIMARY KEY,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    estado VARCHAR(10) NOT NULL,
    fecha DATE NOT NULL,
    detalles VARCHAR(40),
    comida VARCHAR(30),
    cafe VARCHAR(2),
    lapotps VARCHAR(2),
    agua VARCHAR(2),
    alargues VARCHAR(2),
    ide INT(5) NOT NULL,
    ciu INT(10) NOT NULL,
    sala VARCHAR(50) NOT NULL, 
    CONSTRAINT chk_sala CHECK (sala IN ('Pecera', 'Laboratorio de ciencias', 'Laboratorio de física', 'Taller de informática', 'Biblioteca', 'Sala de informática')),
    FOREIGN KEY (ide) REFERENCES espacio(id),
    FOREIGN KEY (ciu) REFERENCES usuario(cedula)
);           

INSERT INTO `usuario`(`cedula`, `nombre`, `contrasena`) 
VALUES ('56831447','Marcos','marcos1234'),
       ('56072839','Agus','agus1234'),
       ('12345678','admin','admin1234');

INSERT INTO usuario (cedula, nombre, contrasena) VALUES
(12345678, 'Juan Perez', '1'),
(23456789, 'Maria Gomez', '12'),
(34567890, 'Carlos Ruiz', '123'),
(45678901, 'Ana Martinez', '1234'),
(56789012, 'Luis Fernandez', '12345'),
(67890123, 'Sofia Perez', '123456'),
(78901234, 'David Morales', '1234567'),
(89012345, 'Paula Ortiz', '12345678'),
(90123456, 'Jorge Lopez', '123456789'),
(12345670, 'Lucia Diaz', '12345678910');

INSERT INTO reserva (hora_inicio, hora_fin, estado, fecha, detalles, comida, cafe, lapotps, agua, alargues, ide, ciu, sala) VALUES
('08:00:00', '10:00:00', 'confirmado', '2024-10-20', 'Reunión de equipo', 'Sándwiches', 'Sí', 'No', 'Sí', 'Sí', 1, 123456789, 'Pecera'),
('11:00:00', '12:30:00', 'pendiente', '2024-10-21', 'Clase de ciencias', 'Galletas', 'No', 'Sí', 'No', 'No', 2, 987654321, 'Laboratorio de ciencias'),
('13:00:00', '15:00:00', 'confirmado', '2024-10-22', 'Taller de informática', 'Pizza', 'Sí', 'Sí', 'Sí', 'No', 3, 112233445, 'Taller de informática'),
('16:00:00', '17:30:00', 'cancelado', '2024-10-23', 'Reunión de padres', 'Frutas', 'Sí', 'No', 'No', 'Sí', 4, 556677889, 'Biblioteca'),
('09:00:00', '11:00:00', 'confirmado', '2024-10-24', 'Laboratorio de física', 'Bebidas energéticas', 'No', 'Sí', 'Sí', 'No', 5, 123123123, 'Laboratorio de física');

CREATE DATABASE proyectobinz;
USE proyectobinz;

create table usuario(
id INT AUTO_INCREMENT PRIMARY KEY,
cedula int(8) NOT NULL,
nombre VARCHAR(40) NOT NULL,
contrasena VARCHAR(40) NOT NULL
);
create table espacio(
    id int(5) Primary key,
    nombre VARCHAR(20) NOT NULL,
    capacidad int(30)NOT NULL
);

create table reserva(
    idr int(5) Primary key,
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
    ide int(5) NOT NULL,
    ciu int(10) NOT NULL,
    FOREIGN key(ide) references espacio(id),
    FOREIGN key(ciu) references usuario(Cedula_u)
);           

INSERT INTO `usuario`(`cedula`, `nombre`, `contrasena`) 
VALUES ('56831447','Marcos','marcos1234');
INSERT INTO `usuario`(`cedula`, `nombre`, `contrasena`) 
VALUES ('56072839','Agus','agus1234');

INSERT INTO usuario (cedula, nombre, contrasena) VALUES
(12345678, 'Juan Perez', '1'),
(23456789, 'Maria Gomez', '12'),
(34567890, 'Carlos Ruiz', '123'),
(45678901, 'Ana Martinez', '1234'),
(56789012, 'Luis Fernandez', '12345'),
(67890123, 'Sofia Sanchez', '123456'),
(78901234, 'David Morales', '1234567'),
(89012345, 'Paula Ortiz', '12345678'),
(90123456, 'Jorge Lopez', '123456789'),
(12345670, 'Lucia Diaz', '12345678910');

INSERT INTO reserva (idr, hora_inicio, hora_fin, estado, fecha, detalles, comida, cafe, lapotps, agua, alargues, ide, ciu)
VALUES (1, '09:00:00', '10:30:00', 'Confirmada', '2024-09-05', 'Reunión de equipo', 'Sándwiches', 'Sí', 'No', 'Sí', 'No', 101, 1234567890);

INSERT INTO reserva (idr, hora_inicio, hora_fin, estado, fecha, detalles, comida, cafe, lapotps, agua, alargues, ide, ciu)
VALUES (2, '11:00:00', '12:00:00', 'Pendiente', '2024-09-06', 'Presentación de proyecto', 'Galletas', 'No', 'Sí', 'Sí', 'Sí', 102, 9876543210);

INSERT INTO reserva (idr, hora_inicio, hora_fin, estado, fecha, detalles, comida, cafe, lapotps, agua, alargues, ide, ciu)
VALUES (3, '14:00:00', '15:30:00', 'Cancelada', '2024-09-07', 'Taller de capacitación', 'Empanadas', 'Sí', 'No', 'Sí', 'No', 103, 1122334455);

INSERT INTO reserva (idr, hora_inicio, hora_fin, estado, fecha, detalles, comida, cafe, lapotps, agua, alargues, ide, ciu)
VALUES (4, '16:00:00', '18:00:00', 'Confirmada', '2024-09-08', 'Reunión de estrategia', 'Pizza', 'Sí', 'Sí', 'No', 'Sí', 104, 2233445566);

INSERT INTO reserva (idr, hora_inicio, hora_fin, estado, fecha, detalles, comida, cafe, lapotps, agua, alargues, ide, ciu)
VALUES (5, '08:30:00', '10:00:00', 'Confirmada', '2024-09-09', 'Reunión con clientes', 'Croissants', 'Sí', 'Sí', 'Sí', 'No', 105, 3344556677);




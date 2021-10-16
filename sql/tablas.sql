
## Crea la base de datos, si no existe
CREATE DATABASE IF NOT EXISTS biblioteca;
## Crea usuario de la base de datos, si no existe.
CREATE USER IF NOT EXISTS 'biblioteca'@'localhost' IDENTIFIED BY 'biblioteca';
## Otorga todos los privilegios al usuario
GRANT ALL PRIVILEGES ON biblioteca.* TO 'biblioteca'@'localhost';
FLUSH PRIVILEGES;

## Establecemos como base de datos actual la que acabamos de crear.
USE biblioteca;

CREATE TABLE autores (
    idAutor int(11) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(50) NOT NULL DEFAULT "Anónimo",
    apellidos varchar(50),
    nacionalidad varchar(15),
    fechaNacimiento date,
    INDEX idx_nombre_apellido (nombre, apellidos)
);

CREATE TABLE socios (
    idSocio int(11) PRIMARY KEY AUTO_INCREMENT,
    DNI varchar(10),
    nombre varchar(20) NOT NULL,
    apellidos varchar(50) NOT NULL,
    direccion varchar(50) NOT NULL,
    telefono varchar(12),
    email varchar(40),
    fechaNacimiento date NOT NULL,
    fechaAlta date NOT NULL DEFAULT (CURRENT_DATE),
    estado tinyint(3),
    INDEX idx_nombre_apellido (nombre, apellidos),
    INDEX ind_dni (DNI)
);

CREATE TABLE libros (
    idLibro int(11) PRIMARY KEY AUTO_INCREMENT,
    titulo varchar(50) NOT NULL,
    editorial varchar(15),
    genero varchar(20),
    isbn varchar(13) NOT NULL,
    anhoPublicacion int(4),
    fechaAlta date NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado tinyint(3),
    INDEX idx_titulo (titulo),
    INDEX idx_isbn (isbn)
);

CREATE TABLE prestamos (
    idPrestamo int(11) PRIMARY KEY AUTO_INCREMENT,
    idSocio int(11) NOT NULL,
    idLibro int(11) NOT NULL,
    fechaInicio date NOT NULL DEFAULT (CURRENT_DATE),
    fechaDevolucion date,
    estado tinyint(3) NOT NULL DEFAULT 0,
    CONSTRAINT fk_idSocio FOREIGN KEY (idSocio) REFERENCES socios(idSocio) ON DELETE CASCADE ,
    CONSTRAINT fk_idLibro FOREIGN KEY (idLibro) REFERENCES libros(idLibro) ON DELETE CASCADE,
    INDEX idx_numero_socio (idSocio),
    INDEX idx_numero_libro (idLibro)
);

CREATE TABLE autor_libro (
    idAutor int(11) NOT NULL ,
    idLibro int(11) NOT NULL,
    CONSTRAINT fk_autorlibro_idAutor FOREIGN KEY (idAutor) REFERENCES autores(idAutor) ON DELETE CASCADE,
    CONSTRAINT fk_autorlibro_idLibro FOREIGN KEY (idLibro) REFERENCES libros(idLibro) ON DELETE CASCADE,
    INDEX idx_numero_libro (idLibro),
    INDEX idx_numero_autor (idAutor)
);

## Insertamos algunos valores por defecto en la biblioteca.

INSERT INTO `autores` (`idAutor`, `nombre`, `apellidos`, `nacionalidad`, `fechaNacimiento`) VALUES
(1, 'Arturo', 'Perez-Reverte', 'Española', '1951-11-25'),
(2, 'Fernando', 'Aramburu Irigoye', 'Española', '1959-01-04'),
(3, 'Paula', 'Hawkins', 'Británica', '1972-08-26'),
(4, 'J. R. R.', 'Tolkien', 'Británica', '1892-01-03'),
(5, 'Christopher R.R.', 'Tolkien', 'Británica', '1924-11-21'),
(6, 'Julio', 'Verne', 'Francesa', '1828-02-08'),
(7, 'Carmen', 'Laforet Díaz', 'Española', '1921-10-06'),
(8, 'Federico', 'García Lorca', 'Española', '1898-06-05'),
(9, 'Roald', 'Dahl', 'Galés', '1916-10-13'),
(10, 'Anónimo', NULL, NULL, NULL),
(11, 'Miguel', 'De Cervantes Saavedra', 'Española', '1547-10-29'),
(12, 'Rudolf Erich', 'Raspe', 'Alemán', '1737-01-01');

INSERT INTO `libros` (`idLibro`, `titulo`, `editorial`, `genero`, `isbn`, `anhoPublicacion`, `fechaAlta`, `estado`) VALUES
(1, 'El italiano', 'Alfaguara', 'Novela', '9788420460499', 2021, '2021-10-09', 1),
(2, 'Los vencejos', 'Tusquets Editores', 'Novela', '9788490669983', 2021, '2021-10-09', 2),
(3, 'A fuego lento', 'Planeta', 'Novela', '9788408246367', 2021, '2021-10-09', 1),
(4, 'El Silmarilion', 'Minotauro', 'Literatura', '9788445073810', 2002, '2021-10-09', 1),
(5, 'El señor de los anillos', 'Minotauro', 'Literatura', '9788445007709', 2019, '2021-10-09', 2),
(6, 'El Hobbit', 'Minotauro', 'Literatura', '9788445073803', 2002, '2021-10-09', 1),
(7, 'Los hijos de Húrin', 'Minotauro', 'Literatura', '9788445076347', 2007, '2021-10-09', 2),
(8, 'Miguel Strogoff', 'RBA Libros', 'Novela', '9788491870074', 2018, '2021-10-09', 2),
(9, 'La isla y los demonios', 'Destino', 'Literatura', '9788423306817', 1991, '2021-10-10', 3),
(10, 'Romancero gitano', 'S.L.U. Espasa Libros', 'Poesía', '9788467036152', 2011, '2021-10-10', 1),
(11, 'Charlie y la fábrica de chocolate', 'Alfaguara', 'Infantíl', '9788420464503', 2002, '2021-10-10', 2),
(12, 'Lazarillo de Tormes', 'S.L.U. Espasa Libros', 'Novela', '9788467052282', 2018, '2021-10-10', 1),
(13, 'Don Quijote de La Mancha', 'S.L.U. Espasa Libros', 'Novela', '9788467016901', 2004, '2021-10-10', 1);

INSERT INTO `autor_libro` (`idAutor`, `idLibro`) VALUES
(1, 1),
(2, 2),
(3, 3),
(5, 4),
(6, 8),
(5, 7),
(4, 4),
(4, 6),
(4, 5),
(7, 9),
(8, 10),
(9, 11),
(10, 12),
(11, 13);

INSERT INTO `socios` (`idSocio`, `DNI`, `nombre`, `apellidos`, `direccion`, `telefono`, `email`, `fechaAlta`, `estado`) VALUES
(1, '12345678A', 'Álvaro', 'Ramiro Martín', 'Avenida Uno, 1 - Oropesa', '555010101', 'alvaroramiromartion@biblioteca.es', '2021-10-10', 2),
(2, '21345678C', 'Catalin', 'Vasile Marcu', 'Avenida Dos, 2 - A', '555020202', 'catalivasilemarcu@biblioteca.es', '2021-10-10', 1),
(3, '31245678F', 'Francisco', 'Fernández Pina', 'Avenida Tres, 3 - Oropesa', '555030303', 'franciscofdzpina@biblioteca.es', '2021-10-10', 2),
(4, '41235678F', 'Francisco José', 'Campos Ayuso', 'Avenida Cuatro, 4 - Montearagón', '555040404', 'franciscojcampos@biblioteca.es', '2021-10-10', 1),
(5, '51234678J', 'Jonathan Javier', 'Chalacan Pantoja', 'Avenida Cinco, 5 - Talavera de la Reina', '555050505', 'jjcahlacanpantoja@biblioteca.es', '2021-10-10', 1),
(6, '61234578J', 'Jorge', 'García Rodríguez', 'Avenida Seis, 6 - Talavera de la Reina', '555060606', 'jorjegarciarodriguez@biblioteca.es', '2021-10-10', 1),
(7, '71234568J', 'José', 'Carión Piqueras', 'Avenida Siete 7, Talavera de la Reina', '555070707', 'josecarionpiqueras@biblioteca.es', '2021-10-10', 1),
(8, '81234567K', 'Karen Gianella', 'Aranda Cañizares', 'Avenida Ocho, 8 - Talavera de la Reina', '555080808', 'karenarandacanizares@biblioteca.es', '2021-10-10', 1),
(9, '91234567L', 'Ladislao Alejandro', 'Gómez Sánchez', 'Avenida Nueve, 9 - Talavera de la Reina', '555090909', 'ladislaogosan@bibliotecha.es', '2021-10-10', 2),
(10, '91234567L', 'Laura', 'Tarango Timón', 'Avenida Diez, 10 - Talavera de la Reina', '555101010', 'lauratarangotimon@biblioteca.es', '2021-10-10', 1),
(11, '11234567L', 'Luis', 'Toboada Rivas', 'Avenida Once, 11 - Talavera de la Reina', '555111111', 'luistoboadarivas@biblioteca.es', '2021-10-10', 1),
(12, '22345678M', 'Marta', 'Barrera Trujillo', 'Avenida Doce, 12 - Talavera de la Reina', '555121212', 'martabarrera@biblioteca.es', '2021-10-10', 1),
(13, '23145678M', 'Marta', 'García García', 'Avenida Trece, 13 - Talavera de la Reina', '555131313', 'martagarciagarcia@biblioteca.es', '2021-10-10', 1),
(14, '24345678R', 'Renato', 'Mascia Pozo', 'Avenida Siete 7, Talavera de la Reina', '555141414', 'renatomaciapozo@biblioteca.es', '2021-10-10', 1),
(15, '34567819R', 'Ruben', 'Sánchez García', 'Avenida Quince, 15 - Talavera de la Reina', '2512378R', 'rubensanchezgarcia@biblioteca.es', '2021-10-10', 1),
(16, '51235478O', 'Octavio', 'Ortega Esteban', 'Avenida Dieciseis, 16 - Toledo', '555161616', 'octavioortegaesteban@biblioteca.es', '2021-10-10', 1);

INSERT INTO `prestamos` (`idPrestamo`, `idSocio`, `idLibro`, `fechaInicio`, `fechaDevolucion`, `estado`) VALUES
(1, 5, 8, '2021-08-04', '2021-08-14', 1),
(2, 8, 11, '2021-08-05', '2021-08-15', 1),
(3, 3, 9, '2021-09-15', '2021-09-25', 3),
(4, 11, 7, '2021-09-16', '2021-10-26', 1),
(5, 16, 7, '2021-09-18', '2021-09-28', 2),
(6, 9, 5, '2021-09-23', '2021-11-02', 1),
(7, 6, 2, '2021-10-01', '2021-10-11', 1),
(8, 2, 6, '2021-10-01', '2021-10-11', 0),
(9, 6, 12, '2021-10-10', '2021-10-20', 0),
(10, 6, 4, '2021-10-02', '2021-10-12', 0),
(11, 5, 8, '2021-10-03', '2021-10-13', 0),
(12, 9, 3, '2021-10-04', '2021-10-14', 0);
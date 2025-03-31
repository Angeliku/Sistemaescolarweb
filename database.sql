-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS SistemaGestionEscolar;
USE SistemaGestionEscolar;

-- Tabla de Representantes
CREATE TABLE Representantes (
    RepresentanteID INT AUTO_INCREMENT PRIMARY KEY,
    Cedula VARCHAR(20) NOT NULL UNIQUE,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    Genero ENUM('Masculino', 'Femenino') NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(15),
    Email VARCHAR(100),
    Parentesco ENUM('Padre', 'Madre', 'Tutor') NOT NULL
);

-- Tabla de Estudiantes
CREATE TABLE Estudiantes (
    EstudianteID INT AUTO_INCREMENT PRIMARY KEY,
    Cedula VARCHAR(20) NOT NULL UNIQUE,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    Genero ENUM('Masculino', 'Femenino') NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(15),
    Email VARCHAR(100),
    RepresentanteID INT NOT NULL,
    Activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (RepresentanteID) REFERENCES Representantes(RepresentanteID)
);

-- Tabla de Profesores
CREATE TABLE Profesores (
    ProfesorID INT AUTO_INCREMENT PRIMARY KEY,
    Cedula VARCHAR(20) NOT NULL UNIQUE,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    Genero ENUM('Masculino', 'Femenino') NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(15),
    Email VARCHAR(100),
    Activo BOOLEAN DEFAULT TRUE
);

-- Tabla de Grados
CREATE TABLE Grados (
    GradoID INT AUTO_INCREMENT PRIMARY KEY,
    NombreGrado VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de Secciones
CREATE TABLE Secciones (
    SeccionID INT AUTO_INCREMENT PRIMARY KEY,
    NombreSeccion VARCHAR(50) NOT NULL UNIQUE,
    GradoID INT NOT NULL,
    FOREIGN KEY (GradoID) REFERENCES Grados(GradoID)
);

-- Tabla de Materias
CREATE TABLE Materias (
    MateriaID INT AUTO_INCREMENT PRIMARY KEY,
    NombreMateria VARCHAR(100) NOT NULL UNIQUE
);

-- Tabla de Matriculas
CREATE TABLE Matriculas (
    MatriculaID INT AUTO_INCREMENT PRIMARY KEY,
    EstudianteID INT NOT NULL,
    SeccionID INT NOT NULL,
    AnioEscolar YEAR NOT NULL,
    FOREIGN KEY (EstudianteID) REFERENCES Estudiantes(EstudianteID),
    FOREIGN KEY (SeccionID) REFERENCES Secciones(SeccionID)
);

-- Tabla de Calificaciones
CREATE TABLE Calificaciones (
    CalificacionID INT AUTO_INCREMENT PRIMARY KEY,
    MatriculaID INT NOT NULL,
    MateriaID INT NOT NULL,
    Lapso ENUM('1', '2', '3') NOT NULL,
    Calificacion DECIMAL(4, 2) NOT NULL,
    FOREIGN KEY (MatriculaID) REFERENCES Matriculas(MatriculaID),
    FOREIGN KEY (MateriaID) REFERENCES Materias(MateriaID)
);

-- Tabla de Asistencias
CREATE TABLE Asistencias (
    AsistenciaID INT AUTO_INCREMENT PRIMARY KEY,
    MatriculaID INT NOT NULL,
    Fecha DATE NOT NULL,
    Asistio BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (MatriculaID) REFERENCES Matriculas(MatriculaID)
);

-- Tabla de Horarios
CREATE TABLE Horarios (
    HorarioID INT AUTO_INCREMENT PRIMARY KEY,
    SeccionID INT NOT NULL,
    MateriaID INT NOT NULL,
    ProfesorID INT NOT NULL,
    DiaSemana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes') NOT NULL,
    HoraInicio TIME NOT NULL,
    HoraFin TIME NOT NULL,
    FOREIGN KEY (SeccionID) REFERENCES Secciones(SeccionID),
    FOREIGN KEY (MateriaID) REFERENCES Materias(MateriaID),
    FOREIGN KEY (ProfesorID) REFERENCES Profesores(ProfesorID)
);

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    UsuarioID INT AUTO_INCREMENT PRIMARY KEY,
    NombreUsuario VARCHAR(50) NOT NULL UNIQUE,
    Contrasena VARCHAR(255) NOT NULL,
    Rol ENUM('Administrador', 'Profesor', 'Estudiante', 'Representante') NOT NULL,
    EstudianteID INT DEFAULT NULL,
    ProfesorID INT DEFAULT NULL,
    RepresentanteID INT DEFAULT NULL,
    FOREIGN KEY (EstudianteID) REFERENCES Estudiantes(EstudianteID),
    FOREIGN KEY (ProfesorID) REFERENCES Profesores(ProfesorID),
    FOREIGN KEY (RepresentanteID) REFERENCES Representantes(RepresentanteID)
);

-- Insertar datos de prueba
INSERT INTO Representantes (Cedula, Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, Email, Parentesco) VALUES 
('V-11111111', 'Carlos', 'Pérez', '1980-01-01', 'Masculino', 'Calle Falsa 123', '0412-1111111', 'carlos.perez@example.com', 'Padre'),
('V-22222222', 'Ana', 'López', '1985-02-02', 'Femenino', 'Avenida Siempre Viva 456', '0416-2222222', 'ana.lopez@example.com', 'Madre');

INSERT INTO Estudiantes (Cedula, Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, Email, RepresentanteID) VALUES 
('V-12345678', 'Juan', 'Pérez', '2010-05-15', 'Masculino', 'Calle Falsa 123', '0412-1234567', 'juan.perez@example.com', 1),
('V-87654321', 'María', 'López', '2011-08-20', 'Femenino', 'Avenida Siempre Viva 456', '0416-7654321', 'maria.lopez@example.com', 2);

INSERT INTO Grados (NombreGrado) VALUES 
('1er Grado'),
('2do Grado'),
('3er Grado');

INSERT INTO Secciones (NombreSeccion, GradoID) VALUES 
('Sección A', 1),
('Sección B', 1),
('Sección A', 2);

INSERT INTO Materias (NombreMateria) VALUES 
('Matemáticas'),
('Ciencias Naturales'),
('Lengua y Literatura');

INSERT INTO Matriculas (EstudianteID, SeccionID, AnioEscolar) VALUES 
(1, 1, 2023),
(2, 2, 2023);

INSERT INTO Calificaciones (MatriculaID, MateriaID, Lapso, Calificacion) VALUES 
(1, 1, '1', 18.50),
(1, 2, '1', 17.00);

INSERT INTO Usuarios (NombreUsuario, Contrasena, Rol) VALUES 
('admin', '$2y$10$EjemploDeHash', 'Administrador'); -- Contraseña: admin123
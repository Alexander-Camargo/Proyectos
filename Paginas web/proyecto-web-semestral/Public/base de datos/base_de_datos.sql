USE bd_examen_ing_web;

CREATE TABLE carreras (
    id_carrera INT AUTO_INCREMENT PRIMARY KEY,
    nombre_carrera VARCHAR(100),
    codigo_carrera VARCHAR(50) UNIQUE
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    contrasena VARCHAR(255),
    rol ENUM('administrador', 'estudiante'),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Datos específicos para estudiantes
    matricula VARCHAR(50) UNIQUE NULL,   -- Solo se llenará si el usuario es estudiante
    id_carrera INT NULL,                 -- Solo se llenará si el usuario es estudiante
    
    FOREIGN KEY (id_carrera) REFERENCES carreras(id_carrera)  -- Relación con carreras
);

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100) UNIQUE
);

CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    autor VARCHAR(100),
    editorial VARCHAR(100),
    anio YEAR,
    categoria_id INT,
    unidades_disponibles INT,
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id_categoria)
);

CREATE TABLE imagenes_libros (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    ruta_imagen TEXT,
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
);

CREATE TABLE reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,                     -- Relación con la tabla usuarios (estudiantes)
    id_libro INT,
    fecha_entrega DATETIME DEFAULT CURRENT_TIMESTAMP,
    cantidad_reservada INT,
    estado_reserva ENUM('reservado', 'devuelto') DEFAULT 'reservado',
    fecha_devolucion DATETIME NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
);
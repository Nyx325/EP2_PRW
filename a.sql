CREATE TABLE
    servicios (
        id int (11) PRIMARY KEY AUTO_INCREMENT,
        nombre varchar(60),
        precio decimal(6, 2)
    );

CREATE TABLE
    usuarios (
        id int (11) PRIMARY KEY AUTO_INCREMENT,
        usuario varchar(15),
        contrasena varchar(10)
    );

CREATE TABLE
    barberia.horario (
        idHorario INT ZEROFILL NOT NULL AUTO_INCREMENT,
        inicio TIME NOT NULL,
        fin TIME NOT NULL,
        Dia VARCHAR(45) NOT NULL,
        PRIMARY KEY (idHorario)
    );

INSERT INTO
    barberia.horario (idHorario, inicio, fin, Dia)
VALUES
    ('1', '10:00', '19:00', 'Lunes'),
    ('2', '11:00', '20:00', 'Martes'),
    ('3', '11:00', '20:00', 'Miercoles'),
    ('4', '11:00', '20:00', 'Jueves'),
    ('5', '11:00', '20:00', 'Viernes'),
    ('6', '10:00', '18:00', 'Sabado'),
    ('7', '10:00', '14:00', 'Domingo');

select
    *
from
    horario;
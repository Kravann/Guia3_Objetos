create database LemosGuia3;
use LemosGuia3;

create table clientes(
    cliente_id int auto_increment,
    nombre varchar(30),
    apellido varchar(30),
    dni int(8),
    direccion varchar(30),
    telefono int (10),
    primary key (cliente_id)
);

insert into clientes (nombre,apellido,dni,direccion,telefono) values
("Fernando", "Torres", 35945101, "Hola 112", 1145637896),
("Alen", "Ozcaris", 40185964, "Hola 999", 1165419875);

create table empleados(
	empleado_id int auto_increment,
    nombre varchar(30),
    apellido varchar(30),
    dni int(8),
    direccion varchar(30),
    telefono int (10),
    sueldo float (9,2),
    rol varchar (20),
    antiguedad date,
    primary key (empleado_id)
);

insert into empleados (nombre,apellido,dni,direccion,telefono,sueldo,rol,antiguedad) values
("Victoria", "Hermosilla", 40124833, "Aranguren 9345", 1123746459, 180000, "administrador", "2021-01-19"),
("Gonzalo", "Rojas", 38546123, "Zapiola 12", 1112343278, 95000, "empleado", "2022-07-03");

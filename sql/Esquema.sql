/*
	usertype:

	0=admin
	1=director tecnico
*/

DROP TABLE usuarios;
CREATE TABLE usuarios
(
	id serial primary key,
	nombre varchar(30) not null,
	apellido varchar(30) not null,
	fnac date,
	username varchar(40) not null,
	password varchar(40) not null,
	usertype int not null
);

DROP TABLE equipos;
CREATE TABLE equipos
(
	id serial primary key,
	id_liga int not null,
	nombre varchar(30) not null
);

DROP TABLE ligas;
CREATE TABLE ligas(
    
	id serial primary key,
	nombre varchar(30) not null	
);

DROP TABLE personal;
CREATE TABLE personal(
	id serial primary key,
	id_usuario int not null,
	id_equipo int not null,
	cargo varchar(20)
);

DROP TABLE torneos;
CREATE TABLE torneos(
	id serial primary key,
	id_liga int not null,
	nombre varchar(30),
	finicio date
);

DROP TABLE participantes;
CREATE TABLE participantes(
	id serial primary key,
	id_torneo int,
	id_equipo int
);	

DROP TABLE rondas;
CREATE TABLE rondas(
	id serial primary key,
	id_torneo int not null,
	nombre varchar(30),
	fecha date,
	id_equipoA int not null,
	id_equipoB int not null,
	puntajeA int,
	puntajeB int
);

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
	id_usuario int not null,
	id_equipo int not null,
	primary key(id_usuario, id_equipo),
	cargo varchar(20)
);

DROP TABLE torneos;
CREATE TABLE torneos(
	id serial primary key,
	id_liga int not null,
	nombre varchar(30),
	finicio date
);

DROP TABLE rondas;
CREATE TABLE rondas(
	id serial primary key,
	id_torneo int not null,
	nombre varchar(30),
	fecha timestamp without time zone,
	id_equipoA int not null,
	id_equipoB int not null,
	puntajeA int,
	puntajeB int
);
	
DROP TABLE participantes;
CREATE TABLE participantes(
	id_torneo int,
	id_equipo int,
	primary key(id_torneo, id_equipo)
);	

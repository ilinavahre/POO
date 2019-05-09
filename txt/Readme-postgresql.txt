Como configurar una base de datos en postgres:

1. Crear estructura de datos
initdb -D <data>


2. Registrar el servicio, como servicio de windows
pg_ctl register -N postgres -D data 

2.5 Iniciar el servicio
net start postgres	

3. Conectarse con la base de datos en la consola
psql -U Delia -d postgres

4.Crear tabla ejemplo
 create table colores (
nombre varchar (24), 
color varchar (24)
);

5. selecccionar los datos
select <>* from colores;

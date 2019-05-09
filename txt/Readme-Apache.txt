1. Configurar httpd.conf 
Abrir conf/httpd.conf
Buscar ServerRoot y poner la ruta a la carpeta en donde esta Apache,
si arriba hay define SRVROOT poner la ruta ahi, en vez de en serverroot.

2. Registrar como servicio
httpd -k install -n apache24

3. Probar configuracion
httpd -k start -n apache24
Esto es para probar que el servidor funciona correctamente, si se encuentra
algun error hay que ir a configurarlo.
Otra forma de comprobar la configuracion del servicio es usando
httpd -n apache24 -t.

4. Utilizar htdocs para el sistema web

5. Visitar localhost a ver si funciona.


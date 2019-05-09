1. Cambiar el nombre de php.ini-develoment a solo php.ini

2.Abrir el nuevo php.ini buscar session.save_path y poner 
la ruta de una carpeta temp si no la hay crear una en el directorio de php.

3. Abrir httpd.conf de apache y copiar lo siguiente

LoadFile C:\Users\Delia\Desktop\ServidorWeb\php-7.3.4-Win32-VC15-x64\php7ts.dll
LoadFile C:\Users\Delia\Desktop\ServidorWeb\php-7.3.4-Win32-VC15-x64\libpq.dll
LoadModule php7_module "C:\Users\Delia\Desktop\ServidorWeb\php-7.3.4-Win32-VC15-x64\php7apache2_4.dll"
AddHandler application/x-httpd-php .php
AddType application/x-httpd-php .html .htm
PHPIniDir "C:\Users\Delia\Desktop\ServidorWeb\php-7.3.4-Win32-VC15-x64"

y recordar que hay que modificar para que apunte a la carpeta correcta donde
se encuentra php7

4.Reiniciar el servidor de apache
httpd -k restart -n apache24

5. Crear un archivo test.php y pegarlo en la webroot con lo siguiente
<?php
	phpinfo();
?>

6. Visitar localhost y abrir el archivo test.php	

7.Habilitar extension pdo pgsql para conectarse con postgres.
Configurar el archivo php.ini buscar la extension_dir y poner la ruta completa
del directorio de las extensiones de php (ext)
Habilitar extension = php_pdo_pgsql.dll

8.Reiniciar apache
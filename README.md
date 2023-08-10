Prueba de diagnostico de Mathias Garthof para Desis.

Version de PHP utilizada: 8.2.8
Version de PhpMyAdmin utilizada: 5.2.0
Version de Laragon utilizada: 6.0 220916

La secuencia de pasos para la instalación y el uso:
1.- Clonar repositorio en directorio deseado o descargar mediante el link -> https://drive.google.com/drive/folders/18YX_paKyk5twuJUsUtW-lUrrkL2JN_VW?usp=drive_link
2.- Instalar la extensión Live Server en visual studio code o utilizar cualquier software que proporcione un entorno de servidor local como Laragon.
En el caso de utilizar Laragon se deberá dejar la carpeta del proyecto dentro del directorio "D:\laragon\www".
3.- El archivo votantes.sql debe iniciarse localmente en cualquier aplicación a conveniencia con cotejamiento utf8mb3_spanish2_ci, idealmente con nombre "desis". (Para el desarrollo de esta prueba, fué utilizado PhpMyAdmin en conjunto a Laragon).
4.- Entrar al archivo conexion.php ubicado en "/data/includes/conexion.php" y ajustar los parametros "servername", "username", "password" y "dbname", según la configuración de su base de datos.
5.- Si está usando la extensión de Live Server, dar click derecho al formulario.html y click en Open with live server.
Si está utilizando Laragon, presione el botón de Start All y dirijase a "localhost/diagnostico-main/votacion/formulario.html".

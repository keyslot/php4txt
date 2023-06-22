#  php4txt

Simple equeleto para editar un txt usando php.

**Características:**

Fácil de incluir jscript y css.

Define bytes a procesar de un archivo txt.

Permite controlar las sesiones de un administrador.

Manejo de errores para procesos **(open/read/write/close)** con el descriptor.

**Seguridad**

De uso personal, datos de acceso en modo plano en index.php.

Fácil de integrar con generadores de vectores hash.

## Escrito en POO
Directorio /includes
|Clase| Descripción  |
|--|--|
|  Administrador.php|  Mecanismos de autentificación para el administrador.|
|Editor.php| Mecanismos para la edición de un único archivo.
|Sesion.php| Mecanismos para gestión de sesiones para un único administrador.

## Configuraciones

Archivos principales para configurar el editor: 

 - index.php
 - editar.php
 

 

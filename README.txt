Sistema de Gestión Escolar
==========================

Este es un sistema de gestión escolar desarrollado en PHP y MySQL. Incluye funcionalidades para gestionar estudiantes, representantes, materias, matrículas, calificaciones, y generar reportes en PDF.

Requisitos:
- Servidor web (Apache, Nginx, etc.).
- PHP 7.0 o superior.
- MySQL 5.6 o superior.
- Navegador web moderno.

Instrucciones de Instalación:
1. Importar la base de datos:
   - Crear una base de datos llamada `SistemaGestionEscolar`.
   - Importar el archivo `database.sql` en MySQL.

2. Configurar la conexión a la base de datos:
   - Editar el archivo `includes/db.php` y actualizar las credenciales de MySQL.

3. Subir los archivos al servidor web.

4. Acceder al sistema:
   - Abrir el navegador y visitar `http://localhost/sistema-gestion-escolar/login.php`.
   - Iniciar sesión con las credenciales de prueba:
     - Usuario: admin
     - Contraseña: admin123

5. Explorar las funcionalidades:
   - Gestionar estudiantes, representantes, materias, matrículas y calificaciones.
   - Generar reportes en PDF.
   - Visualizar gráficos de calificaciones.

Notas:
- Asegúrate de que el servidor web tenga permisos de escritura en las carpetas necesarias.
- Para producción, habilita HTTPS y refuerza la seguridad del sistema.

Desarrollado por: [Tu Nombre]
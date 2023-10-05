# colegio
Este es un sistema para gestionar las notas de un colegio

## Descargar e Instalar

Para descargar y ejecutar este proyecto en tu máquina local, sigue estos pasos:

1. Abre tu terminal (command-line interface).

2. Clona el repositorio a tu máquina local:

   ```bash
   git clone https://github.com/fcombitam/colegio.git

3. Accede al directorio del proyecto:

   ```bash
   cd colegio
   
4. Instala las dependencias del proyecto utilizando Composer:

   ```bash
   composer install

5. Instala las dependencias del proyecto utilizando Composer:

   ```bash
   cp .env.example .env

6. Instala npm:

   ```bash
   npm install && npm run build

7. Genera una clave de aplicación única:

   ```bash
   php artisan key:generate

8. Ejecuta las migraciones de la base de datos y las semillas (debes tener creada la base de datos):

   ```bash
   php artisan migrate:fresh --seed

9. Inicia el servidor de desarrollo de Laravel:

   ```bash
   php artisan serve

## INICIAR SESION

Para iniciar sesion:

1. El usuario es.

   ```bash
   admin@email.com
   
2. Contraseña:

   ```bash
   password

## para ver la api

   ```bash
   tu-dominio.test/api/api-consume

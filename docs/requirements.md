# Requerimientos
**idEvol Dashboard** ha corrido sin problemas con los sistemas operativos _Debian_ y _Ubuntu_ _Linux_  en un ambiente de pruebas. También se despliega sin problemas en el ambiente de desarrollo que levanta _Lando_ en un contenedor de _Docker_ que usa el kernel de [_linuxkit_](https://github.com/linuxkit/linuxkit). El ambiente de desarrollo desplegado por _Lando_ ejecuta la aplicación sin problemas en _Windows_ y _macOS_.

Aun no se ha probado el despliegue de la aplicación en _Windows_ utilizando [_XAMPP_](https://www.apachefriends.org/es/) como servicio, es muy probable surjan errores en la ejecución debido a cómo _Windows_ maneja las rutas de los archivos (directory separator).

## Ambiente de desarrollo
- [Docker](https://www.docker.com/) 4.34
- [Lando](https://lando.dev/) 3.22

## Backend
- [Apache](https://httpd.apache.org/) 2.4
- [PHP](https://www.php.net/) 8.3
- [Slim Framework 4](https://www.slimframework.com/docs/v4/)
- [Composer](https://getcomposer.org/) 2.8

### Dependencias del backend
- illuminate/database ^11.32
- illuminate/events ^11.32
- monolog/monolog ^3.8
- php-di/php-di ^7.0
- pug-php/pug ^3.5
- slim/psr7 ^1.7
- slim/slim ^4.14
- slim/twig-view ^3.4
- vlucas/phpdotenv ^5.6

### Dependencias en desarrollo del backend
- jangregor/phpstan-prophecy ^1.0.2
- phpspec/prophecy-phpunit ^2.3
- phpstan/extension-installer ^1.4
- phpstan/phpstan ^1.12
- phpunit/phpunit ^11.4
- squizlabs/php_codesniffer ^3.11

## Frontend
- [Node](https://nodejs.org/en) 20.18
- [Vite](https://es.vitejs.dev/) 5
- [TypeScript](https://www.typescriptlang.org/) 5.6
- [React](https://es.react.dev/) 18.3
- [NPM](https://www.npmjs.com/package/npm) 10.9

### Dependencias del frontend
- @tailwindcss/forms ^0.5.9
- chart.js ^4.4.6
- chartjs-adapter-moment ^1.0.1
- moment ^2.30.1
- react ^18.3.1
- react-dom ^18.3.1
- react-flatpickr ^3.10.13
- react-icons ^5.3.0
- react-router-dom ^6.28.0
- react-transition-group ^4.4.11

### Dependencias en desarrollo del frontend
- @types/node ^22.9.0
- @types/react ^18.3.12
- @types/react-dom ^18.3.1
- @types/react-transition-group ^4.4.11
- @vitejs/plugin-react ^4.3.3
- autoprefixer ^10.4.20
- postcss ^8.4.49
- tailwindcss ^3.4.15
- typescript ^5.6.3
- vite ^5.4.11

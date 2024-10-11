# idEvol Dashboard
Surge como una prueba de concepto didáctica, más cercana a un MVP, para identificar los alcances de las tecnologías utilizadas y comprobar la armonía entre ellas, con el propósito de que llegue a evolucionar a el esqueleto de una aplicación Fullstack.

## Requerimientos
*Ambiente de desarrollo*:
- Docker 4.34
- Lando 3.22

*Backend*:
- Apache 2.4
- PHP 8.3
- Slim Framework 4
- Composer 2
Dependencias:
    - illuminate/database ^11.26
    - illuminate/events ^11.26
    - monolog/monolog ^2.8
    - php-di/php-di ^6.4
    - pug-php/pug ^3.5
    - slim/psr7 ^1.5
    - slim/slim ^4.10
    - slim/twig-view ^3.4
    - vlucas/phpdotenv ^5.6
Dependencias en desarrollo:
    - jangregor/phpstan-prophecy ^1.0.0
    - phpspec/prophecy-phpunit ^2.0
    - phpstan/extension-installer ^1.2.0
    - phpstan/phpstan ^1.8
    - phpunit/phpunit ^9.5.26
    - squizlabs/php_codesniffer ^3.7

*Frontend*:
- Node 20
- Vite 5
- TypeScript 5.6
- React 18.3
- NPM
Dependencias:
    - @tailwindcss/forms ^0.5.7
    - chart.js ^4.4.1
    - chartjs-adapter-moment ^1.0.1
    - moment ^2.29.4
    - react ^18.2.0
    - react-dom ^18.2.0
    - react-flatpickr ^3.10.13
    - react-icons ^5.3.0
    - react-router-dom ^6.20.1
    - react-transition-group ^4.4.5
Dependencias en desarrollo:
    - @types/node ^22.7.5
    - @types/react ^18.3.11
    - @types/react-dom ^18.3.0
    - @types/react-transition-group ^4.4.11
    - @vitejs/plugin-react ^4.2.1
    - autoprefixer ^10.4.16
    - postcss ^8.4.32
    - tailwindcss ^3.3.6
    - typescript ^5.6.2
    - vite ^5.0.6

## Backend
El _backend_ de la aplicación se encuentra en el directorio `api/` del proyecto. El _backend_ esta desarrollado en [_PHP_ 8.3](https://www.php.net/releases/8.3/es.php) con el framework [_Slim 4_](https://www.slimframework.com/docs/v4/) y como gestor de dependencias se utiliza [_Composer 2_](https://getcomposer.org/doc/00-intro.md).

### Orígenes del Backend
Los siguientes enlaces han sido esenciales para el desarrollo del _backend_ este proyecto.
- [Slim Framework 4 Skeleton Application](https://github.com/slimphp/Slim-Skeleton)
- [Using Model events with Eloquent in Slim PHP 4](https://www.enovision.net/using-model-events-eloquent-slim-php)
- [Slim & Eloquent](https://github.com/kladd/slim-eloquent)

### Pruebas a la API
Para realizar las pruebas a los _endpoint_ de la _API_ se puede hacer por medio de [_Bruno_](https://www.usebruno.com/) la aplicación cliente de _API's_ multiplataforma de código fuente abierto. En la ruta `api/tests/ApiCollections/bruno/` se encuentran las colecciones de las llamadas a los _endpoint_ de la _API_.

## Frontend
El _frontend_ de la aplicación se encuentra en el directorio `web/` del proyecto. El _frontend_ esta desarrollado con [_Node_ 20](https://nodejs.org/en/) y [_Vite 5_](https://es.vitejs.dev/) utilizando [_TypeScript_](https://www.typescriptlang.org/) en [_React_ 18](https://es.react.dev/) y como gestor de _CSS_ [_Tailwind CSS_](https://tailwindcss.com/).

### Orígenes del Frontend
Los siguientes enlaces han sido esenciales para el desarrollo del _frontend_ este proyecto.
- [Free Tailwind admin dashboard template](https://github.com/cruip/tailwind-dashboard-template)
- [Free Tailwind landing page template](https://github.com/cruip/tailwind-landing-page-template)
- [Convert React JavaScript to TypeScript: a Step-by-Step Guide](https://www.technigo.io/explained/convert-react-javascript-to-typescript)
- [How to build a React + TypeScript app with Vite](https://blog.logrocket.com/build-react-typescript-app-vite/)
- [Building a Login Component with React, Tailwind CSS, and React Icons](https://medium.com/@ryaddev/building-a-login-component-with-react-tailwind-css-and-react-icons-12cdcb26ed27)

## Ambiente de desarrollo
Para el ambiente de desarrollo se utiliza un contenedor en [_Docker_](https://www.docker.com/) orquestado con [_Lando_](https://docs.lando.dev/getting-started/).

Para instalar _Docker_ siga las instrucciones adecuadas del sistema operativo que este utilizando.
- [Install Docker Engine](https://docs.docker.com/engine/install/)

Para instalar _Lando_ en _Windows_ siga las siguientes instrucciones:
- [Installing Lando using the PowerShell](https://docs.lando.dev/install/windows.html)

Para instalar _Lando_ en _macOS_ siga las siguientes instrucciones:
- [The macOS quickstart](https://docs.lando.dev/install/macos.html)

### Archivos de configuración del ambiente de desarrollo
En el directorio `lando/` se encuentran los archivos de configuración necesarios para el correcto despliegue del ambiente de desarrollo por medio de _Lando_.

Una vez teniendo instalado _Docker_ y _Lando_ en su computadora podrá iniciar el ambiente de desarrollo con el siguiente comando:
```bash
lando start
```

Al iniciar o levantar el contenedor de _Docker_ con el ambiente de desarrollo por medio de _Lando_ podrá hacer uso de los siguientes comandos:

```bash
lando front-dev
```
Con el comando `lando front-dev` inicializará el servicio _HTTP_ de _Vite_ con la _URL_ `http://localhost:5173/` donde podrá ver los cambios aplicados en las páginas del frontend.

```bash
lando front-build
```
Con el comando `lando front-build` construirá con _Vite_ el frontend en la ruta `/web/dist/` del proyecto.

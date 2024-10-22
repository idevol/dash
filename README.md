# idEvol Dashboard
Surge como una prueba de concepto didáctica, más cercana a un MVP, para identificar los alcances de las tecnologías utilizadas y comprobar la armonía entre ellas, con el propósito de que llegue a evolucionar como esqueleto de una aplicación Fullstack.

- [Requerimientos](docs/requirements.md)
- [Base de datos](docs/database.md)

## Backend
El _backend_ de la aplicación se encuentra en el directorio `api/` del proyecto. El _backend_ está desarrollado en [_PHP_ 8.3](https://www.php.net/releases/8.3/es.php) con el framework [_Slim 4_](https://www.slimframework.com/docs/v4/) y como gestor de dependencias se utiliza [_Composer 2_](https://getcomposer.org/doc/00-intro.md).

### Orígenes del Backend
Los siguientes enlaces han sido esenciales para el desarrollo del _backend_ este proyecto.
- [Slim Framework 4 Skeleton Application](https://github.com/slimphp/Slim-Skeleton)
- [Using Model events with Eloquent in Slim PHP 4](https://www.enovision.net/using-model-events-eloquent-slim-php)
- [Slim & Eloquent](https://github.com/kladd/slim-eloquent)

### Pruebas a la API
Para realizar las pruebas a los _endpoint_ de la _API_ se puede hacer por medio de [_Bruno_](https://www.usebruno.com/) la aplicación cliente de _API's_ multiplataforma de código fuente abierto. En la ruta `api/tests/ApiCollections/bruno/` se encuentran las colecciones de las llamadas a los _endpoint_ de la _API_.

## Frontend
El _frontend_ de la aplicación se encuentra en el directorio `web/` del proyecto. El _frontend_ está desarrollado con [_Node_ 20](https://nodejs.org/en/) y [_Vite 5_](https://es.vitejs.dev/) utilizando [_TypeScript_](https://www.typescriptlang.org/) en [_React_ 18](https://es.react.dev/) y como gestor de _CSS_ [_Tailwind CSS_](https://tailwindcss.com/).

### Orígenes del Frontend
Los siguientes enlaces han sido esenciales para el desarrollo del _frontend_ este proyecto.
- [Free Tailwind admin dashboard template](https://github.com/cruip/tailwind-dashboard-template)
- [Free Tailwind landing page template](https://github.com/cruip/tailwind-landing-page-template)
- [Convert React JavaScript to TypeScript: a Step-by-Step Guide](https://www.technigo.io/explained/convert-react-javascript-to-typescript)
- [How to build a React + TypeScript app with Vite](https://blog.logrocket.com/build-react-typescript-app-vite/)
- [Building a Login Component with React, Tailwind CSS, and React Icons](https://medium.com/@ryaddev/building-a-login-component-with-react-tailwind-css-and-react-icons-12cdcb26ed27)

## Ambiente de desarrollo
Para el ambiente de desarrollo se utiliza un contenedor en [_Docker_](https://www.docker.com/) orquestado con [_Lando_](https://docs.lando.dev/getting-started/).

- [Install Docker Engine](https://docs.docker.com/engine/install/)\
  Siga las instrucciones adecuadas para el sistema operativo que esté utilizando.
- [Installing Lando using the PowerShell](https://docs.lando.dev/install/windows.html)\
  Para instalar _Lando_ en _Windows_.
- [The macOS quickstart](https://docs.lando.dev/install/macos.html)\
  Para instalar _Lando_ en _macOS_.

### Archivos de configuración del ambiente de desarrollo
En el directorio `lando/` se encuentran los archivos de configuración necesarios para el correcto despliegue del ambiente de desarrollo por medio de _Lando_.

### Definición de variables de entorno
Es necesario crear el archivo `.env` en el directorio `api/` y definir las variables de entorno:
- `DASH_SALT`\
  Cadena de texto aleatoría que se concatena a las contraseñas almacenadas.
- `DASH_INIT_VECTOR`\
  Cadena de texto aleatoría que se utiliza como vector inicial en las funciones `openssl_encrypt` y `openssl_decrypt`

El contenido del archivo `api/.env` sería similar a:
```bash
DASH_SALT=F_ODS5EE0V,PAA*:qYsNr.
DASH_INIT_VECTOR=gpdHTB+o.DRnqLlK5AzKA
```
**Atención**: Por seguridad defina en sus entornos (desarrollo, pruebas y producción) diferentes cadenas aleatorias.

### Creación de la base de datos
Siga las instrucciones de [aqui](docs/database.md) para crear una nueva base de datos.

### Despliegue local de la aplicación 
Una vez teniendo instalado _Docker_ y _Lando_ en su computadora podrá iniciar el ambiente de desarrollo con el siguiente comando:
```bash
lando start
```

Una vez haya iniciado el contenedor de _Docker_ orquestado por _Lando_ podrá tener acceso a las _URL's_:
- http://dash.lndo.site:8080/ \
  Esta _URL_ muestra el _frontend_ de la aplicación, compilado por _Vite_ en el directorio `web/dist/`.\
  Puede ver las rutas declaradas de la aplicación _frontend_ en el archivo `web/src/App.tsx`.
- http://dash.lndo.site:8080/api/ \
  En esta _URL_ es en donde iniciara los _endpoint_ de la _API_ de la aplicación, muestra lo publicado en el directorio `api/public/`.\
  En el el archivo `api/app/routes.php` podrá ver las _URI_ de los _endpoints_ declarados de la _API_.

Al iniciar o levantar el contenedor de _Docker_ con el ambiente de desarrollo por medio de _Lando_ podrá hacer uso de los siguientes comandos:

```bash
lando front-dev
```
Con el comando `lando front-dev` inicializará el servicio _HTTP_ de _Vite_ con la _URL_ `http://localhost:5173/` donde podrá ver los cambios aplicados en las páginas del frontend. Este comando es un alias del comando `npm vite` dentro de la ruta `web/`.

```bash
lando front-build
```
Con el comando `lando front-build` construirá con _Vite_ el frontend en la ruta `web/dist/` del proyecto. Este comando es un alias del comando `npm vite build` en la ruta `web/`.

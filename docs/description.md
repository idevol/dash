# Descripción y antecedentes del proyecto
Surge como una prueba de concepto didáctica, más cercana a un MVP, para identificar los alcances de las tecnologías utilizadas y comprobar la armonía entre ellas, con el propósito de que llegue a evolucionar como esqueleto de una aplicación Fullstack.

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

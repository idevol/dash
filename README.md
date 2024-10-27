# idEvol Dashboard

- [Descripción y antecedentes del proyecto](docs/description.md)
- [Requerimientos](docs/requirements.md)
- [Base de datos](docs/database.md)

## Despliegue del ambiente de desarrollo
Para el ambiente de desarrollo se utiliza un contenedor en [_Docker_](https://www.docker.com/) orquestado con [_Lando_](https://docs.lando.dev/getting-started/).

### Instalación de Docker y Lando
- [Install Docker Engine](https://docs.docker.com/engine/install/)\
  Siga las instrucciones adecuadas para el sistema operativo que esté utilizando.
- [Installing Lando using the PowerShell](https://docs.lando.dev/install/windows.html)\
  Para instalar _Lando_ en _Windows_.
- [The macOS quickstart](https://docs.lando.dev/install/macos.html)\
  Para instalar _Lando_ en _macOS_.

Una vez instalado _Lando_ en equipo ejecuté en terminal:
```bash
lando setup
```
Instalará los _plugins_ necesarios para correr la aplicación.

### Archivos de configuración del ambiente de desarrollo
El archivo `.lando.yml` es en donde se declara las características del contenedor en _Docker_ orquestado por _Lando_. En los siguientes enlaces podrá tener mayor contexto de la declaración de esté archivo:

- [Lando PHP introduction](https://docs.lando.dev/plugins/php/)
- [Lando PHP configuration](https://docs.lando.dev/plugins/php/config.html)
- [PHP Lando Plugin](https://github.com/lando/php?tab=readme-ov-file#php-lando-plugin)
- [Installing Node in Your Lando PHP Service](https://github.com/lando/php/blob/main/docs/guides/installing-node.md#installing-node-in-your-lando-php-service)

En el directorio `lando/` se encuentran los archivos de configuración necesarios para el correcto despliegue del ambiente de desarrollo por medio de _Lando_.

### Definición de variables de entorno
Es necesario crear el archivo `.env` en el directorio `api/` y definir las variables de entorno:
- `DASH_SALT`\
  Cadena de texto aleatoria que se concatena a las contraseñas almacenadas.
- `DASH_INIT_VECTOR`\
  Cadena de texto aleatoria que se utiliza como vector inicial en las funciones `openssl_encrypt` y `openssl_decrypt`
- `DASH_HOST`\
  URL del dominio en donde se encuentra la aplicación.

El contenido del archivo `api/.env` sería similar a:
```bash
DASH_SALT=F_ODS5EE0V,PAA_:qYsNr.
DASH_INIT_VECTOR=gpdHTB+o.DRnqLlK5AzKA
DASH_HOST=http://dash.lndo.site:8000
```
**Atención**: Por seguridad defina en sus entornos (desarrollo, pruebas y producción) diferentes cadenas aleatorias.

También es necesario crear el archivo `.env` en el directorio `web/` y definir la variable de entorno:
- `VITE_DASH_HOST`\
  URL del dominio en donde se encuentra la aplicación.

El contenido del archivo `api/.env` sería similar a:
```bash
VITE_DASH_HOST=http://dash.lndo.site:8000
```

### Creación de la base de datos
Siga las instrucciones de [aquí](docs/database.md) para crear una nueva base de datos.

### Despliegue local de la aplicación 
Una vez teniendo instalado _Docker_ y _Lando_ en su computadora podrá iniciar el ambiente de desarrollo con el siguiente comando:
```bash
lando start
```

Una vez haya iniciado el contenedor de _Docker_ orquestado por _Lando_ localmente, podrá tener acceso a las _URL's_:
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
Con el comando `lando front-dev` inicializará el servicio _HTTP_ de _Vite_ con la _URL_ `http://dash.lndo.site:5173/` donde podrá ver los cambios aplicados en las páginas del frontend. Este comando es un alias del comando `npm vite` dentro de la ruta `web/`.

```bash
lando front-build
```
Con el comando `lando front-build` construirá con _Vite_ el frontend en la ruta `web/dist/` del proyecto. Este comando es un alias del comando `npm vite build` en la ruta `web/`.

### Solución de problemas
Llega a pasar que cuando se inicia _Lando_ varias veces llega detenerse sin motivo aparente durante la contrucción del contenedor de _Docker_, mi recomendación para solucionar esté problema es borrar el cache de _Lando_ como lo indica en el siguiente enlace: [Purging Containers](https://docs.lando.dev/help/purging-containers.html).
```bash
lando poweroff && docker system prune -a --volumes && rm -rf ~/.lando/cache
```
También puede hacer uso de los _logs_ de _Lando_ para poder identificar la causa del problema que llegue a tener al construir el contenedor de _Docker_ en el siguiente enlace: [Accessing Logs](https://docs.lando.dev/help/logs.html).

Con el siguiente comando podrá monitorear en tiempo real los eventos que suceden al iniciar el contenedor de _Docker_ con _Lando_:
```bash
tail -f ~/.lando/logs/idevoldash.log
```

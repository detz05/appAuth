## Prueba Técnica Emmanuel Tribiño

## Modo de instalación y configuración
A continuación explicaré el modo de instalación de este proyecto sean de manera local o en un servidor, en este caso lo haré de manera local.

Debemos tener encendido los servicios de Apache y MySql

![Encender servicios Apache y Mysql](https://i.imgur.com/vH0gS9x.png)

Tambien debemos tener instalado Git ya que clonaremos el proyecto.

Abrimos una Terminal y nos ubicamos en la carpeta htdocs o www.

![Ubicación de la carpeta htdocs en el terminal](https://i.imgur.com/GJwDzP1.png)

Una vez que estemos allí clonaremos el proyecto con el siguiente comando

`git clone https://github.com/detz05/appAuth.git`

Esperamos a que termine el proceso de clonación

![Clonando el proyecto](https://i.imgur.com/fDq81VL.png)

Una vez culminado el proceso desde la misma terminal nos úbicamos en la carpeta del proyecto

![Entrar a la carpeta del proyecto](https://i.imgur.com/YZNYPuq.png)

Para el siguiente proceso debemos tener instalado composer.

Ejecutamos el siguiente comando desde el terminal

`composer update`

Y esperamos que culmine el proceso

![Ejecutar el comando de composer](https://i.imgur.com/Ce4CgSd.png)

Luego de eso nos vamos a la carpeta del proyecto y buscamos el archivo

`.env.example`

![Buscar el archivo .env.example](https://i.imgur.com/spIsEmf.png)

Y reemplazamos el nombre por

`.env`

![Cambiar el nombre del archivo .env.example](https://i.imgur.com/bCJ1wGD.png)

Luego de eso lo abrimos con nuestro editor de texto preferido y configuramos los datos para la conexión a la base de datos

![Configuración del .env](https://i.imgur.com/EV3VW30.png)

Muy importante configurar el servicio stmp ya que el la aplicación envia correo para la verificación 2F

Ahora procederemos a crear la base de datos.

Abrimos nuestro administrador de base de datos preferida, en mi caso NAVICAT y creamos una nueva base de datos
con el nombre que asignamos en archivo .env

![Creación de la base de datos](https://i.imgur.com/QIbZl9g.png)
![Creación de la base de datos](https://i.imgur.com/V2XPrks.png)

Una vez creada procedemos a importar el script sql que está en la carpeta del proyecto

![Creación de la base de datos](https://i.imgur.com/KcizPPq.png)

Terminamos con la creación de la base de datos.

Como ya tenemos iniciado los servicios de Apache y MySql procedemos a verificar que el proyecto corre bien

Abrimos la dirección que configuramos en el archivo .env

![Verificamos si la aplicación corre](https://i.imgur.com/rFL2vFg.png)

Si se muestra esta pantalla quiere decir que todo está correctamente

Con esto finalizamos el proceso de instalación y configuración del proyecto.


## COMO USAR LA APLICACIÓN

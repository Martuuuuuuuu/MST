Escuela de Educación Técnica N°1 de Vicente López Eduardo Ader
--------------------------------------------------------------------
                        Proyecto MST
--------------------------------------------------------------------

## Integrantes:
 - Araujo Martina
 - Goya Thiago
 - Salaberry Sofia

## Ideas:
 - Videojuego 
 - Sitio web de ventas (articulos aleatorios)
 - Pagina de ventas del kiosco
 - Página web para la Cooperativa (definitiva)

## Articulado con las siguientes materias:

 - Programación
 - Matemáticas
 - Base de datos
 - Diseño web
 - Modelos y Sistemas
 - ingles

## Lenguajes que se utilizará:

 - HTML: Base de nuestro proyecto (Página Web).
 - CSS: Diseño de la página web.
 - JavaScript: Funcionamiento de la página web (posible).
 - Php myAdmin: Base de datos para el sistema de login de los usuarios.

--------------------------------------------------------------------

## Sobre Nosotros:

Somos un grupo de desarrollo llamado MST, integrado por 3 estudiantes, enfocados en crear soluciones digitales utiles para la comunidad educativa.

--------------------------------------------------------------------

## ¿De qué trata?

Hacer, crear y confeccionar un sitio web independiente accesible para todos, que asista a la página principal de la Escuela llamada "Cooperativa", en donde se podrá acceder al catálogo de los productos disponibles que este puede ofrecer, entre otros. 

--------------------------------------------------------------------

## Objetivos

Lograr realizar una página web para ayudar a mejorar la coordinación y organización de la Cooperativa, permitiéndoles ver los gastos, las ganancias y las reservas que los clientes hagan a través de la página.

--------------------------------------------------------------------

## ¿Qué tendrá?

## Para los Usuarios:

 - Sistema de login.
 - Apartado del equipo de Cooperadora.
 - Apartado de productos (Artículos en venta con modelos y talles).
 - Apartado de reservas.
 - Un ticket/código para verificar si es la persona que realizó
   la reserva.
 - Adaptación para los distintos modelos de dispositivos.

## Para la Cooperativa:

 - Un total de todas las ganancias y gastos de todos los meses.
 - Historial de gastos y ganancias.
 - Un apartado de gastos con sus categorías.


## Ideas adicionales:

 - Agregar a la página web en el apartado de "productos" una sección en donde los alumnos puedan subir artículos que no utilicen y quieran vender. 

--------------------------------------------------------------------

## Estructura:

 Al entrar al sitio web se encontrarán en el inicio, el cual cuenta con una breve descripción de la Cooperativa, seguido de los integrantes que la componen. 
 En la parte superior se encontrará la barra de navegación la cual contará con 4 apartados, "Inicio", "Página principal", "Productos" y "Reservas", los cuales llevarán a sus respectivos apartados con su respectivo contenido.
 
## Apartados:

 - Inicio:
   Este contará con una breve descripción sobre la Cooperativa.

 - Pagina Principal:
   Este apartado llevará a la página principal de la EEST N°1.

 - Productos:
   Este apartado contará con todos los productos que ofrece la Coopeativa como busos, remeras, chombas y cuadernos del ciclo lectivo del año correspondiente, entre otros. Cada uno de estos productos contará con una sección aparte en donde se especificarán los detalles del mismo, como los talles, modelos disponibles y precio.

 - Reservas:
   Cumplirá la función de un carrito, el cual guardará los productos seleccionados que se quieran reservar, al confirmar los productos elegidos se llevará al usuario a otro apartado en donde tendrá que completar un formulario que pedirá ingresar su nombre, apellido, DNI, email o correo, número de teléfono, etc. Luego tendrá que elegir que día desea retirar sus productos seleccionados y una vez hecho esto se le proporcionará un código, el cual servirá para retirar y confirmar que la reserva se ha hecho con éxito.

   * Aclaracion: Los usuaros recibirán un correo de recordatorio cada cierto periodo de tiempo para retirar su reserva, si la persona no se presenta dentro de ese trayecto esta se cancelará. 

   --------------------------------------------------------------------

## Funcionamiento del login

Este sistema permite a los estudiantes y familias de la cooperadora escolar:
1. **Registrarse** con su información personal para contar con un mejor control de quienes nos reservan productos
2. **Iniciar sesión** con credenciales
3. **Comprar** uniformes y útiles en la tienda virtual
4. **Gestionar** su carrito de compras

--------------------------------------------------------------------

## Flujo de Compra

<pre>
Usuario intenta comprar
    ↓
¿Está logueado? 
    │
    ├─ NO → va al apartado de login
    │       Usuario se registra si es que no tiene una cuenta 
    │       Vuelve a intentar a hacer la reserva de su pedido
    │
    └─ SÍ → Agrega al carrito
           ↓
        Completa carrito
           ↓
        Haz clic en "Confirmar reserva"
           ↓
        Se envía pedido al servidor (PHP)
           ↓
        Se guarda en la BD
           ↓
        Confirmación y se espera a que venga la persona a buscar su reserva
</pre>

## Apartados del Login

**Pestaña: iniciar sesion**
    - Correo Electronico
    - Contraseña
    - Validación con servidor

**Pestaña: registrarse**
    - Nombre completo
    - Email
    - Contraseña (mínimo 8 caracteres, caracteres especiales y letras mayusculas)
    - Teléfono 
    - Validación de contraseñas coincidentes

## Tienda Online

**Grid de Productos**
    - Nombre
    - Descripcion
    - Precio
    - Campo de cantidad (contara con un limite de productos a comprar)
    - Boton de agregar al carrito

**Carrito de Compras**
    - Productos seleccionados
    - Cantidad a comprar (con un limite para elegir)
    - subtotal de cada producto de su eleccion y con el monto total por la cantidad de productos elegidos
    - Seccion donde dira el monto a pagar por todo al momento de ir al retiral es pedido

--------------------------------------------------------------------

## Estructura de las carpetas

<pre>
MST/
├── backend/
│   ├── carga_producto.php
│   ├── conexion.php
│   ├── listado.html
│   ├── login.php
│   ├── logout.php
│   ├── procesar.php
│   ├── producto.php
│   └── setup.php
├──docs/
│   ├──Informe/
│   │   └──Informe_MST_v1.0.0.pdf
│   ├── Carpetas_campo/
│   │   ├── carpeta_general_v1.0.0.pdf
│   │   ├── carpeta_sofia_v1.0.0.pdf
│   │   ├── carpeta_thiago_v1.0.0.pdf
│   │   └── carpeta_martina_v1.0.0.pdf
│   ├──Manuales/
│   │   ├── Manual_Usuario_v1.0.0.pdf
│   │   └── Manual_Programador_v1.0.0.pdf
│   ├── disenos/
│   │   ├── afiche
│   │   ├── triptico
│   │   ├── tech_card
│   │   ├── diagrama_flujo
│   │   └── diagrama_gantt
├── frontend/
      ├── html/
      │   ├── administrador.html
      │   ├── buzo.html
      │   ├── cuadernillo.html
      │   ├── formulario.html
      │   ├── inicio.html
      │   ├── registrarse.html
      │   ├── registro.html
      │   ├── remera.html
      │   ├── remera_corta_blanca.html
      │   ├── remera_corta_azul.html
      │   ├── reservas.html
      │   └── tienda.html
      ├── img/
      │   ├── fondo
      │   │   └── fondo.png  
      │   ├── iconos
      │   │   ├── cerrarSesion.jpeg
      │   │   ├── grafico.jpeg
      │   │   ├── inicio.jpeg
      │   │   ├── productos.jpeg
      │   │   └── reserva.jpeg
      │   ├── logos
      │   │   ├── Cooperadora.png
      │   │   ├── eest1.webp
      │   │   ├── facebook.png
      │   │   ├── gmail.png
      │   │   ├── instagram.png
      │   │   └── telegram.png
      │   └── productos
      │   │   ├── buzo1.jpeg
      │   │   ├── buzo2.jpeg
      │   │   ├── buzo3.jpeg
      │   │   ├── buzo4.jpeg
      │   │   ├── cuadernoComunicados1.jpeg
      │   │   ├── cuadernoComunicados2.jpeg
      │   │   ├── remera1.jpeg
      │   │   ├── remera2.jpeg
      │   │   ├── remera3.jpeg
      │   │   ├── remera4.jpeg
      │   │   ├── remeracortazul1.jpeg
      │   │   ├── remeracortazul2.jpeg
      │   │   ├── remeracortazul3.jpeg
      │   │   ├── remeracortazul4.jpeg
      │   │   ├── remeracortblanca1.jpeg
      │   │   ├── remeracortblanca2.jpeg
      │   │   ├── remeracortblanca3.jpeg
      │   │   └── remeracortblanca4.jpeg
      ├── css/
      │   ├── administrador.css
      │   ├── inicio.css
      │   ├── producto.css
      │   ├── sesion.css
      │   └── tienda.css
      └── js/
           ├── administrador.js
           ├── carrusel_producto.js
           └── script.js
</pre>

## Estructura de la base de datos

**Tabla: usuarios**
- `id_usuario` - ID único del usuario
- `nombre` - Nombre del usuario
- `apellido` - Apellido del usuario
- `DNI` - Documento de identidad del usuario
- `email` - Correo electrónico del usuario
- `telefono` - numero de telefono
- `password_hash` - Contraseña encriptada del usuario
- `fecha_registro` - fecha de registro
- `activo` - indica si el usuario esta activo

**tabla: Administradores**
- `id_administrador` - ID único del administrador  
- `nombre` - Nombre del administrador 
- `apellido` - Apellido del administrador
- `email` - Email del administrador 
- `password_hash` - Contraseña encriptada del usuario
- `fecha_registro` - Fecha en la que el administrador se registro en el sitio web
- `activo` - Indica si es que el administrador esta activo

**tabla: Productos**
- `id_producto` - ID único del producto
- `id_categoria` - ID de categorias en los productos
- `nombre` - Nombre del producto
- `descripcion` - Descripcion del producto
- `activo` - Si el producto esta disponible 
- `fecha_alta` - Indica en que fecha este fue registrado en el sistema 

**tabla: Imagenes_Producto**
- `id_imagen` - ID único de la imagen
- `id_producto` - ID foranea de productos 
- `ruta_imagen` - URL de la imagen del producto
- `texto_alteenativo` - Descripcion de que es el producto si no se puede visualizar
- `principal` - Indica si esa imagen es la principal del producto

**tabla: Talle**
- `id_talle` - ID único de la talle 
- `nombre` - Nombre de la talle 

**tabla: Colores**
- `id_colores` - ID único del color de la ropa
- `nombre` - nombre del color

**tabla: Materiales**
- `id_materiales` - ID único del material de la ropa
- `nombre` - nombre del material utilizado
- `descripcion` - descripcion de la calidad del material

**tabla: Precios**
- `id_precios` - ID único de los precios
- `id_variante` - ID de las variantes 
- `precio` - precio de las prendas
- `fecha_desde` - desde que fecha se le implemento ese precio

**tabla: Stock**
- `id_variante` - ID único de las variantes
- `cantidad` - cantidad disponibles de cada prenda

**tabla: Variantes_producto**
- `id_variante` - ID único de variantes
- `id_producto` - ID de los productos 
- `id_material` - ID del material de la prenda
- `id_color` - ID del color de la prenda
- `id_talle` - ID de las talles de cada prenda
- `activo` - indica si es que este aun sigue disponible

**tabla: Reservas**
- `id_reserva` - ID único de reservas
- `id_usuario` - ID de los usuarios
- `fecha_reserva` - fecha en la que se realizo la reserva
- `estado` - indica si es que la reserva esta pendiente, confirmada, retirada o cancelada.
- `observaciones` - Permite guardar información adicional relacionada con la reserva.

**tabla: Detallee_reserva**
- `id_detalle` - ID único de detalle de la reserva
- `id_reserva` - ID de la reserva 
- `id_variante` - ID de las variantes
- `cantidad` - cantidad pedida en la reserva
- `precio_unitario` - precio 

**tabla: Pagos**
- `id_pago` - ID único del pago
- `id_reserva` - ID de la reserva
- `monto` - monto total que se pago
- `fecha_pago` - dia que se realizo el pago
- `metodo_pago` - indica el metodo de pago (efectivo)
- `estado` - Indica la situación del pago (pendiente, aprobado o rechazado)

**tabla: Gastos**
- `id_gasto` - ID único de gasto
- `concepto` - Indica el motivo principal por el cual se realizó el gasto 
- `descripcion` - información adicional sobre el por que se realizo ese gasto.
- `monto` - indica la cantidad que se gasto
- `fecha_gasto` - indica en que fecha se realizo el gasto
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

## Lenguajes que se utilizará:

 - HTML: Base de nuestro proyecto (Página Web).
 - CSS: Diseño de la página web.
 - Python: Backend del proyecto.
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
    - Nombre de usuario de su cuenta
    - Correo Electronico
    - Contraseña
    - Validación con servidor

**Pestaña: registrarse**
    - Nombre completo
    - Email
    - Contraseña (mínimo 8 caracteres y caracteres especiales)
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
Proyecto MST/
├── backend/
│   ├── carga_producto.php
│   ├── conexion.php
│   ├── index.php
│   ├── listado.php
│   ├── login.php
│   ├── logout.php 
│   ├── procesar.php
│   ├── producto.php
│   ├── setup.php
├── frontend/
    └── vscode/
        ├── html/
        │   ├── buso.html
        │   ├── chomba.html
        │   ├── cuadernillo.html
        │   ├── equipo.html
        │   ├── formulario.html
        │   ├── inicio.html
        │   ├── remera.html
        │   ├── reservas.html
        │   ├── tienda.html
        │   └── Equipo.html
        ├── img/
        │   ├── logos
        │   └── productos
        ├── css/
        │   └── style.css
        └── js/
           ├── script.js
           └── inicio.js
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
- `id_administrador` -
- `nombre` -
- `apellido` -
- `email` -
- `password_hash` -
- `fecha_registro` -
- `activo` -

**tabla: Productos**
- `id_producto` -
- `id_categoria` -
- `nombre` -
- `descripcion` -
- `activo` -
- `fecha_alta` -

**tabla: Imagenes_Producto**
- `id_imagen` -
- `id_producto` -
- `ruta_imagen` -
- `texto_alteenativo` -
- `principal` -

**tabla: Talle**
- `id_talle` -
- `nombre` -

**tabla: Colores**
- `id_colores` -
- `nombre` -

**tabla: Materiales**
- `id_materiales` -
- `nombre` -
- `descripcion` -

**tabla: Precios**
- `id_precios` -
- `id_variante` -
- `precio` -
- `fecha_desde` -

**tabla: Stock**
- `id_variante` -
- `cantidad` -

**tabla: Variantes_producto**
- `id_variante` -
- `id_producto` -
- `id_material` -
- `id_color` -
- `id_talle` -
- `activo` -

**tabla: Reservas**
- `id_reserva` -
- `id_usuario` -
- `fecha_reserva` -
- `estado` -
- `observaciones` -

**tabla: Detallee_reserva**
- `id_detalle` -
- `id_reserva` -
- `id_variante` -
- `cantidad` -
- `precio_unitario` -

**tabla: Pagos**
- `id_pago` -
- `id_reserva` -
- `monto` -
- `fecha_pago` -
- `metodo_pago` -
- `estado` -

**tabla: Gastos**
- `id_gasto` -
- `concepto` -
- `descripcion` -
- `monto` -
- `fecha_gasto` -
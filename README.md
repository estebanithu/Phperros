Obligatorio de Taller de programación, Enero 2018.

Se desea implementar una aplicación para ayudar a los dueños de mascotas que se pierden a encontrarlas. Para ello es necesario desarrollar una web que permita registrar mascotas perdidas o encontradas, y que ofrezca una funcionalidad de búsqueda sobre este registro.

El sitio debe funcionar como un catálogo de avisos, donde los usuarios registrados pueden publicar avisos de mascotas
encontradas o perdidas. Para poder realizar búsquedas no es necesario estar registrado.

El sitio a desarrollar debe ofrecer la siguiente funcionalidad:

Página principal (home): Se debe ofrecer un listado con foto de las últimas 10 publicaciones realizadas en el sitio que se encuentren abiertas, ya sea de mascotas encontradas o perdidas. Cada publicación debe mostrar una foto, el título, y los primeros 150 caracteres de su descripción, identificando claramente si se trata de una mascota encontrada o perdida.
La página debe además ofrecer un conjunto de filtros, para buscar por tipo de publicación (encontrada/perdida), especie (perro, gato, etc.), raza, barrio, o parte del texto, tanto en el título como en la publicación.

El listado debe ser paginado de a 10 avisos por pantalla utilizando Ajax, lo que implica que al cambiar de página solo se refresca el listado, y no toda la página. El título de cada aviso en la lista debe ser un link que permita acceder al aviso completo, el que se debe abrir en una pestaña nueva del navegador (ver punto siguiente).

Página de publicación: Cuando se accede a un aviso particular, se debe mostrar un indicador claro de tipo de aviso (encontrada/perdida), un cuadro donde se pueden pasar cada una de las fotos de la publicación (con botones de anterior y siguiente), la especie y raza a la que pertenece la mascota y finalmente el título de la publicación y su descripción.
En la página de la publicación se deben mostrar además una lista de preguntas realizadas por otros usuarios, y las respuestas dadas por quien hizo la publicación. Se debe poder desde allí, realizar una pregunta, para lo que será necesario estar registrado. Solo el usuario que realizó la publicación puede responder preguntas sobre la misma.
El link para registrar una pregunta debe decir “Nueva Pregunta” si quien está accediendo a la página es un usuario registrado que inició sesión, e “Inicia sesión para realizar una pregunta” si no se ha iniciado sesión.
Dentro de la publicación se debe ofrecer la opción de exportarla a pdf, lo que debe generar un archivo que contenga todos los datos de la publicación, incluidas las fotos.
    
Registro en la plataforma: Para poder ingresar un anuncio o realizar una pregunta, los usuarios deben estar registrados. Para ello debe existir un link en la página de inicio que permita acceder a un formulario de registro, en el que se pedirá el email del usuario, su nombre completo y una contraseña. El identificador del usuario es el email, por lo que no pueden haber repetidos. La contraseña debe tener al menos 8 caracteres, una letra y un número.

Inicio de sesión: Debe existir un link en la página principal que permita acceder a una página de inicio de sesión. Desde allí los usuarios registrados podrán iniciar su sesión, indicando su email y contraseña. Una vez iniciada la sesión, deben poder ver en el menú la opción de registrar un aviso, que solo debe ser visible para usuarios registrados que iniciaron sesión.

Registro de una publicación: Los usuarios registrados pueden crear una nueva publicación, para lo que se pedirán todos los datos mencionados anteriormente. Una publicación debe tener al menos una foto, pudiendo tener varias si el usuario las provee. Al crear los avisos los mismos quedan en estado “abierto”, y comienzan a aparecer como resultados de las búsquedas en forma inmediata.
Los datos de especie, raza y barrio deben salir de las tablas que se proveerán. La selección de especie y raza debe ser siempre consistente, por lo que se sugiere cargar un combo con las razas posibles solo después de que el usuario indicó la especie.

Cierre de una publicación: El usuario que realizó una publicación debe poder cerrarla, indicando si la mascota ya se reunió con su dueño o no. Las búsquedas en la página principal solo deben mostrar publicaciones abiertas.

Estadísticas: Solo los usuarios registrados que iniciaron sesión deben tener acceso a una página de estadísticas, que permita conocer cuántos avisos de cada tipo se publicaron en total, segregados por especie y estado (cerrados/abiertos). El reporte debe mostrar además cuántos de ellos se cerraron con resultado positivo (el dueño encontró a la mascota) y cuantos con resultado negativo.

Características deseables, pero no obligatorias (permiten compensar puntos perdidos):
- Al realizar una publicación, solicitar el punto (latitud y longitud) donde se perdió o encontró la mascota. Luego en la página de la publicación, mostrar un mapa centrado y con un marcador en dicho punto. Se recomienza analizar el uso de google maps para esto.

- Que el paginado de los resultados de una búsqueda permita seleccionar de a cuantos avisos se desea paginar, ofreciendo de un combo con los valores (10, 20, 50, Todos).

Esteban Ithurralde - Rodrigo Pintos - 2018.
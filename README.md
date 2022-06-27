# PROYECTO FINAL - INGENIERÍA DE SOFTWARE III

### <img src="views/icons/logo.png" width="25%">

## Integrantes
Jim Leonarda Huertas Canaza

Dennis Pumaraime Espinoza

Solange Aracely Romero Chacón

Santiago Javier Vilca Limachi

Luisa Villanueva Guerrero

## Sobre Tasti
Este software se basa en una idea sencilla: si un estudiante tiene dificultades para aprender sobre un tema específico puede postearlo en un foro y, por otra parte, si algún estudiante de años superiores ve esta publicación y conoce sobre el tema requerido puede ofrecerse para realizar un reforzamiento vía online a esta persona sobre ese tema.

Tasti es un intermediario para que ambas personas puedan reunirse por medio de una conferencia enlace meet, además de permitir a otros estudiantes con dudas similares permitir unirse a la presente explicación, en caso el tutor desee, en caso contrario siempre el tutor podrá dar una clase privada a su aprendiz.

**Herramientas utilizadas:** 

FrontEnd: Html5 - Boostrap - CSS 

BackEnd: PHP

**Prototipo:** https://www.figma.com/file/7NOEbTe5UWg6VplKkzYTtL/Untitled?node-id=0%3A1


## Requisitos Funcionales

* **Mostrar preguntas disponibles**, el sistema debe mostrar en la página principal y sin la necesidad de registrarse, toda la información de las preguntas disponibles.
* **Registro de un usuario**, deberá ingresar su correo institucional, una contraseña y su CUI. Este formulario será enviado como una solicitud de registro a los moderadores para verificar los datos y permitir registro.
* **Inicio de sesión de usuario**, los usuarios deben de identificarse para acceder a las funcionalidades de la página, ya sea para recibir o dar clases, recibiendo el rol de estudiante o mentor respectivamente.
* **Perfil de usuario**, un usuario puede agregar información como una descripción, el año que curso o si es egresado. También se mostrará una sección “Mis preguntas” donde podrá visualizar las preguntas realizadas realizadas o en las que es mentor.
* **Buscar por filtro**, el sistema permite filtrar los temas por nombre de la asignatura correspondiente.
* **Formulario de preguntas**, el sistema tendrá un formulario para que los usuarios puedan colocar preguntas, definir la asignatura a la que corresponde y los horarios en el que puede recibir la mentoría y la fecha límite para recibir una respuesta. Las preguntas se podrán visualizar en la página principal.
* **Vista general de pregunta**, una pregunta puede ser tomada por cualquier usuario (mentor). El mentor debería establecer un horario y definir si desea hacer la mentoría 1 a 1 con el usuario aprendiz o realizar una mentoría grupal con otros usuarios interesados (de manera opcional puede definir un límite de participantes). Luego de esto el usuario dueño de la pregunta debería confirmar si está de acuerdo con los términos del usuario mentor.
* **Cierre de la pregunta**, una vez el estudiante haya encontrado un tutor el cual le apoye en el área correspondiente la pregunta se cerrará evitando que algún otro tutor interesado tome la enseñanza del tema.
* **Unirse a una mentoría**, un usuario ajeno a la pregunta puede solicitar unirse en caso la opción de mentoría grupal esté disponible y haya cupos disponibles, solo así se mostrará el link del meet.
* **Creación automática de los links de meet**, una vez el mentor haya elegido un horario establecido junto a su aprendiz correspondiente. En caso el mentor desee compartir su clase a más estudiantes además de su aprendiz, podrá colocar el link como público, y permitir el ingreso a otras personas también interesadas en el tema.

## Requisitos no funcionales
#### Rendimiento
* Las interfaces del sistema deben de cargar en menos de 3 segundos cuando el número de usuarios simultáneos es mayor a 10 000
* Los datos modificados en la base de datos deben ser actualizados para todos los usuarios que acceden en menos de 2 segundos.
* El sistema debe ser capaz de realizar validaciones del usuario, soportar el acceso de múltiples usuarios y sus consultas con respecto a la información simultáneamente sin reducir su rendimiento.
#### Seguridad
* Uso de contraseñas para cada usuario. Esto permitirá que tengan acceso al sistema solo las personas que tienen autorización, a través de la validación de sus datos y mostrando mensajes de error.
* Registros de ingreso al sistema.
* Creación de roles y asignarlos a cada usuario dependiendo su funcionalidad.
#### Disponibilidad
* La disponibilidad del sistema será 24 horas al día, 7 días a la semana, de tal manera que el usuario pueda acceder a la información que requiera a cualquier hora del día sin ninguna complicación.
#### Usabilidad
* El sistema debe contar con un diseño responsivo gráfico bien formado, claro, eficiente y amigable al usuario.
* Un nuevo usuario no debería tardar más de 120 segundos en registrarse.
* Un usuario registrado no debería tardar más de 150 segundos en acceder a la información que desee.
#### Estándar
* El idioma por defecto es el español.
#### Portabilidad
* El sistema será implantado bajo la plataforma de Windows.

<?php
    session_start();
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8" />

    <!-- Definir el autor del fichero html -->
    <meta name="author" content="Alexander López Méndez" />

    <!-- Definir la descripción del fichero html -->
    <meta name="description"
        content="Información de los sitios turísticos de Armenia y como poder reservar" />

    <!-- Definir las palabras claves -->
    <meta name="keywords" content="armenia,pais,reservas,turismo" />

    <!-- Definir la ventana grafica-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../estilo/estilo.css" />
    <link rel="stylesheet" href="../estilo/layout.css" />
    <link rel="stylesheet" href="../estilo/archivosPHP.css" />
    
    <title>Armenia</title>

</head>

<body>
<header>
      <img
        src="../multimedia/imagenes/bandera-armenia.jpg"
        alt="Bandera de Armenia"
      />
      <h1>Armenia</h1>
    </header>
    <nav>
      <a href="../index.html" accesskey="i" tabindex="0">Índice</a>
      <a href="../gastronomia.html" accesskey="g" tabindex="1">Gastronomia</a>
      <a href="../meteorologia.html" accesskey="m" tabindex="2">Meteorologia</a>
      <a href="../reservas.html" accesskey="r" tabindex="3">Reservas</a>
      <a href="../rutas.html" accesskey="t" tabindex="4">Rutas</a>
      <a href="../juego.html" accesskey="j" tabindex="5">Juego</a>
    </nav>

    <main>
        <!-- Datos con el contenido que aparece en el navegador -->
        <h2>Proceso de reserva</h2>
        <ol>
            <li>Seleccionar la fecha en la que se quiere hacer la reserva</li>
            <li>Seleccionar la hora en la que se quiere hacer la reserva</li>
            <li>Hacer clic en el botón de mostrar recursos turísticos</li>
        </ol>
        <p>Ambos campos han de ser completados para poder mostrar los recursos turisticos.</p>
        <h2>Proceso de añadir una reseña</h2>
        <ol>
            <li>Hacer clic en el botón de mostrar reservas</li>
            <li>Buscar la reserva a la que se quiere añadir una reseña</li>
            <li>Añadir una puntuación de 1 a 5 en la seccion de reseña</li>
            <li>Añadir un comentario en la sección de comentarios (opcional)</li>
            <li>Hacer clic en el botón de enviar reseña</li>
        </ol>
        <p>Para comprobar que la reseña se ha enviado correctamente, se puede volver a hacer clic en el botóin de mostrar reservas.</p>
        <p>Una vez asignada una reseña a un recurso turístico, esta no podra ser modificada.</p>
        <h2>Recursos Turisticos</h2>
       
        <form action='#' method='post'>
            <label for="fecha">Seleccionar una fecha inicial: </label>
            <input id="fecha" name="fecha" type="date"/>
            <label for="time">Seleccionar una hora inicial: </label>
            <input id="time" name="time" type="time"/>
            <label for="fecha2">Seleccionar una fecha final: </label>
            <input id="fecha2" name="fechaF" type="date"/>
            <label for="time2">Seleccionar una hora final: </label>
            <input id="time2" name="timeF" type="time"/>
            <button type='submit' name='mostrarRecursos'>Mostrar recursos turisticos</button>
            <button type='submit' name='verReservas'>Mostrar reservas</button>
        </form>

            
        </form>
        <?php
        require('baseDeDatos.php');
        $base = new BaseDeDatos();
        if (count($_POST) > 0){
             if (isset($_POST['reservar']))
                $base->reservar();
                if (isset($_POST['verReservas']))
                $base->verReservas();
            if (isset($_POST['mostrarRecursos']))
                $base->mostrarRecursos();
                if (isset($_POST['resena']))
                $base->hacerResena();
        }
         
        ?>
    </main>


    <footer>
        <img src="../multimedia/imagenes/HTML5.png" alt="HTML5 válido!" />
        <img src="../multimedia/imagenes/CSS3.png" alt="CSS3 válido!" />
    </footer>
</body>

</html>
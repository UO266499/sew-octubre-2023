<?php
    session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
        <h2>Crear una cuenta</h2>
        <form action='#' method='post'>
            <label for="username">Nombre de usuario: </label>
            <input id="username" type="text" placeholder="Alex99" name="username" required>

            <label for="password">Contraseña: </label>
            <input id="password" type="password" placeholder="123" name="password" required>

            <label for="email">Correo electrónico: </label>
            <input id="email" type="email" placeholder="uo266499@uniovi.es" name="email" required>

            <button type='submit' name='registro'>Conectar a la base de datos</button>
        </form>
        <h2>Iniciar sesión</h2>
        <form action='#' method='post'>
            <label for="username2">Nombre de usuario: </label>
            <input id="username2" type="text" placeholder="Alex99" name="username2" required>

            <label for="password2">Contraseña: </label>
            <input id="password2" type="password" placeholder="123" name="password2" required>

            <button type='submit' name='inicio'>Conectar a la base de datos</button>
        </form>
        
        <h2>Requisitos necesarios para poder crear una cuenta</h2>
        <ul>
            <li>Que no exista una cuenta con el mismo nombre de usuario.</li>
            <li>El nombre de usuario puede estar siendo usado por otro usuario.</li>
            <li>La contraseña puede ya ser usada por otro usuario.</li>
            <li>Se pueden crear múltiples cuentas con el mismo correo electrónico.</li>
        </ul>
        <h2>Requisitos para poder iniciar sesión</h2>
        <ul>
            <li>Tener una cuenta registrada.</li>
            <li>Introducir los datos de la cuenta registrada.</li>
            <li>Que los datos proporcionados sean correctos.</li>
        </ul>
       
        <?php
        require('baseDeDatos.php');
        $base = new BaseDeDatos();
        $base->inicializarBD();
        if (count($_POST) > 0)
            if (isset($_POST['registro']))
                $base->crearCuenta();
            if (isset($_POST['inicio']))
                $base->inicioSesion();
        ?>
    </main>


    <footer>
        <img src="../multimedia/imagenes/HTML5.png" alt="HTML5 válido!" />
        <img src="../multimedia/imagenes/CSS3.png" alt="CSS3 válido!" />
    </footer>
</body>

</html>

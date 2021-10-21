<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/biblioteca/assets/css/colores.css">
</head>

<body class="pt-5">
    <?php
    // Cargamos la barra de navegación general asegurándonos de que no se vuelve a cargar en ninguna otra parte de la aplicación.
    // mediante "require_once"
    require_once(__DIR__ . "/navbar.php");
    ?>
    <!-- Contenedor principal -->
    <div class="container-fluid mt-5 pt-3 min-vh-100">

        <?php
        // Si se ha producido algún error grave durante la ejecución de la aplicación, mostramos una página
        // con los errores y detenemos la ejecución.
        if ($errorReporter->hayErrores()) {

            $errorReporter->mostrarErrores();

            //Cerramos el container y mostramos el footer.
            echo "</div>";
            require(__DIR__ . "/footer.php");
            // La aplicación termina aquí.
            die();
        }

        // si no hay ningún error grave, se termina de mostrar el contenido generado en la página correspondiente.
        ?>
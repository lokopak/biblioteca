<?php

/**
 * Este archivo muestra el contenido html del footer de la página web.
 * El footer se comparte a lo largo de toda la aplicación.
 * Además incluimos la etiqueta de cierre del body y todos los scripts de javascript
 * que también se comparten en toda la aplicación.
 */

// Este es el último archivo que se carga siempre. así que, ponemos quí esto para que se muestren los errores o los mensajes.
if (hayMensajes()) {
    mostrarMensajes();
}

if (hayErrores()) {
    mostrarErrores();
}
?>

</div> <!-- Fin del contenedor principal -->
<footer class="bg-black px-0 py-3">
    <div class="container my-4 border-top">
        <div class="row mt-3">
            <div class="col-3 text-white"><i class="bi bi-record-circle-fill"></i> Laboris Consulting</div>
            <div class="col-6">
                <p class="text-center"><a class="text-white text-decoration-none"
                        href="/biblioteca/index.php">Biblioteca</a>
                </p>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
</body>

</html>
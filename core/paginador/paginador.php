<?php

/**
 * Devuelve un array con todos los datos necesarios
 * para un paginador.
 * 
 * @param int $pagina Entero indicando la página actual.
 * @param int $limite Entero indicando el número de elemntos por página.
 * @param array $elementos Un array con los elementos que se han encontrado
 * @param int $total Número de elementos totales en la tabla
 * 
 * @return array Devuelve un array con los datos necesarios para mostrar el
 *         paginador.
 *  - 'pagina': La página acutal
 *  - 'limite': El número de elementos por página.
 *  - 'total': El total de elementos encontrados.
 *  - 'elementos': El array con los elementos a mostar en la página actual.
 */
function paginar($pagina, $limite, $elementos, $total)
{
    // Si no se proporciona página, cogemos la página 1 por defecto.
    if (null === $pagina) {
        $pagina = 1;
    }

    // Por si acaso el límite no se proporciona o es mayor que el total de elementos...
    if (null === $limite || $limite >= $total) {
        // Nos aseguramos que el límite está dentro de lo permitido igualándolo al número de elementos.
        $limite = $total;
    }

    // Mejor asegurarse de que todos los datos recibidos son correctos.
    if ($pagina < 1 || $limite < 1 || $limite >= $total) {
        // Si algún dato recibido no es válido, devolvemos todos los elementos sin paginar
        return [
            "pagina" => 1,
            "limite" => count($elementos),
            "total" => $total,
            "elementos" => $elementos
        ];
    }

    // Devolvemos el array del paginador.
    $array = [
        "pagina" => $pagina,
        "limite" => $limite,
        "total" => $total,
        "elementos" => $elementos
    ];

    // Devolvemos el array con los datos del paginador.
    return $array;
}

/**
 * Inserta un paginador en el html
 * 
 * @param string $seccion String con el nombre de la sección en la que estamos (dentro de la web)
 * @param array $datos Array con los datos necesarios para que el paginador funciones y pueda calcular el número de páginas a mostrar.
 *  - 'limite': numero de elementos que se van a mostrar por cada página.
 *  - 'total': número total de elementos que hay.
 * 
 * @return void No devuelve ningún valor.
 */
function mostrarPaginador($seccion, $datos)
{
    // Obtenemos el límite (elementos por página) y el total de elementos para calcular el número de páginas
    // con el (int) nos aseguraos que ese valor es un entero para el cálculo más adelante.
    $limite = (int)$datos["limite"];
    $total = (int)$datos["total"];

    // Creamos el link para el paginador, necesita agregarle la página, pero eso se hace en el propio archivo de html.
    // NOTA: se le agrega la '/' antes de 'biblioteca' para que se genere un link relativo al host base. 'localhost'
    // Si no le agregamos ese '/', el link que generará será relativo a la ubicación en la que nos encontremos ahora (en el navegador web)
    $link = "/biblioteca/" . $seccion . "/listado.php?limite=" . $limite;

    // Calculamos el número de páginas que hay en total.
    // La función 'ceil' redondea un número de forma que si es .5 o mayor redondea al más alto.
    // Como 'ceil' siempre devuelve un float (decimal), nos aseguramos de que el valor se convierte en un entero mediante (int)
    $numeroPaginas = (int)ceil($total / $limite);

    // Si se han generado más de una página, mostramos el paginador.
    if ($numeroPaginas > 1) {
        // monstramos el html paginador.
        require(__DIR__ . "/view/paginacion.php");
    }
}
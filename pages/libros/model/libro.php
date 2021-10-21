<?php

const LIBRO_ESTADO_NO_DISPONIBLE = 0;
const LIBRO_ESTADO_DISPONIBLE = 1;
const LIBRO_ESTADO_PRESTADO = 2;
const LIBRO_ESTADO_DETERIORADO = 3;

const LIBRO_ESTADOS = [
    LIBRO_ESTADO_NO_DISPONIBLE => "No disponible",
    LIBRO_ESTADO_DISPONIBLE => "Disponble",
    LIBRO_ESTADO_PRESTADO => "Prestado",
    LIBRO_ESTADO_DETERIORADO => "Deteriorado"
];

// Listado de generos literarios disponibles en la biblioteca.
const GENEROS_LITERARIOS = [
    1 => "Acción",
    2 => "Aventura",
    3 => "Ciencia Ficción",
    4 => "Comedia",
    5 => "Documental",
    6 => "Drama",
    7 => "Musical",
    8 => "Suspense",
    9 => "Terror",
];
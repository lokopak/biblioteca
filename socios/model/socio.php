<?php

const SOCIO_ESTADO_BAJA = 0;
const SOCIO_ESTADO_ACTIVO = 1;
const SOCIO_ESTADO_CON_LIBRO = 2;
const SOCIO_ESTADO_SANCIONADO = 3;
const SOCIO_ESTADO_SUSPENDIDO = 4;

// Constante con los posibles estados de los socios
const ESTADOS_SOCIO = [
    SOCIO_ESTADO_BAJA => "Baja",
    SOCIO_ESTADO_ACTIVO => "Activo",
    SOCIO_ESTADO_CON_LIBRO => "Con libro",
    SOCIO_ESTADO_SANCIONADO => "Sancionado",
    SOCIO_ESTADO_SUSPENDIDO => "Suspendido"
];
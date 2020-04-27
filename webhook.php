<?php
/* Leemos los datos proporcionados en los parámetros GET */
$datos = [
  'topic' => $_GET['topic'],
  'id' => $_GET['id'],
];

if($_GET['topic']=="payment" || $_GET['topic'=="merchant_order"]){
    echo print_r($datos);

    /* Guardamos la información en un archivo de registro */
    file_put_contents('registro.log', json_encode($datos) . PHP_EOL,FILE_APPEND);
}
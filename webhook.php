<?php
/* Leemos los datos proporcionados en los parámetros GET */
$datos = [
  'topic' => $_GET['topic'],
  'id' => $_GET['id'],
];

echo $datos;
/* Guardamos la información en un archivo de registro */
file_put_contents('registro.log', json_encode($datos) . PHP_EOL,FILE_APPEND);
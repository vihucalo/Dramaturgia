<?php
define('OBRAS_TABLE', 'listaautores');
define('_DB_HOST', 'localhost');
define('_DB_USER', 'Dramaturgia');
define('_DB_PASSWORD', '1234123121');
define('_DB_NAME', 'prueba');
define('CATEGORIA', 'representativo');

$db_connection = new mysqli(_DB_HOST, _DB_USER, _DB_PASSWORD, _DB_NAME);

if ($db_connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $db_connection->connect_error;
    exit();
}

function query3($db_connection, $id)
{
    $one = "SELECT `descargas` FROM `listaautores` WHERE id = $id";
    $result = $db_connection->query($one);
    $arrays = $result->fetch_array(MYSQLI_ASSOC);
    $descarga =  $arrays['descargas'] + 1;
    $query = "UPDATE `listaautores` SET `descargas` = $descarga WHERE `id` = $id";

    if ($db_connection->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db_connection->error;
    }
}

$funcion = $_POST['funcion'];
$ids = $_POST['ids'];

if ($funcion == 'aumentar') {
    query3($db_connection, $ids);
}

$db_connection->close();

<?php

require_once 'core/database.php';

$sql = "SELECT * FROM centros";

$conn = new Connection();

$result = $conn->query($sql);

$json = array(
    'estatus' => 0,
    'message' => $result
);

$jsonstring = json_encode($json);

echo $jsonstring;

?>
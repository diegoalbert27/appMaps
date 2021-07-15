<?php

require_once 'core/database.php';

session_start();

// $_SESSION['usr'] = array(
//     'ubch_id' => 4,
//     'id_usr' => 1
// );

$session = $_SESSION['usr']['id_usr'];

$sql = "SELECT id_usr, email_usr, nom_usr, ced_usr, tel_usr, ubch_id, nombre, codigo FROM users a JOIN centros b WHERE supervisor = $session AND a.niv_usr = 5 AND a.ubch_id = b.id";

$conn = new Connection();

$result = $conn->query($sql);

$json = array();

if (!empty($result)) {
    $json = array(
        'estatus' => 0,
        'message' => $result
    );
} else {
    $json = array(
        'estatus' => 1,
        'message' => 'VOID'
    );
}

$jsonstring = json_encode($json);

echo $jsonstring;

?>
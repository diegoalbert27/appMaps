<?php

require_once 'core/database.php';

$sql = "INSERT INTO posiciones (lat_pos, lon_pos, user_id) VALUES (?,?,?)";

if (isset($_GET['latitud']) && isset($_GET['longitud']) && isset($_GET['id'])) {
    if (!empty($_GET['latitud']) && !empty($_GET['longitud']) && !empty($_GET['id'])) {

        $conn = new Connection();

        $latitud = $_GET['latitud'];
        $longitud = $_GET['longitud'];
        $id = $_GET['id'];

        $result = $conn->insertData($sql, 'ssi', array($latitud, $longitud, $id));

        $json = array();

        if ($result) {
            $json = array(
                'estatus' => 0,
                'message' => 'REGISTRADO'
            );
        } else {
            $json = array(
                'estatus' => 0,
                'message' => 'EXISTE'
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;
    } else {
        $json = array(
            'estatus' => 1,
            'message' => 'DATOS VACIO'
        );
        echo json_encode($json);
    }
} else {
    $json = array(
        'estatus' => 1,
        'message' => 'DATOS INEXISTENTES'
    );
    $jsonstring = json_encode($json);

    echo $jsonstring;
}

?>
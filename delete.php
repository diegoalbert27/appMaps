<?php

require_once 'core/database.php';

if (isset($_GET['cedula'])) {
    if (!empty($_GET['cedula'])) {

        $cedula = $_GET['cedula'];

        $conn = new Connection();

        if (!empty($conn->query("SELECT user_id FROM electores WHERE cedula = $cedula AND user_id IS NOT NULL"))) {
            
            $sql = "UPDATE electores SET user_id = NULL WHERE cedula = ?";

            $result = $conn->insertData($sql, 'i', array($cedula));

            $json = array();

            if ($result) {
                $json = array(
                    'estatus' => 0,
                    'message' => 'ELIMINADO'
                );
            } else {
                $json = array(
                    'estatus' => 0,
                    'message' => 'ERROR'
                );
            }

            $jsonstring = json_encode($json);

            echo $jsonstring;
        } else {
            $json = array(
                'estatus' => 0,
                'message' => 'EXCLUIDO'
            );

            echo json_encode($json);
        }
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
        'message' => 'ERROR'
    );
    echo json_encode($json);
}

?>
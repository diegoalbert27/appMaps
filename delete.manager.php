<?php

require_once 'core/database.php';

session_start();

// $_SESSION['usr'] = array(
//     'ubch_id' => 4,
//     'id_usr' => 2 
// );

if (isset($_GET['cedula'])) {
    if (!empty($_GET['cedula'])) {

        $cedula = $_GET['cedula'];

        $session = $_SESSION['usr'];

        foreach ($session as $key => $fila) {
            $session = $fila['id_usr'];
        }

        $conn = new Connection();

        $json = array();

        if (!empty($result = $conn->query("SELECT id_usr FROM users WHERE id_usr = $session AND niv_usr = 10"))) {
            if (empty($conn->query("SELECT niv_usr FROM users WHERE ced_usr = $cedula AND niv_usr = 0"))) {

                $sql = "UPDATE users SET niv_usr = 0 WHERE ced_usr = ? AND niv_usr = 1";

                $result = $conn->insertData($sql, 'i', array($cedula));

                $json = array();

                if ($result) {
                    $json = array(
                        'estatus' => 0,
                        'message' => 'INHABILITADO'
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
                    'message' => 'DESACTIVADO'
                );

                echo json_encode($json);
            }
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

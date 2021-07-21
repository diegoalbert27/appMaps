<?php

require_once 'core/database.php';

//session_start();

// $_SESSION['usr'] = array(
//      'ubch_id' => 4,
//      'id_usr' => 1
// );

if (isset($_POST['usuario'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['cedula']) && !empty($_POST['nombre']) && !empty($_POST['telefono']) && isset($_POST['ubch'])) {

        $sqlInsert = "INSERT INTO users (email_usr, ced_usr, nom_usr, tel_usr, niv_usr, ubch_id, supervisor) VALUES (?,?,?,?,?,?,?)";

        $usuario = $_POST['usuario'];
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $nivel = 1; // $_POST['nivel']
        $session = $_POST['id'];
       
        $ubch = $_POST['ubch'];
/*
        foreach ($session as $key => $fila) {
            $session = $fila['id_usr'];
            $ubch = $fila['ubch_id'];
        }
*/
        $conn = new Connection();

        $json = array();

        if (empty($conn->query("SELECT cedula FROM electores WHERE cedula = '$cedula' AND user_id IS NOT NULL"))) {

            if (empty($conn->query("SELECT ced_usr FROM users WHERE ced_usr = '$cedula' AND niv_usr = 1"))) {
                $data = $conn->query("SELECT id_usr FROM users WHERE ced_usr = '$cedula' AND niv_usr = 0");

                $sqlUpdate = "UPDATE users SET niv_usr = 1 WHERE ced_usr = ? AND niv_usr = 0";

                $result = empty($data) ? $conn->insertData($sqlInsert, 'ssssiii', array($usuario, $cedula, $nombre, $telefono, $nivel, $ubch, $session)) : $conn->insertData($sqlUpdate, 'i', array($cedula));


                if ($result) {
                    $json = array(
                        'estatus' => 0,
                        'message' => 'REGISTRADO'
                    );
                } else {
                    $json = array(
                        'estatus' => 0,
                        'message' => 'ERROR'
                    );
                }
            } else {
                $sqlUpdate = "UPDATE users SET email_usr = ?, nom_usr = ?, tel_usr = ?, ubch_id = ? WHERE ced_usr = ? AND supervisor = ?";

                $result = $conn->insertData($sqlUpdate, 'sssisi', array($usuario, $nombre, $telefono, $ubch, $cedula, $session));

                if ($result) {
                    $json = array(
                        'estatus' => 0,
                        'message' => 'ACTUALIZADO'
                    );
                } else {
                    $json = array(
                        'estatus' => 0,
                        'message' => 'ERROR'
                    );
                }
            }
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
        'message' => 'ERROR'
    );
    echo json_encode($json);
}

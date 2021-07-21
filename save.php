<?php

require_once 'core/database.php';

// session_start();

// $_SESSION['usr'] = array(
//       'ubch_id' => 4,
//       'id_usr' => 2
// );

if (isset($_POST['cedula']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['celular']) && isset($_POST['id']) && isset($_POST['ubch'])) {
    if (!empty($_POST['cedula']) && !empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['celular']) && !empty($_POST['id']) && !empty($_POST['ubch'])) {

        $sqlInsert = "INSERT INTO electores (cedula, nombres, apellidos, correo, celular, user_id, ubch_id) VALUES (?,?,?,?,?,?,?)";

        $cedula = $_POST['cedula'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $email = !empty($_POST['correo']) ? $_POST['correo'] : '' ;
        $celular = $_POST['celular'];

        $usuario = $_POST['id']; //$_SESSION['usr']
        $ubch = $_POST['ubch']; //null

        // foreach ($usuario as $key => $fila) {
        //     $usuario = $fila['id_usr'];
        //     $ubch = $fila['ubch_id'];
        // }

        $conn = new Connection();

        $json = array();

        if (empty($conn->query("SELECT id_usr FROM users WHERE ced_usr = '$cedula' AND niv_usr = 1"))) {

            if (empty($conn->query("SELECT cedula FROM electores WHERE user_id IS NOT NULL AND cedula = $cedula"))) {

                $data = $conn->query("SELECT cedula FROM electores WHERE user_id IS NULL AND cedula = $cedula");

                $sqlUpdate = "UPDATE electores SET user_id = ? WHERE cedula = ?";

                $result = empty($data) ? $conn->insertData($sqlInsert, 'issssii', array($cedula, $nombres, $apellidos, $email, $celular, $usuario, $ubch)) : $conn->insertData($sqlUpdate, 'ii', array($usuario, $cedula));

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
                $sqlUpdate = "UPDATE electores SET nombres = ?, apellidos = ?, correo = ?, celular = ?, ubch_id = ? WHERE cedula = ? AND user_id = ?";
    
                $result = $conn->insertData($sqlUpdate, 'ssssiii', array($nombres, $apellidos, $email, $celular, $ubch, $cedula, $usuario));
    
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
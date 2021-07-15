<?php

require_once 'core/database.php';

session_start();

// $_SESSION['usr'] = array(
//       'ubch_id' => 4,
//       'id_usr' => 2
// );

if (isset($_POST['cedula']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['email']) && isset($_POST['celular'])) {
    if (!empty($_POST['cedula']) && !empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['celular'])) {

        $sql = "INSERT INTO electores (cedula, nombres, apellidos, correo, celular, user_id, ubch_id) VALUES (?,?,?,?,?,?,?)";

        $cedula = $_POST['cedula'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];

        $ubch = $_SESSION['usr']['ubch_id'];
        $usuario = $_SESSION['usr']['id_usr'];

        $conn = new Connection();

        $json = array();
        
        if (empty($conn->query("SELECT id_usr FROM users WHERE ced_usr = '$cedula'"))) {

            $data = $conn->query("SELECT cedula FROM electores WHERE cedula = '$cedula'");
    
            $result = empty($data) ? $conn->insertData($sql, 'issssii', array($cedula, $nombres, $apellidos, $email, $celular, $usuario, $ubch)) : false;
            
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

?>
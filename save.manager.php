<?php

require_once 'core/database.php';

session_start();

// $_SESSION['usr'] = array(
//      'ubch_id' => 4,
//      'id_usr' => 1
// );

if (isset($_POST['usuario'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['cedula']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {

        $sql = "INSERT INTO users (email_usr, pwd_usr, ced_usr, nom_usr, tel_usr, niv_usr, ubch_id, supervisor) VALUES (?,?,?,?,?,?,?,?)";

        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $nivel = 5; // $_POST['nivel']
        
        $ubch = $_SESSION['usr']['ubch_id'];
        $session = $_SESSION['usr']['id_usr'];

        $conn = new Connection();
        
        $json = array();
        
        if (empty($conn->query("SELECT cedula FROM electores WHERE cedula = '$cedula'"))) {

            $data = $conn->query("SELECT id_usr FROM users WHERE ced_usr = '$cedula'");
    
            $result = empty($data) ? $conn->insertData($sql, 'sssssiii', array($usuario, $password, $cedula, $nombre, $telefono, $nivel, $ubch, $session)) : false;
    
    
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
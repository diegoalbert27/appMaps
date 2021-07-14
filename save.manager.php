<?php

require_once 'core/database.php';

if (isset($_POST['usuario'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['nivel']) && !empty($_POST['ubch'])) {

        $sql = "INSERT INTO users (email_usr, pwd_usr, nom_usr, tel_usr, niv_usr, ubch_id) VALUES (?,?,?,?,?,?)";

        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $nivel = $_POST['nivel'];
        $ubch = $_POST['ubch'];

        $conn = new Connection();

        $result = $conn->insertData($sql, 'ssssii', array($usuario, $password, $nombre, $telefono, $nivel, $ubch));

        $json = array();

        if ($result) {
            $json = array(
                'status' => 0,
                'message' => 'REGISTRADO'
            );
        } else {
            $json = array(
                'status' => 1,
                'message' => 'ERROR'
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
}

?>
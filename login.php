<?php

require_once 'core/database.php';

$conn = new Connection();

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        
        $usuario = $_POST['usuario'];
        $passwd = md5($_POST['password']);

        $sql = "SELECT email_usr, pwd_usr FROM users WHERE email_usr = '$usuario' AND pwd_usr = '$passwd'";

        $json = array();

        if (!empty($data = $conn->query($sql))) {
            $json = array(
                'estatus' => 0,
                'message' => $data
            );
        } else {
            $json = array(
                'estatus' => 1,
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
        $jsonstring = json_encode($json);
    }
} else {
    $json = array(
        'estatus' => 1,
        'message' => 'DATOS INEXISTENTES'
    );
    $jsonstring = json_encode($json);
}

?>
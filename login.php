<?php

require_once 'core/database.php';

session_start();

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        
        $conn = new Connection();
        
        $usuario = $_POST['usuario'];
        $passwd = md5($_POST['password']);

        $sql = "SELECT id_usr, email_usr, nom_usr, tel_usr, niv_usr, ubch_id, nombre, codigo, supervisor FROM users a JOIN centros b WHERE a.email_usr = '$usuario' AND a.pwd_usr = '$passwd' AND a.ubch_id = b.id";

        $json = array();

        if (!empty($data = $conn->query($sql))) {

            if ($data[0]['niv_usr'] === 5) {
                $supervisor = $data[0]['supervisor'];

                $datasuper = !empty($result = $conn->query("SELECT nom_usr, tel_usr FROM users WHERE id_usr = $supervisor")) ? $result[0] : $boss; // $data[0]['supervisor']
            }

            $json = array(
                'estatus' => 0,
                'message' => 'SUCCESS',
                'data' => $data
            );
            
            $_SESSION['usr'] = $data;
            $_SESSION['supervisor'] = $datasuper;
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

        echo $jsonstring;
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
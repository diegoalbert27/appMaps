<?php

require_once 'core/database.php';

session_start();

// $_SESSION['usr'] = array(
//      'ubch_id' => 4,
//      'id_usr' => 2
// );

$session = $_SESSION['usr'];

foreach($session as $key => $fila){
    $session = $fila['id_usr'];
}

if (isset($_GET['cedula'])) {
    if (!empty($_GET['cedula'])) {

        $usuario =  isset($_GET['id']) ? $_GET['id']: " ";
        $cedula = $_GET['cedula'];
        
        $queryUsers = "SELECT id_usr, email_usr, nom_usr, ced_usr, niv_usr, tel_usr, ubch_id, nombre, codigo FROM users a JOIN centros b WHERE supervisor = $session AND a.niv_usr = 1 AND ced_usr = $cedula AND a.ubch_id = b.id";
        
        $queryElectores = "SELECT cedula, nombres, apellidos, correo, celular, user_id, a.ubch_id, email_usr, nom_usr, ced_usr, tel_usr FROM electores a JOIN centros b JOIN users c WHERE a.user_id = $usuario AND cedula = $cedula AND a.ubch_id = b.id AND a.user_id = c.id_usr";

        $queryJefe = "SELECT id_usr, email_usr, nom_usr, ced_usr, niv_usr, tel_usr, ubch_id, nombre, codigo FROM users a JOIN centros b WHERE supervisor = $session AND a.niv_usr = 5 AND ced_usr = $cedula AND a.ubch_id = b.id";

        $conn = new Connection();

        $json = array();

        if (!empty($data = $conn->query($queryUsers))) {

            $user = $data[0]['id_usr'];
        
            $result = $conn->query("SELECT * FROM electores WHERE user_id = $user");

            $json = array(
                'estatus' => 0,
                'message' => $data,
                'electores' => $result
            );
        } else {
            if (!empty($data = $conn->query($queryElectores))) {
                $json = array(
                    'estatus' => 0,
                    'message' => $data
                );  
            } else {
                if (!empty($data = $conn->query($queryJefe))) {

                    $user = $data[0]['id_usr'];
                
                    $result = $conn->query("SELECT * FROM users WHERE supervisor = $user");
        
                    $json = array(
                        'estatus' => 0,
                        'message' => $data,
                        'electores' => $result
                    );
                } else {
                    $json = array(
                        'estatus' => 1,
                        'message' => 'ERROR'
                    );
                }
            }
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;

    } else {
        $json = array(
            'estatus' => 1,
            'message' => 'VOID'
        );

        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
} else {
    $json = array(
        'estatus' => 1,
        'message' => 'INEXISTENTE'
    );

    $jsonstring = json_encode($json);

    echo $jsonstring;
}

?>
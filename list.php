<?php
require_once 'core/database.php';

// session_start();

// $_SESSION['usr'] = array(
//     'ubch_id' => 4,
//     'id_usr' => 1
// );

// $session = $_SESSION['usr'];

// foreach($session as $key => $fila){
//     $session = $fila['id_usr'];
// }

if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {

        $usuario = $_GET['id'];

        $sql = "SELECT cedula, nombres, apellidos, correo, celular, user_id, a.ubch_id, email_usr, nom_usr, ced_usr, tel_usr FROM electores a JOIN centros b JOIN users c WHERE a.user_id = $usuario AND a.ubch_id = b.id AND a.user_id = c.id_usr";

        $conn = new Connection();

        $result = $conn->query($sql);

        $json = array();

        if (!empty($result)) {
            $json = array(
                'estatus' => 0,
                'message' => $result
            );
        } else {
            $json = array(
                'estatus' => 1,
                'message' => 'VOID'
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
}

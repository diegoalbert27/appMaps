<?php

require_once 'core/database.php';

if (isset($_POST['cedula']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['email']) && isset($_POST['celular']) && isset($_POST['usuario']) && isset($_POST['ubch'])) {
    if (!empty($_POST['cedula']) && !empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['celular']) && !empty($_POST['usuario']) && !empty($_POST['ubch'])) {

        $sql = "INSERT INTO electores (cedula, nombres, apellidos, correo, celular, user_id, ubch_id) VALUES (?,?,?,?,?,?,?)";

        $conn = new Connection();

        $cedula = $_POST['cedula'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $usuario = $_POST['usuario'];
        $ubch = $_POST['ubch'];

        $result = $conn->insertData($sql, 'issssii', array($cedula, $nombres, $apellidos, $email, $celular, $usuario, $ubch));

        print($result);
    } else {
        echo 'fail1';
    }
} else {
    echo 'fail2';
}

?>
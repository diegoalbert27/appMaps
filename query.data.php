<?php

function getPersona($cedula) {
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "http://neomaps.neoaplicaciones.com/api.php?key=Ap67pNeo&cedula=$cedula");

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // // close curl resource to free up system resources
    // curl_close($ch);

    // $output contains the output string
    return curl_exec($ch);
}

function getJson ($output, $json = array()) {
    if (!empty($resp = json_decode($output))) {
        $json = array(
            'estatus' => 0,
            'message' => $resp
        );
    } else {
        $json = array(
            'estatus' => 1,
            'message' => 'ERROR'
        );
    }

    return json_encode($json);
}

function exec_data () {
    if (isset($_GET['cedula'])) {
        if (!empty($_GET['cedula'])) {
    
            $cedula = $_GET['cedula']; // 31303849
    
            $output = getPersona($cedula);
    
            $jsonstring = getJson($output);
    
            return $jsonstring;
        }
    }
}

echo exec_data();
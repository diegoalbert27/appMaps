<?php

if (isset($_GET['cedula'])) {
    if (!empty($_GET['cedula'])) {

        $cedula = $_GET['cedula']; // 31303849

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "http://neomaps.neoaplicaciones.com/api.php?key=Ap67pNeo&cedula=$cedula");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        $json = array();

        if (!empty($resp = json_decode($output))) {
            $json = array(
                'status' => 0,
                'message' => $resp
            );
        } else {
            $json = array(
                'status' => 1,
                'message' => 'ERROR'
            );
        }

        $jsonstring = json_encode($json);

        // close curl resource to free up system resources
        curl_close($ch);

        echo $jsonstring;
    }
}

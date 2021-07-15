<?php

class Connection {
    private $host, $user, $passwd, $bd, $mysqli;

    public function __construct() {
        $config = require_once 'config/config.inic.php';

        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->passwd = $config['passwd'];
        $this->bd = $config['bd'];
    }

    private function openConnection () {
        return $this->mysqli = new mysqli($this->host, $this->user, $this->passwd, $this->bd);
    }

    private function closeConnection () {
        $this->mysqli->close();
    }

    public function query ($sql) {
        if ($conexion = $this->openConnection()) {
            $array = array();
            $stmt = $conexion->prepare($sql);

            if ($stmt->execute()) {
                $datosArray = $stmt->get_result();
				$cantidadArray = $datosArray->num_rows;
					
                for ($i = 0; $i < $cantidadArray; $i++) {
					array_push($array, $datosArray->fetch_assoc());
				}

                return $array;

                $this->closeConnection();
            }
        }
    }

    public function insertData ($sql, $param, $row) {

        $array = array();
        
        foreach ($row as $key => $value) {
            $array[$key] = $value;
        }

        if ($conexion = $this->openConnection()) {
            
            $stmt = $conexion->prepare($sql);
            
            @call_user_func_array(array($stmt, 'bind_param'), array_merge(array($param), $array));

            if (!$stmt->execute()) {
                return false;
            }

            $this->closeConnection();

            return true;
        }
    }
}

?>
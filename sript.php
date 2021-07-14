<?php

require_once 'core/database.php';

$sql = "ALTER TABLE users  ADD tel_usr VARCHAR(11) NOT NULL  AFTER nom_usr";

$conn = new Connection();

$res = $conn->query($sql);

if ($res) {
    echo 'fino';
} else {
    echo 'no fino';
}

#ALTER TABLE `users` CHANGE `id_usr` `id_usr` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'número único auto incremental';

?>
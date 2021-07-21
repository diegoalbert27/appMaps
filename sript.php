<?php



$sql = "UPDATE users SET pwd_usr = 'e10adc3949ba59abbe56e057f20f883e' WHERE niv_usr = 5";

$conn = new mysqli('localhost', 'starsdivi_appmaps', 'Neo#1357902468', 'starsdivi_appmaps');

$result = $conn->query($sql);

if($result) {
    $row = $result->fetch_array();

    print_r($row);

    // echo 'bien';
} else {
    print_r($conn);
}


#ALTER TABLE `users` CHANGE `id_usr` `id_usr` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'número único auto incremental';

//"ALTER TABLE users  ADD tel_usr VARCHAR(11) NOT NULL  AFTER nom_usr"

//ALTER TABLE electores CHANGE user_id user_id INT(11) NULL;

?>
<?php
header("Content-Type: text/plain");
echo "El servidor funciona correctamente\n";
print_r($_POST);
file_put_contents('test_log.txt', print_r($_POST, true));
?>
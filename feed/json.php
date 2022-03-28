<?php

require_once '../autoload.php';

$json = new feed\classes\CreateJSON();
header('Content-Type: application//json; charset=utf-8');
echo $json->returnJSON();
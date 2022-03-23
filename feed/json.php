<?php

require_once '../autoload.php';

$json = new feed\classes\CreateJSON();
echo $json->returnJSON();
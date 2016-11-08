<?php

require 'config.php';

$db = new PDO("mysql:host=localhost;dbname=$database[database];charset=utf8", $database["username"], $database["password"]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
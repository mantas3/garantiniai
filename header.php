<html>
<head>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
</head>
<body>
<div class="wrapper">
<div class="container">

<?php

$public_files = ['/login.php', '/check_for_expired_warranties.php'];
require "dbconn.php";
session_start();
if(!isset($_SESSION['session_id']) && !in_array($_SERVER['REQUEST_URI'], $public_files)) {
    header('Location: login.php');
}




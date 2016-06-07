<?php

    $database = "VTA";
    $conn = new mysqli("localhost","root","root","vta");

if ($conn->connect_errno) {
    echo "Connessione a MySQL fallita: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

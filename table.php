<?php
require_once("db_connection.php");
header('Content-Type: application/json');

$query="SELECT * FROM vta";

$result=$conn->query($query);

if($result == false)
    print(json_encode("ERROR: unable to retrieve data. Query= ".$query));
else {
    $superrisultato = [];
    while( $row= $result->fetch_assoc() )
    {
        $superrisultato = array_merge( $superrisultato, [$row] );
    }
    print(json_encode($superrisultato));
}
$conn->close();
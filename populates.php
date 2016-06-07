<?php
require_once("db_connection.php");
header('Content-Type: application/json');

$query="SELECT * FROM vta WHERE id=(SELECT MAX(id) FROM vta)";

$result=$conn->query($query);

if($result == false)
    print(json_encode("ERROR: unable to retrieve data. Query= ".$query));
else {
    $row= $result->fetch_assoc();
    print(json_encode($row));
}
$conn->close();



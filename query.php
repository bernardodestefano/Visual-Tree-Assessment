<?php
require_once("db_connection.php");
$json=json_decode(file_get_contents('php://input'),true);
header('Content-Type: application/json');

// POPOLAMENTO DATABASE
$query = 'insert into vta(';
foreach( $json as $key => $value )
{
    $query .= $key . ', ';
}
$query=substr($query,0,strlen($query)-2);

$query .= ' ) values (';

foreach( $json as $key => $value )
{
    if( is_numeric( $value ))
        $query .= $value . ', ';
    else
        $query .= '\'' . $value . '\', ';
}
$query=substr($query,0,strlen($query)-2);


$query .= ' );';

$result=$conn->query($query);

if($result == false)
    print(json_encode("ERROR: Unable to store vta on db. Query= ".$query));
else
    print(json_encode("Successfully executed query"));

$conn->close();



/* CREAZIONE DATABASE
$query = 'CREATE TABLE IF NOT EXISTS vta( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY';

foreach( $json as $key => $value )
{
    $query .=', '.$key.' INT(10) unsigned not null default \'7\' ';


}
$query .= ');';

print(json_encode($query));



*/




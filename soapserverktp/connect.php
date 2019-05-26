<?php
 
$mysqli =  new mysqli('localhost', 'root', '', 'db_penduduk');

if ($mysqli->connect_error) 
{
    die("Connect failed: ".$mysqli->connect_errno()." : ". $mysqli->connect_error);
}
?>
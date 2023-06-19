<?php
$mysqli = new mysqli("localhost", "root", "", "banking_sparks");
if ($mysqli->connect_errno) {
    die("Connection Error" . $mysqli->connect_error);
}
return $mysqli;

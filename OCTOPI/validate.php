<?php

$mysqli = require __DIR__ . "/database.php";

$sql = sprintf("SELECT * FROM user
                WHERE email = '%s'",
                $mysqli->real_escape_string($_GET["email"]));




$result = $mysqli->query($sql);

$available= $result->num_rows===0;


$sqlusername = sprintf("SELECT * FROM user
                WHERE username = '%s'",
                $mysqli->real_escape_string($_GET["Username"]));




$resultuser = $mysqli->query($sqlusername);

$availableuser= $resultuser->num_rows===0;

header("Content-Type: application/json");
echo json_encode(["available" =>$available, "availableuser" => $availableuser])

?>

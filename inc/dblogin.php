<?php

$dbpw = "tierehof17";
$dbname = "db11168189-minutus";
$dbuser = "db11168189-minut";

$db = mysqli_connect("localhost", $dbuser, $dbpw);
mysqli_select_db($db,$dbname);
echo mysqli_error($db);

?>
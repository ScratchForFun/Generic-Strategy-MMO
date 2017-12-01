<?php

$owner = 1;

$coord_x = rand(0, 100);
$coord_y = rand(0, 100);

include "../scripts/sql_connect.php";
$query = "INSERT INTO city (owner, name, coord_x, coord_y, points, ress_clay, ress_iron, ress_wood, ress_wheat) VALUES('$owner', 'Liipaa s city', '$coord_x', '$coord_y', 0, 300, 300, 300, 300)";
$conn->query($query);
<?php

$owner = 1;

$coord_x = rand(0, 100);
$coord_y = rand(0, 100);

include "../../scripts/sql_connect.php";
$query = "INSERT INTO city (owner, name, coord_x, coord_y, points, ress_clay, ress_iron, ress_wood, ress_wheat) VALUES('$owner', 'Liipaa s city', '$coord_x', '$coord_y', 0, 300, 300, 300, 300)";
$conn->query($query);
$city_id = $conn->insert_id;

include 'variables.php';

$clayPit = $BuildingID['ClayPit'];
$woodFarm = $BuildingID['WoodFarm'];
$headquarters = $BuildingID['Headquarters'];
$wheatField = $BuildingID['WheatField'];
$ironMines = $BuildingID['IronMines'];

// Clay pit
$query = "INSERT INTO city_building_levels (city_id, building_id, level) VALUES('$city_id', '$clayPit', 1)";
$conn->query($query);

$query = "INSERT INTO city_building_levels (city_id, building_id, level) VALUES('$city_id', '$woodFarm', 1)";
$conn->query($query);

$query = "INSERT INTO city_building_levels (city_id, building_id, level) VALUES('$city_id', '$headquarters', 1)";
$conn->query($query);

$query = "INSERT INTO city_building_levels (city_id, building_id, level) VALUES('$city_id', '$wheatField', 1)";
$conn->query($query);

$query = "INSERT INTO city_building_levels (city_id, building_id, level) VALUES('$city_id', '$ironMines', 1)";
$conn->query($query);

echo $city_id;
<?php

// TODO : Check owner

echo "go!";

if (!isset($_POST['city_id'])) return;
$city_id = $_POST['city_id'];

echo "go!2";
if (!isset($_POST['building_id'])) return;
$building_id = $_POST['building_id'];
echo "go!3";

include 'load_city.php';
$construction_cost = getBuildingUpgradeCost($city_id, $building_id);
$city = loadCity($city_id);

$costClay = (int) $construction_cost['ress_clay_cost'];
$costWood = (int) $construction_cost['ress_wood_cost'];
$costIron = (int) $construction_cost['ress_iron_cost'];
$costWheat = (int) $construction_cost['ress_wheat_cost'];

if ((int) $city['ress_clay'] < $costClay) return;
if ((int) $city['ress_wood'] < $costWood) return;
if ((int) $city['ress_iron'] < $costIron) return;
if ((int) $city['ress_wheat'] < $costWheat) return;

echo "go!4\n";
include "../../scripts/sql_connect.php";
$query = "UPDATE city_building_levels SET level = level + 1 WHERE city_id='$city_id' AND building_id='$building_id'";
$conn->query($query);

echo $construction_cost['ress_clay_cost'];

$query = "UPDATE city SET ress_clay = (ress_clay - $costClay) , ress_iron = (ress_iron - $costIron) , ress_wood = (ress_wood - $costWood) , ress_wheat = (ress_wheat - $costWheat) WHERE city_id='$city_id'";
$conn->query($query);

echo $conn->error;
echo "success";

// Building level name can be 'lvl_clay'
function getBuildingUpgradeCost($city_id, $building_id) {
    include "../../scripts/sql_connect.php";
    $query = "SELECT * FROM construction_cost WHERE building_id='$building_id' AND level IN ((
            SELECT level FROM city_building_levels WHERE city_id='$city_id' AND building_id='$building_id'
        )+1)";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row;
}

<?php

$BuildingID['ClayPit'] = 1;
$BuildingID['WheatField'] = 2;
$BuildingID['IronMines'] = 3;
$BuildingID['WoodFarm'] = 4;
$BuildingID['Headquarters'] = 5;

// The buildings in the game and their level's costs
$buildings = [];

include "../scripts/sql_connect.php";
$query = "SELECT * FROM buildings";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $building = [];
        $building['id'] = $row['building_id'];
        $building['name'] = $row['name'];
        $building['description'] = $row['description'];
        $building['maxPoints'] = 100;
        $building['maxProduction'] = 100;

        $buildingId = $row['building_id'];
        $query = "SELECT * FROM construction_cost WHERE building_id='$buildingId'";
        $result2 = $conn->query($query);

        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $level = [];
                $level['cost_wood'] = $row2['ress_wood_cost'];
                $level['cost_clay'] = $row2['ress_clay_cost'];
                $level['cost_iron'] = $row2['ress_iron_cost'];
                $level['cost_wheat'] = $row2['ress_wheat_cost'];
                $level['production'] = 100;
                $level['points'] = $row2['points'];

                $building['levels'][$row2['level']] = $level;
            }
        }

        $buildings[$row['building_id']] = $building;
    }
}

/*
$timberCamp = [];
$timberCamp['name'] = "Timber Camp";
$timberCamp['description'] = "This is the description of the timber camp.";
$timberCamp['maxPoints'] = 100;
$timberCamp['maxProduction'] = 100;

$timberCampLevel1 = [];
$timberCampLevel1['cost_wood'] = 0;
$timberCampLevel1['cost_clay'] = 0;
$timberCampLevel1['cost_iron'] = 0;
$timberCampLevel1['cost_wheat'] = 0;
$timberCampLevel1['production'] = 33;
$timberCampLevel1['points'] = 5;

$timberCamp['levels'][1] = $timberCampLevel1;

$timberCampLevel2 = [];
$timberCampLevel2['cost_wood'] = 100;
$timberCampLevel2['cost_clay'] = 100;
$timberCampLevel2['cost_iron'] = 100;
$timberCampLevel2['cost_wheat'] = 100;
$timberCampLevel2['production'] = 51;
$timberCampLevel2['points'] = 10;

$timberCamp['levels'][2] = $timberCampLevel2;

$buildings[$BuildingID['WoodFarm']] = $timberCamp;*/
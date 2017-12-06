<?php

function loadCity($city_id) {
    include "../scripts/sql_connect.php";
    $query = "SELECT * FROM city WHERE city_id='$city_id'";
    $result = $conn->query($query);

    if ($row = $result->fetch_assoc()) {
        return $row;
    }
}

function loadCities($coord_x, $coord_y) {
    //session_start();

    include "../scripts/sql_connect.php";
    $query = "SELECT * FROM city";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $city = $row;


            $levels = getCityBuildingLevels($city['city_id']);
            $city['levels'] = $levels;

            return $city;
        }
    }
}

function getCityBuildingLevels($city_id) {
    include "../scripts/sql_connect.php";
    $query = "SELECT * FROM city_building_levels WHERE city_id='$city_id' ORDER BY level DESC "; // LIMIT 1
    $result = $conn->query($query);

    $building = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = getBuildingName($row['building_id']);
            $building[$name] = $row['level'];
        }
    }

    return $building;
}

function getBuildingName($building_id) {
    include "../scripts/sql_connect.php";
    $query = "SELECT name FROM buildings WHERE building_id='$building_id'";
    $result = $conn->query($query);
    $name = $result->fetch_assoc()['name'];
    return $name;
}


<?php

// Building level name can be 'lvl_clay'
function getBuildingUpgradeCost($city_id, $building_id) {
    include "../scripts/sql_connect.php";
    $query = "SELECT * FROM construction_cost WHERE building_id='$building_id' AND level IN (
            SELECT level FROM city_building_levels WHERE city_id='$city_id' AND building_id='$building_id'
        )";
    $result = $conn->query($query);
    var_dump($result);
}

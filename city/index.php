<?php

include "scripts/load_city.php";
$city = loadCities(0, 0);

include "scripts/variables.php";

?>

<link rel="stylesheet" href="style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    var city_id = 2;
    var buildingLevels = <?php

            $buildingLevels = [];


            $buildingLevels[$BuildingID['WoodFarm']] = $city['levels']['Timber Camp'];

            //var_dump($buildingLevels);

            echo json_encode($buildingLevels);

        ?>;

    var buildingToUpgrade = -1;
    var buildings = <?php

            echo json_encode($buildings);

        ?>;

    function exitUpgradeWindow() {
        document.getElementById('upgrade_window').style.display = 'none';
    }

    function openUpgradeWindow(buildingId) {
        buildingToUpgrade = buildingId;
        document.getElementById('upgrade_window').style.display = 'block';

        document.getElementById('upgrade_window_header').innerHTML = buildings[buildingToUpgrade]['name'];
        document.getElementById('upgrade_window_description').innerHTML = buildings[buildingToUpgrade]['description'];
        document.getElementById('upgrade_window_cost_wood').innerHTML = buildings[buildingToUpgrade]['levels'][parseInt(buildingLevels[buildingToUpgrade])+1]['cost_wood'];
        document.getElementById('upgrade_window_cost_clay').innerHTML = buildings[buildingToUpgrade]['levels'][parseInt(buildingLevels[buildingToUpgrade])+1]['cost_clay'];
        document.getElementById('upgrade_window_cost_iron').innerHTML = buildings[buildingToUpgrade]['levels'][parseInt(buildingLevels[buildingToUpgrade])+1]['cost_iron'];
        document.getElementById('upgrade_window_cost_wheat').innerHTML = buildings[buildingToUpgrade]['levels'][parseInt(buildingLevels[buildingToUpgrade])+1]['cost_wheat'];
        document.getElementById('upgrade_window_points_gained').innerHTML = buildings[buildingToUpgrade]['levels'][parseInt(buildingLevels[buildingToUpgrade])]['points'];
        document.getElementById('upgrade_window_production').innerHTML = buildings[buildingToUpgrade]['levels'][parseInt(buildingLevels[buildingToUpgrade])]['production'];
        document.getElementById('upgrade_window_next_level_costs_header').innerHTML = 'Next level (' + (parseInt(buildingLevels[buildingToUpgrade]) + 1) + ') - Costs';
        document.getElementById('upgrade_window_header_level').innerHTML = '(Level ' + buildingLevels[buildingToUpgrade] + ')';

        var percentage = buildings[buildingToUpgrade]['levels'][1]['points'] / buildings[buildingToUpgrade]['maxPoints'] * 100;
        document.getElementById('upgrade_window_points_slider').style.width = percentage + '%';

        percentage = buildings[buildingToUpgrade]['levels'][1]['production'] / buildings[buildingToUpgrade]['maxProduction'] * 100;
        document.getElementById('upgrade_window_production_slider').style.width = percentage + '%';
    }

    function upgradeBuilding() {
        if (buildingToUpgrade <= 0) return;

        $.ajax({
            data: 'city_id=' + city_id + "&building_id=" + buildingToUpgrade,
            url: 'scripts/upgrade_building.php',
            method: 'POST', // or GET
            success: function(data) {
                if (data === "success") {
                    window.location = "?";
                }
                console.log(data);
            }
        });

        exitUpgradeWindow();
        buildingToUpgrade = -1;
    }
</script>

<!-- Upgrade window -->
<div id="upgrade_window" style="position: absolute; display: none; width: 100%; height: 100%; margin: 0;">
    <div style="position: absolute; background-color: rgba(1, 1, 1, .6); margin: 0; width: 100%; height: 100%; z-index: 5;">

    </div>
    <div style="position: absolute; width: 100%; height: 100%; display: table; z-index: 10;">
        <div style="display: table-cell; vertical-align: middle;">
            <div style=" width: 544px; background-color: white; border-radius: 10px; margin-left: auto; margin-right: auto;">
                <div style="width: 100%; background-color: #eeeeee; border-top-left-radius: 10px; border-top-right-radius: 10px; height: 50px; border-bottom: 1px solid #dddddd;">
                    <div id="exit_upgrade_window" onclick="exitUpgradeWindow()" style="cursor: pointer; float: right; width: 50px; height: 50px;">
                        <p style="text-align: center">X</p>
                    </div>
                    <p id="upgrade_window_header" style="margin: 0; padding-left: 18px; display: inline-block; font-size: 16px; line-height: 50px;">Timber Camp</p>
                    <p id="upgrade_window_header_level" style="margin: 0; display: inline-block; padding-left: 5px;">(Level 10 +1)</p>
                </div>
                <div style="width: 100%; padding: 8px;">
                    <div style="display: inline-block; width: 132px; height: 132px; box-shadow: #aaaaaa 0 0 2px;">

                    </div><div style="display: inline-block; vertical-align: top; width: calc(544px - 3 * 8px - 132px); margin-left: 8px;">
                        <p id="upgrade_window_description" style="margin: 0;">This is a description of the building you are upgrading!</p>
                        <div style="box-shadow: #aaaaaa 0 0 2px; width: 100%; margin: 8px 0; border-radius: 5px; overflow: hidden;">
                            <div style="height: 40px; border-bottom: 1px solid #dddddd;">
                                <p style="margin: 0; padding-left: 10px; line-height: 40px;">Points gained</p>
                            </div>
                            <div style="border-right: 1px solid #dddddd; width: 100%; height: 40px; background-color: #f0f0f0; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">
                                <div id="upgrade_window_points_slider" style="width: 50%; height: 100%; background-color: mediumseagreen;">

                                </div>
                                <p id="upgrade_window_points_gained" style="text-align: center; margin-top: -40px; padding: 10px;">132</p>

                            </div>
                        </div>
                        <div style="box-shadow: #aaaaaa 0 0 2px; width: 100%; margin-bottom: 8px; border-radius: 5px; overflow: hidden;">
                            <div style="height: 40px; border-bottom: 1px solid #dddddd;">
                                <p style="margin: 0; padding-left: 10px; line-height: 40px;">Production</p>
                            </div>
                            <div style="border-right: 1px solid #dddddd; width: 100%; height: 40px; background-color: #f0f0f0; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">
                                <div id="upgrade_window_production_slider" style="width: 50%; height: 100%; background-color: mediumseagreen;">

                                </div>
                                <p id="upgrade_window_production" style="text-align: center; margin-top: -40px; padding: 10px;">132</p>

                            </div>
                        </div>
                        <div style="box-shadow: #aaaaaa 0 0 2px; width: 100%; border-radius: 5px;">
                            <div style="height: 40px; border-bottom: 1px solid #dddddd;">
                                <p id="upgrade_window_next_level_costs_header" style="margin: 0; padding-left: 10px; line-height: 40px;">Next level (2) - Costs</p>
                            </div>
                            <div style="width: 25%; display: inline-block; border-right: 1px solid #dddddd;">
                                <img src="../images/wood.png" style="width: 40px; height: 40px; vertical-align: middle;">
                                <p id="upgrade_window_cost_wood" style="display: inline-block; margin: 0; vertical-align: middle;">60000</p>
                            </div><div style="width: calc(25% - 1px); display: inline-block; border-right: 1px solid #dddddd;">
                                <img src="../images/clay.png" style="width: 40px; height: 40px; vertical-align: middle;">
                                <p id="upgrade_window_cost_clay" style="display: inline-block; margin: 0; vertical-align: middle;">60000</p>
                            </div><div style="width: calc(25% - 1px); display: inline-block; border-right: 1px solid #dddddd;">
                                <img src="../images/iron.png" style="width: 40px; height: 40px; vertical-align: middle;">
                                <p id="upgrade_window_cost_iron" style="display: inline-block; margin: 0; vertical-align: middle;">60000</p>
                            </div><div style="width: calc(25% - 1px); display: inline-block;">
                                <img src="../images/wheat.png" style="width: 40px; height: 40px; vertical-align: middle;">
                                <p id="upgrade_window_cost_wheat" style="display: inline-block; margin: 0; vertical-align: middle;">60000</p>
                            </div>
                        </div>
                    </div>
                    <div onclick="upgradeBuilding()" style="cursor: pointer; width: calc(100% - 2 * 8px); background-color: dodgerblue; margin-top: 8px; color: white; height: 50px; border-radius: 5px;">
                        <p style="margin: 0; line-height: 50px; text-align: center; font-size: 20px;">Upgrade building!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<p><?php echo $city['name']; ?></p>
<p>Wood: <?php echo $city['ress_wood']; ?></p>
<p>Clay: <?php echo $city['ress_clay']; ?></p>
<p>Iron: <?php echo $city['ress_iron']; ?></p>
<p>Wheat: <?php echo $city['ress_wheat']; ?></p>
<div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div onclick="openUpgradeWindow(<?php echo $GLOBALS['BuildingID']['WoodFarm'] ?>)" style="cursor: pointer; width: 100px; height: 100px;">
        <p style="text-align: center; margin: 0; line-height: 100px;">Upgrade</p>
    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Timber<br>Level: <?php echo $city['levels']['Timber Camp']; ?></p>
    </div>
</div><div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div style="width: 100px; height: 100px;">

    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Clay Pit<br>Level: <?php echo $city['levels']['Clay pit']; ?></p>
    </div>
</div><div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div style="width: 100px; height: 100px;">

    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Iron Mines<br>Level: <?php echo $city['levels']['Iron mines']; ?></p>
    </div>
</div><div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div style="width: 100px; height: 100px;">

    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Wheat Field<br>Level: <?php echo $city['levels']['Wheat field']; ?></p>
    </div>
</div>

<br><br><br><br>
<p>TODO:</p>
<ul>
    <li>Red text if no item</li>
    <li>Map</li>
    <li>Update ressources automatically</li>
    <li>Produce resources</li>
</ul>
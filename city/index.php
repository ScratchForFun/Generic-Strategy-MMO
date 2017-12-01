<?php

include "scripts/load_city.php";
$city = loadCity(0, 0);

$levels = getCityBuildingLevels(1);
echo (count($levels));

?>

<p><?php echo $city['name']; ?></p>
<p>Wood: <?php echo $city['ress_wood']; ?></p>
<p>Clay: <?php echo $city['ress_clay']; ?></p>
<p>Iron: <?php echo $city['ress_iron']; ?></p>
<p>Wheat: <?php echo $city['ress_wheat']; ?></p>
<div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div style="width: 100px; height: 100px;">
        <p style="text-align: center; margin: 0; line-height: 100px;">Upgrade</p>
    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Wood<br>Level: <?php echo $city['level']['wood']; ?></p>
    </div>
</div><div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div style="width: 100px; height: 100px;">

    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Clay<br>Level: <?php echo $city['level']['clay pit']; ?></p>
    </div>
</div><div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div style="width: 100px; height: 100px;">

    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Iron<br>Level: <?php echo $city['level']['iron']; ?></p>
    </div>
</div><div style="width: 100px; height: 150px; box-shadow: #acacac 0 1px 2px; border-radius: 5px; margin-right: 10px; display: inline-block;">
    <div style="width: 100px; height: 100px;">

    </div><div style="width: 100px; background-color: #dddddd; height: 1px;"></div>
    <div style="width: 100px; height: 49px;">
        <p style="margin-top: 6px; padding: 0 10px 0 10px;">Wheat<br>Level: <?php echo $city['level']['wheat']; ?></p>
    </div>
</div>
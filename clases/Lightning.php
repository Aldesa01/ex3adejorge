<?php
require_once 'Connection.php';
require_once 'Lamp.php';
class Lightning extends Connection {

    public function getAllLamps() {
        $sql = "SELECT lamps.lamp_id, lamps.lamp_name, lamp_on,
        lamp_models.model_part_number,lamp_models.model_wattage,
        zones.zone_name FROM lamps INNER JOIN lamp_models ON
        lamps.lamp_model=lamp_models.model_id INNER JOIN zones ON
        lamps.lamp_zone = zones.zone_id ORDER BY lamps.lamp_id;";
        $stmt = $this->getConn()->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lamps = [];

        foreach ($result as $row) {
            $lamp = new Lamp (
                $row['lamp_id'],
                $row['lamp_name'],
                $row['lamp_on'],
                $row['model_part_number'],
                $row['model_wattage'],
                $row['zone_name']
            );
            $lamps[] = $lamp;
        }
        return $lamps;
        }

        public function drawLampsList() {
            $lamps = $this->getAllLamps();

            echo '<div class="center">
            <h1>BIG STADIUM - LIGHTING CONTROL PANEL</h1>
            <form action="" method="post">
                <select name="filter">
                    <option value="all">All</option>
                    <option value="1">Fondo Norte</option>
                    <option value="2">Fondo Sur</option>
                    <option value="3">Grada Este</option>
                    <option value="4">Grada Oeste</option>
                </select>
                <input type="submit" value="Filter by zone">
            </form>';

            foreach ($lamps as $row) {
                $name = $row->getLampName();
                $on = $row->getLampOn();
                $wattage = $row->getLampWattage();
                $zone = $row->getLampZone();

                if ($on == 1) { echo "<div class='element on'><h4><img src='img/bulb-icon-on.png'>". $name ."</h4><h1>". $wattage ."W.</h1><h4>". $zone ."</h4></div>"; } 
                else { echo "<div class='element off'><h4><img src='img/bulb-icon-off.png'>". $name ."</h4><h1>". $wattage ."W.</h1><h4>". $zone ."</h4></div>"; }
            }
        }

    public function getPotenciaZona() {
        $sql = "SELECT SUM(lamp_models.model_wattage) as power, zone_name FROM
        lamps INNER JOIN lamp_models on
        lamp_model=lamp_models.model_id INNER JOIN zones on 
        lamps.lamp_zone = zones.zone_id WHERE lamps.lamp_on = 1
        GROUP BY zone_id, zone_name;";
        $stmt = $this->getConn()->query($sql);
        $powers = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $powers[$result['zone_name']] = $result['power'];
        }
        return $powers;
    }
        public function drawPotenciaZona(){
            $power = $this->getPotenciaZona();
            foreach ($power as $zone => $powers){
            echo "<div class='center'><h4>". $zone .": ". $powers ."W.</h4></div>" ;
            }
}
}
?>
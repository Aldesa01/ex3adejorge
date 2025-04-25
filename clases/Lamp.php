<?php
class Lamp {
    private $lamp_id;
    private $lamp_name;
    private $lamp_on;
    private $lamp_model;
    private $lamp_wattage;
    private $lamp_zone;

    public function __construct($lamp_id, $lamp_name, $lamp_on, $lamp_model, $lamp_wattage, $lamp_zone) {
        $this->lamp_id = $lamp_id;
        $this->lamp_name = $lamp_name;
        $this->lamp_on = $lamp_on;
        $this->lamp_model = $lamp_model;
        $this->lamp_wattage = $lamp_wattage;
        $this->lamp_zone = $lamp_zone;
    }

    public function getLampId() {
        return $this->lamp_id;
    }

    public function getLampName() {
        return $this->lamp_name;
    }

    public function getLampOn() {
        return $this->lamp_on;
    }

    public function getLampModel() {
        return $this->lamp_model;
    }

    public function getLampWattage() {
        return $this->lamp_wattage;
    }

    public function getLampZone() {
        return $this->lamp_zone;
    }
}
?>
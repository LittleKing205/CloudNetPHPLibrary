<?php
namespace CloudNetLibrary\Interfaces;

class Player {
    private $rawData;
    
    public function __construct($rawJsonObject) {
        $this->rawData = $rawJsonObject;
    }
    
    public function getName() {
        return $this->rawData["name"];
    }
    
    public function getUuid() {
        return $this->rawData["uniqueId"];
    }
    
    public function getHealth() {
        return $this->rawData["health"];
    }
    
    public function getMaxHealth() {
        return $this->rawData["maxHealth"];
    }
    
    public function getSaturation() {
        return $this->rawData["saturation"];
    }
    
    public function getLevel() {
        return $this->rawData["level"];
    }
    
    public function getPosition() {
        return $this->rawData["location"];
    }
    
    public function getHostAdress() {
        return $this->rawData["adress"]["host"];
    }
    
    public function getHostPort() {
        return $this->rawData["adress"]["port"];
    }
}


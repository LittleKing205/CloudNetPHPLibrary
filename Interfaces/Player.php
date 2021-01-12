<?php
namespace CloudNetLibrary\Interfaces;

class Player {
    private $rawData;
    
    public function __construct($rawJsonObject) {
        $this->rawData = $rawJsonObject;
    }
    
    /**
     * @return mixed
     */
    public function getRawJsonObject() {
        return $this->rawData;
    }
    
    /**
     * @return string
     */
    public function getName() {
        return $this->rawData["name"];
    }
    
    /**
     * @return string
     */
    public function getUuid() {
        return $this->rawData["uniqueId"];
    }
    
    /**
     * @return int
     */
    public function getHealth() {
        return $this->rawData["health"];
    }
    
    /**
     * @return int
     */
    public function getMaxHealth() {
        return $this->rawData["maxHealth"];
    }
    
    /**
     * @return int
     */
    public function getSaturation() {
        return $this->rawData["saturation"];
    }
    
    /**
     * @return int
     */
    public function getLevel() {
        return $this->rawData["level"];
    }
    
    /**
     * @return mixed
     */
    public function getPosition() {
        return $this->rawData["location"];
    }
    
    /**
     * @return string
     */
    public function getHostAdress() {
        return $this->rawData["adress"]["host"];
    }
    
    /**
     * @return int
     */
    public function getHostPort() {
        return $this->rawData["adress"]["port"];
    }
}


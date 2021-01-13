<?php
namespace CloudNetLibrary\Interfaces;

class Task {
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
        return $this->getRawJsonObject()["name"];
    }
    
    /**
     * @return string
     */
    public function getRuntime() {
        return $this->getRawJsonObject()["runtime"];
    }
    
    /**
     * @return bool
     */
    public function getAutoDeleteOnStop() {
        return $this->getRawJsonObject()["autoDeleteOnStop"];
    }
    
    /**
     * @return bool
     */
    public function getStaticServices() {
        return $this->getRawJsonObject()["staticServices"];
    }
    
    /**
     * @return string
     */
    public function getEnvironment() {
        return $this->getRawJsonObject()["processConfiguration"]["environment"];
    }
    
    public function isGameserver() {
        if ($this->getEnvironment() == "MINECRAFT_SERVER" || $this->getEnvironment() == "GLOWSTONE" || $this->getEnvironment() == "NUKKIT")
            return true;
            return false;
    }
    
    public function isProxy() {
        if ($this->getEnvironment() == "BUNGEECORD" || $this->getEnvironment() == "VELOCITY" || $this->getEnvironment() == "WATERDOG")
            return true;
            return false;
    }
}


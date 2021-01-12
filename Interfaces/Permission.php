<?php
namespace CloudNetLibrary\Interfaces;

class Permission {
    private $rawData;
    
    public function __construct($rawJsonObject) {
        $this->rawData = $rawJsonObject;
    }
    
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
     * @return int
     */
    public function getPotency() {
        return $this->rawData["potency"];
    }
    
    /**
     * @return integer
     */
    public function getTimeoutMillis() {
        return $this->rawData["timeOutMillis"];
    }
}


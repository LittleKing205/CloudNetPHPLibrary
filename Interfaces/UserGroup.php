<?php
namespace CloudNetLibrary\Interfaces;

class UserGroup {
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
        return $this->getRawJsonObject()["group"];
    }
    
    /**
     * @return integer
     */
    public function getTimeoutMillis() {
        return $this->getRawJsonObject()["timeOutMillis"];
    }
    
    /**
     * @return mixed
     */
    public function getProperties() {
        return $this->getRawJsonObject()["properties"];
    }
}


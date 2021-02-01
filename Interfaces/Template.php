<?php
namespace CloudNetLibrary\Interfaces;

class Template {
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
     * @param mixed
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setRawJsonObject($json) {
        $this->rawData = $json;
    }
    
    /**
     * @return string
     */
    public function getPrefix() {
        return $this->getRawJsonObject()["prefix"];
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
    public function getStorage() {
        return $this->getRawJsonObject()["storage"];
    }
    
    /**
     * @return boolean
     */
    public function getAlwaysCopyToStaticServices() {
        return $this->getRawJsonObject()["alwaysCopyToStaticServices"];
    }
    
    //TODO: Add Set/Get Files && Set/Get Folder
}

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
     * @param mixed
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setRawJsonObject($json) {
        $this->rawData = $json;
    }
    
    /**
     * @return string
     */
    public function getName() {
        return $this->getRawJsonObject()["name"];
    }
    
    /**
     * @param string $name
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setName($name) {
        $this->rawData["name"] = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getRuntime() {
        return $this->getRawJsonObject()["runtime"];
    }
    
    /**
     * @param string $runtime
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setRuntime($runtime) {
        $this->rawData["runtime"] = $runtime;
        return $this;
    }
    
    /**
     * @return boolean
     */
    public function getMaintenance() {
        return $this->getRawJsonObject()["maintenance"];
    }
    
    /**
     * @param boolean $maintenance
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setMaintenance($maintenance) {
        $this->rawData["maintenance"] = $maintenance;
        return $this;
    }
    
    /**
     * @return bool
     */
    public function getAutoDeleteOnStop() {
        return $this->getRawJsonObject()["autoDeleteOnStop"];
    }
    
    /**
     * @param bool $deleteOnStop
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setAutoDeleteOnStop($deleteOnStop) {
        $this->rawData["autoDeleteOnStop"] = $deleteOnStop;
        return $this;
    }
    
    /**
     * @return bool
     */
    public function getStaticServices() {
        return $this->getRawJsonObject()["staticServices"];
    }
    
    /**
     * @param bool $staticService
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setStaticServices($staticService) {
        $this->rawData["staticServices"] = $staticService;
        return $this;
    }
    
    /**
     * @return string[]
     */
    public function getGroups() {
        return $this->getRawJsonObject()["groups"];
    }
    
    /**
     * @param string[] $groupArray
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setGroups($groupArray) {
        $this->rawData["groups"] = $groupArray;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEnvironment() {
        return $this->getRawJsonObject()["processConfiguration"]["environment"];
    }
    
    /**
     * @param String $enviroment
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setEnviroment($enviroment) {
        $this->rawData["processConfiguration"]["environment"] = $enviroment;
        return $this;
    }
    
    /**
     * @return integer
     */
    public function getMaxHeapMemorySize() {
        return $this->getRawJsonObject()["processConfiguration"]["maxHeapMemorySize"];
    }
    
    /**
     * @param integer $maxSizeMB
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setMaxHeapMemorySize($maxSizeMB) {
        $this->rawData["processConfiguration"]["maxHeapMemorySize"] = $maxSizeMB;
        return $this;
    }
    
    /**
     * @return integer
     */
    public function getStartPort() {
        return $this->getRawJsonObject()["startPort"];
    }
    
    /**
     * @param integer $startPort
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setStartPort($startPort) {
        $this->rawData["startPort"] = $startPort;
        return $this;
    }
    
    /**
     * @return integer
     */
    public function getMinServiceCount() {
        return $this->getRawJsonObject()["minServiceCount"];
    }
    
    /**
     * @param integer $minServiceCount
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setMinServiceCount($minServiceCount) {
        $this->rawData["minServiceCount"] = $minServiceCount;
        return $this;
    }
    
    /**
     * @return \CloudNetLibrary\Interfaces\Template
     */
    public function getTemplate() {
        return new Template($this->getRawJsonObject()["templates"][0]);
    }
    
    /**
     * @param Template $template
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setTemplate($template) {
        $this->rawData["templates"][0] = $template->getRawJsonObject();
        return $this;
    }
    
    //TODO: Set and Get SmartConfig if Interface exists
    
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

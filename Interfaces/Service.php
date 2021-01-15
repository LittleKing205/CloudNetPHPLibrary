<?php
namespace CloudNetLibrary\Interfaces;

class Service {
    private $rawData;
    
    public function __construct($rawJsonObject) {
        $this->rawData = $rawJsonObject;
    }
    
    public function getRawJsonObject() {
        return $this->rawData;
    }
    
    public function getServiceName() {
        return $this->rawData["serviceId"]["taskName"]."-".$this->rawData["serviceId"]["taskServiceId"];
    }
    
    public function getServiceUuid() {
        return $this->rawData["serviceId"]["uniqueId"];
    }
    
    public function getTaskName() {
        return $this->rawData["serviceId"]["taskName"];
    }
    
    public function getEnvironment() {
        return $this->rawData["serviceId"]["environment"];
    }
    
    public function getStatus() {
        return $this->rawData["lifeCycle"];
    }
    
    public function getMotd() {
        return $this->rawData["properties"]["Motd"];
    }
    
    public function getTaskId() {
        return $this->rawData["serviceId"]["taskServiceId"];
    }
    
    public function getPlugins() {
        return $this->rawData["properties"]["Plugins"];
    }
    
    public function getPluginCount() {
        return count($this->rawData["properties"]["Plugins"]);
    }
    
    public function getOnlinePlayerCount() {
        return $this->rawData["properties"]["Online-Count"];
    }
    
    public function getMaxPlayer() {
        return $this->rawData["properties"]["Max-Players"];
    }
    
    public function getHost() {
        return $this->rawData["address"]["host"];
    }
    
    public function getPort() {
        return $this->rawData["address"]["port"];
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
    
    public function isRunning() {
        if ($this->getStatus() == "RUNNING")
            return true;
        return false;
    }
    
    public function getHeapUsageMemory() {
        return $this->rawData["processSnapshot"]["heapUsageMemory"];
    }
    
    public function getMaxHeapMemory() {
        return $this->rawData["processSnapshot"]["maxHeapMemory"];
    }
    
    public function getCpuUsage() {
        return $this->rawData["processSnapshot"]["cpuUsage"];
    }
    
    /**
     * @return \CloudNetLibrary\Interfaces\Player[]
     */
    public function getPlayer() {
        $ret = array();
        foreach ($this->rawData["properties"]["Players"] as $playerData)
            $ret[] = new Player($playerData);
        return $ret;
    }
}


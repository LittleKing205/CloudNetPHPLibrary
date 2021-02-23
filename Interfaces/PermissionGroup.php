<?php
namespace CloudNetLibrary\Interfaces;

class PermissionGroup {
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
     * @return boolean
     */
    public function isDefaultGroup() {
        return $this->rawData["defaultGroup"];
    }
    
    /**
     * @return integer
     */
    public function getSortId() {
        return $this->rawData["sortId"];
    }
    
    /**
     * @return string
     */
    public function getPrefix() {
        return $this->rawData["prefix"];
    }
    
    /**
     * @return string
     */
    public function getColor() {
        return $this->rawData["color"];
    }
    
    /**
     * @return string
     */
    public function getSuffix() {
        return $this->rawData["suffix"];
    }
    
    /**
     * @return string
     */
    public function getDisplay() {
        return $this->rawData["display"];
    }
    
    /**
     * @return Permission[]
     */
    public function getPermissions() {
        $ret = array();
        foreach ($this->rawData["permissions"] as $perm)
            $ret[] = new Permission($perm);
        return $ret;
    }
    
    public function getGroupPermissions() {
        $ret = array();
        foreach($this->rawData["groupPermissions"] as $groupName => $group) {
            foreach($group as $permission) {
                $ret[$groupName][] = new Permission($permission);
            }
        }
        return $ret;
    }
}
/*

            $ret[$data["name"]]["name"] = $data["name"];
            $ret[$data["name"]]["potency"] = $data["potency"];
            $ret[$data["name"]]["default"] = $data["defaultGroup"];
            $ret[$data["name"]]["sortId"] = $data["sortId"];
            $ret[$data["name"]]["prefix"] = $data["prefix"];
            $ret[$data["name"]]["color"] = $data["color"];
            $ret[$data["name"]]["suffix"] = $data["suffix"];
            $ret[$data["name"]]["display"] = $data["display"];
            $ret[$data["name"]]["permissions"] = array();
            foreach ($data["permissions"] as $permission)
                $ret[$data["name"]]["permissions"][] = new Permission($permission);
            $ret[$data["name"]]["groupPermissions"] = array();
            foreach ($data["groupPermissions"] as $groupName => $permission)
                $ret[$data["name"]]["groupPermissions"][$groupName] = new Permission($permission);
                
                
                */
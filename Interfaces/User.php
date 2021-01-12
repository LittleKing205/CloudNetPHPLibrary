<?php
namespace CloudNetLibrary\Interfaces;

class User {
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
    
    public function getUuid() {
        return $this->getRawJsonObject()["uniqueId"];
    }
    
    /**
     * @return UserGroup[]
     */
    public function getUserGroups() {
        $ret = array();
        foreach ($this->getRawJsonObject()["groups"]as $group)
            $ret[] = new UserGroup($group);
        return $ret;
    }
    
    /**
     * @return boolean
     */
    public function isRegistred() {
        if ($this->getRawJsonObject()["hashedPassword"] == "")
            return false;
        return true;
    }
    
    /**
     * @return integer
     */
    public function getCreatedTime() {
        return $this->getRawJsonObject()["createdTime"];
    }
    
    /**
     * @return string
     */
    public function getName() {
        return $this->getRawJsonObject()["name"];
    }
    
    /**
     * @return int
     */
    public function getPotency() {
        return $this->getRawJsonObject()["potency"];
    }
    
    /**
     * @return Permission[]
     */
    public function getUserPermissions() {
        $ret = array();
        foreach($this->getRawJsonObject()["permissions"] as $permission)
            $ret[] = new Permission($permission);
        return $ret;
    }
    
    /** @return Permission[][] */
    public function getGroupPermissions() {
        $ret = array();
        foreach ($this->getRawJsonObject()["groupPermissions"] as $groupName => $permission)
            $ret[$groupName][] = new Permission($permission);
        $ret;
    }
    
    /**
     * @return Permission[]
     */
    public function getAllIndividualPermissions() {
        return $this->getUserPermissions();
    }
    
    /**
     * @return mixed
     */
    public function getProperties() {
        return $this->getRawJsonObject()["properties"];
    }
}


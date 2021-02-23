<?php
namespace CloudNetLibrary\ExtraModul;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Utils\CurlHandler;
use CloudNetLibrary\Interfaces\Permission;

/**
 * Der DB Endpoint des CloudNet Server Systems
 * @author Pascal Schreiber
 */
class Permissions {
    
    /** @var CloudNetLibrary */
    private $library;
    
    public function __construct($library) {
        $this->library = $library;
    }
    
    /**
     * Gibt die angegebene Tabelle zurück
     * permission: 
     * @return mixed
     */
    public function getAllPermissions() {
        $datas = json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/permissions/"), true);
        $ret = array();
        foreach ($datas as $data) {
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
        }
        return $ret;
    }
}


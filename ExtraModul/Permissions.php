<?php
namespace CloudNetLibrary\ExtraModul;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Interfaces\PermissionGroup;
use CloudNetLibrary\Utils\CurlHandler;

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
     * @return PermissionGroup[]
     */
    public function getAllPermissions() {
        $datas = json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/permissions/"), true);
        $ret = array();
        foreach ($datas as $data) {
            $ret[] = new PermissionGroup($data);
        }
        return $ret;
    }
    
    /**
     * Gibt die angegebene Tabelle zurück
     * permission:
     * @return PermissionGroup[]
     */
    public function getAllPermissionsSortedByGroups() {
        $datas = json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/permissions/"), true);
        $ret = array();
        foreach ($datas as $data) {
            $ret[$data["name"]] = new PermissionGroup($data);
        }
        return $ret;
    }
}


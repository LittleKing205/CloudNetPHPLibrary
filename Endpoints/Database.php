<?php
namespace CloudNetLibrary\Endpoints;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Utils\CurlHandler;
use CloudNetLibrary\Interfaces\User;

/**
 * Der DB Endpoint des CloudNet Server Systems
 * @author Pascal Schreiber
 */
class Database {
    
    /** @var CloudNetLibrary */
    private $library;
    
    public function __construct($library) {
        $this->library = $library;
    }
    
    /**
     * Gibt die angegebene Tabelle zurück
     * permission: cloudnet.http.v1.database
     * @param string $table
     * @return mixed
     */
    public function getTable($table) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/db/".$table), true);
    }
    
    /**
     * Gibt eine Zeile einer Tabelle zurück
     * permission: cloudnet.http.v1.database
     * @param string $table
     * @param string $key
     * @return mixed
     */
    public function getData($table, $key) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/db/".$table."/".$key), true);
    }
    
    /**
     * Gibt die User Tabelle zurück.
     * permission: cloudnet.http.v1.database
     * @return User[]
     */
    public function getUserTable() {
        $ret = array();
        foreach ($this->getTable("cloudnet_permission_users") as $user)
            $ret[] = new User($user);
        return $ret;
    }
    
    /**
     * Gibt einen User aus der User Tabelle aus
     * permission: cloudnet.http.v1.database
     * @return User
     */
    public function getUserFromTable($uuid) {
        return new User($this->getData("cloudnet_permission_users", $uuid));
    }
}


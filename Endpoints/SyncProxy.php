<?php
namespace CloudNetLibrary\Endpoints;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Utils\CurlHandler;

/**
 * Der Command Endpoint des CloudNet Server Systems
 * @author Pascal Schreiber
 */
class SyncProxy {
    
    /** @var CloudNetLibrary */
    private $library;
    
    public function __construct($library) {
        $this->library = $library;
    }
    
    /**
     * Gibt die SyncProxy Config Datei zurück.
     * permission: cloudnet.http.v1.modules.syncproxy.config
     * @param string $command
     * @return mixed
     */
    public function getCompleteConfiguration() {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/modules/syncproxy/config"), true);
    }
    
    /**
     * Speichert die SyncConfig Datei af dem Server
     * permission: cloudnet.http.v1.command
     * @param string $command
     * @return mixed
     */
    public function saveCompleteConfiguration($jsonData) {
        $data = array(
            CURLOPT_POSTFIELDS => json_encode($jsonData)
        );
        print_r( json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/modules/syncproxy/config", "POST", $data), true) );
        //exit();
    }
}


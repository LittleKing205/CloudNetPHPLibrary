<?php
namespace CloudNetLibrary\Functions;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Utils\CurlHandler;
use CloudNetLibrary\Endpoints\Command;

/**
 * Der Services Endpoint des CloudNet Server Systems
 * @author Pascal Schreiber
 */
class Services {
    
    /** @var CloudNetLibrary */
    private $library;
    /** @var Command */
    private $commandEndpoint;
    
    public function __construct($library) {
        $this->library = $library;
    }
    
    /**
     * Erhalte alle Services mit sämtlichen Informationen
     * @return mixed
     */
    public function listServices() {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services"), true);
    }
    
    /**
     * Erhalte alle Informationen eines Services
     * @param string $uuid
     * @return mixed
     */
    public function getService($uuid) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services/".$uuid), true);
    }
    
    /**
     * Erstellt ein Service anhand eines Tasks
     * Permission: cloudnet.http.v1.command
     * @param String $taskName
     */
    public function createService($taskName, $ammount = 1 ,$startImmediately = false) {
        $startParam = "";
        if ($startImmediately)
            $startParam = " --start";
        return $this->getCommandEndpoint()->sendCommand("create by ".$taskName." ".$ammount.$startParam);
    }
    
    /**
     * Startet ein Service
     * Permission: cloudnet.http.v1.services
     * @param string $uuid
     * @return mixed
     */
    public function startService($uuid) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services/".$uuid."/start"), true);
    }
    
    /**
     * Stopt ein Service und löscht ihn, falls dies in der Task angegeben ist
     * Permission: cloudnet.http.v1.services
     * @param string $uuid
     * @return mixed
     */
    public function stopService($uuid) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services/".$uuid."/stop"), true);
    }
    
    /**
     * Startet einen Servie neu
     * Permission: cloudnet.http.v1.services.operation
     * @param string $uuid
     * @return mixed
     */
    public function restartService($uuid) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services/".$uuid."/restart"), true);
    }
    
    /**
     * Erhalte den Log des Servers
     * Permission: cloudnet.http.v1.services.operation
     * @param string $uuid
     * @return string
     */
    public function getLog($uuid) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services/".$uuid."/log_json"), true);
    }
    
    /**
     * Führt ein befehl auf dem angegebenen Server aus
     * Permission: cloudnet.http.v1.command
     * @param string $uuid Serivce ID
     * @param string $command Server Command
     */
    public function sendServerCommand($uuid, $command) {
        $service = $this->getService($uuid);
        $serviceName = $service["serviceId"]["taskName"]."-".$service["serviceId"]["taskServiceId"];
        return $this->getCommandEndpoint()->sendCommand("service ".$serviceName." command ".$command);
    }
    
    private function getCommandEndpoint() {
        if ($this->commandEndpoint == null)
            $this->commandEndpoint = new Command($this->library);
        return $this->commandEndpoint;
    }
}
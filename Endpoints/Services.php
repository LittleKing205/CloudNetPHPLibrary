<?php
namespace CloudNetLibrary\Endpoints;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Utils\CurlHandler;
use CloudNetLibrary\Interfaces\Service;

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
     * @return Service[]
     */
    public function listServices() {
        $ret = array();
        $datas = json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services"), true);
        foreach ($datas as $data)
            $ret[] = new Service($data);
        return $ret;
    }
    
    /**
     * Erhalte alle Informationen eines Services
     * @param string $uuid
     * @return Service
     */
    public function getService($uuid) {
        return new Service(json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services/".$uuid), true));
    }
    
    /**
     * Erstellt ein Service anhand eines Tasks
     * Permission: cloudnet.http.v1.command
     * @param String $taskName
     */
    public function createService($taskName, $ammount = 1, $startImmediately = false) {
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
     * Permission: cloudnet.http.v1.command
     * @param string $uuid
     * @return mixed
     */
    public function restartService($uuid) {
        return $this->getCommandEndpoint()->sendCommand("service ".$this->getService($uuid)->getServiceName()." restart");
    }
    
    /**
     * Löscht einen Servie neu
     * Permission: cloudnet.http.v1.services.operation
     * @param string $uuid
     * @return mixed
     */
    public function deleteService($uuid) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/services/".$uuid."/delete"), true);
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
    
    /**
     * Startet eine Command Class instance wenn noch keine erstellt wurde.
     * @return \CloudNetLibrary\Endpoints\Command
     */
    private function getCommandEndpoint() {
        if ($this->commandEndpoint == null)
            $this->commandEndpoint = new Command($this->library);
        return $this->commandEndpoint;
    }
}
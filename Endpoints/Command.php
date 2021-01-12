<?php
namespace CloudNetLibrary\Endpoints;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Utils\CurlHandler;

/**
 * Der Command Endpoint des CloudNet Server Systems
 * @author Pascal Schreiber
 */
class Command {
    
    /** @var CloudNetLibrary */
    private $library;
    
    public function __construct($library) {
        $this->library = $library;
    }
    
    /**
     * Sendet einen Server Command direkt an die CloudNet Console.
     * permission: cloudnet.http.v1.command
     * @param string $command
     * @return mixed
     */
    public function runCommand($command) {
        $data = array(
            CURLOPT_POSTFIELDS => "$command"
        );
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/command", "POST", $data), true)["receivedMessages"];
    }
}


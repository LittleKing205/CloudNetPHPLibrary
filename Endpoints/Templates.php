<?php
namespace CloudNetLibrary\Endpoints;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Interfaces\Template;
use CloudNetLibrary\Utils\CurlHandler;

/**
 * Der Command Endpoint des CloudNet Server Systems
 * @author Pascal Schreiber
 */
class Templates {
    
    /** @var CloudNetLibrary */
    private $library;
    
    public function __construct($library) {
        $this->library = $library;
    }
    
    /**
     * Sendet einen Server Command direkt an die CloudNet Console.
     * permission: cloudnet.http.v1.command
     * @return Template[]
     */
    public function getTemplates() {
        $ret = array();
        foreach (json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/local_templates"), true) as $template)
            $ret[] = new Template($template);
        return $ret;
    }
}


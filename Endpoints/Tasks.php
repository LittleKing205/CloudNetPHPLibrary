<?php
namespace CloudNetLibrary\Endpoints;

use CloudNetLibrary\CloudNetLibrary;
use CloudNetLibrary\Utils\CurlHandler;
use CloudNetLibrary\Interfaces\Task;

/**
 * Der Command Endpoint des CloudNet Server Systems
 * @author Pascal Schreiber
 */
class Tasks {
    
    /** @var CloudNetLibrary */
    private $library;
    
    public function __construct($library) {
        $this->library = $library;
    }
    
    public function listTasks() {
        $ret = array();
        foreach (json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/tasks"), true) as $task)
            $ret[] = new Task($task);
        return $ret;
    }
    
    public function getTask($task) {
        return new Task(json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/tasks/".$task), true));
    }
    
    public function deleteTask($taskName) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/tasks/".$taskName), true);
    }
    
    /* TODO: Test it, how it works */
    public function addTask($taskData) {
        
    }
}


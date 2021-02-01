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
        return new Task(json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/tasks/".strtolower($task)), true)["task"]);
    }
    
    public function deleteTask($taskName) {
        return json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/tasks/".strtolower($taskName), "DELETE"), true);
    }
    
    /* TODO: Test how it's works */
    /** 
     * @param Task $task
     * @return \CloudNetLibrary\Interfaces\Task
     */
    public function setTask($task) {
        $data = array(
            CURLOPT_POSTFIELDS => json_encode($task->getRawJsonObject())
        );
        return new Task(json_decode(CurlHandler::run($this->library->getAuthHandler(), $this->library->getBaseUrl()."/tasks/".strtolower($task->getName()), "POST", $data), true)["task"]);
    }
}


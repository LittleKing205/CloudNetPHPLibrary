<?php
namespace CloudNetLibrary;

use CloudNetLibrary\Utils\AuthHandler;

class CloudNetLibrary {

    /** @var AuthHandler */
    private $authHandler;
    /** @var string */
    private $base_url;
    /** @var string */
    private $version;
    /** @var string */
    private $tmpDir;

    /**
     * @param string $base_url
     * @param string $version
     * @param string $user
     * @param string $password
     * @param string $tmpDir
     */
    public function __construct($base_url, $version, $user, $password, $tmpDir) {
        $this->loadClasses();
        $this->base_url = $base_url;
        $this->version = $version;
        $this->tmpDir = $tmpDir;
        
        $this->authHandler = new AuthHandler($this, $user, $password);
        $this->authHandler->auth();
    }
    
    public static function loadClasses() {
        require_once __DIR__ . "/Utils/AuthHandler.php";
        require_once __DIR__ . "/Utils/CurlHandler.php";
        require_once __DIR__ . "/Endpoints/Command.php";
        require_once __DIR__ . "/Endpoints/Services.php";
        require_once __DIR__ . "/Interfaces/Service.php";
        require_once __DIR__ . "/Interfaces/Player.php";
    } 
    
    /**
     * @return AuthHandler
     */
    public function getAuthHandler() {
        return $this->authHandler;
    }
    
    /**
     * @return string
     */
    public function getBaseUrl() {
        return $this->base_url."/api/".$this->getApiVersion();
    }
    
    /**
     * @return string
     */
    public function getTmpDir() {
        return $this->tmpDir;
    }

    /**
     * @return string
     */
    public function getApiVersion() {
        return $this->version;
    }

    public function close() {
        unlink($_SESSION["CloudNetLibrary_Cookies_File"]);
        unset($_SESSION["CloudNetLibrary_Cookies_File"]);
    }
    
    public function cloudnetautoloader($class) {
        $class = preg_replace("#CloudNetLibrary#", "", $class, 1);
        $class = substr($class, 1, strlen($class)-1);
        $class = str_replace("\\", "/", $class);
        require_once __DIR__ . "\\" . $class . ".php";
    }
}


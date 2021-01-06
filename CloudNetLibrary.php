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
        require_once 'Utils/CurlHandler.php';
        require_once 'Utils/AuthHandler.php';
        require_once 'Endpoints/Services.php';
        require_once 'Endpoints/Command.php';
        
        $this->base_url = $base_url;
        $this->version = $version;
        $this->tmpDir = $tmpDir;
        
        $this->authHandler = new AuthHandler($this, $user, $password);
        $this->authHandler->auth();
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
}


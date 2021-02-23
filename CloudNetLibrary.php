<?php
namespace CloudNetLibrary;

use CloudNetLibrary\Utils\AuthHandler;

/**
 * Main Constructor Class. This is Needed for the Endpoints to Work 
 * @author pascal.schreiber
 */
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
    public function __construct($base_url, $version, $user, $password, $tmpDir = null) {
        $this->loadClasses();
        $this->base_url = $base_url;
        $this->version = $version;
        if ($tmpDir == null)
            $this->tmpDir = sys_get_temp_dir ();
        else
            $this->tmpDir = $tmpDir;
        
        $this->authHandler = new AuthHandler($this, $user, $password);
        $this->authHandler->auth();
    }
    
    public static function loadClasses() {
        require_once __DIR__ . "/Utils/AuthHandler.php";
        require_once __DIR__ . "/Utils/CurlHandler.php";
        
        require_once __DIR__ . "/Endpoints/Command.php";
        require_once __DIR__ . "/Endpoints/Database.php";
        require_once __DIR__ . "/Endpoints/Services.php";
        require_once __DIR__ . "/Endpoints/SyncProxy.php";
        require_once __DIR__ . "/Endpoints/Tasks.php";
        require_once __DIR__ . "/Endpoints/Templates.php";
        
        require_once __DIR__ . "/Enums/Enviroment.php";
        
        require_once __DIR__ . "/Interfaces/Player.php";
        require_once __DIR__ . "/Interfaces/Permission.php";
        require_once __DIR__ . "/Interfaces/PermissionGroup.php";
        require_once __DIR__ . "/Interfaces/Service.php";
        require_once __DIR__ . "/Interfaces/Task.php";
        require_once __DIR__ . "/Interfaces/Template.php";
        require_once __DIR__ . "/Interfaces/User.php";
        require_once __DIR__ . "/Interfaces/UserGroup.php";
        
        require_once __DIR__ . "/ExtraModul/Permissions.php";
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
        include __DIR__ . "\\" . $class . ".php";
    }
}


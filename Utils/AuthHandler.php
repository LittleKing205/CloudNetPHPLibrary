<?php
namespace CloudNetLibrary\Utils;


use CloudNetLibrary\CloudNetLibrary;

class AuthHandler {
    
    /** @var string */
    private $user;
    /** @var string */
    private $password;
    /** @var CloudNetLibrary */
    private $library;
    
    /**
     * @param CloudNetLibrary $library
     * @param string $user
     * @param string $password
     */
    public function __construct($library, $user, $password) {
        $this->user = $user;
        $this->password = $password;
        $this->library = $library;
    }
    
    /**
     * @return boolean
     */
    public function isAuthenticated() {
        if (isset($_SESSION["CloudNetLibrary_Cookies_File"])) {
            if (file_exists($_SESSION["CloudNetLibrary_Cookies_File"])) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * return string[]
     */
    public function getAuthData() {
        return array(
            CURLOPT_COOKIEFILE => $_SESSION["CloudNetLibrary_Cookies_File"],
            CURLOPT_USERPWD => $this->user . ':' . $this->password
        );
    }
    
    public function auth() {
        if ($this->isAuthenticated() == false) {
            $cookie_file = tempnam ($this->library->getTmpDir(), "CURLCOOKIE");
            $_SESSION["CloudNetLibrary_Cookies_File"] = $cookie_file;
            CurlHandler::auth($this->library->getBaseUrl()."/auth", array(
                CURLOPT_COOKIEJAR => $cookie_file,
                CURLOPT_USERPWD => $this->user . ':' . $this->password
            ));
        }
    }
}
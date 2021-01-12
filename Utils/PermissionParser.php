<?php
namespace CloudNetLibrary\Utils;


use CloudNetLibrary\CloudNetLibrary;

class PermissionParser {
    
    /** @var CloudNetLibrary */
    private $library;
    
    /**
     * @param CloudNetLibrary $library
     * @param string $user
     * @param string $password
     */
    public function __construct($library) {
        $this->library = $library;
    }
    
    /*
        * Admin | 100
        Inherits: []
        Default: false | SortId: 10
        Prefix: §4Admin §8| §7
        Color: [color]7
        Suffix: §f
        Display: §4
        Permissions:
        - web.site:0 | Timeout LIFETIME
        
        * Proxy
        - *:0 | Timeout LIFETIME
     */
    
    /**
     *      preg_match #^\* (.*) \| ([0-9]{1,3})$#    // [1] Gruppen name      [2] Potency
     *      preg match #^- (.*):[0-9]{1,3} \| Timeout (.*)$#    // [1] Permission Name      [2] Porency     [3] Timeout  (LIFETIME)
     *      preg_match #^\* (.\w*)$#     // [1] Group Permission Name
     */
}
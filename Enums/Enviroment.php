<?php
namespace CloudNetLibrary\Enums;

class Enviroment {
    
    /** @var string */
    const MINECRAFT_SERVER = "MINECRAFT_SERVER";
    /** @var string */
    const GLOWSTONE = "GLOWSTONE";
    /** @var string */
    const NUKKIT = "NUKKIT";
    /** @var string */
    const BUNGEECORD = "BUNGEECORD";
    /** @var string */
    const VELOCITY = "VELOCITY";
    /** @var string */
    const WATERDOG = "WATERDOG";
    
    /**
     * @return string[]
     */
    public static function getList() {
        $ret = array();
        $ret[] = "MINECRAFT_SERVER";
        $ret[] = "GLOWSTONE";
        $ret[] = "NUKKIT";
        $ret[] = "BUNGEECORD";
        $ret[] = "VELOCITY";
        $ret[] = "WATERDOG";
        return $ret;
    }
    
    /**
     * @param string $enviroment
     * @return boolean
     */
    public static function isValid($enviroment) {
        return in_array($enviroment, self::getList());
    }
}


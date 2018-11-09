<?php
/**
 * Description of conn
 *
 * @author roberto.urrutia
 */
class conn {
    static $_instance;
    
    public function __construct() {
        $this->connect();
    }
    
    private function __clone() {
       
    }
    
    public static function getInstance() {
        if(!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    static function connect() {
        $link = mysqli_connect('localhost', 'adminSM', 'ugalileo$TDS', 'supermercadoweb');
        
        if(!$link) {
            die('Error en la conexión: ' . mysqli_connect_error());
        }
        
        return $link;
    }
}

<?php

namespace src\Decorator;

use \Memcache;

class CacheDecorator 
{
    private static Memcache $mc;


    public static function getInstanse(string $instance = 'default'){
        // if(!isset(self::$list[$instance])) self::$list[$instance] = new self;

        // return self::$list[$instance];
        if(!isset(self::$mc)){
            self::$mc = new Memcache;
            self::$mc->addServer('localhost', 11211);
        }
        return self::$mc;
    }

    private function __construct()
    {
        
    }
    private function __clone(){

    }
    private function __wakeup()
    {
        
    }

    public function set($key, $value) :void {
        $key = md5($key);
        // $this->registry[$key] = $value;
        self::$mc->set($key, $value);
    }

    public function get($key) :array {
        $key = md5($key);
        // if(isset($this->registry[$key])){
        //     return $this->registry[$key];
        // } else {
        //     return [];
        // }
        $cache = self::$mc->get($key); 
        if($cache != null){
            return self::$mc->get($key);
        }
        return [];
    }
}
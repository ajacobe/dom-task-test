<?php
namespace dom\codingChallenge;

class PDOdb{
    protected static $instance = null;

    function __construct(){
        throw new Exception("Don't instantiate throught \"new\" keyword. Use static getInstance method instead.");
    }
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = self::buildObject();
        }
        return self::$instance;
    }
    protected static function buildObject(){
        return new \PDO("sqlite:" . $_ENV['SQLITE_PATH']);
    }
    public static function showErrors(bool $show = true){
        if($show){
            self::getInstance()->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }else{
            self::getInstance()->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
        }
        return self::getInstance();
    }
    public static function hideErrors(){
        return self::showErrors(false);
    }
}
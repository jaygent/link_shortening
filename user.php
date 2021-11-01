<?php
Class User implements iUser,iUse
{
    public static $name;
    public $names;
    public static $age;

    public static function setName($name){
        self::$name=$name;
    }
    public static function getName(){
        echo self::$name;
    }
    public static function setAge($age){
        self::$age=$age;
    }
    public static function getAge(){
        echo self::$age;
    }
    public function setNames($names){
        $this->names=$names;
    }

}

interface iUser
{
    public static function setName($name); // установить имя
    public static function getName();      // получить имя
    public static function setAge($age);   // установить возраст
    public static function getAge();       // получить возраст
}
interface iUse
{
    public function setNames($names); // установить имя

}

User::setName('jaygem');
User::setAge(26);
User::getName();
User::getAge();
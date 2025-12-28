<?php 
class Database{
    private static ?PDO $connection = NULL;
    public static $DatabaseName = "ASSAD";
    private static $UserName = "fadi";
    private static $Host = "127.0.0.1";
    private static $Password = "fadiinsaf";

    private function __construct(){}
    private function __clone(){}

    public static function getConnection():PDO{
        if(self::$connection === NULL){
            try {
                self::$connection = new PDO("mysql:host=" . self::$Host . ";dbname=" . self::$DatabaseName . ";charset=utf8", self::$UserName , self::$Password , [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]);
            }
            catch (PDOException $e){
                die("Database Error : " . $e->getMessage());                
            }
        }
        return self::$connection;
    }
}
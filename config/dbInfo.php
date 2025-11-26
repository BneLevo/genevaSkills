<?php
include CONFIG_PATH . 'dbConnectionInfo.php';

 class Database
 {
     private static $db = null;
     private static $host = DB_HOST;
     private static $db_name = DB_NAME;
     private static $user = DB_USER;
     private static $password = DB_PASSWORD;
     private static $port = DB_PORT;

     private static $option = [

         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Pour capturer les erreurs
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
         // PDO::ATTR_AUTOCOMMIT => false // Désactiver l'auto-commit

     ];

     public static function connexion()
     {

         if (is_null(self::$db) || !self::$db) {

             try {
                 self::$db = new PDO ("mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";port=" . self::$port . ";charset=utf8mb4", self::$user, self::$password, self::$option);
             } catch (PDOException $e) {
                 trigger_error("Erreur connexion :" . $e->getMessage() . "");
             }

         }

         return self::$db;
     }

 }
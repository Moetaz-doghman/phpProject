<?php

class Config {
    private static $pdo = NULL;

    public static function getConnexion() {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=webPhp', 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function executeQuery($sql) {
        $conn = self::getConnexion();
        return $conn->query($sql);
    }

    public static function getLastInsertedId() {
        $conn = self::getConnexion();
        return $conn->lastInsertId();
    }
}

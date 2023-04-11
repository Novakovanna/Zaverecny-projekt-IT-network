<?php

class Databaze
{
 private static PDO $spojeni;

    private static array $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );

    public static function pripoj(string $host, string $uzivatel, string $heslo, string $databaze) : PDO
    {
        if (!isset(self::$spojeni))
        {
            self::$spojeni = @new PDO(
                "mysql:host=$host;dbname=$databaze",
                $uzivatel,
                $heslo,
                self::$nastaveni
            );
        }
        return self::$spojeni;
    }

    public static function dotazVsechny(string $dotaz, array $parametry = array()) : array|bool
    {
    $navrat = self::$spojeni->prepare($dotaz);
    $navrat->execute($parametry);
    return $navrat->fetchAll();
    }

    public static function dotaz(string $dotaz, array $parametry = array()) : PDOStatement
    {
    $navrat = self::$spojeni->prepare($dotaz);
    $navrat->execute($parametry);
    return $navrat;
    }
}

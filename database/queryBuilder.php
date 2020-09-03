<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); //!!!!!

require_once('ini.php');

class queryBuilder
{
    public $pdo;

    function __construct($dsn, $user, $password)
    {
        try {
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            print " base connect Error!: " . $e->getMessage();
            die();
        }
    }

    //получаем все записи/index.php
    function getAll($table) //task
    {

        $statement = $this->pdo->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT 0,10 ");
        //`` NO! ""prepare-внутренний метод PDO
        $statement->execute();                                          //выполнение sql, false || true
        //echo "<br>";
        $result = $statement->fetchAll(2);  //2-(PDO::FETCH_ASSOC)-Извлекает результирующий ряд в виде асс.массива

        return $result;
    }

    function getSpecialTime($table, $time)
    {
        $statement = $this->pdo->prepare("SELECT UNIX
FROM $table
WHERE UNIX>$time");
        $statement->execute();
        $result = $statement->fetchAll(2);
        return $result;
    }

    function store($data)

        //two parameters name of table and data

    {
        $sql = "INSERT INTO `oxu_news` (news,hour,minute,year,mouth,day,difference,UNIX) VALUES (:news,:hour,:minute,:year,:mouth,:day,:difference,:UNIX)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }


}




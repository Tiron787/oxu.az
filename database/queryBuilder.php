<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); //!!!!!

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

        $statement = $this->pdo->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT 0,30 ");
        //`` NO! ""prepare-внутренний метод PDO
        $statement->execute();                                          //выполнение sql, false || true
        //echo "<br>";
        $result = $statement->fetchAll(2);  //2-(PDO::FETCH_ASSOC)-Извлекает результирующий ряд в виде асс.массива
        return $result;
    }

//выбераем время unix поля которое больше $ResultInterval
    function getSpecialTime($table, $ResultInterval)
    {
        $statement = $this->pdo->prepare("SELECT UNIX FROM $table
WHERE UNIX>$ResultInterval");
        $statement->execute();
        $result = $statement->fetchAll(2);
        return $result;
    }

    function getAverageTime($table, $time)
    {
        $statement = $this->pdo->prepare("SELECT difference FROM $table
WHERE UNIX>$time");
        $statement->execute();
        $result = $statement->fetchAll(2);
        return $result;
    }

    /*function parsOneNews($table)
    {
        $statement = $this->pdo->prepare("SELECT newsLink FROM $table LIMIT 1" );

        $statement->execute();
        $result = $statement->fetchAll(2);
        return $result;
    }*/

    function store($data,$table)

        //two parameters name of table and data

    {
        $sql = "INSERT INTO $table (news,hour,minute,year,mouth,day,difference,UNIX,newsLink,Characters,date) VALUES (:news,:hour,:minute,:year,:mouth,:day,:difference,:UNIX,:newsLink,:Characters,:date)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }


}




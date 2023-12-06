<?php

class dbController
{
    //Holds the database instance as a static variable
    protected static $_dbInstance = null;
    //Holds the PDO object
    protected $_dbHandle;


    public function getInstance()
    { //Check if the database instance has been created, if not create one and return it
        $username = '';
        $password = '';
        $host = '';
        $dbName = '';

        if (self::$_dbInstance === null)
        {
            self::$_dbInstance = new self($username, $password, $host, $dbName);
        }
        return self::$_dbInstance;
    }
    private function __construct($username, $password, $host, $database)
    { //Create the PDO object
        try
        {//Try to create the PDO object
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        }
        catch (PDOException $e)
        {//Catch any errors
            echo $e->getMessage();
        }
    }

    public function getConnection()
    { //Return the PDO object
        return $this->_dbHandle;
    }

    public function __destruct()
    { //Set the PDO object to null
        $this->_dbHandle = null;
    }
}
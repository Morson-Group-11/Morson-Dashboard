<?php
require_once 'Models/businessData.php';
require_once 'Models/dbController.php';
class BusinessDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = dbController::getInstance();
        $this->_dbHandle = $this->_dbInstance->getConnection();
    }

    public function fetchAllBusinesses()
    {
        $sqlQuery = "SELECT * FROM business_development";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch())
        {
            $dataSet[] = new BusinessData($row);
        }
        return $dataSet;
    }

    public function fetchBusinessFromMonth($month)
    {
        $sqlQuery = "SELECT * FROM business_development WHERE month = :month";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(":month", $month);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new BusinessData($result);
    }
}
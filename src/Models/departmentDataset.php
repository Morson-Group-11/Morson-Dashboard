<?php
require_once 'Models/businessData.php';
require_once 'Models/dbController.php';
class DepartmentDataset
{
    protected $_dbHandle, $_dbInstance;
    protected $departments = array(
        'business_development',
        'commercial_and_accounts' => null,
        'health_and_safety' => null,
        'human_resources' => null,
        'it_and_systems' => null,
        'it_and_systems_software' => null,
        'it_and_systems_status' => null
    );


    public function __construct()
    {
        $this->_dbInstance = dbController::getInstance();
        $this->_dbHandle = $this->_dbInstance->getConnection();
    }

    public function fetchAllBusinesses()
    {
        foreach ($this->departments as $department => &$value) {
            $sqlQuery = "SELECT * FROM " . $department;
            $statement = $this->_dbHandle->prepare($sqlQuery);
            $statement->execute();

            $value =  $statement->fetch();

        }

        echo $this->departments;
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
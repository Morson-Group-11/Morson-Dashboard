<?php
require_once 'Models/businessData.php';
require_once 'Models/dbController.php';
class DepartmentDataset
{
    protected $_dbHandle, $_dbInstance;
    protected $departments = array(
        'business_development' => null,
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
        foreach ($this->departments as $department => &$value) {
            // Check if the 'month' column exists in the table
            $sqlQuery = "SHOW COLUMNS FROM " . $department . " LIKE 'month'";
            $statement = $this->_dbHandle->prepare($sqlQuery);
            $statement->execute();
            $columnExists = $statement->fetch(PDO::FETCH_ASSOC);

            if ($columnExists) {
                // If the 'month' column exists, execute the query with the WHERE clause on the 'month' column
                $sqlQuery = "SELECT * FROM " . $department . " WHERE month = :month";
                $statement = $this->_dbHandle->prepare($sqlQuery);
                $statement->bindParam(":month", $month);
                $statement->execute();

                $value =  $statement->fetch(PDO::FETCH_ASSOC);
            }
        }

        return $this->departments;
    }
}
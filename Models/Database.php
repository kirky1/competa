<?php


class Database
{
    /**
     * @var Database
     */
    protected static $_dbInstance = null;

    /**
     * @var PDO
     */
    protected $_dbHandle;

    /**
     * @return Database
     */
    public static function getInstance()
    {
        $username ='sgb814';
        $password = 'Kiran1!?';
        $host = 'poseidon.salford.ac.uk';
        $dbName = 'sgb814';

        if(self::$_dbInstance === null)
        {   //checks if the PDO exists
            // creates new instance if not, sending in connection info
            self::$_dbInstance = new self($username, $password, $host, $dbName);
        }

        return self::$_dbInstance;
    }

    /**
     * @param $username
     * @param $password
     * @param $host
     * @param $database
     */
    private function __construct($username, $password, $host, $database)
    {
        try
        {
            // creates the database handle with connection info
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database",
                $username, $password);
        }
        catch (PDOException $e)
        { // catch any failure to connect to the database
            echo $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getdbConnection()
    {
        return $this->_dbHandle; // returns the PDO handle to be used                                        elsewhere
    }

    public function __destruct()
    {
        $this->_dbHandle = null; // destroys the PDO handle when nolonger needed                                        longer needed
    }
}
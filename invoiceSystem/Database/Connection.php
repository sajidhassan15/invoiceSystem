<?php
class Database
{
    private $host;
    private $dbusername;
    private $dppassword;
    private $dbname;


    protected function connect()
    {
        $this->host = 'localhost';
        $this->dbusername = 'root';
        $this->dppassword = '';
        $this->dbname = 'php_crud_db';

        $conn = new mysqli($this->host, $this->dbusername, $this->dppassword, $this->dbname);
        return $conn;
    }
}
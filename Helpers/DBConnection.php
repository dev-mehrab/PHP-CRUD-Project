<?php
/**
 * Summary of DBConnection
 */
class DBConnection{
    private $server_name='localhost';
    private $user_name='root';
    private $password='';
    private $database_name='task_management';

    /**
     * Summary of connect
     * @return PDO|string
     */
    public function connect(){

        try{
            $conn = new PDO("mysql:host=$this->server_name;dbname=$this->database_name", $this->user_name, $this->password );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            return 'Database Connection failed'. $e->getMessage();
        }
    }

}
<?php
    namespace Controller;

    // include('../Helpers/DBConnection.php');
    include(__DIR__.'/../Helpers/DBConnection.php');

    use DBConnection;
    use PDO;
    use PDOException;

    /**
     * Summary of CrudController
     */
    class CrudController{
        /**
         * Summary of conn
         * @var
         */
        private $conn;

        /**
         * Summary of __construct
         */
        public function __construct()
        {
            $conn = new DBConnection();
            $this->conn= $conn->connect();
        }
        /**
         * @param mixed $query

         * @return array|false|string
         */
        public function index($query){
            try{
                $statement = $this->conn->prepare($query);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_OBJ);
                return $statement->fetchAll();
            }catch(PDOException $e){
                return 'Data insert failed' .$e->getMessage();
            }
        }

        /**
         * Summary of storage
         * @param mixed $query
         * @return string
         */
        public function storage($query)
        {
            try{
                $this->conn->query($query);
                return 'Created successfully';
            }catch (PDOException $e) {
                return 'Created fail' .$e->getMessage();
            }
        }
        public function update($query)
        {
            try{
                $this->conn->query($query);
                return 'Task update successfully';
            }catch (PDOException $e) {
                return 'Update fail' .$e->getMessage();
            }
        }
        public function destroy($query)
        {
            try{
                $this->conn->query($query);
                return 'Task update successfully';
            }catch (PDOException $e) {
                return 'Update fail' .$e->getMessage();
            }
        }

        /**
         * @param mixed $query
         */
        public function show($query){
            try{
                $statement = $this->conn->prepare($query);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_OBJ);
                return $statement->fetch();
            }catch(PDOException $e){
                return 'Login  failed' .$e->getMessage();
            }
        }
    }
?>

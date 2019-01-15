<?php
class Crud
{
    private $database;
    private $connection;

    function __construct(){
        $this->database = "gpib";
        if(!isset($this->connection)){
            $this->connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            if(!$this->connection){
                echo "Cannot connect to database server mongodb";
                exit;
            }
        }
    }

    public function count($command){
        try {
            $cursor = $this->connection->executeCommand($this->database, $command);
            $result = current($cursor->toArray());
            return $result->n;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }

    public function find($table, $query){
        try {
            $result = $this->connection->executeQuery($this->database.".".$table, $query);
            if(!$result){
                return false;
            }
            $rows = array();
            foreach($result as $data){
                $rows[] = $data;
            }
            return $rows;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }

    public function findById($table, $id){
        try {
            $filter = [
                'id' => $id
            ];
            $options = [
                'projection' => [
                    '_id' => 0
                ],
                'limit' => 1
            ]; 
            $query = new MongoDB\Driver\Query($filter, $options);
            $cursor = $this->connection->executeQuery($this->database.".".$table, $query);
            $cursor->setTypeMap(['document' => 'array']);
            $result = current($cursor->toArray());
            return $result;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }

    public function aggregate($command){
        try {
            $result = $this->connection->executeCommand($this->database, $command);
            if(!$result){
                return false;
            }
            $rows = array();
            foreach($result as $data){
                $rows[] = $data;
            }
            return $rows;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }

    public function post($table, $bulk){
        try {
            $result = $this->connection->executeBulkWrite($this->database.".".$table, $bulk);
            return $result->getInsertedCount() >= 1 ? true : false;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }

    public function put($table, $bulk){
        try {
            $result = $this->connection->executeBulkWrite($this->database.".".$table, $bulk);
            return $result->getModifiedCount() >= 1 ? true : false;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }

    public function remove($table, $bulk){
        try {
            $result = $this->connection->executeBulkWrite($this->database.".".$table, $bulk);
            return $result->getDeletedCount() >= 1 ? true : false;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }

    public function removeById($table, $id){
        try {
            $bulk = new MongoDB\Driver\BulkWrite;
            $bulk->delete(['id' => $id]);
            $result = $this->connection->executeBulkWrite($this->database.".".$table, $bulk);
            return $result->getDeletedCount() >= 1 ? true : false;
        } catch (Throwable $t) {
            echo "Error: ".$t->getMessage();
        }
    }
}
?>
<?php
class Category
{
    private $_id;
    private $_title;
    private $_slug;
    private $_type;
    private $_status;
    private $table;

    function __construct(){
        $this->table = "category";
    }

    function setId($id){ 
        $this->_id = $id;
    }
    
    function getId(){ 
        return $this->_id;
    }
    
    function setTitle($title){ 
        $this->_title = $title;
    }
    
    function getTitle(){ 
        return $this->_title;
    }

    function setSlug($slug){ 
        $this->_slug = $slug;
    }
    
    function getSlug(){ 
        return $this->_slug;
    }

    function setType($type){ 
        $this->_type = $type;
    }
    
    function getType(){ 
        return $this->_type;
    }

    function setStatus($status){ 
        $this->_status = $status;
    }
    
    function getStatus(){ 
        return $this->_status;
    }
    
//START FUNCTION FOR ADMIN PAGE
    public function get_all($crud, $type){
        $filter = [
            'type' => $type
        ];
        $options = [
            'projection' => [
                '_id' => 0, 
                'id' => 1, 
                'title' => 1, 
                'status' => 1, 
                'datetime' => 1,
                'timestamp' => 1
            ],
            'sort' => [
                'title' => 1
            ]
        ];
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(!$result){
            return false;
        }
        return $result;
    }

    public function insert_data($crud, $category){
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");

        $query = [
            'id' => $category->_id, 
            'title' => $category->_title, 
            'slug' => $category->_slug, 
            'type' => $category->_type,  
            'status' => (int) $category->_status, 
            'timestamp' => $now, 
            'datetime' => $now
        ];
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($query);
        $result = $crud->post($this->table, $bulk);
        return $result;
    }

    public function update_data($crud, $category){
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            [
                'id' => $category->_id
            ], 
            [
                '$set' => [
                    'title' => $category->_title, 
                    'slug' => $category->_slug,
                    'status' => (int) $category->_status, 
                    'timestamp' => $now
                ]
            ]
        );
        $result = $crud->put($this->table, $bulk);
        return $result;
    }

    public function delete_data($crud, $id){
        return $crud->removeById($this->table, $id);
    }
//END FUNCTION FOR ADMIN PAGE
}
?>
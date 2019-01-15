<?php
class Admin
{
    private $_id;
    private $_name;
    private $_email;
    private $_password;
    private $_repassword;
    private $_salt_hash;
    private $_auth_code;
    private $_status;
    private $_image;
    private $table;
    private $itemPerPageAdmin;

    function __construct(){
        $this->_image = "";
        $this->table = "admin";
        $this->itemPerPageAdmin = 20;
    }

    function setId($id){ 
        $this->_id = $id;
    }
    
    function getId(){ 
        return $this->_id;
    }
    
    function setName($name){ 
        $this->_name = $name;
    }
    
    function getName(){ 
        return $this->_name;
    }

    function setEmail($email){ 
        $this->_email = $email;
    }
    
    function getEmail(){ 
        return $this->_email;
    }

    function setPassword($password){ 
        $this->_password = $password;
    }
    
    function getPassword(){ 
        return $this->_password;
    }

    function setRepassword($repassword){ 
        $this->_repassword = $repassword;
    }
    
    function getRepassword(){ 
        return $this->_repassword;
    }

    function setSaltHash($salt_hash){ 
        $this->_salt_hash = $salt_hash;
    }
    
    function getSaltHash(){ 
        return $this->_salt_hash;
    }

    function setAuthCode($auth_code){ 
        $this->_auth_code = $auth_code;
    }
    
    function getAuthCode(){ 
        return $this->_auth_code;
    }

    function setStatus($status){ 
        $this->_status = $status;
    }
    
    function getStatus(){ 
        return $this->_status;
    }

    function setImage($image){ 
        $this->_image = $image;
    }
    
    function getImage(){ 
        return $this->_image;
    }
    
//START FUNCTION FOR ADMIN PAGE
    public function check_reset_code($crud, $email, $reset_code){
        $filter = [
            'email' => $email, 
            'reset_code' => $reset_code
        ];
        $options = [
            'projection' => [
                '_id' => 0, 
                'id' => 1
            ],
            'limit' => 1
        ]; 
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(!$result){
            return false;
        }
        return is_array($result) ? true : false;
    }

    public function check_code($crud, $id, $auth_code){
        $filter = [
            'id' => $id, 
            'auth_code' => $auth_code
        ];
        $options = [
            'projection' => [
                '_id' => 0, 
                'id' => 1
            ],
            'limit' => 1
        ]; 
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(!$result){
            return false;
        }
        return is_array($result) ? true : false;
    }

    public function check_email($crud, $email){
        $filter = [
            'email' => $email
        ];
        $options = [
            'projection' => [
                '_id' => 0, 
                'email' => 1
            ],
            'limit' => 1
        ]; 
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(!$result){
            return false;
        }
        return is_array($result) ? true : false;
    }

    public function get_salt($crud, $email){
        $filter = [
            'email' => $email
        ];
        $options = [
            'projection' => [
                '_id' => 0, 
                'salt_hash' => 1
            ],
            'limit' => 1
        ]; 
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(!$result){
            return "";
        }
        return is_array($result) ? $result[0]->salt_hash : "";
    }

    public function login($crud, $email, $password){
        $filter = [
            'email' => $email, 
            'password' => $password
        ];
        $options = [
            'projection' => [
                '_id' => 0, 
                'id' => 1, 
                'name' => 1, 
                'email' => 1, 
                'img' => 1, 
                'auth_code' => 1, 
                'status' => 1
            ],
            'limit' => 1
        ]; 
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(!$result){
            return false;
        }
        return is_array($result) ? $result[0] : false;
    }

    public function get_all($crud, $page=1){
        //get total data
        $query_total = [];
        $total_data = $crud->count(
            new MongoDB\Driver\Command([
                'count' => $this->table, 
                'query' => $query_total
            ])
        );

        //get total page
        $total_page  = ceil($total_data / $this->itemPerPageAdmin);
        $limitBefore = $page <= 1 || $page == null ? 0 : ($page-1) * $this->itemPerPageAdmin;

        $filter = [];
        $options = [
            'projection' => [
                '_id' => 0, 
                'id' => 1, 
                'name' => 1, 
                'email' => 1, 
                'img' => 1, 
                'status' => 1,
                'datetime' => 1,
                'timestamp' => 1
            ],
            'sort' => [
                'datetime' => -1
            ],
            'skip' => $limitBefore,
            'limit' => $this->itemPerPageAdmin
        ];
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(!$result){
            return false;
        }else{
            if(is_array($result)){
                $obj = new stdClass;
                $obj->total_page = $total_page;
                $obj->total_data = count($result);
                $obj->total_data_all = $total_data;
                $obj->data = $result;
                $result = $obj;
            }
        }
        return $result;
    }

    public function get_detail($crud, $id){
        return $crud->findById($this->table, $id);
    }

    public function insert_data($crud, $admin){
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");
        
        $query = [
            'id' => $admin->_id, 
            'name' => $admin->_name, 
            'email' => $admin->_email, 
            'password' => $admin->_password, 
            'salt_hash' => $admin->_salt_hash, 
            'reset_code' => "", 
            'auth_code' => $admin->_auth_code, 
            'status' => (int) $admin->_status, 
            'img' => $admin->_image, 
            'timestamp' => $now, 
            'datetime' => $now
        ];
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($query);
        $result = $crud->post($this->table, $bulk);
        return $result;
    }

    public function update_data($crud, $admin, $encrypt, $path){
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            [
                'id' => $admin->_id
            ], 
            [
                '$set' => [
                    'name' => $admin->_name, 
                    'email' => $admin->_email, 
                    'reset_code' => "", 
                    'status' => (int) $admin->_status, 
                    'timestamp' => $now
                ]
            ]
        );
        if($admin->_image != ""){
            $this->remove_image($crud, $admin->_id, $encrypt, $path);
            $bulk->update(['id' => $admin->_id], ['$set' => ['img' => $admin->_image]]);
        }
        $result = $crud->put($this->table, $bulk);
        return $result;
    }

    public function update_reset_code($crud, $email, $reset_code){
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            [
                'email' => $email
            ], 
            [
                '$set' => [
                    'reset_code' => $reset_code, 
                    'timestamp' => $now
                ]
            ]
        );
        $result = $crud->put($this->table, $bulk);
        return $result;
    }

    public function change_password($crud, $id, $password, $salt_hash){
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            [
                'id' => $id
            ], 
            [
                '$set' => [
                    'password' => $password, 
                    'salt_hash' => $salt_hash, 
                    'timestamp' => $now
                ]
            ]
        );
        $result = $crud->put($this->table, $bulk);
        return $result;
    }

    public function reset_password($crud, $email, $reset_code, $password, $salt_hash){
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            [
                'email' => $email, 
                'reset_code' => $reset_code
            ], 
            [
                '$set' => [
                    'password' => $password, 
                    'salt_hash' => $salt_hash, 
                    'reset_code' => "", 
                    'timestamp' => $now
                ]
            ]
        );
        $result = $crud->put($this->table, $bulk);
        return $result;
    }

    public function delete_data($crud, $id, $encrypt, $path){
        $this->remove_image($crud, $id, $encrypt, $path);
        return $crud->removeById($this->table, $id);
    }

    public function remove_image($crud, $id, $encrypt, $path){
        $filter = [
            'id' => $id
        ];
        $options = [
            'projection' => [
                '_id' => 0, 
                'img' => 1
            ]
        ]; 
        $query = new MongoDB\Driver\Query($filter, $options);
        $result = $crud->find($this->table, $query);
        if(is_array($result)){
            foreach($result as $data){
                if($data->img != ""){
                    $deleteImg = $path.$encrypt->encrypt_decrypt("decrypt", $data->img);
                    if(file_exists($deleteImg)){
                        unlink($deleteImg);
                    }
                    $deleteImgThmb = $path."thmb/".$encrypt->encrypt_decrypt("decrypt", $data->img);
                    if(file_exists($deleteImgThmb)){
                        unlink($deleteImgThmb);
                    }
                    $result = true;
                }
            }
        }else{
            $result = false;
        }
        return $result;
    }
//END FUNCTION FOR ADMIN PAGE
}
?>
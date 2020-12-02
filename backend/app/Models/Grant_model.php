<?php
namespace App\Models;

use CodeIgniter\Model;

class Grant_Model extends Model {
    
    protected $table = 'grant';
    
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function add_grants($data_grant, $user_id)
    {
        $data = array();

        foreach ($data_grant as $key => $value) {
            array_push($data, array('user_id'=>$user_id, 'branch_id'=>$value) );
            // $data[] = array('user_id'=>$user_id, 'branch_id'=>$value);
        }

        $builder = $this->db->table($this->table);

        $builder->insertBatch($data);

    }

    public function del_grant($user_id)
    {
        $builder = $this->db->table($this->table);
        $builder->delete(['user_id' => $user_id]);
    }

}
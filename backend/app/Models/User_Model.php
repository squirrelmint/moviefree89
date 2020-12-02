<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\Grant_Model;

class User_Model extends Model {
    
    protected $table = 'user';
    protected $table_grant = 'grant';
    protected $table_branch = 'branch';

    protected $Grant_Model = 'branch';
    
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $this->Grant_Model = new Grant_Model();
    }

    public function add_user_grant($data_user, $data_grant)
    {
        
        $this->db->transBegin();

        $this->add_user($data_user);
        
        $insert_id = $this->db->insertID();

        $this->Grant_Model->add_grants($data_grant, $insert_id);

        if ($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            return false;
        }
        else
        {
            $this->db->transCommit();
            return true;
        }

    }

    public function edit_user_grant($data_user, $data_grant, $id)
    {

        $this->db->transBegin();

        $this->edit_user($data_user, $id);

        $this->Grant_Model->del_grant($id);

        $this->Grant_Model->add_grants($data_grant, $id);

        if ($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            return false;
        }
        else
        {
            $this->db->transCommit();
            return true;
        }
        
    }

    public function edit_user($data, $id){

        $builder = $this->db->table($this->table);

        $builder->where('user_id', $id);

        try {
            if( $builder->update($data)==true ){
                return true;
            }
         }
         catch (\Exception $e)
         {
            // throw new Exception("Error Insert user", 1);
            return $e->getMessage();
                
         }

    }

    public function get_user_id($id)
    {
        $sql = "SELECT
            `$this->table`.user_id,
            `$this->table`.user_name,
            `$this->table`.user_pass,
            `$this->table`.user_label,
            `$this->table`.user_email,
            `$this->table`.user_tel,
            `$this->table`.user_status
            FROM
            `user`
            WHERE
            `$this->table`.user_id = ?";

        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();

    }

    public function delete_user($data, $id)
    {
        $builder = $this->db->table($this->table);
        
        // $data = [
        //         'user_status' => '0'
        // ];

        $builder->where('user_id', $id);

        try {
            if( $builder->update($data)==true ){
                return true;
            }
         }
         catch (\Exception $e)
         {
            // throw new Exception("Error Insert user", 1);
            return $e->getMessage();
                
         }

    }

    public function add_user($data)
    {
        
        $builder = $this->db->table($this->table);

        try {
           if( $builder->insert($data)==true ){
               return true;
           }
        }
        catch (\Exception $e)
        {
           // throw new Exception("Error Insert user", 1);
           return $e->getMessage();
               
        }

    }

    public function count_user_page($search){

        $sql_where = "";

        if ($search!="") {
            $sql_where .= " AND CONCAT_WS('', `$this->table`.user_name, `$this->table`.user_label, `$this->table`.user_email, `$this->table`.user_tel) LIKE '%$search%' ";
        }

        $sql = "SELECT count(user_id) as count_id FROM `$this->table` WHERE 1=1 ".$sql_where.";";
        $query = $this->db->query($sql);
        return $query->getResult()[0]->count_id;

    }

    public function get_user_page($search, $page=1){

        $sql_where = "";

        if ($search!="") {
            $sql_where .= " AND CONCAT_WS('', `$this->table`.user_name, `$this->table`.user_label, `$this->table`.user_email, `$this->table`.user_tel) LIKE '%$search%' ";
        }

        $sql = "SELECT
            `$this->table`.user_id,
            `$this->table`.user_name,
            `$this->table`.user_pass,
            `$this->table`.user_label,
            `$this->table`.user_email,
            `$this->table`.user_tel,
            `$this->table`.user_status,
            GROUP_CONCAT(`$this->table_branch`.branch_id) as groupidlist,
            GROUP_CONCAT(`$this->table_branch`.branch_name) as groupnamelist
            FROM
            `$this->table`
            LEFT JOIN `$this->table_grant` ON `$this->table_grant`.user_id = `$this->table`.user_id
            LEFT JOIN `$this->table_branch` ON `$this->table_grant`.branch_id = `$this->table_branch`.branch_id
            WHERE
            1=1 ".$sql_where."
            GROUP BY `$this->table`.user_id
            ";
            
        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 20;
        
        return get_pagination($sql,$page,$perpage,$total);

    }
    
    public function get_user($data)
    {
        $user_name = $data["user_name"];
        $user_pass = $data["user_pass"];
        
        $sql = "SELECT
            `$this->table`.user_id,
            `$this->table`.user_name,
            `$this->table`.user_pass,
            `$this->table`.user_label,
            `$this->table`.user_email,
            `$this->table`.user_tel,
            `$this->table`.user_status,
            GROUP_CONCAT(`$this->table_grant`.branch_id) as user_system
            FROM
            `user`
            LEFT JOIN `$this->table_grant` ON `$this->table_grant`.user_id = `$this->table`.user_id
            WHERE `$this->table`.user_name = ? AND `$this->table`.user_pass = ? ";
        
        $query = $this->db->query($sql, [$user_name, $user_pass]);

        // echo json_encode($query->getResult());die;
        return $query->getResult();
        
    }

    public function get_branchsystem($user_id, $user_status)
    {

        $wh_uid = "";
        if($user_status!=2){
            $wh_uid .= " INNER JOIN `$this->table_grant` ON `$this->table_grant`.branch_id = `$this->table_branch`.branch_id";
            $wh_uid .= " INNER JOIN `$this->table` ON `$this->table_grant`.user_id = `$this->table`.user_id";
            $wh_uid .= " WHERE `$this->table`.user_id = '$user_id' ";
        }

        $sql = "SELECT
                    $this->table_branch.branch_id,
                    $this->table_branch.branch_system
                FROM
                    `$this->table_branch`
                $wh_uid
                GROUP BY `$this->table_branch`.branch_id
                ";


        $query = $this->db->query($sql);
        $result = $query->getResultArray();

        $resultarray = array();
        if(!empty($result)){
            foreach($result as $val){
                $resultarray['id'.$val['branch_id']] = $val['branch_system'];
            }
        }

        return $resultarray;
    }

    public function get_branchtemplate($user_id)
    {
        $sql =  "SELECT
                    $this->table_branch.branch_id,
                    $this->table_branch.branch_template,
                    `$this->table`.user_id,
                    `$this->table`.user_status
                FROM
                    $this->table_branch
                LEFT JOIN
                    `$this->table_grant` ON $this->table_branch.branch_id = `$this->table_grant`.branch_id AND  `$this->table_grant`.user_id = '$user_id'
                LEFT JOIN `$this->table` ON `$this->table`.user_id = `$this->table_grant`.user_id
                ";
        $query = $this->db->query($sql);
        $result = $query->getResultArray();

        $resultarray = array();
        if(!empty($result)){
            foreach($result as $val){
                if($val['user_status']=='2'){
                    $resultarray = array();
                    foreach($result as $val){
                        $resultarray[$val['branch_id']] = $val['branch_template'];
                    }
                break;
                }else if($val['user_id']==$user_id){
                    $resultarray[$val['branch_id']] = $val['branch_template'];
                }
            }
        }

        // echo $user_id;print_r($resultarray);die;

        return $resultarray;
    }
}
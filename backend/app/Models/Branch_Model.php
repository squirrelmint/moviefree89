<?php
namespace App\Models;

use CodeIgniter\Model;

class Branch_Model extends Model {
    
    protected $table = 'branch';
    protected $table_grant = 'grant';
    private $path_filelogo;
    
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $this->path_filelogo = "logo";
    }

    public function get_branch_id($id)
    {
        $sql = "SELECT
            *
            FROM
            `branch`
            WHERE
            `$this->table`.branch_id = ?";

       
        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();

    }

    public function delete_brach($data, $id)
    {
        $builder = $this->db->table($this->table);

        $builder->where('branch_id', $id);

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

    public function get_branch_all($user_id=0){

        $sql = "SELECT
                    $this->table.branch_id,
                    $this->table.branch_name,
                    $this->table.branch_system,
                    $this->table.branch_logo,
                    $this->table.branch_status,
                    `grant`.user_id
                FROM
                    $this->table
                LEFT JOIN `$this->table_grant` ON `$this->table_grant`.branch_id = $this->table.branch_id
                AND `grant`.user_id = $user_id 
                ORDER BY $this->table.branch_system ASC";

        $query = $this->db->query($sql);
  

        return $query->getResultArray();

    }

    public function count_user_page($search){

        $sql_where = "";

        if ($search!="") {
            $sql_where .= " AND CONCAT_WS('', `$this->table`.branch_id,`$this->table`.branch_name, `$this->table`.branch_system, `$this->table`.branch_status) LIKE '%$search%' ";
        }

        $sql = "SELECT count(branch_id) as count_id FROM `$this->table` WHERE 1=1 ".$sql_where.";";
        $query = $this->db->query($sql);
        return $query->getResult()[0]->count_id;

    }

    public function get_branch_page($search, $page=1){

        $sql_where = "";

        if ($search!="") {
            $sql_where .= " AND CONCAT_WS('', `$this->table`.branch_id,`$this->table`.branch_name, `$this->table`.branch_system, `$this->table`.branch_status) LIKE '%$search%' ";
        }

        $sql = "SELECT
            `$this->table`.branch_id,
            `$this->table`.branch_name,
            `$this->table`.branch_system,
            `$this->table`.branch_status,
            `$this->table`.branch_logo
            FROM
            `$this->table`
            WHERE
            1=1 ".$sql_where."
            GROUP BY `$this->table`.branch_id ";

        $query = $this->db->query($sql);
		$total = count($query->getResultArray());
        $perpage = 20;
        
        return get_pagination($sql,$page,$perpage,$total);
    }

    public function edit_branch($id, $data, $oldlogo, $files)
    {
        
        $builder = $this->db->table($this->table);

        $builder->where('branch_id', $id);

        if ( $files->isValid() ) {

            $data['branch_logo'] = $files->getRandomName();

            if($builder->update($data)==true && $files->move(FCPATH.$this->path_filelogo, $data['branch_logo'])){
                // return redirect()->to('/branch/add');
                if (!empty($files)) {
                    @unlink(set_realpath(FCPATH.$this->path_filelogo."/".$oldlogo));
                }
    
                return true;
            }else{
                return false;
            }

        }else{

            if($builder->update($data)==true){   
                return true;
            }else{
                return false;
            }

        }
 
        
    }

    public function insert_data($data, $files){

        $data['branch_logo'] = $files->getRandomName();

        $bd =  $this->db->table($this->table);
        
   		$params = [
                    'branch_name'=> $data['branch_name'], 
                    'branch_system' => $data['branch_system'],
                    'branch_logo' => $data['branch_logo'],
                    'branch_status' => $data['branch_status']
                ];

     	if($bd->insert($params) && $files->move(FCPATH.$this->path_filelogo, $data['branch_logo'])){
            // return redirect()->to('/branch/add');
            return true;
        }else{
            return false;
        }
    }

    public function update_branchstatus($branch_id, $branch_status)
	{

		$builder = $this->db->table($this->table);

		$data =  [
        	'branch_status' => $branch_status
        ];


		try {
         	$builder->where('branch_id', $branch_id);
			if( $builder->update($data)==true ){
				return "ok";
			}
		}
		catch (\Exception $e)
		{
	       // throw new Exception("Error Update Branch Status", 1);
		        
		}
	}

    
    // public function get_user($data)
    // {
    //     // $user_name = $data["user_name"];
    //     // $user_pass = $data["user_pass"];
        
    //     $sql = "SELECT
    //         `$this->table`.branch_id,
    //         `$this->table`.branch_system,
    //         `$this->table`.branch_status
    //         FROM
    //         -- INNER JOIN `$this->table_grant` ON `$this->table_grant`.user_id = `$this->table`.user_id
    //         -- WHERE `$this->table`.user_name = ? AND `$this->table`.user_pass = ? ";
        
    //     $query = $this->db->query($sql, [$user_name, $user_pass]);

    //     // echo json_encode($query->getResult());die;
    //     return $query->getResult();
        
    // }
}

?>
